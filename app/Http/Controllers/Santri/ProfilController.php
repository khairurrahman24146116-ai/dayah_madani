<?php

namespace App\Http\Controllers\Santri;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{
    public function index()
    {
        $santri = Auth::user()->santri()->with('tingkat')->first();
        return view('santri.profil.index', compact('santri'));
    }
}
