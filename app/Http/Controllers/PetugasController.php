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
        # variasi 1
        // $list_petugas = User::all();

        # variasi 2
        $list_petugas = User::orderBy('id', 'DESC')->get();

        // Gambaran isi dari variabel $list_petugas
        // $list_petugas = [
        //     (object) [
        //         'fullname' => 'Nurul',
        //         'email' => 'nurul@nurul.com',
        //         'active' => 1,
        //     ],
        //     (object) [
        //         'fullname' => 'Cahya',
        //         'email' => 'cahya@cahya.com',
        //         'active' => 0,
        //     ],
        // ];
        $data['list_petugas'] = $list_petugas;
        return view('menu.petugas.index', $data);
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
