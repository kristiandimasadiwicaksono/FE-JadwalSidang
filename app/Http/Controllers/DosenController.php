<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class DosenController extends Controller
{
    protected $apiUrl;

    public function __construct()
    {
        $this->apiUrl = 'http://localhost:8080/dosen';
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
                $dosens = isset($data['data']) ? $data['data'] : [];

                return view('dosen.index', compact('dosens'));
            }

            return back()->with('error', 'Gagal memuat data dosen: ' . $response->status());
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dosen.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nidn' => 'required|string|max:20',
            'nama_dosen' => 'required|string|max:100',
            'program_studi' => 'required|string|max:100',
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return redirect()->route('dosen.create')
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $response = Http::post($this->getApiUrl(), $request->all());

            if ($response->successful()) {
                return redirect()->route('dosen.index')->with('success', 'Data dosen berhasil ditambahkan!');
            }

            if ($response->status() === 422) {
                // Ambil error validasi dari backend
                $errors = $response->json()['message'];
                return redirect()->route('dosen.create')->withErrors($errors)->withInput();
            }

            return back()->with('error', 'Gagal menambahkan data dosen: ' . $response->status())->withInput();
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

                $dosen = $result['data'];

                return view('dosen.show', compact('dosen'));
            

                return back()->with('error', 'Format data tidak valid');
            }

            return back()->with('error', 'Gagal memuat data dosen: ' . $response->status());
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
                
                $dosen = $result['data'];

                if (is_array($dosen) || is_object($dosen)) {
                    return view('dosen.edit', compact('dosen'));
                }

                return back()->with('error', 'Format data tidak valid');
            }

            return back()->with('error', 'Gagal memuat data dosen: ' . $response->status());
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
            'nidn' => 'required|string|max:20',
            'nama_dosen' => 'required|string|max:100',
            'program_studi' => 'required|string|max:100',
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return redirect()->route('dosen.edit', $id)
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $response = Http::put($this->getApiUrl($id), [
                'nidn' => $request->nidn,
                'nama_dosen' => $request->nama_dosen,
                'program_studi' => $request->program_studi,
                'email' => $request->email,
            ]);

            if ($response->successful()) {
                return redirect()->route('dosen.index')->with('success', 'Data dosen berhasil diperbarui!');
            }

            return back()->with('error', 'Gagal memperbarui data dosen: ' . $response->status())->withInput();
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
                return redirect()->route('dosen.index')->with('success', 'Data dosen berhasil dihapus!');
            }

            return back()->with('error', 'Gagal menghapus data dosen: ' . $response->status());
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}