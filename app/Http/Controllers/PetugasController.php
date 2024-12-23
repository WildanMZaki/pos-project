<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    // fungsi untuk mengatur nilai aktif dan inaktif
    public function active_control($id)
    {
        $petugas = User::find($id);

        if (empty($petugas)) {
            abort(404);
        }

        $petugas->active = !$petugas->active;

        # Variasi 2 logika ganti kebalikan niai:
        // if ($petugas->active == 1) {
        //     $petugas->active = 0;
        // } else {
        //     $petugas->active = 1;
        // }

        # Proses update data:
        $petugas->save();

        return redirect('/petugas');

        // Visualisasi Update data atau nilai dari suatu objek
        // $obj = (object)[
        //     'name' => 'John',
        //     'age' => 60,
        // ];

        // $obj->age = 20;
        // $obj->name = 'Junaedi';
    }

    public function edit($id)
    {
        $petugas = User::find($id);

        if (empty($petugas)) {
            abort(404);
        }

        $data['petugas'] = $petugas;
        return view('menu.petugas.edit', $data);
    }

    public function update(Request $request, $id)
    {
        # Validasi Data
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email_petugas' => 'required|email|min:5',
            'avatar' => 'mimes:jpg,png,jpeg|max:5000',
        ], [
            'nama_lengkap.required' => 'Kolom nama lengkap harus diisi',
            'nama_lengkap.max' => 'Kolom nama lengkap tidak boleh lebih panjang dari 255 karakter',
            'email_petugas.required' => 'Kolom email harus diisi',
        ]);

        # Cari Petugas
        $petugas = User::find($id);

        if (empty($petugas)) {
            abort(404);
        }

        # Proses ganti nilai, dengan menimpa nilai yang ada dengan nilai baru yang diinputkan dari formulir (form)
        $petugas->fullname = $request->nama_lengkap;
        $petugas->email = $request->email_petugas;

        $password = $request->kata_sandi;
        if (!empty($password)) { // Hanya ganti password kalau memang diinputkan dari form-nya
            $petugas->password = bcrypt($password);
        }

        if ($request->hasFile('avatar')) { // Hanya ganti ketika ada file dengan key 'avatar' yang diupload
            $penyimpananPhoto = $request->file('avatar')->store('avatars', 'public');
            if ($petugas->avatar !== null) {
                Storage::disk('public')->delete($petugas->avatar);
            }
            $petugas->avatar = $penyimpananPhoto;
        }

        # Proses update ke database
        $success = $petugas->save();

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

        # Hapus foto petugas kalau gak null (artinya pernah ganti poto)
        if ($petugas->avatar !== null) {
            Storage::disk('public')->delete($petugas->avatar);
        }

        $petugas->delete();
        return redirect('/petugas');
    }
}
