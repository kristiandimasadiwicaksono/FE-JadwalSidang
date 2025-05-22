<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class MahasiswaController extends Controller
{
    protected $apiUrl;

    public function __construct()
    {
        $this->apiUrl = 'http://localhost:8080/mahasiswa';
    }

    /**
     * Helper to get API URL.
     */
    private function getApiUrl($id = null)
    {
        return $id ? "{$this->apiUrl}/{$id}" : $this->apiUrl;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $response = Http::get($this->getApiUrl());

            if ($response->successful()) {
                $data = $response->json();

                // Ambil hanya bagian `data`
                $mahasiswas = isset($data['data']) ? $data['data'] : [];

                return view('mahasiswa.index', compact('mahasiswas'));
            }

            return back()->with('error', 'Gagal memuat data mahasiswa: ' . $response->status());
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mahasiswa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'npm' => 'required|string|max:20',
            'nama_mahasiswa' => 'required|string|max:100',
            'program_studi' => 'required|string|max:100',
            'judul_skripsi' => 'required|string|max:150',
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return redirect()->route('mahasiswa.create')
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $response = Http::post($this->getApiUrl(), $request->all());

            if ($response->successful()) {
                return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil ditambahkan!');
            }

            return back()->with('error', 'Gagal menambahkan data mahasiswa: ' . $response->status())->withInput();
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $response = Http::get($this->getApiUrl($id));

            if ($response->successful()) {
                $result = $response->json();

                $mahasiswa = $result['data'];

                return view('mahasiswa.show', compact('mahasiswa'));
            

                return back()->with('error', 'Format data tidak valid');
            }

            return back()->with('error', 'Gagal memuat data mahasiswa: ' . $response->status());
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $response = Http::get($this->getApiUrl($id));

            if ($response->successful()) {
                $result = $response->json();
                
                $mahasiswa = $result['data'];

                if (is_array($mahasiswa) || is_object($mahasiswa)) {
                    return view('mahasiswa.edit', compact('mahasiswa'));
                }

                return back()->with('error', 'Format data tidak valid');
            }

            return back()->with('error', 'Gagal memuat data mahasiswa: ' . $response->status());
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'npm' => 'required|string|max:20',
            'nama_mahasiswa' => 'required|string|max:100',
            'program_studi' => 'required|string|max:100',
            'judul_skripsi' => 'required|string|max:150',
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return redirect()->route('mahasiswa.edit', $id)
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $response = Http::put($this->getApiUrl($id), [
                'npm' => $request->npm,
                'nama_mahasiswa' => $request->nama_mahasiswa,
                'program_studi' => $request->program_studi,
                'judul_skripsi' => $request->judul_skripsi,
                'email' => $request->email,
            ]);

            if ($response->successful()) {
                return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil diperbarui!');
            }

            return back()->with('error', 'Gagal memperbarui data mahasiswa: ' . $response->status())->withInput();
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $response = Http::delete($this->getApiUrl($id));

            if ($response->successful()) {
                return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil dihapus!');
            }

            return back()->with('error', 'Gagal menghapus data mahasiswa: ' . $response->status());
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}