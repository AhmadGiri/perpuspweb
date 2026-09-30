<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">
                {{ __('Tambah Buku Baru') }}
            </h2>
            <p class="mt-1 text-sm text-gray-500">
                Tambahkan buku baru ke dalam koleksi perpustakaan.
            </p>
        </div>
    </x-slot>

    <div class="min-h-screen bg-gray-50 py-10">
        <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">

            <div class="overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm">

                <div class="border-b border-gray-100 px-6 py-5">
                    <h3 class="text-lg font-semibold text-gray-800">
                        Form Tambah Buku
                    </h3>

                    <p class="mt-1 text-sm text-gray-500">
                        Isi informasi buku dengan lengkap.
                    </p>
                </div>

                <form action="{{ route('admin.buku.store') }}" method="POST" class="p-6">
                    @csrf

                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                        <div>
                            <label for="kode_buku" class="mb-2 block text-sm font-semibold text-gray-700">
                                Kode Buku
                            </label>

                            <input
                                id="kode_buku"
                                type="text"
                                name="kode_buku"
                                value="{{ old('kode_buku') }}"
                                placeholder="Contoh: BK-003"
                                required
                                class="w-full rounded-lg border-gray-300 shadow-sm transition focus:border-indigo-500 focus:ring-indigo-500"
                            >

                            @error('kode_buku')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="judul" class="mb-2 block text-sm font-semibold text-gray-700">
                                Judul Buku
                            </label>

                            <input
                                id="judul"
                                type="text"
                                name="judul"
                                value="{{ old('judul') }}"
                                placeholder="Masukkan judul buku"
                                required
                                class="w-full rounded-lg border-gray-300 shadow-sm transition focus:border-indigo-500 focus:ring-indigo-500"
                            >

                            @error('judul')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="pengarang" class="mb-2 block text-sm font-semibold text-gray-700">
                                Pengarang
                            </label>

                            <input
                                id="pengarang"
                                type="text"
                                name="pengarang"
                                value="{{ old('pengarang') }}"
                                placeholder="Nama pengarang"
                                required
                                class="w-full rounded-lg border-gray-300 shadow-sm transition focus:border-indigo-500 focus:ring-indigo-500"
                            >

                            @error('pengarang')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="penerbit" class="mb-2 block text-sm font-semibold text-gray-700">
                                Penerbit
                            </label>

                            <input
                                id="penerbit"
                                type="text"
                                name="penerbit"
                                value="{{ old('penerbit') }}"
                                placeholder="Nama penerbit"
                                required
                                class="w-full rounded-lg border-gray-300 shadow-sm transition focus:border-indigo-500 focus:ring-indigo-500"
                            >

                            @error('penerbit')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="stok" class="mb-2 block text-sm font-semibold text-gray-700">
                                Stok Buku
                            </label>

                            <input
                                id="stok"
                                type="number"
                                name="stok"
                                value="{{ old('stok') }}"
                                min="0"
                                placeholder="Jumlah stok"
                                required
                                class="w-full rounded-lg border-gray-300 shadow-sm transition focus:border-indigo-500 focus:ring-indigo-500"
                            >

                            <p class="mt-1 text-xs text-gray-400">
                                Masukkan jumlah buku yang tersedia.
                            </p>

                            @error('stok')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    <div class="mt-8 flex flex-col-reverse gap-3 border-t border-gray-100 pt-6 sm:flex-row sm:justify-end">

                        <a
                            href="{{ route('admin.buku.index') }}"
                            class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-5 py-2.5 font-medium text-gray-700 transition duration-200 hover:bg-gray-50"
                        >
                            Batal
                        </a>

                        <button
                            type="submit"
                            class="inline-flex items-center justify-center gap-2 rounded-lg bg-indigo-600 px-5 py-2.5 font-medium text-white shadow-sm transition duration-200 hover:bg-indigo-700 hover:shadow"
                        >
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 4v16m8-8H4"/>
                            </svg>

                            Simpan Buku
                        </button>

                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
