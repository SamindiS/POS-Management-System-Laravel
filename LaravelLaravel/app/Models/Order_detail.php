<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_Detail extends Model
{
    protected $table= 'order__details';
    protected $fillable = ['order_id', 'product_id', 'unitprice','quantity',  'amount', 'discount'];

    public function product()
    {
        return $this->belongsTo('APP\Models\Product');
    }

    public function order()
    {
        return $this->belongsTo('APP\Models\Order');
    }
}

