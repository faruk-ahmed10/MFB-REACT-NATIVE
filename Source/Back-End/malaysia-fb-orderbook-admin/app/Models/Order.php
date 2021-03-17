<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $primaryKey = 'id';

    public function order_details() {
        return $this->hasMany(OrderDetail::class)->with('product');
    }

    public function user() {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
