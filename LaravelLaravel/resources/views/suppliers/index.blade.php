@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-truck mr-2"></i>Supplier Management
                    </h5>
                    <div>
                        <a href="{{ route('suppliers.create') }}" class="btn btn-light btn-sm">
                            <i class="fas fa-plus-circle"></i> New Supplier
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Search and Filter Bar -->
                    <div class="row mb-3">
                        <div class="col-md-8">
                            <form action="{{ route('suppliers.index') }}" method="GET">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="search" 
                                           placeholder="Search suppliers..." value="{{ request('search') }}">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-4">
                            <div class="btn-group float-right">
                                <a href="{{ route('suppliers.index') }}" 
                                   class="btn btn-sm {{ !request('status') ? 'btn-primary' : 'btn-outline-primary' }}">
                                    All
                                </a>
                                <a href="{{ route('suppliers.index', ['status' => 'active']) }}" 
                                   class="btn btn-sm {{ request('status') === 'active' ? 'btn-primary' : 'btn-outline-primary' }}">
                                    Active
                                </a>
                                <a href="{{ route('suppliers.index', ['status' => 'inactive']) }}" 
                                   class="btn btn-sm {{ request('status') === 'inactive' ? 'btn-primary' : 'btn-outline-primary' }}">
                                    Inactive
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Success/Error Messages -->
                    @include('partials.alerts')

                    <!-- Suppliers Table with Dummy Data -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th width="5%">ID</th>
                                    <th>Supplier Name</th>
                                    <th>Contact Person</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Products</th>
                                    <th>Status</th>
                                    <th width="15%">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Dummy Data Starts Here -->
                                <tr>
                                    <td>SL001</td>
                                    <td><a href="#" class="text-primary">Nippolak (Pvt) Ltd</a></td>
                                    <td>Mr. Rohan Perera</td>
                                    <td>011-2456789</td>
                                    <td>sales@nippolak.lk</td>
                                    <td class="text-center">24</td>
                                    <td class="text-center"><span class="badge rounded-pill bg-success">Active</span></td>
                                    <td class="text-center">
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a href="#" class="btn btn-info" title="View"><i class="fas fa-eye"></i></a>
                                            <a href="#" class="btn btn-warning" title="Edit"><i class="fas fa-edit"></i></a>
                                            <button type="button" class="btn btn-secondary" title="Deactivate"><i class="fas fa-times"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>SL002</td>
                                    <td><a href="#" class="text-primary">Noppon Hardware</a></td>
                                    <td>Ms. Anusha Silva</td>
                                    <td>011-2789456</td>
                                    <td>info@nopponhardware.com</td>
                                    <td class="text-center">18</td>
<td class="text-center"><span class="badge rounded-pill bg-success">Active</span></td>                                    <td class="text-center">
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a href="#" class="btn btn-info" title="View"><i class="fas fa-eye"></i></a>
                                            <a href="#" class="btn btn-warning" title="Edit"><i class="fas fa-edit"></i></a>
                                            <button type="button" class="btn btn-secondary" title="Deactivate"><i class="fas fa-times"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>SL003</td>
                                    <td><a href="#" class="text-primary">SLON Industries</a></td>
                                    <td>Mr. Dinesh Fernando</td>
                                    <td>011-2567890</td>
                                    <td>dinesh@slonindustries.lk</td>
                                    <td class="text-center">32</td>
<td class="text-center"><span class="badge rounded-pill bg-success">Active</span></td>                                    <td class="text-center">
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a href="#" class="btn btn-info" title="View"><i class="fas fa-eye"></i></a>
                                            <a href="#" class="btn btn-warning" title="Edit"><i class="fas fa-edit"></i></a>
                                            <button type="button" class="btn btn-secondary" title="Deactivate"><i class="fas fa-times"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>SL004</td>
                                    <td><a href="#" class="text-primary">Lankatronic Solutions</a></td>
                                    <td>Eng. Nimal Rathnayake</td>
                                    <td>011-2678901</td>
                                    <td>tech@lankatronic.lk</td>
                                    <td class="text-center">15</td>
<td class="text-center"><span class="badge rounded-pill bg-success">Active</span></td>                                    <td class="text-center">
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a href="#" class="btn btn-info" title="View"><i class="fas fa-eye"></i></a>
                                            <a href="#" class="btn btn-warning" title="Edit"><i class="fas fa-edit"></i></a>
                                            <button type="button" class="btn btn-secondary" title="Deactivate"><i class="fas fa-times"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>SL005</td>
                                    <td><a href="#" class="text-primary">Ceylon Steel Traders</a></td>
                                    <td>Mr. Ajith Bandara</td>
                                    <td>011-2890123</td>
                                    <td>cst@ceylonsteel.com</td>
                                    <td class="text-center">28</td>
<td class="text-center"><span class="badge rounded-pill bg-success">Active</span></td>                                    <td class="text-center">
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a href="#" class="btn btn-info" title="View"><i class="fas fa-eye"></i></a>
                                            <a href="#" class="btn btn-warning" title="Edit"><i class="fas fa-edit"></i></a>
                                            <button type="button" class="btn btn-secondary" title="Deactivate"><i class="fas fa-times"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>SL006</td>
                                    <td><a href="#" class="text-primary">Mega Hardware Lanka</a></td>
                                    <td>Ms. Priyanka Jayasuriya</td>
                                    <td>011-2345678</td>
                                    <td>procurement@megalanka.lk</td>
                                    <td class="text-center">42</td>
<td class="text-center"><span class="badge rounded-pill bg-success">Active</span></td>                                    <td class="text-center">
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a href="#" class="btn btn-info" title="View"><i class="fas fa-eye"></i></a>
                                            <a href="#" class="btn btn-warning" title="Edit"><i class="fas fa-edit"></i></a>
                                            <button type="button" class="btn btn-secondary" title="Deactivate"><i class="fas fa-times"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>SL007</td>
                                    <td><a href="#" class="text-primary">PowerTech Electricals</a></td>
                                    <td>Mr. Sanjeewa Weerasinghe</td>
                                    <td>011-2765432</td>
                                    <td>powertech@electricals.lk</td>
                                    <td class="text-center">36</td>
<td class="text-center"><span class="badge rounded-pill bg-success">Active</span></td>                                    <td class="text-center">
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a href="#" class="btn btn-info" title="View"><i class="fas fa-eye"></i></a>
                                            <a href="#" class="btn btn-warning" title="Edit"><i class="fas fa-edit"></i></a>
                                            <button type="button" class="btn btn-secondary" title="Deactivate"><i class="fas fa-times"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>SL008</td>
                                    <td><a href="#" class="text-primary">BuildMore Suppliers</a></td>
                                    <td>Mr. Chaminda Alwis</td>
                                    <td>011-2987654</td>
                                    <td>buildmore@suppliers.lk</td>
                                    <td class="text-center">12</td>
<td class="text-center"><span class="badge rounded-pill bg-danger">Inactive</span></td>                                    <td class="text-center">
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a href="#" class="btn btn-info" title="View"><i class="fas fa-eye"></i></a>
                                            <a href="#" class="btn btn-warning" title="Edit"><i class="fas fa-edit"></i></a>
                                            <button type="button" class="btn btn-success" title="Activate"><i class="fas fa-check"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>SL009</td>
                                    <td><a href="#" class="text-primary">Lanka Bearing Center</a></td>
                                    <td>Mr. Asanka Gamage</td>
                                    <td>011-2456781</td>
                                    <td>bearings@lankabc.lk</td>
                                    <td class="text-center">21</td>
<td class="text-center"><span class="badge rounded-pill bg-success">Active</span></td>                                    <td class="text-center">
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a href="#" class="btn btn-info" title="View"><i class="fas fa-eye"></i></a>
                                            <a href="#" class="btn btn-warning" title="Edit"><i class="fas fa-edit"></i></a>
                                            <button type="button" class="btn btn-secondary" title="Deactivate"><i class="fas fa-times"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>SL010</td>
                                    <td><a href="#" class="text-primary">TechnoFast (Pvt) Ltd</a></td>
                                    <td>Eng. Roshan Fernando</td>
                                    <td>011-2678902</td>
                                    <td>tech@technofast.lk</td>
                                    <td class="text-center">19</td>
<td class="text-center"><span class="badge rounded-pill bg-success">Active</span></td>                                    <td class="text-center">
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a href="#" class="btn btn-info" title="View"><i class="fas fa-eye"></i></a>
                                            <a href="#" class="btn btn-warning" title="Edit"><i class="fas fa-edit"></i></a>
                                            <button type="button" class="btn btn-secondary" title="Deactivate"><i class="fas fa-times"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <!-- Additional rows can be added following the same pattern -->
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div class="text-muted">
                            Showing 1 to 10 of 20 entries
                        </div>
                        <div>
                            <ul class="pagination pagination-sm">
                                <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">Next</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Initialize tooltips
        $('[title]').tooltip();
        
        // Confirm before changing status
        $('.btn-secondary, .btn-success').click(function(e) {
            if (!confirm('Are you sure you want to change this supplier\'s status?')) {
                e.preventDefault();
            }
        });
    });
</script>
@endsection