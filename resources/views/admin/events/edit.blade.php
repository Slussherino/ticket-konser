<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Event
        </h2>
    </x-slot>

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

        {{-- Form utama untuk update event --}}
        <form action="{{ route('admin.events.update', $event->id) }}"
              method="POST"
              enctype="multipart/form-data"
              class="bg-white p-6 rounded-lg shadow-sm border">

            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="title" class="block font-medium mb-1">
                    Nama Event
                </label>
                <input id="title" type="text" name="title"
                       value="{{ old('title', $event->title) }}"
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
                    <option value="Musik" @selected(old('category', $event->category) === 'Musik')>
                        Musik
                    </option>
                    <option value="Festival" @selected(old('category', $event->category) === 'Festival')>
                        Festival
                    </option>
                    <option value="Seminar" @selected(old('category', $event->category) === 'Seminar')>
                        Seminar
                    </option>
                </select>
            </div>

            <div class="mb-4">
                <label for="price" class="block font-medium mb-1">
                    Harga Tiket (Rp)
                </label>
                <input id="price" type="number" name="price"
                       value="{{ old('price', $event->price) }}"
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
                          required>{{ old('description', $event->description) }}</textarea>
            </div>

            <div class="mb-5">
                <label class="block font-medium mb-2">
                    Poster Saat Ini
                </label>

                @if ($event->image)
                    <img src="{{ asset('storage/' . $event->image) }}"
                         alt="{{ $event->title }}"
                         class="w-40 h-40 object-cover rounded-lg border mb-3">
                @else
                    <div class="w-40 h-40 bg-gray-100 rounded-lg flex items-center justify-center text-gray-400 mb-3">
                        Belum ada poster
                    </div>
                @endif

                <label for="image" class="block font-medium mb-1">
                    Ganti Poster (Opsional)
                </label>
                <input id="image" type="file" name="image"
                       accept=".jpg,.jpeg,.png,.gif"
                       class="w-full border rounded-lg p-2">

                <p class="text-sm text-gray-500 mt-1">
                    Kosongkan jika tidak ingin mengganti poster. Maksimal 2 MB.
                </p>
            </div>

            <div class="flex gap-3">
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-lg font-semibold">
                    Update Event
                </button>

                <a href="{{ route('admin.events.index') }}"
                   class="bg-gray-200 hover:bg-gray-300 px-6 py-2.5 rounded-lg font-semibold">
                    Kembali
                </a>
            </div>
        </form>
    </div>
</x-app-layout>