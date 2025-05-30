@extends('layouts.app')

@section('content')
    {{-- Flash Message --}}
    @if (session('success'))
        <div class="mb-4 px-4 py-3 bg-green-100 text-green-800 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow rounded-lg">
        {{-- header --}}
        <div class="flex items-center justify-between px-6 py-4 border-b">
            <h1 class="text-lg font-semibold text-gray-800">Kotak Masuk - Pesan Kontak</h1>
        </div>

        {{-- filter form --}}
        <div class="px-4 sm:px-6 py-4 border-b">
            <form method="GET" class="flex flex-col sm:flex-row gap-3 sm:items-center">
                <!-- Search Input -->
                <div class="flex-1">
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Cari nama, email, atau pesan..."
                        class="w-full px-3 py-2 border rounded-lg text-sm
                            focus:ring-2 focus:ring-indigo-200 focus:border-indigo-400
                            transition duration-150 ease-in-out"
                    >
                </div>

                <!-- Filter Controls Container -->
                <div class="flex flex-row gap-3 items-center">
                    <!-- Order Select -->
                    <select
                        name="order"
                        class="w-full sm:w-32 px-3 py-2 border rounded-lg text-sm
                            focus:ring-2 focus:ring-indigo-200 focus:border-indigo-400
                            transition duration-150 ease-in-out"
                    >
                        <option value="newest" {{ request('order')!='oldest' ? 'selected' : '' }}>
                            Terbaru
                        </option>
                        <option value="oldest" {{ request('order')=='oldest' ? 'selected' : '' }}>
                            Terlama
                        </option>
                    </select>

                    <!-- Submit Button -->
                    <button
                        type="submit"
                        class="w-full sm:w-auto px-4 py-2 bg-indigo-600 hover:bg-indigo-700
                            text-white text-sm font-medium rounded-lg
                            transition duration-150 ease-in-out
                            focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        Filter
                    </button>
                </div>
            </form>
        </div>

        {{-- table --}}
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm whitespace-nowrap">
                <thead class="bg-gray-50 ">
                    <tr class="text-left text-gray-600 font-medium">
                        <th class="px-6 py-3">Tanggal</th>
                        <th class="px-6 py-3">Nama</th>
                        <th class="px-6 py-3">Email</th>
                        <th class="px-6 py-3">Pesan</th>
                        <th class="px-4 py-3 w-24"></th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse ($pesan as $row)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-3">{{ $row->created_at->format('d M Y H:i') }}</td>
                            <td class="px-6 py-3">{{ $row->nama }}</td>
                            <td class="px-6 py-3">{{ $row->email }}</td>
                            <td class="px-6 py-3">
                                <div class="truncate max-w-xs">{{ $row->pesan }}</div>
                            </td>
                            <td class="px-4 py-3 flex gap-2">
                                <a href="{{ route('admin.form-kontak.show', $row) }}"
                                   class="text-indigo-600 hover:underline">Lihat</a>
                                <form method="POST" action="{{ route('admin.form-kontak.destroy', $row) }}"
                                      onsubmit="return confirm('Hapus pesan ini?')">
                                    @csrf @method('DELETE')
                                    <button class="text-red-600 hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="px-6 py-4 text-center text-gray-500">Belum ada pesan masuk.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- pagination --}}
        <div class="p-4">{{ $pesan->links() }}</div>
    </div>
@endsection