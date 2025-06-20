@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-plus-circle mr-2"></i>
                        {{ isset($transaction) ? 'Edit Transaction' : 'Create New Transaction' }}
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ isset($transaction) ? route('transactions.update', $transaction->id) : route('transactions.store') }}" method="POST">
                        @csrf
                        @if(isset($transaction))
                            @method('PUT')
                        @endif
                        
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="order_id">Order ID</label>
                                <select class="form-control @error('order_id') is-invalid @enderror" 
                                        id="order_id" name="order_id" required
                                        {{ isset($transaction) ? 'disabled' : '' }}>
                                    <option value="">Select Order</option>
                                    @foreach($orders as $order)
                                        <option value="{{ $order->id }}"
                                            {{ (isset($transaction) && $transaction->order_id == $order->id) || old('order_id') == $order->id ? 'selected' : '' }}>
                                            Order #{{ $order->id }} ({{ $order->customer->name ?? 'N/A' }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('order_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label for="payment_method">Payment Method</label>
                                <select class="form-control @error('payment_method') is-invalid @enderror" 
                                        id="payment_method" name="payment_method" required>
                                    <option value="">Select Method</option>
                                    <option value="credit_card" {{ (isset($transaction) && $transaction->payment_method == 'credit_card') || old('payment_method') == 'credit_card' ? 'selected' : '' }}>Credit Card</option>
                                    <option value="bank_transfer" {{ (isset($transaction) && $transaction->payment_method == 'bank_transfer') || old('payment_method') == 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                                    <option value="cash" {{ (isset($transaction) && $transaction->payment_method == 'cash') || old('payment_method') == 'cash' ? 'selected' : '' }}>Cash</option>
                                    <option value="paypal" {{ (isset($transaction) && $transaction->payment_method == 'paypal') || old('payment_method') == 'paypal' ? 'selected' : '' }}>PayPal</option>
                                </select>
                                @error('payment_method')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="paid_amount">Paid Amount</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input type="number" step="0.01" min="0" 
                                           class="form-control @error('paid_amount') is-invalid @enderror" 
                                           id="paid_amount" name="paid_amount" 
                                           value="{{ old('paid_amount', $transaction->paid_amount ?? '') }}" required>
                                </div>
                                @error('paid_amount')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="form-group col-md-4">
                                <label for="balance">Balance</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input type="number" step="0.01" 
                                           class="form-control @error('balance') is-invalid @enderror" 
                                           id="balance" name="balance" 
                                           value="{{ old('balance', $transaction->balance ?? '0') }}" required>
                                </div>
                                @error('balance')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="form-group col-md-4">
                                <label for="status">Status</label>
                                <select class="form-control @error('status') is-invalid @enderror" 
                                        id="status" name="status" required>
                                    <option value="completed" {{ (isset($transaction) && $transaction->status == 'completed') || old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="pending" {{ (isset($transaction) && $transaction->status == 'pending') || old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="failed" {{ (isset($transaction) && $transaction->status == 'failed') || old('status') == 'failed' ? 'selected' : '' }}>Failed</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="transac_date">Transaction Date</label>
                                <input type="datetime-local" 
                                       class="form-control @error('transac_date') is-invalid @enderror" 
                                       id="transac_date" name="transac_date" 
                                       value="{{ old('transac_date', isset($transaction) ? \Carbon\Carbon::parse($transaction->transac_date)->format('Y-m-d\TH:i') : '') }}" required>
                                @error('transac_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="notes">Notes</label>
                            <textarea class="form-control @error('notes') is-invalid @enderror" 
                                      id="notes" name="notes" rows="3">{{ old('notes', $transaction->notes ?? '') }}</textarea>
                            @error('notes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group text-right">
                            <a href="{{ route('transactions.index') }}" class="btn btn-secondary mr-2">
                                <i class="fas fa-times mr-1"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save mr-1"></i> 
                                {{ isset($transaction) ? 'Update Transaction' : 'Create Transaction' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Auto-calculate balance if order is selected (optional)
        $('#order_id').change(function() {
            const orderId = $(this).val();
            if (orderId) {
                // You would typically make an AJAX call here to get order details
                // For example:
                // $.get(`/api/orders/${orderId}`, function(data) {
                //     const total = data.total_amount;
                //     $('#paid_amount').val(total);
                //     $('#balance').val(0);
                // });
            }
        });
        
        // Calculate balance when paid amount changes
        $('#paid_amount').change(function() {
            // This is a simplified version - you'd typically get the order total first
            const paidAmount = parseFloat($(this).val()) || 0;
            const orderTotal = 100; // This should come from order data
            $('#balance').val((orderTotal - paidAmount).toFixed(2));
        });
    });
</script>
@endsection