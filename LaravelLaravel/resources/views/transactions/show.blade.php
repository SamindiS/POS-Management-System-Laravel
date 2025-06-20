@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-receipt mr-2"></i>
                        Transaction Details - #{{ $transaction->id }}
                    </h5>
                    <div>
                        <a href="{{ route('transactions.edit', $transaction->id) }}" class="btn btn-light btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <button class="btn btn-light btn-sm ml-2 print-btn">
                            <i class="fas fa-print"></i> Print
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6 class="text-primary">Transaction Information</h6>
                            <table class="table table-sm table-borderless">
                                <tr>
                                    <th width="40%">Transaction ID:</th>
                                    <td>#{{ $transaction->id }}</td>
                                </tr>
                                <tr>
                                    <th>Order ID:</th>
                                    <td>
                                        <a href="{{ route('orders.show', $transaction->order_id) }}" class="text-primary">
                                            #{{ $transaction->order_id }}
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Date:</th>
                                    <td>{{ \Carbon\Carbon::parse($transaction->transac_date)->format('M d, Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Status:</th>
                                    <td>
                                        <span class="badge badge-pill 
                                            @if($transaction->status == 'completed') badge-success
                                            @elseif($transaction->status == 'pending') badge-warning
                                            @elseif($transaction->status == 'failed') badge-danger
                                            @else badge-secondary @endif">
                                            {{ ucfirst($transaction->status) }}
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-primary">Payment Details</h6>
                            <table class="table table-sm table-borderless">
                                <tr>
                                    <th width="40%">Payment Method:</th>
                                    <td>
                                        <span class="badge badge-pill 
                                            @if($transaction->payment_method == 'credit_card') badge-primary
                                            @elseif($transaction->payment_method == 'bank_transfer') badge-info
                                            @elseif($transaction->payment_method == 'cash') badge-success
                                            @elseif($transaction->payment_method == 'paypal') badge-warning
                                            @else badge-secondary @endif">
                                            {{ ucfirst(str_replace('_', ' ', $transaction->payment_method)) }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Paid Amount:</th>
                                    <td>${{ number_format($transaction->paid_amount, 2) }}</td>
                                </tr>
                                <tr>
                                    <th>Balance:</th>
                                    <td class="{{ $transaction->balance > 0 ? 'text-danger' : 'text-success' }}">
                                        ${{ number_format($transaction->balance, 2) }}
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-12">
                            <h6 class="text-primary">Additional Information</h6>
                            <div class="card bg-light">
                                <div class="card-body">
                                    @if($transaction->notes)
                                        {!! nl2br(e($transaction->notes)) !!}
                                    @else
                                        <p class="text-muted mb-0">No additional notes provided.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mt-4">
                        <div class="col-12">
                            <h6 class="text-primary">Transaction History</h6>
                            <div class="table-responsive">
                                <table class="table table-sm table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Action</th>
                                            <th>Changed By</th>
                                            <th>Changes</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($transaction->audits as $audit)
                                        <tr>
                                            <td>{{ $audit->created_at->format('M d, Y H:i') }}</td>
                                            <td>{{ ucfirst($audit->event) }}</td>
                                            <td>{{ $audit->user->name ?? 'System' }}</td>
                                            <td>
                                                @foreach($audit->getModified() as $attribute => $modified)
                                                    <strong>{{ $attribute }}:</strong> 
                                                    {{ $modified['old'] ?? 'NULL' }} → 
                                                    {{ $modified['new'] ?? 'NULL' }}<br>
                                                @endforeach
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-muted">
                                                No history available
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <small class="text-muted">
                        Created: {{ $transaction->created_at->format('M d, Y H:i') }} | 
                        Last Updated: {{ $transaction->updated_at->format('M d, Y H:i') }}
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Print button functionality
        $('.print-btn').click(function() {
            window.print();
        });
    });
</script>
@endsection

@section('styles')
<style>
    @media print {
        body * {
            visibility: hidden;
        }
        .card, .card * {
            visibility: visible;
        }
        .card {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            border: none;
            box-shadow: none;
        }
        .card-header {
            background-color: white !important;
            color: black !important;
            border-bottom: 2px solid #000;
        }
        .btn {
            display: none !important;
        }
    }
</style>
@endsection