<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Events;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrdersController extends Controller
{
    /**
     * Menampilkan halaman customer beserta daftar event.
     */
    public function index()
    {
        $events = Events::latest()->get();

        return view('customer.index', compact('events'));
    }

    /**
     * Membuat pesanan baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'event_id' => 'required|exists:events,id',
            'quantity' => 'required|integer|min:1',
        ]);

        try {
            DB::transaction(function () use ($validated) {
                $event = Events::findOrFail($validated['event_id']);

                $subtotal = $event->price * $validated['quantity'];

                $order = Orders::create([
                    'customer_name' => $validated['customer_name'],
                    'customer_email' => $validated['customer_email'],
                    'total_price' => $subtotal,
                    'status' => 'Pending',
                ]);

                OrderDetails::create([
                    'order_id' => $order->id,
                    'event_id' => $event->id,
                    'quantity' => $validated['quantity'],
                    'subtotal' => $subtotal,
                ]);
            });

            return redirect()
                ->route('customer.index')
                ->with(
                    'success',
                    'Pesanan berhasil dibuat! Silakan tunggu konfirmasi.'
                );
        } catch (\Throwable $e) {
            Log::error('Gagal membuat pesanan', [
                'message' => $e->getMessage(),
            ]);

            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat memproses pesanan.');
        }
    }

    /**
     * Dashboard admin.
     */
    public function adminDashboard()
    {
        $orders = Orders::with('orderDetails.events')
            ->latest()
            ->paginate(10);

        $totalEvents = Events::count();
        $totalOrders = Orders::count();

        $pendingOrders = Orders::where('status', 'Pending')->count();
        $confirmedOrders = Orders::where('status', 'Confirmed')->count();
        $cancelledOrders = Orders::where('status', 'Cancelled')->count();

        return view('admin.dashboard', compact(
            'orders',
            'totalEvents',
            'totalOrders',
            'pendingOrders',
            'confirmedOrders',
            'cancelledOrders'
        ));
    }

    /**
     * Mengubah status pesanan.
     */
    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:Pending,Confirmed,Cancelled',
        ]);

        $order = Orders::findOrFail($id);

        $order->update([
            'status' => $validated['status'],
        ]);

        return redirect()
            ->route('dashboard')
            ->with('success', 'Status pesanan berhasil diperbarui!');
    }

    /**
     * Menghapus pesanan.
     */
    public function destroy(Orders $orders)
    {
        $orders->delete();

        return redirect()
            ->back()
            ->with('success', 'Data pesanan berhasil dihapus!');
    }
}