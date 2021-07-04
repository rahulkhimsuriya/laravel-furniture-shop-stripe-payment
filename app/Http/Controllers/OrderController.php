<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Order/Index', [
            'orders' => Order::with('orderDetails.product')
                ->paginate(10)
                ->withQueryString()
        ]);
    }
}
