<?php

namespace App\Http\Controllers;

use App\Models\OrderDetails;
use Illuminate\Http\Request;

class OrderDetailsController extends Controller
{
    public function index()
    {
        $orderDetails = OrderDetails::with(['orders', 'events'])->latest()->paginate(10);
        return view('admin.order_details.index', compact('orderDetails'));
    }

    public function show(OrderDetails $orderDetails)
    {
        return view('admin.order_details.show', compact('orderDetails'));
    }

    public function destroy(OrderDetails $orderDetails)
    {
        $orderDetails->delete();
        return redirect()->back()->with('success', 'Detail pesanan berhasil dihapus!');
    }
}