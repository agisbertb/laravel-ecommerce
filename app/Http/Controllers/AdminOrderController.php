<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Inertia\Inertia;

class AdminOrderController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');
        $order = $request->input('order');

        $orders = Order::with('user', 'billingAddress', 'shippingAddress', 'details')
            ->when($query, function ($query, $search) {
                return $query->where('id', 'like', '%' . $search . '%');
            })
            ->when($order, function ($query, $order) {
                [$criteria, $direction] = explode('_', $order);
                $column = $criteria === 'total' ? 'total' : 'status';
                return $query->orderBy($column, $direction);
            })
            ->paginate(10);

        return Inertia::render('Admin/Orders/Index', [
            'orders' => $orders,
            'flash' => [
                'success' => session('success')
            ]
        ]);
    }
}
