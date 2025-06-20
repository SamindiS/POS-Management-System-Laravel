<div class="receipt-container" id="receipt">
    <div class="receipt-header">
        <div class="logo">
            <!-- <i class="fas fa-store-alt fa-1x"></i> -->
        </div>
        <div class="company-info">
            <h1>Construction22 (Pvt) Ltd</h1>
            <p class="tagline">Building Excellence Since 2022</p>
            <p class="contact">123 Builder's Lane, Construct City, CC 90210</p>
            <p class="contact">Tel: +1 234 567 8900 | Email: contact@construction22.com</p>
        </div>
    </div>
    
    <div class="receipt-meta">
        <div class="meta-row">
            <span>Receipt #:</span>
            <strong>INV-{{ str_pad($order_receipt->first()->order_id, 5, '0', STR_PAD_LEFT) }}</strong>
        </div>
        <div class="meta-row">
            <span>Date:</span>
            <strong>{{ now()->format('d/m/Y H:i') }}</strong>
        </div>
        <div class="meta-row">
            <span>Cashier:</span>
            <strong>{{ Auth::user()->name }}</strong>
        </div>
    </div>
    
    <div class="customer-info">
        <div class="info-row">
            <span>Customer:</span>
            <strong>{{ $orders->first()->name ?? 'Walk-in Customer' }}</strong>
        </div>
        <div class="info-row">
            <span>Phone:</span>
            <strong>{{ $orders->first()->phone ?? 'N/A' }}</strong>
        </div>
    </div>
    
    <div class="items-table">
        <table>
            <thead>
                <tr>
                    <th class="text-left">Item</th>
                    <th class="text-center">Qty</th>
                    <th class="text-right">Price</th>
                    <th class="text-right">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order_receipt as $receipt)
                <tr>
                    <td class="text-left">{{ $receipt->product->product_name }}</td>
                    <td class="text-center">{{ $receipt->quantity }}</td>
                    <td class="text-right">{{ number_format($receipt->unitprice, 2) }}</td>
                    <td class="text-right">{{ number_format($receipt->amount, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <div class="totals-section">
        <div class="total-row">
            <span>Subtotal:</span>
            <span>{{ number_format($order_receipt->sum('amount'), 2) }}</span>
        </div>
        <div class="total-row">
            <span>Discount:</span>
            <span>{{ number_format($order_receipt->sum(function($item) { 
                return ($item->unitprice * $item->quantity) * ($item->discount / 100); 
            }), 2) }}</span>
        </div>
        <div class="total-row">
            <span>Tax (10%):</span>
            <span>{{ number_format($order_receipt->sum('amount') * 0.1, 2) }}</span>
        </div>
        <div class="total-row grand-total">
            <span>TOTAL:</span>
            <span>{{ number_format($total_amount, 2) }}</span>
        </div>
        <div class="total-row">
            <span>Amount Paid:</span>
            <span>{{ number_format($paid_amount, 2) }}</span>
        </div>
        <div class="total-row">
            <span>Change Due:</span>
            <span>{{ number_format($balance, 2) }}</span>
        </div>
    </div>
    
    <div class="payment-method">
        <p>Payment Method: <strong>Cash</strong></p>
    </div>
    
    <div class="receipt-footer">
        <div class="thank-you">
            <p>Thank you for your business!</p>
        </div>
        <div class="return-policy">
            <p>Items can be returned within 14 days with original receipt</p>
        </div>
        <div class="barcode">
            <div class="barcode-placeholder">*INV-{{ str_pad($order_receipt->first()->order_id, 5, '0', STR_PAD_LEFT) }}*</div>
        </div>
        <div class="footer-note">
            <p>This is a computer generated receipt</p>
            <p>No signature required</p>
        </div>
    </div>
</div>

<style>
    /* Receipt Styles */
    .receipt-container {
        width: 80mm;
        margin: 0 auto;
        padding: 5mm;
        font-family: 'Arial', sans-serif;
        font-size: 12px;
        color: #000;
        background: #fff;
    }
    
    .receipt-header {
        text-align: center;
        margin-bottom: 10px;
        padding-bottom: 10px;
        border-bottom: 1px dashed #ccc;
    }
    
    .receipt-header .logo {
        margin-bottom: 5px;
        color: #2c3e50;
    }
    
    .receipt-header .company-info h1 {
        font-size: 18px;
        margin: 5px 0;
        font-weight: bold;
    }
    
    .receipt-header .tagline {
        font-size: 10px;
        color: #666;
        margin: 0 0 5px 0;
    }
    
    .receipt-header .contact {
        font-size: 9px;
        margin: 2px 0;
        color: #555;
    }
    
    .receipt-meta {
        margin: 8px 0;
        padding-bottom: 8px;
        border-bottom: 1px dashed #ccc;
    }
    
    .meta-row {
        display: flex;
        justify-content: space-between;
        margin: 3px 0;
    }
    
    .customer-info {
        margin: 8px 0;
        padding-bottom: 8px;
        border-bottom: 1px dashed #ccc;
    }
    
    .info-row {
        display: flex;
        justify-content: space-between;
        margin: 3px 0;
    }
    
    .items-table {
        width: 100%;
        margin: 10px 0;
    }
    
    .items-table table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .items-table th {
        text-align: left;
        padding: 3px 0;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
    }
    
    .items-table td {
        padding: 4px 0;
        border-bottom: 1px dashed #eee;
    }
    
    .text-left { text-align: left; }
    .text-center { text-align: center; }
    .text-right { text-align: right; }
    
    .totals-section {
        margin: 10px 0;
        padding-top: 5px;
        border-top: 1px dashed #ccc;
    }
    
    .total-row {
        display: flex;
        justify-content: space-between;
        margin: 5px 0;
    }
    
    .grand-total {
        font-weight: bold;
        font-size: 14px;
        margin: 8px 0;
        padding-top: 5px;
        border-top: 1px solid #000;
    }
    
    .payment-method {
        margin: 10px 0;
        padding: 5px 0;
        border-top: 1px dashed #ccc;
        border-bottom: 1px dashed #ccc;
        text-align: center;
    }
    
    .receipt-footer {
        margin-top: 15px;
        text-align: center;
        font-size: 10px;
    }
    
    .thank-you {
        font-weight: bold;
        margin-bottom: 5px;
    }
    
    .return-policy {
        margin: 5px 0;
        color: #666;
    }
    
    .barcode {
        margin: 10px 0;
    }
    
    .barcode-placeholder {
        font-family: 'Libre Barcode 128', cursive;
        font-size: 24px;
        letter-spacing: 2px;
    }
    
    .footer-note {
        margin-top: 10px;
        color: #777;
        font-size: 9px;
    }
    
    @media print {
        body * {
            visibility: hidden;
        }
        #receipt, #receipt * {
            visibility: visible;
        }
        #receipt {
            position: absolute;
            left: 0;
            top: 0;
            width: 80mm;
            margin: 0;
            padding: 5mm;
        }
        @page {
            size: auto;
            margin: 0;
        }
    }
</style>