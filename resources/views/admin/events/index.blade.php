<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Manajemen Event
        </h2>
    </x-slot>

    <div class="py-10 max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        {{-- Notifikasi Sukses --}}
        @if (session('success'))
            <div class="bg-green-100 border border-green-300 text-green-800 p-4 rounded-lg mb-5">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex justify-between items-center mb-6">
            <h3 class="text-lg font-bold text-gray-800">Daftar Event</h3>
            <a href="{{ route('admin.events.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-semibold">
                + Tambah Event Baru
            </a>
        </div>

        {{-- Tabel Daftar Event --}}
        <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-100 text-gray-600 text-sm border-b">
                        <th class="p-4">Poster</th>
                        <th class="p-4">Judul Event</th>
                        <th class="p-4">Kategori</th>
                        <th class="p-4">Harga</th>
                        <th class="p-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($events as $event)
                        <tr class="border-b hover:bg-gray-50 text-sm">
                            <td class="p-4">
                                @if($event->image)
                                    <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}" class="w-16 h-12 object-cover rounded">
                                @else
                                    <span class="text-xs text-gray-400">Tidak ada</span>
                                @endif
                            </td>
                            <td class="p-4 font-semibold text-gray-800">{{ $event->title }}</td>
                            <td class="p-4">
                                <span class="bg-blue-100 text-blue-700 px-2.5 py-1 rounded text-xs font-semibold">
                                    {{ $event->category }}
                                </span>
                            </td>
                            <td class="p-4 font-bold text-green-600">Rp {{ number_format($event->price, 0, ',', '.') }}</td>
                            <td class="p-4 text-center space-x-2">
                                <a href="{{ route('admin.events.edit', $event->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1.5 rounded text-xs font-semibold">
                                    Edit
                                </a>
                                <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus event ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1.5 rounded text-xs font-semibold">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-10 text-center text-gray-500">
                                Belum ada event yang ditambahkan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-5">
            {{ $events->links() }}
        </div>

    </div>
</x-app-layout>