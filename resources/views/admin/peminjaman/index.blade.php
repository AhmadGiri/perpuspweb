<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">
                {{ __('Data Peminjaman') }}
            </h2>
            <p class="mt-1 text-sm text-gray-500">
                Kelola seluruh transaksi peminjaman buku.
            </p>
        </div>
    </x-slot>

    <div class="min-h-screen bg-gray-50 py-10">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            <div class="overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm">

                {{-- Header --}}
                <div class="border-b border-gray-100 px-6 py-5">
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">
                                Daftar Peminjaman
                            </h3>

                            <p class="mt-1 text-sm text-gray-500">
                                Daftar seluruh transaksi peminjaman buku.
                            </p>
                        </div>

                        <a
                            href="{{ route('admin.peminjaman.create') }}"
                            class="inline-flex items-center justify-center gap-2 rounded-lg bg-indigo-600 px-5 py-2.5 text-sm font-medium text-white shadow-sm transition hover:bg-indigo-700"
                        >
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 4v16m8-8H4"/>
                            </svg>

                            Tambah Peminjaman
                        </a>
                    </div>
                </div>

                {{-- Notifikasi --}}
                @if (session('success'))
                    <div class="mx-6 mt-5 rounded-xl border border-green-200 bg-green-50 px-5 py-4 text-sm font-medium text-green-700">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="mx-6 mt-5 rounded-xl border border-red-200 bg-red-50 px-5 py-4 text-sm font-medium text-red-700">
                        {{ session('error') }}
                    </div>
                @endif

                {{-- Table --}}
                <div class="p-6">
                    <div class="overflow-x-auto rounded-xl border border-gray-200">

                        <table class="w-full text-left text-sm">
                            <thead class="bg-gray-50 text-xs uppercase tracking-wider text-gray-600">
                                <tr>
                                    <th class="px-5 py-4 text-center font-semibold">No</th>
                                    <th class="px-5 py-4 font-semibold">Anggota</th>
                                    <th class="px-5 py-4 font-semibold">Buku</th>
                                    <th class="px-5 py-4 text-center font-semibold">Tanggal Pinjam</th>
                                    <th class="px-5 py-4 text-center font-semibold">Batas Kembali</th>
                                    <th class="px-5 py-4 text-center font-semibold">Status</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-100 bg-white">

                                @forelse ($peminjamans as $peminjaman)
                                    <tr class="transition hover:bg-gray-50">

                                        <td class="px-5 py-4 text-center text-gray-500">
                                            {{ $loop->iteration }}
                                        </td>

                                        <td class="px-5 py-4">
                                            <div class="font-semibold text-gray-800">
                                                {{ $peminjaman->user->name }}
                                            </div>
                                            <div class="mt-1 text-xs text-gray-400">
                                                {{ $peminjaman->user->email }}
                                            </div>
                                        </td>

                                        <td class="px-5 py-4">
                                            <div class="font-semibold text-gray-800">
                                                {{ $peminjaman->buku->judul }}
                                            </div>
                                            <div class="mt-1 text-xs text-indigo-600">
                                                {{ $peminjaman->buku->kode_buku }}
                                            </div>
                                        </td>

                                        <td class="px-5 py-4 text-center text-gray-600">
                                            {{ $peminjaman->tanggal_pinjam }}
                                        </td>

                                        <td class="px-5 py-4 text-center text-gray-600">
                                            {{ $peminjaman->tanggal_kembali }}
                                        </td>

                                        <td class="px-5 py-4 text-center">
                                            @if ($peminjaman->status === 'dipinjam')
                                                <span class="inline-flex rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold text-amber-700">
                                                    Dipinjam
                                                </span>
                                            @else
                                                <span class="inline-flex rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                                    Dikembalikan
                                                </span>
                                            @endif
                                        </td>

                                    </tr>

                                @empty

                                    <tr>
                                        <td colspan="6" class="px-6 py-12 text-center">
                                            <div class="flex flex-col items-center">

                                                <svg class="mb-3 h-12 w-12 text-gray-300"
                                                     fill="none"
                                                     stroke="currentColor"
                                                     viewBox="0 0 24 24">
                                                    <path stroke-linecap="round"
                                                          stroke-linejoin="round"
                                                          stroke-width="1.5"
                                                          d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                </svg>

                                                <p class="font-medium text-gray-500">
                                                    Belum ada data peminjaman
                                                </p>

                                                <p class="mt-1 text-sm text-gray-400">
                                                    Transaksi peminjaman akan muncul di sini.
                                                </p>

                                            </div>
                                        </td>
                                    </tr>

                                @endforelse

                            </tbody>
                        </table>

                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
