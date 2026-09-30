<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">
                {{ __('Tambah Peminjaman') }}
            </h2>
            <p class="mt-1 text-sm text-gray-500">
                Buat transaksi peminjaman buku untuk anggota perpustakaan.
            </p>
        </div>
    </x-slot>

    <div class="min-h-screen bg-gray-50 py-10">
        <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">

            <div class="overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm">

                <div class="border-b border-gray-100 px-6 py-5">
                    <h3 class="text-lg font-semibold text-gray-800">
                        Form Peminjaman Buku
                    </h3>

                    <p class="mt-1 text-sm text-gray-500">
                        Isi data anggota, buku, dan tanggal peminjaman.
                    </p>
                </div>

                <form action="{{ route('admin.peminjaman.store') }}" method="POST" class="p-6">
                    @csrf

                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                        {{-- Anggota --}}
                        <div class="md:col-span-2">
                            <label for="user_id" class="mb-2 block text-sm font-semibold text-gray-700">
                                Siswa / Anggota
                            </label>

                            <select
                                id="user_id"
                                name="user_id"
                                required
                                class="w-full rounded-lg border-gray-300 shadow-sm transition focus:border-indigo-500 focus:ring-indigo-500"
                            >
                                <option value="">-- Pilih Siswa --</option>

                                @foreach ($users as $usr)
                                    <option
                                        value="{{ $usr->id }}"
                                        {{ old('user_id') == $usr->id ? 'selected' : '' }}
                                    >
                                        {{ $usr->name }} ({{ $usr->email }})
                                    </option>
                                @endforeach
                            </select>

                            @error('user_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Buku --}}
                        <div class="md:col-span-2">
                            <label for="buku_id" class="mb-2 block text-sm font-semibold text-gray-700">
                                Buku
                            </label>

                            <select
                                id="buku_id"
                                name="buku_id"
                                required
                                class="w-full rounded-lg border-gray-300 shadow-sm transition focus:border-indigo-500 focus:ring-indigo-500"
                            >
                                <option value="">-- Pilih Buku --</option>

                                @foreach ($bukus as $buku)
                                    <option
                                        value="{{ $buku->id }}"
                                        {{ old('buku_id') == $buku->id ? 'selected' : '' }}
                                        {{ $buku->stok <= 0 ? 'disabled' : '' }}
                                    >
                                        {{ $buku->judul }} — Stok: {{ $buku->stok }}
                                    </option>
                                @endforeach
                            </select>

                            @error('buku_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Tanggal Pinjam --}}
                        <div>
                            <label for="tanggal_pinjam" class="mb-2 block text-sm font-semibold text-gray-700">
                                Tanggal Pinjam
                            </label>

                            <input
                                id="tanggal_pinjam"
                                type="date"
                                name="tanggal_pinjam"
                                value="{{ old('tanggal_pinjam', date('Y-m-d')) }}"
                                required
                                class="w-full rounded-lg border-gray-300 shadow-sm transition focus:border-indigo-500 focus:ring-indigo-500"
                            >

                            @error('tanggal_pinjam')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Tanggal Kembali --}}
                        <div>
                            <label for="tanggal_kembali" class="mb-2 block text-sm font-semibold text-gray-700">
                                Batas Pengembalian
                            </label>

                            <input
                                id="tanggal_kembali"
                                type="date"
                                name="tanggal_kembali"
                                value="{{ old('tanggal_kembali', date('Y-m-d', strtotime('+7 days'))) }}"
                                required
                                class="w-full rounded-lg border-gray-300 shadow-sm transition focus:border-indigo-500 focus:ring-indigo-500"
                            >

                            @error('tanggal_kembali')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    <div class="mt-8 flex flex-col-reverse gap-3 border-t border-gray-100 pt-6 sm:flex-row sm:justify-end">

                        <a
                            href="{{ route('admin.peminjaman.index') }}"
                            class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-5 py-2.5 font-medium text-gray-700 transition hover:bg-gray-50"
                        >
                            Batal
                        </a>

                        <button
                            type="submit"
                            class="inline-flex items-center justify-center gap-2 rounded-lg bg-indigo-600 px-5 py-2.5 font-medium text-white shadow-sm transition hover:bg-indigo-700"
                        >
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M5 13l4 4L19 7"/>
                            </svg>

                            Simpan Peminjaman
                        </button>

                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
