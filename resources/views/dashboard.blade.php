<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">
                {{ __('Katalog & Peminjaman Buku') }}
            </h2>
            <p class="mt-1 text-sm text-gray-500">
                Cari buku yang tersedia dan kelola peminjaman Anda.
            </p>
        </div>
    </x-slot>

    <div class="min-h-screen bg-gray-50 py-10">
        <div class="mx-auto max-w-7xl space-y-6 px-4 sm:px-6 lg:px-8">

            {{-- Notifikasi --}}
            @if (session('success'))
                <div class="flex items-center gap-3 rounded-xl border border-green-200 bg-green-50 px-5 py-4 text-sm font-medium text-green-700">
                    <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M5 13l4 4L19 7"/>
                    </svg>

                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if (session('error'))
                <div class="flex items-center gap-3 rounded-xl border border-red-200 bg-red-50 px-5 py-4 text-sm font-medium text-red-700">
                    <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 8v4m0 4h.01M10.29 3.86l-7.36 12.75A2 2 0 004.66 19.6h14.68a2 2 0 001.73-2.99L13.71 3.86a2 2 0 00-3.42 0z"/>
                    </svg>

                    <span>{{ session('error') }}</span>
                </div>
            @endif

            {{-- Katalog --}}
            <div class="overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm">

                <div class="border-b border-gray-100 px-6 py-5">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">
                            Daftar Katalog Buku
                        </h3>
                        <p class="mt-1 text-sm text-gray-500">
                            Buku yang saat ini tersedia untuk dipinjam.
                        </p>
                    </div>
                </div>

                <div class="p-6">
                    <div class="overflow-x-auto rounded-xl border border-gray-200">
                        <table class="w-full text-left text-sm">
                            <thead class="bg-gray-50 text-xs uppercase tracking-wider text-gray-600">
                                <tr>
                                    <th class="px-5 py-4 font-semibold">Kode</th>
                                    <th class="px-5 py-4 font-semibold">Judul Buku</th>
                                    <th class="px-5 py-4 font-semibold">Pengarang</th>
                                    <th class="px-5 py-4 font-semibold">Penerbit</th>
                                    <th class="px-5 py-4 text-center font-semibold">Stok</th>
                                    <th class="px-5 py-4 text-center font-semibold">Aksi</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-100 bg-white">
                                @forelse ($bukus as $buku)
                                    <tr class="transition duration-150 hover:bg-gray-50">

                                        <td class="px-5 py-4">
                                            <span class="font-semibold text-indigo-600">
                                                {{ $buku->kode_buku }}
                                            </span>
                                        </td>

                                        <td class="px-5 py-4">
                                            <span class="font-semibold text-gray-800">
                                                {{ $buku->judul }}
                                            </span>
                                        </td>

                                        <td class="px-5 py-4 text-gray-600">
                                            {{ $buku->pengarang }}
                                        </td>

                                        <td class="px-5 py-4 text-gray-600">
                                            {{ $buku->penerbit }}
                                        </td>

                                        <td class="px-5 py-4 text-center">
                                            <span class="inline-flex items-center rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                                {{ $buku->stok }} tersedia
                                            </span>
                                        </td>

                                        <td class="px-5 py-4 text-center">
                                            <form action="{{ route('user.pinjam') }}" method="POST">
                                                @csrf

                                                <input type="hidden"
                                                       name="buku_id"
                                                       value="{{ $buku->id }}">

                                                <input type="hidden"
                                                       name="tanggal_kembali"
                                                       value="{{ date('Y-m-d', strtotime('+7 days')) }}">

                                                <button
                                                    type="submit"
                                                    class="inline-flex items-center gap-2 rounded-lg bg-emerald-600 px-4 py-2 text-xs font-medium text-white shadow-sm transition duration-200 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2"
                                                >
                                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                              d="M12 6v12m6-6H6"/>
                                                    </svg>
                                                    Pinjam
                                                </button>
                                            </form>
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
                                                          d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                                </svg>

                                                <p class="font-medium text-gray-500">
                                                    Tidak ada buku tersedia
                                                </p>

                                                <p class="mt-1 text-sm text-gray-400">
                                                    Semua stok buku sedang kosong atau habis dipinjam.
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

            {{-- Riwayat --}}
            <div class="overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm">

                <div class="border-b border-gray-100 px-6 py-5">
                    <h3 class="text-lg font-semibold text-gray-800">
                        Riwayat Peminjaman Saya
                    </h3>
                    <p class="mt-1 text-sm text-gray-500">
                        Daftar buku yang pernah atau sedang Anda pinjam.
                    </p>
                </div>

                <div class="p-6">
                    <div class="overflow-x-auto rounded-xl border border-gray-200">
                        <table class="w-full text-left text-sm">
                            <thead class="bg-gray-50 text-xs uppercase tracking-wider text-gray-600">
                                <tr>
                                    <th class="px-5 py-4 text-center font-semibold">No</th>
                                    <th class="px-5 py-4 font-semibold">Judul Buku</th>
                                    <th class="px-5 py-4 text-center font-semibold">Tanggal Pinjam</th>
                                    <th class="px-5 py-4 text-center font-semibold">Batas Pengembalian</th>
                                    <th class="px-5 py-4 text-center font-semibold">Status</th>
                                    <th class="px-5 py-4 text-center font-semibold">Aksi</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-100 bg-white">
                                @forelse ($riwayat as $r)
                                    <tr class="transition duration-150 hover:bg-gray-50">

                                        <td class="px-5 py-4 text-center text-gray-500">
                                            {{ $loop->iteration }}
                                        </td>

                                        <td class="px-5 py-4 font-semibold text-gray-800">
                                            {{ $r->buku->judul }}
                                        </td>

                                        <td class="px-5 py-4 text-center text-gray-600">
                                            {{ $r->tanggal_pinjam }}
                                        </td>

                                        <td class="px-5 py-4 text-center text-gray-600">
                                            {{ $r->tanggal_kembali }}
                                        </td>

                                        <td class="px-5 py-4 text-center">
                                            @if ($r->status === 'dipinjam')
                                                <span class="inline-flex rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold text-amber-700">
                                                    Dipinjam
                                                </span>
                                            @else
                                                <span class="inline-flex rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                                    Dikembalikan
                                                </span>
                                            @endif
                                        </td>

                                        <td class="px-5 py-4 text-center">
                                            @if ($r->status === 'dipinjam')
                                                <form
                                                    action="{{ route('user.kembali', $r->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Yakin ingin mengembalikan buku ini?')"
                                                >
                                                    @csrf
                                                    @method('PATCH')

                                                    <button
                                                        type="submit"
                                                        class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2 text-xs font-medium text-white shadow-sm transition duration-200 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                                                    >
                                                        Kembalikan
                                                    </button>
                                                </form>
                                            @else
                                                <span class="text-sm text-gray-400">
                                                    Selesai
                                                </span>
                                            @endif
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-12 text-center">
                                            <p class="font-medium text-gray-500">
                                                Belum ada riwayat peminjaman.
                                            </p>
                                            <p class="mt-1 text-sm text-gray-400">
                                                Riwayat peminjaman Anda akan muncul di sini.
                                            </p>
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
