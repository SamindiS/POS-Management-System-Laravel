@extends('layouts.app')

@section('content')
<div class="container-fluid px-0">
    <!-- Dashboard Header -->
    <div class="dashboard-header bg-dark text-white py-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="display-5 fw-bold mb-0">
                        <i class="fas fa-hard-hat me-2"></i>Construction22 POS System
                    </h1>
                    <p class="mb-0 text-light">Industrial Construction Materials Management</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <div class="d-flex justify-content-md-end align-items-center">
                        <div class="me-3">
                            <span class="badge bg-warning text-dark">
                                <i class="fas fa-warehouse me-1"></i> Warehouse: Galle
                            </span>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-outline-light dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown">
                                <i class="fas fa-user-circle me-1"></i> Site Supervisor
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>Profile</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Settings</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="container-fluid py-3 bg-light">
        <div class="container">
            <div class="row g-3">
                <div class="col-md-3">
                    <div class="card stat-card shadow-sm border-primary">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted mb-2">Today's Sales</h6>
                                    <h3 class="mb-0">Rs. 1,245,750</h3>
                                </div>
                                <div class="bg-primary bg-opacity-10 p-3 rounded">
                                    <i class="fas fa-rupee-sign text-primary fs-4"></i>
                                </div>
                            </div>
                            <div class="mt-2">
                                <span class="badge bg-success"><i class="fas fa-arrow-up me-1"></i> 12.5%</span>
                                <span class="text-muted ms-2">vs yesterday</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card stat-card shadow-sm border-warning">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted mb-2">Active Projects</h6>
                                    <h3 class="mb-0">18</h3>
                                </div>
                                <div class="bg-warning bg-opacity-10 p-3 rounded">
                                    <i class="fas fa-building text-warning fs-4"></i>
                                </div>
                            </div>
                            <div class="mt-2">
                                <span class="badge bg-danger"><i class="fas fa-arrow-down me-1"></i> 2</span>
                                <span class="text-muted ms-2">completed this week</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card stat-card shadow-sm border-danger">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted mb-2">Low Stock Items</h6>
                                    <h3 class="mb-0">9</h3>
                                </div>
                                <div class="bg-danger bg-opacity-10 p-3 rounded">
                                    <i class="fas fa-exclamation-triangle text-danger fs-4"></i>
                                </div>
                            </div>
                            <div class="mt-2">
                                <a href="#" class="text-danger small">View critical items</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card stat-card shadow-sm border-success">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted mb-2">Pending Orders</h6>
                                    <h3 class="mb-0">5</h3>
                                </div>
                                <div class="bg-success bg-opacity-10 p-3 rounded">
                                    <i class="fas fa-truck-loading text-success fs-4"></i>
                                </div>
                            </div>
                            <div class="mt-2">
                                <a href="#" class="text-success small">Process deliveries</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container py-4">
        <div class="row g-4">
            <!-- Left Column -->
            <div class="col-lg-8">
                <!-- Quick Actions -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-white border-bottom">
                        <h5 class="mb-0"><i class="fas fa-bolt text-warning me-2"></i>Quick Actions</h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-2">
                            <div class="col-6 col-md-3">
                                <a href="#" class="btn btn-outline-primary w-100 py-3" data-bs-toggle="modal" data-bs-target="#newInvoiceModal">
                                    <i class="fas fa-file-invoice-dollar fs-2 mb-2"></i><br>
                                    New Invoice
                                </a>
                            </div>
                            <div class="col-6 col-md-3">
                                <a href="#" class="btn btn-outline-success w-100 py-3" data-bs-toggle="modal" data-bs-target="#newProjectModal">
                                    <i class="fas fa-project-diagram fs-2 mb-2"></i><br>
                                    New Project
                                </a>
                            </div>
                            <div class="col-6 col-md-3">
                                <a href="#" class="btn btn-outline-info w-100 py-3" data-bs-toggle="modal" data-bs-target="#quickOrderModal">
                                    <i class="fas fa-cubes fs-2 mb-2"></i><br>
                                    Quick Order
                                </a>
                            </div>
                            <div class="col-6 col-md-3">
                                <a href="#" class="btn btn-outline-danger w-100 py-3" data-bs-toggle="modal" data-bs-target="#emergencyModal">
                                    <i class="fas fa-exclamation-triangle fs-2 mb-2"></i><br>
                                    Emergency
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Transactions -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"><i class="fas fa-exchange-alt text-primary me-2"></i>Recent Transactions</h5>
                        <a href="#" class="btn btn-sm btn-outline-primary">View All</a>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Invoice #</th>
                                        <th>Project</th>
                                        <th>Client</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><a href="#" class="text-primary">INV-2023-1256</a></td>
                                        <td>Colombo Tower</td>
                                        <td>ABC Constructions</td>
                                        <td>Rs. 2,450,000</td>
                                        <td><span class="badge bg-success">Paid</span></td>
                                    </tr>
                                    <tr>
                                        <td><a href="#" class="text-primary">INV-2023-1255</a></td>
                                        <td>Kandy Highway</td>
                                        <td>Road Development Co.</td>
                                        <td>Rs. 5,780,000</td>
                                        <td><span class="badge bg-warning text-dark">Pending</span></td>
                                    </tr>
                                    <tr>
                                        <td><a href="#" class="text-primary">INV-2023-1254</a></td>
                                        <td>Galle Hotel</td>
                                        <td>Resort Developers</td>
                                        <td>Rs. 3,120,500</td>
                                        <td><span class="badge bg-success">Paid</span></td>
                                    </tr>
                                    <tr>
                                        <td><a href="#" class="text-primary">INV-2023-1253</a></td>
                                        <td>Matara Bridge</td>
                                        <td>National Highways</td>
                                        <td>Rs. 8,450,000</td>
                                        <td><span class="badge bg-danger">Overdue</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Project Progress -->
                <div class="card shadow-sm">
                    <div class="card-header bg-white border-bottom">
                        <h5 class="mb-0"><i class="fas fa-tasks text-info me-2"></i>Active Projects</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-1">
                                <span>Colombo Tower (75%)</span>
                                <span>Due in 15 days</span>
                            </div>
                            <div class="progress" style="height: 10px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 75%"></div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-1">
                                <span>Kandy Highway (42%)</span>
                                <span>Due in 28 days</span>
                            </div>
                            <div class="progress" style="height: 10px;">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 42%"></div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-1">
                                <span>Galle Hotel (90%)</span>
                                <span>Due in 5 days</span>
                            </div>
                            <div class="progress" style="height: 10px;">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 90%"></div>
                            </div>
                        </div>
                        <div class="mb-0">
                            <div class="d-flex justify-content-between mb-1">
                                <span>Matara Bridge (15%)</span>
                                <span>Due in 60 days</span>
                            </div>
                            <div class="progress" style="height: 10px;">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 15%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-lg-4">
                <!-- Inventory Alerts -->
                <div class="card shadow-sm mb-4 border-danger">
                    <div class="card-header bg-white border-bottom border-danger">
                        <h5 class="mb-0 text-danger"><i class="fas fa-exclamation-circle me-2"></i>Inventory Alerts</h5>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-warning mb-3">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-box-open fa-2x"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="alert-heading">Steel Rods 12mm</h6>
                                    <p class="mb-0 small">Only 15 units left (Alert at 50)</p>
                                </div>
                            </div>
                        </div>
                        <div class="alert alert-danger mb-3">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-fire-extinguisher fa-2x"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="alert-heading">Portland Cement</h6>
                                    <p class="mb-0 small">Only 5 bags left (Alert at 20)</p>
                                </div>
                            </div>
                        </div>
                        <div class="alert alert-warning mb-0">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-bolt fa-2x"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="alert-heading">Electrical Wires</h6>
                                    <p class="mb-0 small">Only 8 rolls left (Alert at 15)</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Deliveries -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-white border-bottom">
                        <h5 class="mb-0"><i class="fas fa-truck text-success me-2"></i>Recent Deliveries</h5>
                    </div>
                    <div class="card-body">
                        <div class="list-group list-group-flush">
                            <div class="list-group-item border-0 px-0 py-2">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 bg-success bg-opacity-10 p-2 rounded">
                                        <i class="fas fa-check-circle text-success"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-0">Steel Beams (50 units)</h6>
                                        <small class="text-muted">Delivered to Colombo Tower - 2 hours ago</small>
                                    </div>
                                </div>
                            </div>
                            <div class="list-group-item border-0 px-0 py-2">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 bg-info bg-opacity-10 p-2 rounded">
                                        <i class="fas fa-shipping-fast text-info"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-0">Cement (200 bags)</h6>
                                        <small class="text-muted">In transit to Kandy Highway - 5 hours ago</small>
                                    </div>
                                </div>
                            </div>
                            <div class="list-group-item border-0 px-0 py-2">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 bg-warning bg-opacity-10 p-2 rounded">
                                        <i class="fas fa-clock text-warning"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-0">Sand (10 tons)</h6>
                                        <small class="text-muted">Scheduled for Galle Hotel - tomorrow</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Site Activity -->
                <div class="card shadow-sm">
                    <div class="card-header bg-white border-bottom">
                        <h5 class="mb-0"><i class="fas fa-hard-hat text-primary me-2"></i>Site Activity</h5>
                    </div>
                    <div class="card-body">
                        <div class="timeline">
                            <div class="timeline-item">
                                <div class="timeline-item-marker">
                                    <div class="timeline-item-marker-indicator bg-success"></div>
                                </div>
                                <div class="timeline-item-content">
                                    <small class="text-muted float-end">10 min ago</small>
                                    <p class="mb-0">Order #1256 approved by Site Manager</p>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-item-marker">
                                    <div class="timeline-item-marker-indicator bg-info"></div>
                                </div>
                                <div class="timeline-item-content">
                                    <small class="text-muted float-end">45 min ago</small>
                                    <p class="mb-0">New material request from Kandy site</p>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-item-marker">
                                    <div class="timeline-item-marker-indicator bg-warning"></div>
                                </div>
                                <div class="timeline-item-content">
                                    <small class="text-muted float-end">2 hours ago</small>
                                    <p class="mb-0">Inventory check completed</p>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-item-marker">
                                    <div class="timeline-item-marker-indicator bg-danger"></div>
                                </div>
                                <div class="timeline-item-content">
                                    <small class="text-muted float-end">4 hours ago</small>
                                    <p class="mb-0">Delay reported in Matara Bridge materials</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- New Invoice Modal -->
<div class="modal fade" id="newInvoiceModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Create New Invoice</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Invoice form would go here -->
                <p>Invoice creation form content...</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Create Invoice</button>
            </div>
        </div>
    </div>
</div>

<!-- Other modals would follow similar structure -->
@endsection

@section('styles')
<style>
    .dashboard-header {
        background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
        border-bottom: 4px solid #f0ad4e;
    }
    
    .stat-card {
        transition: transform 0.3s;
        border-top: 3px solid;
    }
    
    .stat-card:hover {
        transform: translateY(-5px);
    }
    
    .timeline {
        position: relative;
        padding-left: 1rem;
    }
    
    .timeline-item {
        position: relative;
        padding-bottom: 1.5rem;
    }
    
    .timeline-item-marker {
        position: absolute;
        left: -1.5rem;
        width: 2rem;
        height: 2rem;
        text-align: center;
    }
    
    .timeline-item-marker-indicator {
        display: inline-block;
        width: 12px;
        height: 12px;
        border-radius: 100%;
        background: #adb5bd;
    }
    
    .timeline-item-content {
        padding-left: 0.5rem;
    }
    
    .progress {
        border-radius: 10px;
    }
    
    .progress-bar {
        border-radius: 10px;
    }
</style>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Initialize tooltips
        $('[data-bs-toggle="tooltip"]').tooltip();
        
        // Real-time clock
        function updateClock() {
            const now = new Date();
            const timeString = now.toLocaleTimeString();
            const dateString = now.toLocaleDateString();
            $('#dashboard-clock').text(`${dateString} ${timeString}`);
        }
        setInterval(updateClock, 1000);
        updateClock();
    });
</script>
@endsection