
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Event
        </h2>
    </x-slot>

    <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
    </form>

    <div class="py-12 max-w-2xl mx-auto sm:px-6 lg:px-8">

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-5">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.events.store') }}"
              method="POST"
              enctype="multipart/form-data"
              class="bg-white p-6 rounded-lg shadow-sm border">

            @csrf

            <div class="mb-4">
                <label for="title" class="block font-medium mb-1">
                    Nama Event
                </label>
                <input id="title" type="text" name="title"
                       value="{{ old('title') }}"
                       class="w-full border-gray-300 rounded-lg p-2"
                       required>
            </div>

            <div class="mb-4">
                <label for="category" class="block font-medium mb-1">
                    Kategori
                </label>
                <select id="category" name="category"
                        class="w-full border-gray-300 rounded-lg p-2"
                        required>
                    <option value="">-- Pilih Kategori --</option>
                    <option value="Musik" @selected(old('category') === 'Musik')>
                        Musik
                    </option>
                    <option value="Festival" @selected(old('category') === 'Festival')>
                        Festival
                    </option>
                    <option value="Seminar" @selected(old('category') === 'Seminar')>
                        Seminar
                    </option>
                </select>
            </div>

            <div class="mb-4">
                <label for="price" class="block font-medium mb-1">
                    Harga Tiket (Rp)
                </label>
                <input id="price" type="number" name="price"
                       value="{{ old('price') }}"
                       min="0"
                       class="w-full border-gray-300 rounded-lg p-2"
                       required>
            </div>

            <div class="mb-4">
                <label for="description" class="block font-medium mb-1">
                    Deskripsi
                </label>
                <textarea id="description" name="description" rows="4"
                          class="w-full border-gray-300 rounded-lg p-2"
                          required>{{ old('description') }}</textarea>
            </div>

            <div class="mb-6">
                <label for="image" class="block font-medium mb-1">
                    Poster Event
                </label>
                <input id="image" type="file" name="image"
                       accept=".jpg,.jpeg,.png,.gif"
                       class="w-full border rounded-lg p-2">

                <p class="text-sm text-gray-500 mt-1">
                    Maksimal 2 MB. Gambar bersifat opsional.
                </p>
            </div>

            <div class="flex gap-3">
                <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white px-6 py-2.5 rounded-lg font-semibold">
                    Simpan Event
                </button>

                <a href="{{ route('admin.events.index') }}"
                   class="bg-gray-200 hover:bg-gray-300 px-6 py-2.5 rounded-lg font-semibold">
                    Kembali
                </a>
            </div>
        </form>
    </div>
</x-app-layout>
