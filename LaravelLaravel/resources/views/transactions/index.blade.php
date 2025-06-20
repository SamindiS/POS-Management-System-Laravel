@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-exchange-alt mr-2"></i>Transaction Management</h5>
                    <div>
                        <a href="{{ route('transactions.create') }}" class="btn btn-light btn-sm">
                            <i class="fas fa-plus-circle"></i> New Transaction
                        </a>
                        <button class="btn btn-light btn-sm ml-2" data-toggle="modal" data-target="#filterModal">
                            <i class="fas fa-filter"></i> Filter
                        </button>
                        @if(request()->hasAny(['order_id', 'payment_method', 'start_date', 'end_date']))
                            <a href="{{ route('transactions.index') }}" class="btn btn-warning btn-sm ml-2">
                                <i class="fas fa-times"></i> Clear Filters
                            </a>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <!-- Success/Error Messages -->
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert">
                                <span>&times;</span>
                            </button>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show">
                            <i class="fas fa-exclamation-triangle mr-2"></i>
                            <ul class="mb-0 pl-3">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="close" data-dismiss="alert">
                                <span>&times;</span>
                            </button>
                        </div>
                    @endif

                    <!-- Summary Cards -->
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="card border-left-success shadow-sm h-100 py-2">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Total Transactions</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalTransactions }}</div>
                                        </div>
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-list text-white"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card border-left-primary shadow-sm h-100 py-2">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total Amount</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($totalAmount, 2) }}</div>
                                        </div>
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-dollar-sign text-white"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card border-left-info shadow-sm h-100 py-2">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                Average Transaction</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($averageTransaction, 2) }}</div>
                                        </div>
                                        <div class="icon-circle bg-info">
                                            <i class="fas fa-calculator text-white"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card border-left-warning shadow-sm h-100 py-2">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Pending Balance</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($pendingBalance, 2) }}</div>
                                        </div>
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-clock text-white"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Transactions Table -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="transactionsTable">
                            <thead class="thead-light">
                                <tr>
                                    <th width="5%">ID</th>
                                    <th width="15%">Order ID</th>
                                    <th width="12%">Paid Amount</th>
                                    <th width="12%">Balance</th>
                                    <th width="15%">Payment Method</th>
                                    <th width="15%">Date</th>
                                    <th width="15%">Status</th>
                                    <th width="11%">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($transactions as $transaction)
                                <tr>
                                    <td>{{ $transaction->id }}</td>
                                    <td>
                                        <a href="{{ route('orders.show', $transaction->order_id) }}" class="text-primary">
                                            #{{ $transaction->order_id }}
                                        </a>
                                    </td>
                                    <td class="text-right">{{ number_format($transaction->paid_amount, 2) }}</td>
                                    <td class="text-right {{ $transaction->balance > 0 ? 'text-danger' : 'text-success' }}">
                                        {{ number_format($transaction->balance, 2) }}
                                    </td>
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
                                    <td>{{ \Carbon\Carbon::parse($transaction->transac_date)->format('M d, Y H:i') }}</td>
                                    <td>
                                        <span class="badge badge-pill 
                                            @if($transaction->status == 'completed') badge-success
                                            @elseif($transaction->status == 'pending') badge-warning
                                            @elseif($transaction->status == 'failed') badge-danger
                                            @else badge-secondary @endif">
                                            {{ ucfirst($transaction->status) }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a href="{{ route('transactions.show', $transaction->id) }}" 
                                               class="btn btn-info" title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('transactions.edit', $transaction->id) }}" 
                                               class="btn btn-warning" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-danger delete-btn" 
                                                    data-id="{{ $transaction->id }}" title="Delete">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted py-4">No transactions found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div class="text-muted">
                            Showing {{ $transactions->firstItem() }} to {{ $transactions->lastItem() }} of {{ $transactions->total() }} entries
                        </div>
                        <div>
                            {{ $transactions->withQueryString()->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Filter Modal -->
<div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="filterModalLabel">Filter Transactions</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('transactions.index') }}" method="GET">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="order_id">Order ID</label>
                        <input type="text" class="form-control" id="order_id" name="order_id" 
                               value="{{ request('order_id') }}" placeholder="Enter order ID">
                    </div>
                    <div class="form-group">
                        <label for="payment_method">Payment Method</label>
                        <select class="form-control" id="payment_method" name="payment_method">
                            <option value="">All Methods</option>
                            <option value="credit_card" {{ request('payment_method') == 'credit_card' ? 'selected' : '' }}>Credit Card</option>
                            <option value="bank_transfer" {{ request('payment_method') == 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                            <option value="cash" {{ request('payment_method') == 'cash' ? 'selected' : '' }}>Cash</option>
                            <option value="paypal" {{ request('payment_method') == 'paypal' ? 'selected' : '' }}>PayPal</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status">
                            <option value="">All Statuses</option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>Failed</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Date Range</label>
                        <div class="input-daterange input-group">
                            <input type="date" class="form-control" name="start_date" 
                                   value="{{ request('start_date') }}" max="{{ date('Y-m-d') }}">
                            <div class="input-group-append">
                                <span class="input-group-text">to</span>
                            </div>
                            <input type="date" class="form-control" name="end_date" 
                                   value="{{ request('end_date') }}" max="{{ date('Y-m-d') }}">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Apply Filters</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Confirm Deletion</h5>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this transaction? This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Delete button handler
        $('.delete-btn').click(function() {
            const id = $(this).data('id');
            $('#deleteForm').attr('action', `/transactions/${id}`);
            $('#deleteModal').modal('show');
        });

        // Initialize datepicker if needed
        $('.input-daterange').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true
        });

        // DataTable initialization if needed
        $('#transactionsTable').DataTable({
            responsive: true,
            dom: '<"top"f>rt<"bottom"lip><"clear">',
            paging: false,
            searching: false,
            info: false,
            order: [[5, 'desc']]
        });
    });
</script>
@endsection

@section('styles')
<style>
    .card-header {
        border-radius: 0.35rem 0.35rem 0 0 !important;
    }
    
    .icon-circle {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 100%;
    }
    
    .table th {
        white-space: nowrap;
        position: relative;
    }
    
    .table td {
        vertical-align: middle;
    }
    
    .badge-pill {
        padding: 0.35em 0.65em;
        font-weight: 500;
    }
    
    .btn-group-sm > .btn {
        padding: 0.25rem 0.5rem;
    }
    
    .text-right {
        text-align: right !important;
    }
    
    .text-center {
        text-align: center !important;
    }
    
    .table-hover tbody tr:hover {
        background-color: rgba(0, 0, 0, 0.03);
    }
    
    .alert {
        border-left: 4px solid;
    }
</style>
@endsection