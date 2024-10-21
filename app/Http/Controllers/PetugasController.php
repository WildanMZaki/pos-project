<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class PetugasController extends Controller
{
    // menampilkan daftar petugas
    public function index()
    {
        return view('menu.petugas.index');
    }

    // menampilkan halaman formulir untuk tambah petugas
    public function create()
    {
        return view('menu.petugas.create');
    }

    // fungsi untuk memproses data dari formulir dan menyimpan ke database
    public function store(Request $request)
    {
        // Menangkap nilai dari formulir
        $fullname = $request->nama_lengkap;
        $email = $request->email_petugas;
        $password = $request->kata_sandi;

        // Proses Query ke database
        $success = User::create([
            'fullname' => $fullname,
            'email' => $email,
            'password' => bcrypt($password),
        ]);

        if ($success) {
            return redirect('/petugas');
        } else {
            return redirect()->back();
        }
    }
}
