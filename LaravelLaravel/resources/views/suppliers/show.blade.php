@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-truck mr-2"></i>
                        Supplier Details - {{ $supplier->supplier_name }}
                    </h5>
                    <div>
                        <a href="{{ route('suppliers.edit', $supplier->id) }}" class="btn btn-light btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <button class="btn btn-light btn-sm ml-2 print-btn">
                            <i class="fas fa-print"></i> Print
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Success/Error Messages -->
                    @include('partials.alerts')
                    
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="card mb-4">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0 text-primary">Supplier Information</h6>
                                </div>
                                <div class="card-body">
                                    <table class="table table-sm table-borderless">
                                        <tr>
                                            <th width="40%">Supplier ID:</th>
                                            <td>#{{ $supplier->id }}</td>
                                        </tr>
                                        <tr>
                                            <th>Supplier Name:</th>
                                            <td>{{ $supplier->supplier_name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Contact Person:</th>
                                            <td>{{ $supplier->contact_person ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Status:</th>
                                            <td>
                                                <span class="badge badge-pill badge-{{ $supplier->is_active ? 'success' : 'danger' }}">
                                                    {{ $supplier->is_active ? 'Active' : 'Inactive' }}
                                                </span>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            
                            <div class="card">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0 text-primary">Contact Details</h6>
                                </div>
                                <div class="card-body">
                                    <table class="table table-sm table-borderless">
                                        <tr>
                                            <th width="40%">Phone:</th>
                                            <td>{{ $supplier->phone }}</td>
                                        </tr>
                                        <tr>
                                            <th>Email:</th>
                                            <td>
                                                @if($supplier->email)
                                                    <a href="mailto:{{ $supplier->email }}">{{ $supplier->email }}</a>
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Website:</th>
                                            <td>
                                                @if($supplier->website)
                                                    <a href="{{ $supplier->website }}" target="_blank">{{ $supplier->website }}</a>
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Tax ID:</th>
                                            <td>{{ $supplier->tax_id ?? 'N/A' }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0 text-primary">Address Information</h6>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <h6 class="text-muted">Full Address</h6>
                                        <p>{{ $supplier->full_address }}</p>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h6 class="text-muted">City</h6>
                                            <p>{{ $supplier->city ?? 'N/A' }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <h6 class="text-muted">State/Province</h6>
                                            <p>{{ $supplier->state ?? 'N/A' }}</p>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h6 class="text-muted">ZIP/Postal Code</h6>
                                            <p>{{ $supplier->zip_code ?? 'N/A' }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <h6 class="text-muted">Country</h6>
                                            <p>{{ $supplier->countries()[$supplier->country] ?? $supplier->country }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0 text-primary">Additional Information</h6>
                                </div>
                                <div class="card-body">
                                    @if($supplier->notes)
                                        <div class="notes-content">
                                            {!! nl2br(e($supplier->notes)) !!}
                                        </div>
                                    @else
                                        <p class="text-muted mb-0">No additional notes provided.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Products Section -->
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                    <h6 class="mb-0 text-primary">Supplied Products</h6>
                                    <span class="badge badge-primary">{{ $supplier->products->count() }} products</span>
                                </div>
                                <div class="card-body">
                                    @if($supplier->products->count() > 0)
                                        <div class="table-responsive">
                                            <table class="table table-sm table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Product Code</th>
                                                        <th>Product Name</th>
                                                        <th>Category</th>
                                                        <th class="text-right">Price</th>
                                                        <th class="text-right">Stock</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($supplier->products as $product)
                                                    <tr>
                                                        <td>{{ $product->product_code ?? 'N/A' }}</td>
                                                        <td>
                                                            <a href="{{ route('products.show', $product->id) }}">
                                                                {{ $product->product_name }}
                                                            </a>
                                                        </td>
                                                        <td>{{ $product->category->name ?? 'N/A' }}</td>
                                                        <td class="text-right">{{ number_format($product->price, 2) }}</td>
                                                        <td class="text-right">{{ $product->quantity }}</td>
                                                        <td>
                                                            @if($product->quantity <= $product->alert_stock)
                                                                <span class="badge badge-warning">Low Stock</span>
                                                            @else
                                                                <span class="badge badge-success">In Stock</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @else
                                        <div class="alert alert-info mb-0">
                                            No products associated with this supplier.
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <small class="text-muted">
                        Created: {{ $supplier->created_at->format('M d, Y H:i') }} | 
                        Last Updated: {{ $supplier->updated_at->format('M d, Y H:i') }}
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
        .table {
            page-break-inside: avoid;
        }
    }
    
    .notes-content {
        white-space: pre-wrap;
    }
</style>
@endsection