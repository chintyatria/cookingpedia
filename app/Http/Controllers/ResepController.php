<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Resep;
use App\Models\User;
use App\Models\Kategori;

class ResepController extends Controller
{
    public function index(){
        $title = '';

        if(request('kategori')){
            $kategori = Kategori::firstWhere('slug', request('kategori'));
            $title = ' in ' . $kategori->nama;
        }
        if(request('chef')){
            $chef = User::firstWhere('username', request('chef'));
            $title = ' by ' . $chef->name;
        } 

        return view('reseps', [
            "title" => "Kumpulan Resep" . $title,
            "active" => 'reseps',
            "reseps" => Resep::latest()->filter(request(['cari', 'kategori', 'chef']))->paginate(7)->withQueryString()
        ]);
    }

    public function show(Resep $resep){
        return view('resep', [
            "title" => "Resep",
            "active" => 'reseps',
            "data_resep" => $resep
        ]);
    }

} 
