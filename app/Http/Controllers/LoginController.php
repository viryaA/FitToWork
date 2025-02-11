<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\ftw_ms_users; 

class LoginController extends Controller
{
    public function showLoginForm()
    {
        // Render the login form view
        return view('logins.index');
    }

    public function login(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'username' => 'required|string',
            // 'password' => 'required|string',
        ]);

         // Cari user di tabel 'ftw_ms_users'
    $user = DB::table('ftw_ms_users')->where('usr_ID', $validated['username'])->first();

    if (!$user) {
        return back()->withErrors(['username' => 'Username tidak ditemukan.']);
    }
        // // Ambil data dari tabel 'ftw_ms_users'
        // $user = DB::table('ftw_ms_users')->where('usr_ID', $validated['username'])->first();

        // Gabungkan data dari tabel 'ftw_ms_mahasiswas' dan 'ftw_ms_karyawans'
        $mahasiswa = DB::table('ftw_ms_mahasiswas')->where('mhs_id', $user->usr_ID ?? null)->first();
        $karyawan = DB::table('ftw_ms_karyawans')->where('kry_id', $user->usr_ID ?? null)->first();

        // Ambil data role berdasarkan id_role
        $roles = DB::table('ftw_ms_roles')->where('rol_id', $user->rol_id ?? null)->first();

        // Verifikasi user dan password
        $timeNow = now()->format('Y-m-d H:i:s'); 
        DB::table('ftw_ms_users')->where('usr_ID', $validated['username'])->update([
            'last_login_at' => $timeNow,
        ]);

            // Simpan data ke session
            session([
                'rol_id' => $user->rol_id,
                'last_login_at' => $timeNow,
                'full_name' => $mahasiswa->mhs_nama ?? ($karyawan->kry_nama_depan . ' ' . $karyawan->kry_nama_blk),
            ]);

        // // Cek pengguna di database berdasarkan username dan password (seharusnya gunakan hashing untuk password)
        // $user = ftw_ms_users ::where('usr_ID', $request->username)
        //             ->where('usr_STATUS', 'Aktif') // Hanya user aktif yang bisa login
        //             ->first();

        // if ($user) {
        //     $request->session()->put('user', [
        //         'username' => $user->usr_ID,
        //         'role' => $user->rol_id,
        //     ]);

            // Redirect berdasarkan role
            switch ($user->rol_id) {
                case 'ROL001':
                    return redirect()->route('mahasiswas.show', ['page' => 'beranda']);
                case 'ROL003':
                    return redirect()->route('dkas.show', ['page' => 'beranda']);
                case 'ROL004':
                    return redirect()->route('gas.show', ['page' => 'beranda']);
                case 'ROL005':
                    return redirect()->route('upts.show', ['page' => 'beranda']);
                case 'ROL006':
                    return redirect()->route('ukks.show', ['page' => 'beranda']);
                case 'ROL007':
                    return redirect()->route('k3s.show', ['page' => 'beranda']);
                case 'ROL008':
                    return redirect()->route('admin.show', ['page' => 'beranda']);
                default:
                return view('login', ['errors' => new \Illuminate\Support\MessageBag(['login' => 'Role tidak dikenali.'])]);
            }
        }

        public function logout(Request $request){
            // Log out the user
            Auth::logout();
        
            // Clear all session data
            session()->flush();
        
            // Regenerate session ID to prevent session fixation attacks
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        
            // Redirect to login page
            return redirect()->route('login.form');
        }
        
}
