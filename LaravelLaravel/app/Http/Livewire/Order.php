<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Order as OrderModel;
use App\Models\Order_Detail;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class Order extends Component
{
    public $products = [];
    public $product_code;
    public $orderItems = [];
    public $customer_name;
    public $customer_phone;
    public $payment_method = 'Cash';
    public $paid_amount = 0;
    public $balance = 0;
    public $total = 0;
    public $showBarcodeScanner = false;
    public $scannerActive = false;
    public $order_receipt = [];
    public $showReceipt = false;
    public $lastOrderId = null;
    public $transactionHistory = [];
    public $salesReport = [];
    public $report_start_date = null;
    public $report_end_date = null;

    protected $listeners = ['productScanned' => 'addProductByBarcode'];

    public function mount()
    {
        $this->products = Product::all();
        $this->addNewRow();
        $this->transactionHistory = Transaction::orderBy('created_at', 'desc')->get();
    }

    public function render()
    {
        $this->calculateTotal();
        return view('livewire.order');
    }

    public function addNewRow()
    {
        $this->orderItems[] = [
            'product_id' => null,
            'quantity' => 1,
            'price' => 0,
            'discount' => 0,
            'total_amount' => 0,
            'available_quantity' => 0,
            'max_quantity' => 0
        ];
    }

    public function removeRow($index)
    {
        if (count($this->orderItems) > 1) {
            unset($this->orderItems[$index]);
            $this->orderItems = array_values($this->orderItems);
        }
    }

    public function updatedOrderItems($value, $key)
    {
        $parts = explode('.', $key);
        $index = $parts[0];
        $field = $parts[1];
        
        if ($field === 'product_id') {
            $product = Product::find($value);
            if ($product) {
                $this->orderItems[$index]['price'] = $product->price;
                $this->orderItems[$index]['available_quantity'] = $product->quantity;
                $this->orderItems[$index]['max_quantity'] = $product->quantity;
            }
        }
        
        if ($field === 'quantity') {
            $this->validateQuantity($index, $value);
        }
        
        $this->calculateRowTotal($index);
    }

    protected function validateQuantity($index, $newQuantity)
    {
        $productId = $this->orderItems[$index]['product_id'];
        if (!$productId) return;
        
        $product = Product::find($productId);
        if (!$product) return;
        
        $currentOrderQty = collect($this->orderItems)
            ->where('product_id', $productId)
            ->sum('quantity');
            
        $currentOrderQty = $currentOrderQty - $this->orderItems[$index]['quantity'] + $newQuantity;
        
        if ($currentOrderQty > $product->quantity) {
            $this->addError('orderItems.'.$index.'.quantity', 'Not enough stock. Available: '.$product->quantity);
            $this->orderItems[$index]['quantity'] = min(
                $this->orderItems[$index]['quantity'],
                $product->quantity
            );
            return false;
        }
        
        foreach ($this->orderItems as $i => $item) {
            if ($item['product_id'] == $productId) {
                $this->orderItems[$i]['max_quantity'] = $product->quantity - ($currentOrderQty - $this->orderItems[$i]['quantity']);
            }
        }
        
        return true;
    }

    private function calculateRowTotal($index)
    {
        if (!isset($this->orderItems[$index])) return;

        $item = $this->orderItems[$index];
        $price = $item['price'] ?? 0;
        $quantity = $item['quantity'] ?? 0;
        $discount = $item['discount'] ?? 0;

        $subtotal = $price * $quantity;
        $discountAmount = $subtotal * ($discount / 100);
        $total = $subtotal - $discountAmount;

        $this->orderItems[$index]['total_amount'] = $total;
    }

    public function calculateTotal()
    {
        $this->total = collect($this->orderItems)->sum('total_amount');
        $this->balance = $this->paid_amount - $this->total;
    }

    public function toggleBarcodeScanner()
    {
        $this->showBarcodeScanner = !$this->showBarcodeScanner;
        if ($this->showBarcodeScanner) {
            $this->dispatchBrowserEvent('startScanner');
        } else {
            $this->dispatchBrowserEvent('stopScanner');
        }
    }

    public function addProductByBarcode($barcode)
    {
        $product = Product::where('product_code', $barcode)->first();
        
        if (!$product) {
            $this->dispatchBrowserEvent('notify', ['type' => 'error', 'message' => 'Product not found!']);
            return;
        }

        foreach ($this->orderItems as $index => $item) {
            if ($item['product_id'] == $product->id) {
                $this->orderItems[$index]['quantity'] += 1;
                $this->calculateRowTotal($index);
                return;
            }
        }

        $this->addNewRow();
        $lastIndex = count($this->orderItems) - 1;
        $this->orderItems[$lastIndex] = [
            'product_id' => $product->id,
            'quantity' => 1,
            'price' => $product->price,
            'discount' => 0,
            'total_amount' => $product->price,
            'available_quantity' => $product->quantity,
            'max_quantity' => $product->quantity
        ];
    }

    public function saveOrder()
    {
        $this->validate([
            'customer_name' => 'required',
            'payment_method' => 'required',
            'paid_amount' => 'required|numeric|min:0',
            'orderItems.*.product_id' => 'required',
            'orderItems.*.quantity' => [
                'required',
                'numeric',
                'min:1',
                function ($attribute, $value, $fail) {
                    $index = explode('.', $attribute)[1];
                    $productId = $this->orderItems[$index]['product_id'];
                    $product = Product::find($productId);
                    
                    if (!$product || $value > $product->quantity) {
                        $fail('Not enough stock for '.$product->product_name);
                    }
                }
            ],
            'orderItems.*.price' => 'required|numeric|min:0',
            'orderItems.*.discount' => 'nullable|numeric|min:0|max:100',
        ]);

        try {
            DB::transaction(function () {
                $order = OrderModel::create([
                    'name' => $this->customer_name,
                    'phone' => $this->customer_phone,
                    'user_id' => auth()->id(),
                ]);

                $this->lastOrderId = $order->id;

                foreach ($this->orderItems as $item) {
                    Order_Detail::create([
                        'order_id' => $order->id,
                        'product_id' => $item['product_id'],
                        'unitprice' => $item['price'],
                        'quantity' => $item['quantity'],
                        'discount' => $item['discount'],
                        'amount' => $item['total_amount'],
                    ]);

                    $product = Product::find($item['product_id']);
                    if ($product) {
                        $product->decrement('quantity', $item['quantity']);
                    }
                }

                Transaction::create([
                    'order_id' => $order->id,
                    'user_id' => auth()->id(),
                    'balance' => $this->balance,
                    'paid_amount' => $this->paid_amount,
                    'payment_method' => $this->payment_method,
                    'transac_amount' => $this->total,
                    'transac_date' => now(),
                ]);

                $this->order_receipt = Order_Detail::where('order_id', $order->id)->get();
                $this->showReceipt = true;
            });

            $this->dispatchBrowserEvent('notify', ['type' => 'success', 'message' => 'Order saved successfully!']);
            $this->dispatchBrowserEvent('print-receipt');
            $this->resetOrder();
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('notify', ['type' => 'error', 'message' => 'Error saving order: ' . $e->getMessage()]);
        }
    }

    public function printReceipt()
    {
        if (!$this->lastOrderId) {
            $this->dispatchBrowserEvent('notify', ['type' => 'error', 'message' => 'No order to print']);
            return;
        }

        $this->order_receipt = Order_Detail::where('order_id', $this->lastOrderId)->get();
        $this->showReceipt = true;
        $this->dispatchBrowserEvent('print-receipt');
    }

    public function resetOrder()
    {
        $this->orderItems = [];
        $this->addNewRow();
        $this->customer_name = '';
        $this->customer_phone = '';
        $this->paid_amount = 0;
        $this->payment_method = 'Cash';
        $this->total = 0;
        $this->balance = 0;
        $this->showReceipt = false;
        $this->lastOrderId = null;
    }

    public function generateReport()
    {
        $startDate = $this->report_start_date ? \Carbon\Carbon::parse($this->report_start_date)->startOfDay() : null;
        $endDate = $this->report_end_date ? \Carbon\Carbon::parse($this->report_end_date)->endOfDay() : null;

        $this->salesReport = Transaction::selectRaw('DATE(transac_date) as date, SUM(transac_amount) as total_sales, COUNT(*) as transaction_count')
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                return $query->whereBetween('transac_date', [$startDate, $endDate]);
            })
            ->groupBy('date')
            ->get();
    }
}