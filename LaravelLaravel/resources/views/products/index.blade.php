@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Main Content Area -->
        <div class="col-lg-9 col-md-12">
            <div class="card industrial-card">
                <div class="card-header industrial-card-header">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                        <h4 class="text-light fw-bold mb-0">
                            <i class="fas fa-pallet me-2"></i>Inventory Management
                        </h4>
                        <div class="d-flex gap-2">
                            <button class="btn btn-industrial btn-sm" data-bs-toggle="modal" data-bs-target="#addproduct">
                                <i class="fas fa-forklift me-1"></i>Add Product
                            </button>
                            <button class="btn btn-industrial btn-sm" data-bs-toggle="modal" data-bs-target="#bulkActions">
                                <i class="fas fa-cogs me-1"></i>Bulk Actions
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body industrial-card-body p-2">
                    <div class="table-responsive industrial-table-wrapper">
                        <table class="table table-hover industrial-table">
                            <thead class="industrial-table-header">
                                <tr>
                                    <th class="text-center" style="width: 5%;">
                                        <input type="checkbox" id="selectAll">
                                    </th>
                                    <th style="width: 5%;">No.</th>
                                    <th style="width: 20%;">Product Name</th>
                                    <th style="width: 15%;">Brand</th>
                                    <th style="width: 15%;">Category</th>
                                    <th class="text-end" style="width: 15%;">Price (රු.)</th>
                                    <th class="text-center" style="width: 10%;">Qty</th>
                                    <th class="text-center" style="width: 15%;">Alert</th>
                                    <th class="text-center" style="width: 15%;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $key => $product)
                                <tr class="industrial-table-row @if($product->alert_stock >= $product->quantity) table-warning @endif">
                                    <td class="text-center">
                                        <input type="checkbox" class="select-item" value="{{ $product->id }}">
                                    </td>
                                    <td class="text-center industrial-id">{{ $key+1 }}</td>
                                    <td class="industrial-name">
                                        <strong>{{ Str::limit($product->product_name, 20) }}</strong>
                                        @if($product->description)
                                        <small class="text-muted d-block">{{ Str::limit($product->description, 25) }}</small>
                                        @endif
                                    </td>
                                    <td class="industrial-brand">{{ Str::limit($product->brand, 15) }}</td>
                                    <td class="industrial-category">{{ $product->category ?? '#301A' }}</td>
                                    <td class="text-end industrial-price">රු. {{ number_format($product->price, 2) }}</td>
                                    <td class="text-center industrial-qty">
                                        <span class="badge industrial-badge-qty @if($product->quantity == 0) bg-danger @elseif($product->quantity <= $product->alert_stock) bg-warning text-dark @endif">
                                            {{ $product->quantity }}
                                        </span>
                                    </td>
                                    <td class="text-center industrial-alert">
                                        @if($product->alert_stock >= $product->quantity)
                                        <span class="badge industrial-badge-danger">
                                            <i class="fas fa-exclamation-triangle me-1"></i> {{ $product->alert_stock }}
                                        </span>
                                        @else
                                        <span class="badge industrial-badge-success">
                                            <i class="fas fa-check-circle me-1"></i> {{ $product->alert_stock }}
                                        </span>
                                        @endif
                                    </td>
                                    <td class="text-center industrial-actions">
                                        <div class="btn-group industrial-btn-group" role="group">
                                            <button class="btn btn-industrial-edit btn-sm" data-bs-toggle="modal" data-bs-target="#editproduct{{ $product->id }}" title="සංස්කරණය">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-industrial-delete btn-sm" data-bs-toggle="modal" data-bs-target="#deleteproduct{{ $product->id }}" title="මකන්න">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                            <button class="btn btn-industrial-view btn-sm" data-bs-toggle="modal" data-bs-target="#viewproduct{{ $product->id }}" title="බලන්න">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- View Product Modal -->
                                <div class="modal industrial-modal fade" id="viewproduct{{ $product->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="viewProductLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content industrial-modal-content">
                                            <div class="modal-header industrial-modal-header">
                                                <h5 class="modal-title" id="viewProductLabel">
                                                    <i class="fas fa-eye me-2"></i>භාණ්ඩ විස්තර
                                                </h5>
                                                <button type="button" class="btn-close-industrial" data-bs-dismiss="modal" aria-label="Close">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                            <div class="modal-body industrial-modal-body">
                                                <div class="industrial-form-group">
                                                    <label class="industrial-form-label">භාණ්ඩයේ නම</label>
                                                    <p>{{ $product->product_name }}</p>
                                                </div>
                                                <div class="industrial-form-group">
                                                    <label class="industrial-form-label">වෙළඳ නාමය</label>
                                                    <p>{{ $product->brand ?? 'N/A' }}</p>
                                                </div>
                                                <div class="industrial-form-group">
                                                    <label class="industrial-form-label">ප්‍රවර්ගය</label>
                                                    <p>{{ $product->category ?? 'N/A' }}</p>
                                                </div>
                                                <div class="industrial-form-group">
                                                    <label class="industrial-form-label">මිල (රුපියල්)</label>
                                                    <p>රු. {{ number_format($product->price, 2) }}</p>
                                                </div>
                                                <div class="industrial-form-group">
                                                    <label class="industrial-form-label">ප්‍රමාණය</label>
                                                    <p>{{ $product->quantity }}</p>
                                                </div>
                                                <div class="industrial-form-group">
                                                    <label class="industrial-form-label">අවධානම් මට්ටම</label>
                                                    <p>{{ $product->alert_stock }}</p>
                                                </div>
                                                <div class="industrial-form-group">
                                                    <label class="industrial-form-label">විස්තර</label>
                                                    <p>{{ $product->description ?? 'N/A' }}</p>
                                                </div>
                                                <div class="modal-footer industrial-modal-footer">
                                                    <button type="button" class="btn btn-industrial-cancel" data-bs-dismiss="modal">
                                                        <i class="fas fa-times me-2"></i>වසන්න
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Edit Product Modal -->
                                <div class="modal industrial-modal fade" id="editproduct{{ $product->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editProductLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content industrial-modal-content">
                                            <div class="modal-header industrial-modal-header">
                                                <h5 class="modal-title" id="editProductLabel">
                                                    <i class="fas fa-edit me-2"></i>භාණ්ඩය සංස්කරණය
                                                </h5>
                                                <button type="button" class="btn-close-industrial" data-bs-dismiss="modal" aria-label="Close">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                            <div class="modal-body industrial-modal-body">
                                                <form action="{{ route('products.update', $product->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="industrial-form-group">
                                                        <label class="industrial-form-label">
                                                            <i class="fas fa-tag me-2"></i>භාණ්ඩයේ නම
                                                        </label>
                                                        <input type="text" name="product_name" class="industrial-form-control" value="{{ $product->product_name }}" required>
                                                    </div>
                                                    <div class="industrial-form-group">
                                                        <label class="industrial-form-label">
                                                            <i class="fas fa-industry me-2"></i>වෙළඳ නාමය
                                                        </label>
                                                        <input type="text" name="brand" class="industrial-form-control" value="{{ $product->brand }}">
                                                    </div>
                                                    <div class="industrial-form-group">
                                                        <label class="industrial-form-label">
                                                            <i class="fas fa-list me-2"></i>ප්‍රවර්ගය
                                                        </label>
                                                        <input type="text" name="category" class="industrial-form-control" value="{{ $product->category ?? '' }}">
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="industrial-form-group">
                                                                <label class="industrial-form-label">
                                                                    <i class="fas fa-money-bill-wave me-2"></i>මිල (රුපියල්)
                                                                </label>
                                                                <div class="input-group">
                                                                    <span class="input-group-text industrial-input-group-text">රු.</span>
                                                                    <input type="number" step="0.01" name="price" class="industrial-form-control" value="{{ $product->price }}" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="industrial-form-group">
                                                                <label class="industrial-form-label">
                                                                    <i class="fas fa-boxes me-2"></i>ප්‍රමාණය
                                                                </label>
                                                                <input type="number" name="quantity" class="industrial-form-control" value="{{ $product->quantity }}" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="industrial-form-group">
                                                        <label class="industrial-form-label">
                                                            <i class="fas fa-exclamation-triangle me-2"></i>අවධානම් මට්ටම
                                                        </label>
                                                        <input type="number" name="alert_stock" class="industrial-form-control" value="{{ $product->alert_stock }}" required>
                                                    </div>
                                                    <div class="industrial-form-group">
                                                        <label class="industrial-form-label">
                                                            <i class="fas fa-align-left me-2"></i>විස්තර
                                                        </label>
                                                        <textarea name="description" rows="3" class="industrial-form-control">{{ $product->description }}</textarea>
                                                    </div>
                                                    <div class="modal-footer industrial-modal-footer">
                                                        <button type="button" class="btn btn-industrial-cancel" data-bs-dismiss="modal">
                                                            <i class="fas fa-times me-2"></i>අවලංගු කරන්න
                                                        </button>
                                                        <button type="submit" class="btn btn-industrial-primary">
                                                            <i class="fas fa-save me-2"></i>යාවත්කාලීන කරන්න
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Delete Product Modal -->
                                <div class="modal industrial-modal fade" id="deleteproduct{{ $product->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteProductLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content industrial-modal-content industrial-modal-danger">
                                            <div class="modal-header industrial-modal-header">
                                                <h5 class="modal-title" id="deleteProductLabel">
                                                    <i class="fas fa-trash-alt me-2"></i>මැකීම තහවුරු කරන්න
                                                </h5>
                                                <button type="button" class="btn-close-industrial" data-bs-dismiss="modal" aria-label="Close">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                            <div class="modal-body industrial-modal-body">
                                                <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="industrial-alert industrial-alert-danger">
                                                        <i class="fas fa-exclamation-circle fa-2x me-3"></i>
                                                        <div>
                                                            <h5>අවවාදයයි: භාණ්ඩය මකා දැමීම</h5>
                                                            <p class="mb-0">ඔබට ඇත්තෙන්ම <strong>{{ $product->product_name }}</strong> භාණ්ඩය ගබඩාවෙන් මැකීමට අවශ්‍යද?</p>
                                                            <small class="text-muted">මෙම ක්‍රියාව අහෝසි කල නොහැක.</small>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer industrial-modal-footer">
                                                        <button type="button" class="btn btn-industrial-cancel" data-bs-dismiss="modal">
                                                            <i class="fas fa-times me-2"></i>අවලංගු කරන්න
                                                        </button>
                                                        <button type="submit" class="btn btn-industrial-danger">
                                                            <i class="fas fa-trash-alt me-2"></i>මකා දමන්න
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center mt-3">
                            <nav aria-label="Inventory pagination">
                                {{ $products->onEachSide(1)->links('pagination::bootstrap-5') }}
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Sidebar: Inventory Tools -->
        <div class="col-lg-3 col-md-12">
            <div class="card industrial-card industrial-card-tools">
                <div class="card-header industrial-card-header">
                    <h4 class="text-light mb-0">
                        <i class="fas fa-tools me-2"></i>උපකරණ
                    </h4>
                </div>
                <div class="card-body p-3">
                    <div class="industrial-search-box mb-3">
                        <div class="input-group mb-2">
                            <span class="input-group-text industrial-input-group-text">
                                <i class="fas fa-search"></i>
                            </span>
                            <input type="text" class="industrial-form-control" placeholder="භාණ්ඩ සොයන්න...">
                            <button class="btn btn-industrial-search btn-sm" type="button" title="පෙරහන්">
                                <i class="fas fa-filter"></i>
                            </button>
                        </div>
                        <div class="d-flex flex-wrap gap-2">
                            <button class="btn btn-industrial-search btn-sm" type="button" title="වෙළඳ නාමයෙන් සොයන්න">
                                <i class="fas fa-industry me-1"></i> By Brand
                            </button>
                            <button class="btn btn-industrial-search btn-sm" type="button" title="භාණ්ඩයෙන් සොයන්න">
                                <i class="fas fa-tag me-1"></i> By Product
                            </button>
                            <button class="btn btn-industrial-search btn-sm" type="button" title="ප්‍රවර්ගයෙන් සොයන්න">
                                <i class="fas fa-list me-1"></i> By Category
                            </button>
                            <button class="btn btn-industrial-search btn-sm" type="button" title="මිලෙන් සොයන්න">
                                <i class="fas fa-money-bill-wave me-1"></i> By Price
                            </button>
                            <button class="btn btn-industrial-search btn-sm" type="button" title="ප්‍රමාණයෙන් සොයන්න">
                                <i class="fas fa-boxes me-1"></i> By Quantity
                            </button>
                            <button class="btn btn-industrial-search btn-sm" type="button" title="අවධානම් මට්ටමින් සොයන්න">
                                <i class="fas fa-exclamation-triangle me-1"></i> By Alert
                            </button>
                            <button class="btn btn-industrial-search btn-sm" type="button" title="ස්ථානයෙන් සොයන්න">
                                <i class="fas fa-map-marker-alt me-1"></i> By Location
                            </button>
                            <button class="btn btn-industrial-search btn-sm" type="button" title="සැපයුම්කරුවන්ගෙන් සොයන්න">
                                <i class="fas fa-truck me-1"></i> By Supplier
                            </button>
                        </div>
                    </div>
                    <div class="industrial-stats-card mb-3">
                        <div class="industrial-stats-header">
                            <i class="fas fa-chart-bar me-2"></i>සාරාංශය
                        </div>
                        <div class="industrial-stats-body">
                            <div class="industrial-stat-item">
                                <span class="stat-label">මුළු භාණ්ඩ</span>
                                <span class="stat-value">{{ $products->total() }}</span>
                            </div>
                            <div class="industrial-stat-item">
                                <span class="stat-label">අඩු ඉඩම්</span>
                                <span class="stat-value text-danger">{{ $lowStockCount }}</span>
                            </div>
                            <div class="industrial-stat-item">
                                <span class="stat-label">ඉවර වී ඇත</span>
                                <span class="stat-value text-danger">{{ $outOfStockCount }}</span>
                            </div>
                            <div class="industrial-stat-item">
                                <span class="stat-label">ප්‍රවර්ග</span>
                                <span class="stat-value">{{ $categoryCount ?? 'N/A' }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="industrial-quick-actions">
                        <button class="btn btn-industrial-action btn-sm mb-2">
                            <i class="fas fa-file-export me-1"></i>Export CSV
                        </button>
                        <button class="btn btn-industrial-action btn-sm mb-2">
                            <i class="fas fa-file-import me-1"></i>Import Data
                        </button>
                        <button class="btn btn-industrial-action btn-sm mb-2">
                            <i class="fas fa-bell me-1"></i>Notifications
                        </button>
                        <button class="btn btn-industrial-action btn-sm mb-2">
                            <i class="fas fa-history me-1"></i>Activity Log
                        </button>
                        <button class="btn btn-industrial-action btn-sm">
                            <i class="fas fa-print me-1"></i>Print Report
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Product Modal -->
<div class="modal industrial-modal fade" id="addproduct" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addProductLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content industrial-modal-content">
            <div class="modal-header industrial-modal-header">
                <h5 class="modal-title" id="addProductLabel">
                    <i class="fas fa-forklift me-2"></i>නව භාණ්ඩය එක් කරන්න
                </h5>
                <button type="button" class="btn-close-industrial" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body industrial-modal-body">
                <form action="{{ route('products.store') }}" method="POST">
                    @csrf
                    <div class="industrial-form-group">
                        <label class="industrial-form-label">
                            <i class="fas fa-tag me-2"></i>භාණ්ඩයේ නම
                        </label>
                        <input type="text" name="product_name" class="industrial-form-control" required>
                    </div>
                    <div class="industrial-form-group">
                        <label class="industrial-form-label">
                            <i class="fas fa-industry me-2"></i>වෙළඳ නාමය
                        </label>
                        <input type="text" name="brand" class="industrial-form-control">
                    </div>
                    <div class="industrial-form-group">
                        <label class="industrial-form-label">
                            <i class="fas fa-list me-2"></i>ප්‍රවර්ගය
                        </label>
                        <input type="text" name="category" class="industrial-form-control">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="industrial-form-group">
                                <label class="industrial-form-label">
                                    <i class="fas fa-money-bill-wave me-2"></i>මිල (රුපියල්)
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text industrial-input-group-text">රු.</span>
                                    <input type="number" step="0.01" name="price" class="industrial-form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="industrial-form-group">
                                <label class="industrial-form-label">
                                    <i class="fas fa-boxes me-2"></i>ප්‍රමාණය
                                </label>
                                <input type="number" name="quantity" class="industrial-form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="industrial-form-group">
                        <label class="industrial-form-label">
                            <i class="fas fa-exclamation-triangle me-2"></i>අවධානම් මට්ටම
                        </label>
                        <input type="number" name="alert_stock" class="industrial-form-control" required>
                    </div>
                    <div class="industrial-form-group">
                        <label class="industrial-form-label">
                            <i class="fas fa-align-left me-2"></i>විස්තර
                        </label>
                        <textarea name="description" rows="3" class="industrial-form-control"></textarea>
                    </div>
                    <div class="modal-footer industrial-modal-footer">
                        <button type="button" class="btn btn-industrial-cancel" data-bs-dismiss="modal">
                            <i class="fas fa-times me-2"></i>අවලංගු කරන්න
                        </button>
                        <button type="submit" class="btn btn-industrial-primary">
                            <i class="fas fa-save me-2"></i>සුරකින්න
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bulk Actions Modal -->
<div class="modal industrial-modal fade" id="bulkActions" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="bulkActionsLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content industrial-modal-content">
            <div class="modal-header industrial-modal-header">
                <h5 class="modal-title" id="bulkActionsLabel">
                    <i class="fas fa-cogs me-2"></i>තොග ක්‍රියාකාරකම්
                </h5>
                <button type="button" class="btn-close-industrial" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body industrial-modal-body">
                <div class="d-flex flex-column gap-2">
                    <button class="btn btn-industrial-primary btn-sm">
                        <i class="fas fa-edit me-1"></i> Bulk Edit
                    </button>
                    <button class="btn btn-industrial-danger btn-sm">
                        <i class="fas fa-trash-alt me-1"></i> Bulk Delete
                    </button>
                    <button class="btn btn-industrial-action btn-sm">
                        <i class="fas fa-file-export me-1"></i> Export Selected
                    </button>
                    <button class="btn btn-industrial-action btn-sm">
                        <i class="fas fa-tag me-1"></i> Update Category
                    </button>
                </div>
                <div class="modal-footer industrial-modal-footer">
                    <button type="button" class="btn btn-industrial-cancel" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>අවලංගු කරන්න
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Sinhala font integration */
    @font-face {
        font-family: 'Iskoola Pota';
        src: url("{{ asset('fonts/iskoola-pota.ttf') }}") format('truetype');
    }

    /* Industrial Theme Variables */
    :root {
        --industrial-primary: #2c3e50;
        --industrial-secondary: #34495e;
        --industrial-accent: #e74c3c;
        --industrial-highlight: #3498db;
        --industrial-light: #ecf0f1;
        --industrial-dark: #1a252f;
        --industrial-success: #27ae60;
        --industrial-warning: #f39c12;
        --industrial-danger: #e74c3c;
        --industrial-info: #2980b9;
    }

    /* Sinhala text elements */
    .sinhala-text {
        font-family: 'Iskoola Pota', 'Nunito', sans-serif;
    }

    /* Industrial Card Styles */
    .industrial-card {
        border: none;
        border-radius: 6px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        margin-bottom: 16px;
    }

    .industrial-card-header {
        background-color: var(--industrial-primary);
        color: white;
        padding: 10px 15px;
        border-bottom: 2px solid var(--industrial-highlight);
    }

    .industrial-card-body {
        background-color: white;
    }

    .industrial-card-tools {
        background-color: #f8f9fa;
    }

    /* Table Styles */
    .industrial-table-wrapper {
        border-radius: 6px;
        overflow: hidden;
    }

    .industrial-table-header {
        background-color: var(--industrial-secondary);
        color: white;
    }

    .industrial-table-header th {
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.65rem;
        letter-spacing: 0.5px;
        padding: 6px 8px;
    }

    .industrial-table-row:hover {
        background-color: rgba(52, 152, 219, 0.05);
    }

    .industrial-table-row td {
        padding: 8px 10px;
        vertical-align: middle;
        border-bottom: 1px solid #eee;
        font-size: 0.8rem;
    }

    /* Enhanced badge styles */
    .industrial-badge-qty, .industrial-badge-success, .industrial-badge-danger {
        padding: 3px 8px;
        border-radius: 10px;
        font-size: 0.7rem;
        font-weight: 600;
        min-width: 30px;
        display: inline-block;
        text-align: center;
    }

    .industrial-badge-qty {
        background-color: var(--industrial-secondary);
        color: white;
    }

    .industrial-badge-success {
        background-color: var(--industrial-success);
        color: white;
    }

    .industrial-badge-danger {
        background-color: var(--industrial-danger);
        color: white;
    }

    /* Highlight for low stock rows */
    .table-warning {
        background-color: rgba(243, 156, 18, 0.1) !important;
    }

    .table-warning:hover {
        background-color: rgba(243, 156, 18, 0.2) !important;
    }

    .industrial-table-row.table-warning td {
        border-left: 2px solid var(--industrial-warning);
    }

    /* Button Styles */
    .btn-industrial, .btn-industrial-search, .btn-industrial-action, .btn-industrial-primary, .btn-industrial-cancel, .btn-industrial-danger, .btn-industrial-edit, .btn-industrial-view {
        border: none;
        padding: 6px 12px;
        font-weight: 600;
        transition: all 0.2s;
        font-size: 0.8rem;
    }

    .btn-industrial, .btn-industrial-primary {
        background-color: var(--industrial-primary);
        color: white;
    }

    .btn-industrial:hover, .btn-industrial-primary:hover {
        background-color: var(--industrial-secondary);
        transform: translateY(-1px);
    }

    .btn-industrial-search {
        background-color: var(--industrial-highlight);
        color: white;
    }

    .btn-industrial-search:hover {
        background-color: var(--industrial-info);
    }

    .btn-industrial-action {
        background-color: var(--industrial-info);
        color: white;
        width: 100%;
        text-align: left;
    }

    .btn-industrial-action:hover {
        background-color: var(--industrial-highlight);
    }

    .btn-industrial-cancel {
        background-color: #6c757d;
        color: white;
    }

    .btn-industrial-cancel:hover {
        background-color: #5a6268;
    }

    .btn-industrial-danger {
        background-color: var(--industrial-danger);
        color: white;
    }

    .btn-industrial-danger:hover {
        background-color: #c0392b;
    }

    .btn-industrial-edit {
        background-color: var(--industrial-info);
        color: white;
    }

    .btn-industrial-edit:hover {
        background-color: #2574a9;
    }

    .btn-industrial-view {
        background-color: #6c757d;
        color: white;
    }

    .btn-industrial-view:hover {
        background-color: #5a6268;
    }

    /* Form Styles */
    .industrial-form-control {
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 8px 10px;
        width: 100%;
        font-size: 0.8rem;
        transition: border 0.2s;
    }

    .industrial-form-control:focus {
        border-color: var(--industrial-highlight);
        box-shadow: 0 0 0 0.15rem rgba(52, 152, 219, 0.25);
    }

    .industrial-form-label {
        font-weight: 600;
        color: var(--industrial-dark);
        margin-bottom: 6px;
        display: block;
        font-size: 0.8rem;
    }

    /* Modal Styles */
    .industrial-modal-content {
        border: none;
        border-radius: 6px;
        overflow: hidden;
    }

    .industrial-modal-header {
        background-color: var(--industrial-primary);
        color: white;
        padding: 10px 15px;
    }

    .industrial-modal-body {
        padding: 15px;
    }

    .industrial-modal-footer {
        background-color: #f8f9fa;
        padding: 10px 15px;
    }

    /* Stats Card */
    .industrial-stats-card {
        background-color: white;
        border-radius: 6px;
        box-shadow: 0 1px 6px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .industrial-stats-header {
        background-color: var(--industrial-secondary);
        color: white;
        padding: 8px 12px;
        font-weight: 600;
        font-size: 0.8rem;
    }

    .industrial-stats-body {
        padding: 12px;
    }

    .industrial-stat-item {
        display: flex;
        justify-content: space-between;
        padding: 6px 0;
        border-bottom: 1px solid #eee;
        font-size: 0.8rem;
    }

    .stat-label {
        color: var(--industrial-dark);
    }

    .stat-value {
        font-weight: 600;
    }

    /* Compact table */
    .industrial-table {
        font-size: 0.8rem;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Enable Bootstrap tooltips
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));

        // Highlight current page in pagination
        const paginationLinks = document.querySelectorAll('.pagination .page-link');
        paginationLinks.forEach(link => {
            if (link.textContent.trim() === '{{ $products->currentPage() }}') {
                link.parentElement.classList.add('active');
            }
        });

        // Select all checkboxes
        const selectAll = document.getElementById('selectAll');
        const checkboxes = document.querySelectorAll('.select-item');
        selectAll.addEventListener('change', function() {
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        });
    });
</script>

@endsection