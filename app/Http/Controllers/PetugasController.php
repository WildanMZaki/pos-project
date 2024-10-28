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
        $list_petugas = User::orderBy('id', 'DESC')->get(); // : [(object), ...]

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

    public function test($name, $age)
    {
        echo $name;
        echo "<br/>";
        echo $age;
    }

    // menampilkan halaman formulir untuk tambah petugas
    public function create()
    {
        return view('menu.petugas.create');
    }

    // fungsi untuk memproses data dari formulir dan menyimpan ke database
    public function store(Request $request)
    {
        # Form Validation
        // Rules + Message (opsional)
        // Beberapa aturan lain yang sering digunakan: numeric
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email_petugas' => 'required|email|min:5',
            'kata_sandi' => 'required|min:8',
            'avatar' => 'mimes:jpg,png,jpeg|max:5000',
        ], [
            'nama_lengkap.required' => 'Kolom nama lengkap harus diisi',
            'nama_lengkap.max' => 'Kolom nama lengkap tidak boleh lebih panjang dari 255 karakter',
            'email_petugas.required' => 'Kolom email harus diisi',
            'kata_sandi.required' => 'Kolom kata sandi harus diisi',
            'kata_sandi.min' => 'Kolom kata sandi setidaknya harus 8 karakter',
        ]);

        // Menangkap nilai dari formulir
        $fullname = $request->nama_lengkap;
        $email = $request->email_petugas;
        $password = $request->kata_sandi;

        $penyimpananPhoto = null;
        if ($request->hasFile('avatar')) {
            // $namaFile = $request->file('value_dari_attribute_name_di_form')->store('folder_penyimpanan', 'public')
            $penyimpananPhoto = $request->file('avatar')->store('avatars', 'public');
        }

        // Proses Query ke database
        $success = User::create([
            'fullname' => $fullname,
            'email' => $email,
            'password' => bcrypt($password),
            'avatar' => $penyimpananPhoto,
        ]);

        if ($success) {
            return redirect('/petugas');
        } else {
            return redirect()->back();
        }
    }

    // fungsi untuk menghapus data dari database : ?id=2
    public function delete($petugas_id)
    {
        $petugas = User::find($petugas_id);

        // Variasi 2:
        // $petugas = User::where('id', $petugas_id)->first();

        if (empty($petugas)) {
            abort(404);
        }

        $petugas->delete();
        return redirect('/petugas');
    }
}
