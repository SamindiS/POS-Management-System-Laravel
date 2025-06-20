<div>
    <div class="container-fluid">
        <div class="row">
            <!-- Product Table -->
            <div class="col-lg-8 col-md-7">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-primary text-white fw-bold d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"><i class="fas fa-shopping-cart mr-2"></i> Order Products</h5>
                        <div class="btn-group btn-group-sm">
                            <button type="button" class="btn btn-light {{ !$showBarcodeScanner ? 'active' : '' }}" 
                                wire:click="$set('showBarcodeScanner', false)">
                                <i class="fas fa-keyboard mr-1"></i> Manual
                            </button>
                            <button type="button" class="btn btn-light {{ $showBarcodeScanner ? 'active' : '' }}" 
                                wire:click="toggleBarcodeScanner">
                                <i class="fas fa-barcode mr-1"></i> Barcode
                            </button>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <!-- Barcode Scanner Section -->
                        @if($showBarcodeScanner)
                        <div class="barcode-section mb-4 p-3 bg-light rounded">
                            <div class="input-group">
                                <input type="text" wire:model="product_code" class="form-control form-control-lg" 
                                    placeholder="Scan barcode or enter manually" 
                                    wire:keydown.enter="addProductByBarcode($event.target.value)">
                                <button class="btn btn-dark" type="button" wire:click="toggleBarcodeScanner">
                                    <i class="fas fa-camera mr-1"></i> {{ $scannerActive ? 'Stop' : 'Camera' }}
                                </button>
                            </div>
                            <div class="camera-preview mt-3 text-center bg-dark p-2 rounded">
                                <video id="barcodeScanner" width="100%" height="200" style="border-radius: 4px;"></video>
                            </div>
                        </div>
                        @endif

                        <!-- Order Items Table -->
                        <div class="manual-entry-section">
                            <div class="input-group mb-3">
                                <input type="text" wire:model="product_code" class="form-control form-control-lg" 
                                    placeholder="Enter Product Code" 
                                    wire:keydown.enter="addProductByBarcode($event.target.value)">
                                <button class="btn btn-success" type="button" wire:click="addNewRow">
                                    <i class="fas fa-plus-circle mr-1"></i> Add Item
                                </button>
                            </div>
                            
                            <div class="table-responsive rounded" style="max-height: 400px; overflow-y: auto;">
                                <table class="table table-hover table-bordered mb-0">
                                    <thead class="table-dark">
                                        <tr>
                                            <th width="5%">#</th>
                                            <th width="35%">Product</th>
                                            <th width="10%">Qty</th>
                                            <th width="15%">Price</th>
                                            <th width="10%">Disc.</th>
                                            <th width="15%">Total</th>
                                            <th width="10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($orderItems as $index => $item)
                                        <tr class="{{ $index % 2 === 0 ? 'bg-light' : 'bg-white' }}">
                                            <td class="align-middle">{{ $index + 1 }}</td>
                                            <td>
                                                <select class="form-select select2" wire:model="orderItems.{{ $index }}.product_id">
                                                    <option value="" selected disabled>Select Product</option>
                                                    @foreach ($products as $product)
                                                    <option value="{{ $product->id }}" data-price="{{ $product->price }}"
                                                        {{ $orderItems[$index]['product_id'] == $product->id ? 'selected' : '' }}>
                                                        {{ $product->product_name }} ({{ $product->product_code }})
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <div class="input-group">
                                                    <input 
                                                        type="number" 
                                                        class="form-control @error('orderItems.'.$index.'.quantity') is-invalid @enderror" 
                                                        min="1" 
                                                        wire:model="orderItems.{{ $index }}.quantity"
                                                        @if(isset($orderItems[$index]['max_quantity']))
                                                            max="{{ $orderItems[$index]['max_quantity'] }}"
                                                        @endif
                                                    >
                                                </div>
                                                @error('orderItems.'.$index.'.quantity')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                @if(isset($orderItems[$index]['available_quantity']))
                                                    <small class="text-muted">
                                                        Available: {{ $orderItems[$index]['available_quantity'] }}
                                                    </small>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="input-group">
                                                    <span class="input-group-text">රු.</span>
                                                    <input type="text" class="form-control text-end" 
                                                        wire:model="orderItems.{{ $index }}.price" readonly>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group">
                                                    <input type="number" class="form-control" min="0" max="100" 
                                                        wire:model="orderItems.{{ $index }}.discount">
                                                    <span class="input-group-text">%</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group">
                                                    <span class="input-group-text">රු.</span>
                                                    <input type="text" class="form-control text-end fw-bold" 
                                                        wire:model="orderItems.{{ $index }}.total_amount" readonly>
                                                </div>
                                            </td>
                                            <td class="text-center align-middle">
                                                <button type="button" class="btn btn-sm btn-danger" 
                                                    wire:click="removeRow({{ $index }})">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Sidebar: Total & Payment -->
            <div class="col-md-4">
                <div class="card border-0 shadow-sm sticky-top" style="top: 20px;">
                    <div class="card-header bg-success text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">Order Summary</h4>
                            <h4 class="mb-0">රු. {{ number_format($total, 2) }}</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Quick Action Buttons -->
                        <div class="d-grid gap-2 mb-4">
                            <div class="btn-group">
                                <button type="button" class="btn btn-dark" wire:click="printReceipt">
                                    <i class="fas fa-print mr-1"></i> Print
                                </button>
                                <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#historyModal">
                                    <i class="fas fa-history mr-1"></i> History
                                </button>
                                <button type="button" class="btn btn-warning">
                                    <i class="fas fa-file-alt mr-1"></i> Report
                                </button>
                            </div>
                        </div>
                        
                        <!-- Customer Information -->
                        <div class="mb-4">
                            <h5 class="border-bottom pb-2 mb-3"><i class="fas fa-user mr-2"></i> Customer Details</h5>
                            <div class="mb-3">
                                <label class="form-label">Customer Name</label>
                                <input type="text" class="form-control" wire:model="customer_name" placeholder="Walk-in Customer">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Customer Phone</label>
                                <div class="input-group">
                                    <span class="input-group-text">+94</span>
                                    <input type="text" class="form-control" wire:model="customer_phone" placeholder="77 123 4567">
                                </div>
                            </div>
                        </div>
                        
                        <!-- Payment Information -->
                        <div class="mb-4">
                            <h5 class="border-bottom pb-2 mb-3"><i class="fas fa-credit-card mr-2"></i> Payment Method</h5>
                            <div class="btn-group-vertical w-100 mb-3">
                                <button type="button" class="btn btn-outline-success text-start py-2 {{ $payment_method === 'Cash' ? 'active' : '' }}" 
                                    wire:click="$set('payment_method', 'Cash')">
                                    <i class="fas fa-money-bill-wave mr-2"></i> Cash Payment
                                </button>
                                <button type="button" class="btn btn-outline-primary text-start py-2 {{ $payment_method === 'Bank Transfer' ? 'active' : '' }}" 
                                    wire:click="$set('payment_method', 'Bank Transfer')">
                                    <i class="fas fa-university mr-2"></i> Bank Transfer
                                </button>
                                <button type="button" class="btn btn-outline-info text-start py-2 {{ $payment_method === 'Credit Card' ? 'active' : '' }}" 
                                    wire:click="$set('payment_method', 'Credit Card')">
                                    <i class="fas fa-credit-card mr-2"></i> Credit Card
                                </button>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Amount Paid</label>
                                <div class="input-group">
                                    <span class="input-group-text">රු.</span>
                                    <input type="number" class="form-control form-control-lg text-end fw-bold" 
                                        wire:model="paid_amount" placeholder="0.00">
                                </div>
                            </div>
                            
                            <div class="alert alert-info d-flex align-items-center">
                                <i class="fas fa-info-circle fa-2x me-3"></i>
                                <div>
                                    <h5 class="mb-1">Balance: රු. {{ number_format($balance, 2) }}</h5>
                                    <small class="mb-0">Change to return to customer</small>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Action Buttons -->
                        <div class="d-grid gap-2">
                            <button type="button" class="btn btn-primary btn-lg py-3" wire:click="saveOrder">
                                <i class="fas fa-save mr-2"></i> Complete Order
                            </button>
                            <button type="button" class="btn btn-secondary btn-lg py-3" data-bs-toggle="modal" data-bs-target="#calculatorModal">
                                <i class="fas fa-calculator mr-2"></i> Open Calculator
                            </button>
                            <a href="{{ route('home') }}" class="btn btn-outline-danger">
                                <i class="fas fa-sign-out-alt mr-2"></i> Exit POS
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Receipt Modal -->
    @if($showReceipt)
    <div class="modal fade show" id="receiptModal" tabindex="-1" aria-labelledby="receiptModalLabel" aria-modal="true" role="dialog" style="display: block;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="receiptModalLabel">Order Receipt #{{ $order_receipt->first()->order_id ?? '' }}</h5>
                    <button type="button" class="btn-close btn-close-white" wire:click="$set('showReceipt', false)"></button>
                </div>
                <div class="modal-body p-0">
                    @include('reports.receipt', [
                        'order_receipt' => $order_receipt,
                        'orders' => collect([(object)[
                            'id' => $order_receipt->first()->order_id,
                            'name' => $this->customer_name,
                            'phone' => $this->customer_phone
                        ]]),
                        'total_amount' => $this->total,
                        'paid_amount' => $this->paid_amount,
                        'balance' => $this->balance
                    ])
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="$set('showReceipt', false)">
                        <i class="fas fa-times mr-1"></i> Close
                    </button>
                    <button type="button" class="btn btn-primary" onclick="printReceiptContent()">
                        <i class="fas fa-print mr-1"></i> Print Receipt
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-backdrop fade show"></div>
    @endif

    @push('styles')
    <style>
        /* Custom Styles */
        .card {
            border-radius: 10px;
            overflow: hidden;
        }
        
        .table thead th {
            position: sticky;
            top: 0;
            background-color: #2c3e50;
            color: white;
            z-index: 10;
        }
        
        .table tbody tr:hover {
            background-color: rgba(52, 152, 219, 0.1) !important;
        }
        
        .input-group-text {
            background-color: #f8f9fa;
        }
        
        .btn-outline-success.active, .btn-outline-primary.active, .btn-outline-info.active {
            color: white !important;
        }
        
        .select2-container .select2-selection--single {
            height: 38px;
            border-radius: 4px;
            border: 1px solid #ced4da;
        }
        
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 36px;
        }
        
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 36px;
        }
        
        /* Animation for new items */
        @keyframes highlight {
            from { background-color: #d4edda; }
            to { background-color: transparent; }
        }
        
        .highlight {
            animation: highlight 2s;
        }
    </style>
    @endpush

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/quagga/dist/quagga.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        document.addEventListener('livewire:load', function() {
            // Initialize Select2
            $('.select2').select2({
                placeholder: "Select Product",
                allowClear: true
            }).on('change', function() {
                let model = $(this).attr('wire:model');
                let value = $(this).val();
                Livewire.set(model, value);
            });
            
            // Barcode scanner
            Livewire.on('startScanner', () => {
                Quagga.init({
                    inputStream: {
                        name: "Live",
                        type: "LiveStream",
                        target: document.querySelector('#barcodeScanner'),
                        constraints: {
                            width: 300,
                            height: 200,
                            facingMode: "environment"
                        },
                    },
                    decoder: {
                        readers: ["ean_reader", "ean_8_reader", "code_128_reader", "upc_reader", "upc_e_reader"]
                    },
                }, function(err) {
                    if (err) {
                        console.error(err);
                        Livewire.emit('notify', {type: 'error', message: 'Error initializing barcode scanner'});
                        return;
                    }
                    Quagga.start();
                    Livewire.set('scannerActive', true);
                });
                
                Quagga.onDetected(function(result) {
                    const code = result.codeResult.code;
                    Livewire.emit('productScanned', code);
                });
            });

            Livewire.on('stopScanner', () => {
                if (Quagga) {
                    Quagga.stop();
                    Livewire.set('scannerActive', false);
                }
            });

            Livewire.on('print-receipt', () => {
                setTimeout(() => {
                    printReceiptContent();
                }, 500);
            });

            Livewire.on('notify', (data) => {
                Toastify({
                    text: data.message,
                    duration: 3000,
                    close: true,
                    gravity: "top",
                    position: "right",
                    backgroundColor: data.type === 'success' ? "#28a745" : "#dc3545",
                }).showToast();
            });
            
            // Highlight new rows
            Livewire.on('rowAdded', (index) => {
                $(`tr:nth-child(${index + 1})`).addClass('highlight');
            });
        });

        function printReceiptContent() {
            let printContent = document.getElementById('receipt').innerHTML;
            let originalContent = document.body.innerHTML;
            
            document.body.innerHTML = printContent;
            window.print();
            document.body.innerHTML = originalContent;
            
            Livewire.emit('closeReceiptModal');
        }
    </script>
    @endpush
</div>