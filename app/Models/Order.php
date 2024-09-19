<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    static public function getSingle($id)
    {
        return self::find($id);
    }

    static public function getRecord()
    {
        return self::select('orders.*', 'users.name as user_name', 'product.title as product_title')
            ->join('users', 'users.id', '=', 'orders.user_id')
            ->join('product', 'product.id', '=', 'orders.product_id')
            ->orderBy('id', 'desc')
            ->paginate(10);
    }

    static public function getOrderByUser($user_id)
    {
        return self::select('orders.*', 'product.title as product_title')
            ->join('product', 'product.id', '=', 'orders.product_id')
            ->where('orders.user_id', $user_id)
            ->orderBy('id', 'desc')
            ->paginate(10);
    }

    static public function getNewOrders()
    {
        return self::select('orders.*', 'users.name as user_name', 'product.title as product_title')
            ->join('users', 'users.id', '=', 'orders.user_id')
            ->join('product', 'product.id', '=', 'orders.product_id')
            ->orderBy('id', 'desc')
            ->limit(10)
            ->get();
    }

    static public function getTotalOrder()
    {
        return self::select('id')
            ->count();
    }

    public function getUser()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
