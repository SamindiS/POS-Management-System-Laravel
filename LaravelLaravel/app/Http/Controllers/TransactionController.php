<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Transaction::query();
        
        // Apply filters
        if ($request->has('order_id') && $request->order_id != '') {
            $query->where('order_id', $request->order_id);
        }
        
        if ($request->has('payment_method') && $request->payment_method != '') {
            $query->where('payment_method', $request->payment_method);
        }
        
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }
        
        if ($request->has('start_date') && $request->start_date != '') {
            $query->whereDate('transac_date', '>=', $request->start_date);
        }
        
        if ($request->has('end_date') && $request->end_date != '') {
            $query->whereDate('transac_date', '<=', $request->end_date);
        }
        
        // Get summary statistics
        $totalTransactions = $query->count();
        $totalAmount = $query->sum('paid_amount');
        $averageTransaction = $totalTransactions > 0 ? $totalAmount / $totalTransactions : 0;
        $pendingBalance = $query->sum('balance');
        
        // Paginate results
        $transactions = $query->latest('transac_date')->paginate(15);
        
        return view('transactions.index', compact(
            'transactions',
            'totalTransactions',
            'totalAmount',
            'averageTransaction',
            'pendingBalance'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('transactions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'paid_amount' => 'required|numeric|min:0',
            'balance' => 'required|numeric',
            'payment_method' => 'required|in:credit_card,bank_transfer,cash,paypal',
            'transac_date' => 'required|date',
            'status' => 'required|in:completed,pending,failed',
            'notes' => 'nullable|string|max:500',
        ]);
        
        try {
            DB::beginTransaction();
            
            $transaction = Transaction::create($validated);
            
            // Here you might want to update the order status or other related models
            // For example:
            // $order = Order::find($validated['order_id']);
            // $order->updatePaymentStatus();
            
            DB::commit();
            
            return redirect()
                ->route('transactions.show', $transaction->id)
                ->with('success', 'Transaction created successfully!');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return back()
                ->withInput()
                ->with('error', 'Error creating transaction: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
         return view('transactions.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
          return view('transactions.edit', compact('transaction'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        $validated = $request->validate([
            'paid_amount' => 'required|numeric|min:0',
            'balance' => 'required|numeric',
            'payment_method' => 'required|in:credit_card,bank_transfer,cash,paypal',
            'transac_date' => 'required|date',
            'status' => 'required|in:completed,pending,failed',
            'notes' => 'nullable|string|max:500',
        ]);
        
        try {
            DB::beginTransaction();
            
            $transaction->update($validated);
            
            // Update related models if needed
            // $order = $transaction->order;
            // $order->updatePaymentStatus();
            
            DB::commit();
            
            return redirect()
                ->route('transactions.show', $transaction->id)
                ->with('success', 'Transaction updated successfully!');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return back()
                ->withInput()
                ->with('error', 'Error updating transaction: ' . $e->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        try {
            DB::beginTransaction();
            
            $transaction->delete();
            
            // Update related models if needed
            // $order = $transaction->order;
            // $order->updatePaymentStatus();
            
            DB::commit();
            
            return redirect()
                ->route('transactions.index')
                ->with('success', 'Transaction deleted successfully!');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return back()
                ->with('error', 'Error deleting transaction: ' . $e->getMessage());
        }
    }
}
