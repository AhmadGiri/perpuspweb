<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Kelola Data Anggota (User & Admin)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white p-6 shadow-sm sm:rounded-lg">
                
                {{-- Flash Notifications --}}
                @if (session('success'))
                    <div class="mb-4 rounded-md border border-green-200 bg-green-50 p-4 text-sm text-green-700">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-4 rounded-md border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                        {{ session('error') }}
                    </div>
                @endif

                {{-- Action Header --}}
                <div class="mb-4 flex items-center justify-between">
                    <a href="{{ route('admin.user.create') }}" 
                       class="inline-flex items-center rounded-md bg-emerald-600 px-4 py-2 text-sm font-medium text-white shadow-sm transition hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">
                        <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Tambah Anggota
                    </a>
                </div>

                {{-- Table Data --}}
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 text-left text-sm text-gray-600">
                        <thead class="bg-gray-50 text-xs uppercase tracking-wider text-gray-700">
                            <tr>
                                <th scope="col" class="px-4 py-3 text-center">No</th>
                                <th scope="col" class="px-6 py-3">Nama</th>
                                <th scope="col" class="px-6 py-3">Email</th>
                                <th scope="col" class="px-6 py-3 text-center">Role</th>
                                <th scope="col" class="px-6 py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @forelse ($users as $index => $usr)
                                <tr class="transition hover:bg-gray-50">
                                    <td class="whitespace-nowrap px-4 py-4 text-center font-medium text-gray-900">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                                        {{ $usr->name }}
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        {{ $usr->email }}
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4 text-center">
                                        @if ($usr->role === 'admin')
                                            <span class="inline-flex items-center rounded-full bg-purple-100 px-2.5 py-0.5 text-xs font-semibold text-purple-800">
                                                Admin
                                            </span>
                                        @else
                                            <span class="inline-flex items-center rounded-full bg-blue-100 px-2.5 py-0.5 text-xs font-semibold text-blue-800">
                                                User
                                            </span>
                                        @endif
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4 text-center">
                                        <div class="flex items-center justify-center space-x-2">
                                            <a href="{{ route('admin.user.edit', $usr->id) }}" 
                                               class="rounded-md bg-amber-500 px-3 py-1.5 text-xs font-medium text-white shadow-sm transition hover:bg-amber-600 focus:outline-none focus:ring-2 focus:ring-amber-400">
                                                Edit
                                            </a>
                                            <form action="{{ route('admin.user.destroy', $usr->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus anggota ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="rounded-md bg-rose-600 px-3 py-1.5 text-xs font-medium text-white shadow-sm transition hover:bg-rose-700 focus:outline-none focus:ring-2 focus:ring-rose-500">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                                        Belum ada data anggota.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>