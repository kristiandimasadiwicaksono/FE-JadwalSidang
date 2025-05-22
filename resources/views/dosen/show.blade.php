@extends('layouts.app')

@section('content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 bg-white border-b border-gray-200">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Detail Dosen</h2>
            <div class="flex space-x-2">
                <a href="{{ route('dosen.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 transition">
                    Kembali
                </a>
            </div>
        </div>

        <div class="bg-gray-50 p-6 rounded-lg shadow-sm">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-sm font-medium text-gray-500">NIDN</h3>
                    <p class="mt-1 text-lg font-semibold">{{ $dosen['nidn'] }}</p>
                </div>

                <div>
                    <h3 class="text-sm font-medium text-gray-500">Nama Dosen</h3>
                    <p class="mt-1 text-lg font-semibold">{{ $dosen['nama_dosen'] }}</p>
                </div>

                <div>
                    <h3 class="text-sm font-medium text-gray-500">Program Studi</h3>
                    <p class="mt-1 text-lg font-semibold">{{ $dosen['program_studi'] }}</p>
                </div>

                <div>
                    <h3 class="text-sm font-medium text-gray-500">Email</h3>
                    <p class="mt-1 text-lg font-semibold">{{ $dosen['email'] }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection