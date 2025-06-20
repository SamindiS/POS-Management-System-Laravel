<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use App\Models\Order;


class Transaction extends Model implements Auditable
{
     use \OwenIt\Auditing\Auditable;
    
    protected $fillable = [
        'order_id',
        'paid_amount',
        'balance',
        'payment_method',
        'transac_date',
        'status',
        'notes'
    ];
    
    protected $casts = [
        'transac_date' => 'datetime',
        'paid_amount' => 'decimal:2',
        'balance' => 'decimal:2'
    ];
    
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    
    public static function paymentMethods()
    {
        return [
            'credit_card' => 'Credit Card',
            'bank_transfer' => 'Bank Transfer',
            'cash' => 'Cash',
            'paypal' => 'PayPal'
        ];
    }
    
    public static function statuses()
    {
        return [
            'completed' => 'Completed',
            'pending' => 'Pending',
            'failed' => 'Failed'
        ];
    }
}