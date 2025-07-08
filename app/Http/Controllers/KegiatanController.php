<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kegiatan;

class KegiatanController extends Controller
{
    public function index(){
        $daftar_kegiatan = Kegiatan::all();
        return view('kegiatan', compact('daftar_kegiatan'));
    }
}