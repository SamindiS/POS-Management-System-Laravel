@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">

        <!-- Product Table -->
        <div class="col-md-9 order-2 order-md-1">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-light fw-bold" style="float: left;">Order Products</h4>

                </div>
                <form action="{{ route('orders.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Product Name</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                    <th>Dis (%)</th>
                                    <th>Total</th>
                                    <th>
                                        <a href="#" class="btn btn-sm btn-success add_more rounded-circle">
                                            <i class="fa fa-plus-circle"></i>
                                        </a>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="addMoreProduct">
                                <tr>
                                    <td>1</td>
                                    <td>
                                        <select name="product_id[]" id="product_id" class="form-select product_id">
                                            <option value="" selected disabled>Select Product</option>
                                            @foreach ($products as $product)
                                            <option data-price="{{ $product->price }}" value="{{ $product->id }}">
                                                {{ $product->product_name }}
                                            </option>
                                            @endforeach
                                        </select>

                                    </td>
                                    <td><input type="number" name="quantity[]" class="form-control quantity"></td>
                                    <td><input type="number" name="price[]" class="form-control price" readonly></td>
                                    <td><input type="number" name="discount[]" class="form-control discount"></td>
                                    <td><input type="number" name="total_amount[]" class="form-control total_amount"
                                            readonly></td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-danger delete rounded-circle">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
            </div>
        </div>

        <!-- Right Sidebar: Total & Search -->
        <div class="col-md-3 order-1 order-md-2">
            <div class="card">
                <div class="card-header">
                    <h4>Total <b class="total">0.00</b></h4>
                </div>
                <div class="card-body">
                    <div class="btn-group w-100 mb-3">
                        <button type="button" onclick="PrintReceiptContent('print')" class="btn btn-dark">
                            <i class="fa fa-print"></i> <span>Print</span>
                        </button>
                        <button type="button" onclick="PrintReceiptContent('history')" class="btn btn-primary">
                            <i class="fa fa-history"></i> <span>History</span>
                        </button>
                        <button type="button" onclick="PrintReceiptContent('report')" class="btn btn-danger">
                            <i class="fa fa-file-alt"></i> <span>Report</span>
                        </button>
                    </div>
                    <div class="panel">
                        <div class="row">
                            <table class="table table-striped">
                                <tr>
                                    <td>
                                        <label for="">Customer Name</label>

                                        <input type="text" name="customer_name" id="" class="form-control">


                                    </td>
                                    <td>
                                        <label for="">Customer Phone</label>

                                        <input type="number" name="customer_phone" id="" class="form-control">


                                    </td>
                                </tr>
                            </table>
                            <td>Payment Method<br>
                                <div class="d-flex flex-column">
                                    <div class="radio-item mb-2">
                                        <input type="radio" name="payment_method" id="payment_cash" value="Cash" checked>
                                        <label for="payment_cash"><i class="fa fa-money-bill text-success"></i> Cash</label>
                                    </div>
                                    <div class="radio-item mb-2">
                                        <input type="radio" name="payment_method" id="payment_bank" value="bank transfer">
                                        <label for="payment_bank"><i class="fa fa-university text-danger"></i> Bank Transfer</label>
                                    </div>
                                    <div class="radio-item">
                                        <input type="radio" name="payment_method" id="payment_credit" value="credit card">
                                        <label for="payment_credit"><i class="fa fa-credit-card text-info"></i> Credit Card</label>
                                    </div>
                                </div>
                            </td><br>
                            <td> Payment <input type="number" name="paid_amount" id="paid_amount" class="form-control">
                            </td>
                            <td> Returning Change <input type="number" readonly name="balance" id="balance" class="form-control">
                            </td>
                            <td>
                                <button type="submit" class="btn-lg btn-block mt-2" style="background-color:rgb(4, 56, 134) !important; color: white !important;">Save</button>
                            </td>
                            <td>
                                <button class="btn-lg btn-block mt-2" style="background-color:rgb(245, 12, 12) !important; color: white !important;">Calculator</button>
                            </td>
                            <br>
                            <div class="text-center" style="text-align: center !important">
                                <a href="#" class="text-danger"><i class="fa fa-sign-out-alt"></i> </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>


    </div>
</div>


<!-- Modal: Add product -->
<div class="modal right fade" id="addproduct" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="staticBackdropLabel">Add product</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('products.store') }}" method="POST">
                    @csrf
                    <div class="form-group mb-2">
                        <label>Product Name</label>
                        <input type="text" name="product_name" class="form-control">
                    </div>
                    <div class="form-group mb-2">
                        <label>Brand</label>
                        <input type="text" name="brand" class="form-control">
                    </div>
                    <div class="form-group mb-2">
                        <label>Price</label>
                        <input type="number" name="price" class="form-control">
                    </div>
                    <div class="form-group mb-2">
                        <label>Quantity</label>
                        <input type="number" name="quantity" class="form-control">
                    </div>
                    <div class="form-group mb-2">
                        <label>Alert Stock</label>
                        <input type="number" name="alert_stock" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label>Description</label>
                        <textarea name="description" class="form-control" rows="2"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary w-100">Save Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal">
    <div id="print">
        @include('reports.receipt')
    </div>

</div>



@endsection

<style>
    .modal.right .modal-dialog {
        /* position: absolute; */
        right: 0;
        margin-right: 19vh;
        top: 0;
    }


    .modal.fade:not(.in).right .modal-dialog {
        -webkit-transform: translate3d(25%, 0, 0);
        transform: translate3d(25%, 0, 0);
    }

    /* RADIO BUTTON STYLING - SIMPLE & EFFECTIVE */
    .radio-item {
        display: inline-flex;
        align-items: center;
        margin-right: 15px;
        cursor: pointer;
    }

    /* Hide the default radio */
    .radio-item input[type="radio"] {
        appearance: none;
        -webkit-appearance: none;
        width: 18px;
        height: 18px;
        border: 2px solid #ddd;
        border-radius: 50%;
        margin-right: 5px;
        cursor: pointer;
        position: relative;
    }

    /* Radio checked dot */
    .radio-item input[type="radio"]:checked::after {
        content: "";
        position: absolute;
        width: 10px;
        height: 10px;
        background: #0d6efd;
        border-radius: 50%;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    /* Style the label text & icon */
    .radio-item label {
        display: flex;
        align-items: center;
        gap: 5px;
        cursor: pointer;
    }
</style>

@section('scripts')
<script>
    $(document).ready(function() {
        // Initialize calculation on first row
        calculateRowTotal($('.addMoreProduct tr:first'));

        // Add new row functionality
        $('.add_more').on('click', function(e) {
            e.preventDefault();
            let newRow = `
            <tr>
                <td>${$('.addMoreProduct tr').length + 1}</td>
                <td>
                    <select name="product_id[]" class="form-control product_id">
                        <option value="" selected disabled>Select Product</option>
                        @foreach($products as $product)
                        <option data-price="{{ $product->price }}" value="{{ $product->id }}">
                            {{ $product->product_name }}
                        </option>
                        @endforeach
                    </select>
                </td>
                <td><input type="number" name="quantity[]" class="form-control quantity" min="1" value="1"></td>
                <td><input type="number" name="price[]" class="form-control price" readonly></td>
                <td><input type="number" name="discount[]" class="form-control discount" min="0" max="100" value="0"></td>
                <td><input type="number" name="total_amount[]" class="form-control total_amount" readonly></td>
                <td>
                    <a href="#" class="btn btn-sm btn-danger delete rounded-circle">
                        <i class="fa fa-times"></i>
                    </a>
                </td>
            </tr>`;
            $('.addMoreProduct').append(newRow);
        });

        // Product selection change
        $(document).on('change', '.product_id', function() {
            let price = $(this).find(':selected').data('price') || 0;
            $(this).closest('tr').find('.price').val(price);
            calculateRowTotal($(this).closest('tr'));
        });

        // Quantity or discount change
        $(document).on('input', '.quantity, .discount', function() {
            calculateRowTotal($(this).closest('tr'));
        });

        // Delete row
        $(document).on('click', '.delete', function(e) {
            e.preventDefault();
            if ($('.addMoreProduct tr').length > 1) {
                $(this).closest('tr').remove();
                calculateTotalAmount();
            }
        });

        // Calculate row total
        function calculateRowTotal(row) {
            let price = parseFloat(row.find('.price').val()) || 0;
            let qty = parseFloat(row.find('.quantity').val()) || 0;
            let disc = parseFloat(row.find('.discount').val()) || 0;

            let subtotal = price * qty;
            let discountAmount = subtotal * (disc / 100);
            let total = subtotal - discountAmount;

            row.find('.total_amount').val(total.toFixed(2));
            calculateTotalAmount();
        }

        // Calculate grand total
        function calculateTotalAmount() {
            let total = 0;
            $('.total_amount').each(function() {
                let amount = parseFloat($(this).val()) || 0;
                total += amount;
            });

            $('.total').html(total.toFixed(2));

            // Update balance if payment amount exists
            let paidAmount = parseFloat($('#paid_amount').val()) || 0;
            $('#balance').val((paidAmount - total).toFixed(2));
        }

        // Update balance when payment amount changes
        $('#paid_amount').on('input', function() {
            calculateTotalAmount();
        });
    });

    //print receipt content
    function PrintReceiptContent(el) {
        var data= '<input type="button" id="printPageButton" class="printPageButton" style="display:block; width:100%; border:none; background-color:#008B8B; color:#fff ; padding:14px 28px; font-size:16px; cursor:pointer; text-align:center" value="Print Receipt" onclick="window.print()>'
             data+= document.getElementById(el).innerHTML;
             myReceipt = window.open('', 'myWin', 'left=150, top=130, width=400,height=400');
                myReceipt.screnX=0;
                myReceipt.screnY=0;
                myReceipt.document.write(data);
                myReceipt.document.title = " Print Receipt";
            myReceipt.focus();
            setTimeout(() => {
                
                myReceipt.close();
            }, 8000);
            }

    

</script>
@endsection