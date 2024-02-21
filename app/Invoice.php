<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = ['invoice_id', 'user_name', 'product_id', 'product_qty', 'status', 'seller_id'];
}
