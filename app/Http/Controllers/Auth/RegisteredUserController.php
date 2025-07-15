<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Opd; // <-- TAMBAHKAN BARIS INI
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        // Ambil data OPD yang aktif dari database
        $opds = Opd::where('status', 'aktif')->orderBy('nama_opd')->get();

        // Kirim data $opds ke view
        return view('auth.register', ['opds' => $opds]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'nip' => ['required', 'string', 'max:255', 'unique:'.User::class], // Anda mungkin ingin mengganti validasi NIP
            'no_kontak' => ['nullable', 'string', 'max:20'], // DITAMBAHKAN
            'id_opd' => ['required', 'exists:opds,id_opd'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'nama' => $request->nama,
            'nip' => $request->nip,
            'no_kontak' => $request->no_kontak, // DITAMBAHKAN
            'id_opd' => $request->id_opd,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}