<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-gray-800">
                    {{ __('Data Buku') }}
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Kelola data buku perpustakaan
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-10 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

                {{-- Header Card --}}
                <div class="px-6 py-5 border-b border-gray-100">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">
                                Daftar Buku
                            </h3>
                            <p class="text-sm text-gray-500 mt-1">
                                Daftar seluruh buku yang tersedia di perpustakaan.
                            </p>
                        </div>

                        {{-- Tombol Tambah --}}
                        <a href="{{ route('admin.buku.create') }}"
                           class="inline-flex items-center justify-center gap-2
                                  bg-indigo-600 hover:bg-indigo-700
                                  text-white font-medium
                                  px-5 py-2.5 rounded-lg
                                  shadow-sm hover:shadow
                                  transition duration-200">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="w-5 h-5"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M12 4v16m8-8H4" />
                            </svg>

                            Tambah Buku
                        </a>
                    </div>
                </div>

                {{-- Pesan sukses --}}
                @if (session('success'))
                    <div class="mx-6 mt-5">
                        <div class="flex items-center gap-3
                                    bg-green-50 border border-green-200
                                    text-green-700
                                    px-4 py-3 rounded-lg">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="w-5 h-5"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M5 13l4 4L19 7" />
                            </svg>

                            <span class="text-sm font-medium">
                                {{ session('success') }}
                            </span>
                        </div>
                    </div>
                @endif

                {{-- Tabel --}}
                <div class="p-6">
                    <div class="overflow-x-auto rounded-xl border border-gray-200">

                        <table class="w-full text-sm text-left">

                            {{-- Table Header --}}
                            <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                                <tr>
                                    <th class="px-5 py-4 font-semibold">
                                        No
                                    </th>

                                    <th class="px-5 py-4 font-semibold">
                                        Kode Buku
                                    </th>

                                    <th class="px-5 py-4 font-semibold">
                                        Judul
                                    </th>

                                    <th class="px-5 py-4 font-semibold">
                                        Pengarang
                                    </th>

                                    <th class="px-5 py-4 font-semibold">
                                        Penerbit
                                    </th>

                                    <th class="px-5 py-4 font-semibold text-center">
                                        Stok
                                    </th>

                                    <th class="px-5 py-4 font-semibold text-center">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>

                            {{-- Table Body --}}
                            <tbody class="divide-y divide-gray-100 bg-white">

                                @forelse ($bukus as $buku)

                                    <tr class="hover:bg-gray-50 transition duration-150">

                                        {{-- No --}}
                                        <td class="px-5 py-4 text-gray-500">
                                            {{ $loop->iteration }}
                                        </td>

                                        {{-- Kode --}}
                                        <td class="px-5 py-4">
                                            <span class="font-medium text-indigo-600">
                                                {{ $buku->kode_buku }}
                                            </span>
                                        </td>

                                        {{-- Judul --}}
                                        <td class="px-5 py-4">
                                            <div class="font-semibold text-gray-800">
                                                {{ $buku->judul }}
                                            </div>
                                        </td>

                                        {{-- Pengarang --}}
                                        <td class="px-5 py-4 text-gray-600">
                                            {{ $buku->pengarang }}
                                        </td>

                                        {{-- Penerbit --}}
                                        <td class="px-5 py-4 text-gray-600">
                                            {{ $buku->penerbit }}
                                        </td>

                                        {{-- Stok --}}
                                        <td class="px-5 py-4 text-center">

                                            @if ($buku->stok > 0)
                                                <span class="inline-flex items-center
                                                             px-3 py-1 rounded-full
                                                             text-xs font-semibold
                                                             bg-green-100 text-green-700">
                                                    {{ $buku->stok }} tersedia
                                                </span>
                                            @else
                                                <span class="inline-flex items-center
                                                             px-3 py-1 rounded-full
                                                             text-xs font-semibold
                                                             bg-red-100 text-red-700">
                                                    Habis
                                                </span>
                                            @endif

                                        </td>

                                        {{-- Aksi --}}
                                        <td class="px-5 py-4">

                                            <div class="flex items-center justify-center gap-2">

                                                {{-- Edit --}}
                                                <a href="{{ route('admin.buku.edit', $buku->id) }}"
                                                   class="inline-flex items-center gap-1
                                                          bg-amber-500 hover:bg-amber-600
                                                          text-white
                                                          px-3 py-2 rounded-lg
                                                          text-xs font-medium
                                                          transition duration-200">

                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                         class="w-4 h-4"
                                                         fill="none"
                                                         viewBox="0 0 24 24"
                                                         stroke="currentColor">
                                                        <path stroke-linecap="round"
                                                              stroke-linejoin="round"
                                                              stroke-width="2"
                                                              d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.5-9.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 7.5-7.5z" />
                                                    </svg>

                                                    Edit
                                                </a>

                                                {{-- Hapus --}}
                                                <form action="{{ route('admin.buku.destroy', $buku->id) }}"
                                                      method="POST"
                                                      class="inline">

                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit"
                                                            onclick="return confirm('Yakin ingin menghapus buku ini?')"
                                                            class="inline-flex items-center gap-1
                                                                   bg-red-500 hover:bg-red-600
                                                                   text-white
                                                                   px-3 py-2 rounded-lg
                                                                   text-xs font-medium
                                                                   transition duration-200">

                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                             class="w-4 h-4"
                                                             fill="none"
                                                             viewBox="0 0 24 24"
                                                             stroke="currentColor">
                                                            <path stroke-linecap="round"
                                                                  stroke-linejoin="round"
                                                                  stroke-width="2"
                                                                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-9 0h14" />
                                                        </svg>

                                                        Hapus
                                                    </button>

                                                </form>

                                            </div>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>
                                        <td colspan="7"
                                            class="px-6 py-12 text-center">

                                            <div class="flex flex-col items-center">

                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     class="w-12 h-12 text-gray-300 mb-3"
                                                     fill="none"
                                                     viewBox="0 0 24 24"
                                                     stroke="currentColor">
                                                    <path stroke-linecap="round"
                                                          stroke-linejoin="round"
                                                          stroke-width="1.5"
                                                          d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                                </svg>

                                                <p class="text-gray-500 font-medium">
                                                    Belum ada data buku
                                                </p>

                                                <p class="text-gray-400 text-sm mt-1">
                                                    Silakan tambahkan buku baru.
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
