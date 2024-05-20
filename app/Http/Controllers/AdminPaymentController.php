<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;
use Inertia\Inertia;

class AdminPaymentController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');
        $order = $request->input('order');

        $payments = Payment::with('order.user')
            ->when($query, function ($query, $search) {
                return $query->where('transaction_id', 'like', '%' . $search . '%');
            })
            ->when($order, function ($query, $order) {
                [$criteria, $direction] = explode('_', $order);
                $column = $criteria === 'amount' ? 'amount' : 'status';
                return $query->orderBy($column, $direction);
            })
            ->paginate(10);

        return Inertia::render('Admin/Payments/Index', [
            'payments' => $payments,
            'flash' => [
                'success' => session('success')
            ]
        ]);
    }
}
