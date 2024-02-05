<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\Product;


class DashboardController extends Controller
{
    public function index() {

        $users = User::count();
        $orders = Transaction::sum('subtotal');
        $products = Product::count();
        $montlyOrder = Transaction::whereMonth('created_at', date('m'))->sum('subtotal');
        return view('admin.dashboard', compact('users', 'orders', 'products', 'montlyOrder'));
    }
}
