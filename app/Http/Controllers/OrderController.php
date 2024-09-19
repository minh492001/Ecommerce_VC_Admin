<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CompanyModel;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function list()
    {
        $data['header_title'] = "Orders";
        $data['getOrder'] = Order::getRecord();
        $data['TotalOrder'] = Order::getTotalOrder();
        return view('order.list', $data);
    }

    public function add()
    {
        $data['header_title'] = "New Order";
        $data['getProduct'] = Product::getActiveProduct();
        $data['getUser'] = User::getRecord();

        return view('order.add', $data);
    }

    public function insert(Request $request)
    {
        $product = Product::getSingle($request->product_id);
        $price = intval($product->price);
        $total = $price * $request->quantity;

        $order = new Order;
        $order->order_number = mt_rand(100000000, 999999999);
        $order->user_id = $request->user_id;
        $order->product_id = $request->product_id;
        $order->price = $price;
        $order->quantity = $request->quantity;
        $order->total = $total;
        $order->save();

        return redirect('orders/list')->with('success', 'Order added successfully !');
    }

    public function edit($id)
    {
        $data['header_title'] = "Edit Company";
        $data['getRecord'] = Order::getSingle($id);
        $data['getUser'] = User::getRecord();
        $data['getProduct'] = Product::getRecord();
        return view('order.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $product = Product::getSingle($request->product_id);
        $price = intval($product->price);
        $total = $price * $request->quantity;

        $order = Order::getSingle($id);
        $order->user_id = $request->user_id;
        $order->product_id = $request->product_id;
        $order->price = $price;
        $order->quantity = $request->quantity;
        $order->total = $total;
        $order->save();

        return redirect('orders/list')->with('success', 'Order updated successfully !');

    }
}
