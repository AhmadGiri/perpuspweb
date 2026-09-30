<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">
                {{ __('Edit Data Anggota') }}
            </h2>
            <p class="mt-1 text-sm text-gray-500">
                Perbarui informasi akun anggota perpustakaan.
            </p>
        </div>
    </x-slot>

    <div class="min-h-screen bg-gray-50 py-10">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">

            <div class="overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm">

                <div class="border-b border-gray-100 px-6 py-5">
                    <h3 class="text-lg font-semibold text-gray-800">
                        Form Edit Anggota
                    </h3>

                    <p class="mt-1 text-sm text-gray-500">
                        Ubah informasi akun sesuai kebutuhan.
                    </p>
                </div>

                <form action="{{ route('admin.user.update', $user->id) }}" method="POST" class="p-6">
                    @csrf
                    @method('PUT')

                    <div class="space-y-6">

                        {{-- Nama --}}
                        <div>
                            <label for="name" class="mb-2 block text-sm font-semibold text-gray-700">
                                Nama Lengkap
                            </label>

                            <input
                                id="name"
                                type="text"
                                name="name"
                                value="{{ old('name', $user->name) }}"
                                required
                                class="w-full rounded-lg border-gray-300 shadow-sm transition focus:border-indigo-500 focus:ring-indigo-500"
                            >

                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div>
                            <label for="email" class="mb-2 block text-sm font-semibold text-gray-700">
                                Email
                            </label>

                            <input
                                id="email"
                                type="email"
                                name="email"
                                value="{{ old('email', $user->email) }}"
                                required
                                class="w-full rounded-lg border-gray-300 shadow-sm transition focus:border-indigo-500 focus:ring-indigo-500"
                            >

                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <div>
                            <label for="password" class="mb-2 block text-sm font-semibold text-gray-700">
                                Password Baru
                            </label>

                            <input
                                id="password"
                                type="password"
                                name="password"
                                placeholder="Kosongkan jika tidak ingin mengubah password"
                                class="w-full rounded-lg border-gray-300 shadow-sm transition focus:border-indigo-500 focus:ring-indigo-500"
                            >

                            <p class="mt-1 text-xs text-gray-400">
                                Kosongkan apabila password tidak ingin diubah.
                            </p>

                            @error('password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Role --}}
                        <div>
                            <label for="role" class="mb-2 block text-sm font-semibold text-gray-700">
                                Role / Hak Akses
                            </label>

                            <select
                                id="role"
                                name="role"
                                required
                                class="w-full rounded-lg border-gray-300 shadow-sm transition focus:border-indigo-500 focus:ring-indigo-500"
                            >
                                <option value="user" {{ old('role', $user->role) === 'user' ? 'selected' : '' }}>
                                    User / Siswa
                                </option>

                                <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>
                                    Admin
                                </option>
                            </select>

                            @error('role')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    <div class="mt-8 flex flex-col-reverse gap-3 border-t border-gray-100 pt-6 sm:flex-row sm:justify-end">

                        <a
                            href="{{ route('admin.user.index') }}"
                            class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-5 py-2.5 font-medium text-gray-700 transition hover:bg-gray-50"
                        >
                            Batal
                        </a>

                        <button
                            type="submit"
                            class="inline-flex items-center justify-center gap-2 rounded-lg bg-indigo-600 px-5 py-2.5 font-medium text-white shadow-sm transition hover:bg-indigo-700"
                        >
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M5 13l4 4L19 7"/>
                            </svg>

                            Update Anggota
                        </button>

                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>
