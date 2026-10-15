
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard Admin
        </h2>
    </x-slot>

    <div class="py-10 max-w-7xl mx-auto sm:px-6 lg:px-8">

        {{-- Notifikasi --}}
        @if (session('success'))
            <div class="bg-green-100 border border-green-300 text-green-800 p-4 rounded-lg mb-5">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border border-red-300 text-red-800 p-4 rounded-lg mb-5">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 border border-red-300 text-red-800 p-4 rounded-lg mb-5">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Ringkasan --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-5 mb-8">

            <div class="bg-white rounded-xl shadow-sm border p-5">
                <p class="text-sm text-gray-500">Total Event</p>
                <h3 class="text-3xl font-bold text-blue-600 mt-2">
                    {{ $totalEvents }}
                </h3>
            </div>

            <div class="bg-white rounded-xl shadow-sm border p-5">
                <p class="text-sm text-gray-500">Total Pesanan</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2">
                    {{ $totalOrders }}
                </h3>
            </div>

            <div class="bg-white rounded-xl shadow-sm border p-5">
                <p class="text-sm text-gray-500">Pending</p>
                <h3 class="text-3xl font-bold text-yellow-600 mt-2">
                    {{ $pendingOrders }}
                </h3>
            </div>

            <div class="bg-white rounded-xl shadow-sm border p-5">
                <p class="text-sm text-gray-500">Confirmed</p>
                <h3 class="text-3xl font-bold text-green-600 mt-2">
                    {{ $confirmedOrders }}
                </h3>
            </div>

            <div class="bg-white rounded-xl shadow-sm border p-5">
                <p class="text-sm text-gray-500">Cancelled</p>
                <h3 class="text-3xl font-bold text-red-600 mt-2">
                    {{ $cancelledOrders }}
                </h3>
            </div>

        </div>

        {{-- Tabel Pesanan --}}
        <div class="bg-white rounded-xl shadow-sm border overflow-hidden">

            <div class="p-5 border-b">
                <h3 class="text-lg font-bold text-gray-800">
                    Manajemen Pesanan
                </h3>
                <p class="text-sm text-gray-500 mt-1">
                    Konfirmasi atau batalkan pesanan customer.
                </p>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full min-w-[1000px]">
                    <thead>
                        <tr class="bg-gray-100 text-gray-600 text-sm">
                            <th class="p-4 text-center">ID</th>
                            <th class="p-4 text-left">Nama Customer</th>
                            <th class="p-4 text-left">Email</th>
                            <th class="p-4 text-left">Event</th>
                            <th class="p-4 text-center">Jumlah</th>
                            <th class="p-4 text-right">Total Harga</th>
                            <th class="p-4 text-center">Status</th>
                            <th class="p-4 text-center">Ubah Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($orders as $order)
                            <tr class="border-t hover:bg-gray-50 text-sm">

                                <td class="p-4 text-center">
                                    #{{ $order->id }}
                                </td>

                                <td class="p-4 font-semibold text-gray-800">
                                    {{ $order->customer_name }}
                                </td>

                                <td class="p-4">
                                    {{ $order->customer_email }}
                                </td>

                                <td class="p-4">
                                    @forelse ($order->orderDetails as $detail)
                                        <div class="mb-1">
                                            {{ $detail->events?->title ?? 'Event tidak tersedia' }}
                                        </div>
                                    @empty
                                        <span class="text-gray-400">
                                            Tidak ada detail
                                        </span>
                                    @endforelse
                                </td>

                                <td class="p-4 text-center">
                                    @forelse ($order->orderDetails as $detail)
                                        <div class="mb-1">
                                            {{ $detail->quantity }}
                                        </div>
                                    @empty
                                        -
                                    @endforelse
                                </td>

                                <td class="p-4 text-right font-bold whitespace-nowrap">
                                    Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                </td>

                                <td class="p-4 text-center">
                                    @if ($order->status === 'Pending')
                                        <span class="inline-block bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-xs font-semibold">
                                            Pending
                                        </span>
                                    @elseif ($order->status === 'Confirmed')
                                        <span class="inline-block bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-semibold">
                                            Confirmed
                                        </span>
                                    @else
                                        <span class="inline-block bg-red-100 text-red-800 px-3 py-1 rounded-full text-xs font-semibold">
                                            Cancelled
                                        </span>
                                    @endif
                                </td>

                                <td class="p-4">
                                    <form action="{{ route('admin.orders.updateStatus', ['id' => $order->id]) }}"method="POST" class="flex flex-col gap-2">
                                    @csrf
                                    @method('PATCH')
        
                                <select name="status" ="w-full border-gray-300 rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500" required>
                                    <option value="Pending" @selected($order->status === 'Pending')>Pending</option>
                                    <option value="Confirmed" @selected($order->status === 'Confirmed')>Confirmed</option>
                                    <option value="Cancelled" @selected($order->status === 'Cancelled')>Cancelled</option>
                                </select>

                                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded-lg text-sm font-semibold">Simpan Status
                                </button>
                                </form>
                            </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="p-10 text-center text-gray-500">
                                    Belum ada pesanan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-5 border-t">
                {{ $orders->links() }}
            </div>

        </div>
    </div>
</x-app-layout>
