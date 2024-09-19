<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $data['TotalOrders'] = Order::getTotalOrder();
        $data['TotalUsers'] = User::getTotalMembers();
        $data['getNewOrders'] = Order::getNewOrders();
        $data['getNewCustomers'] = User::getNewCustomer();
        $data['header_title'] = 'Dashboard';
        return view('dashboard', $data);
    }
}
