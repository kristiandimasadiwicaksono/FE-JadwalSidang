@extends('layouts.app')

@section('content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 bg-white border-b border-gray-200">
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Edit Data Dosen</h2>
        </div>

        @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('dosen.update', $dosen['nidn']) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="nidn" class="block text-sm font-medium text-gray-700 mb-1">NIDN</label>
                    <input type="text" name="nidn" id="nidn" value="{{ old('nidn', $dosen['nidn']) }}" class="w-full rounded-md border-gray-300 bg-gray-300 p-2 shadow-sm focus:outline-none cursor-default" readonly required>
                </div>

                <div>
                    <label for="nama_dosen" class="block text-sm font-medium text-gray-700 mb-1">Nama Dosen</label>
                    <input type="text" name="nama_dosen" id="nama_dosen" value="{{ old('nama_dosen', $dosen['nama_dosen']) }}" class="w-full rounded-md border-gray-300 bg-gray-100 p-2 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required>
                </div>

                <div class="mb-4">
                    <label for="program_studi" class="block text-sm font-medium text-gray-700 mb-1">Program Studi*</label>
                    <select name="program_studi" id="program_studi" class="w-full px-3 py-2 border rounded-md bg-gray-100 shadow-sm focus:ring focus:ring-blue-200">
                        <option value="" disabled selected>Pilih Program Studi</option>
                        <option value="D3 Teknik Elektronika">D3 Teknik Elektronika</option>
                        <option value="D3 Teknik Listrik">D3 Teknik Listrik</option>
                        <option value="D3 Teknik Informatika">D3 Teknik Informatika</option>
                        <option value="D3 Teknik Mesin">D3 Teknik Mesin</option>
                        <option value="D4 Teknik Pengendalian Pencemaran Lingkungan">D4 Teknik Pengendalian Pencemaran Lingkungan</option>
                        <option value="D4 Pengembangan Produk Agroindustri">D4 Pengembangan Produk Agroindustri</option>
                        <option value="D4 Teknologi Rekayasa Energi Terbarukan">D4 Teknologi Rekayasa Energi Terbarukan</option>
                        <option value="D4 Rekayasa Kimia Industri">D4 Rekayasa Kimia Industri</option>
                        <option value="D4 Teknologi Rekayasa Mekatronika">D4 Teknologi Rekayasa Mekatronika</option>
                        <option value="D4 Rekayasa Keamanan Siber">D4 Rekayasa Keamanan Siber</option>
                        <option value="D4 Teknologi Rekayasa Multimedia">D4 Teknologi Rekayasa Multimedia</option>
                        <option value="D4 Akuntansi Lembaga Keuangan Syariah">D4 Akuntansi Lembaga Keuangan Syariah</option>
                        <option value="D4 Rekayasa Perangkat Lunak">D4 Rekayasa Perangkat Lunak</option>
                    </select>
                    @error('program_studi')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email*</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $dosen['email']) }}" class="w-full rounded-md border-gray-300 bg-gray-100 shadow-sm p-2 focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required>
                </div>
            </div>

            <div class="flex justify-end mt-6 space-x-3">
                <a href="{{ route('dosen.index') }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 transition">
                    Batal
                </a>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
                    Perbarui
                </button>
            </div>
        </form>
    </div>
</div>
@endsection