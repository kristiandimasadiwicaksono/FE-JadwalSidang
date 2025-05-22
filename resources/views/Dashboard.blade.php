@extends('layouts.app')

@section('title', 'Dashboard - Sistem Penjadwalan Sidang')

@section('content')
<div class="space-y-6">
    <div>
        <h1 class="text-3xl font-bold tracking-tight">Dashboard</h1>
        <p class="text-gray-500">Selamat datang di Sistem Penjadwalan Sidang</p>
    </div>

    <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                        <i class="fas fa-users text-white"></i>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Total Dosen</dt>
                            <dd class="flex items-baseline">
                                <div class="text-2xl font-semibold text-gray-900">{{ $totalDosen }}</div>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                        <i class="fas fa-calendar-alt text-white"></i>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Jadwal Sidang</dt>
                            <dd class="flex items-baseline">
                                <div class="text-2xl font-semibold text-gray-900">{{ $jadwalBulanIni }}</div>
                                <div class="ml-2 text-sm text-gray-500">Jadwal sidang bulan ini</div>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                        <i class="fas fa-user-graduate text-white"></i>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Mahasiswa</dt>
                            <dd class="flex items-baseline">
                                <div class="text-2xl font-semibold text-gray-900">{{ $totalMahasiswa }}</div>
                                <div class="ml-2 text-sm text-gray-500">Mahasiswa terdaftar sidang</div>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid gap-4 md:grid-cols-2">
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Jadwal Sidang Terbaru</h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">Daftar jadwal sidang yang akan datang</p>
            </div>
            <div class="border-t border-gray-200">
                <div class="px-4 py-5 sm:p-6">
                    <div class="space-y-4">
                        @foreach($jadwalTerbaru as $jadwal)
                        <div class="flex items-center gap-4">
                            <div class="rounded-full bg-blue-100 p-2">
                                <i class="fas fa-calendar-alt text-blue-600"></i>
                            </div>
                            <div class="flex-1 space-y-1">
                                <p class="text-sm font-medium leading-none">Sidang Tugas Akhir - {{ $jadwal['mahasiswa'] }}</p>
                                <p class="text-sm text-gray-500">
                                    {{ \Carbon\Carbon::parse($jadwal['tanggal'])->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
                                </p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Dosen Aktif</h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">Dosen yang aktif dalam sidang bulan ini</p>
            </div>
            <div class="border-t border-gray-200">
                <div class="px-4 py-5 sm:p-6">
                    <div class="space-y-4">
                        @foreach($dosenAktif as $dosen)
                        <div class="flex items-center gap-4">
                            <div class="rounded-full bg-blue-100 p-2">
                                <i class="fas fa-user text-blue-600"></i>
                            </div>
                            <div class="flex-1 space-y-1">
                                <p class="text-sm font-medium leading-none">{{ $dosen['nama_dosen'] }}</p>
                                <p class="text-sm text-gray-500">{{ $dosen['program_studi'] }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
