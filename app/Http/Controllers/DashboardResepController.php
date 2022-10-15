<?php

namespace App\Http\Controllers;

use App\Models\Resep;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class DashboardResepController extends Controller
{
    /** 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.reseps.index',[
            'reseps' => Resep::where('user_id', auth()->user()->id)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.reseps.create',[
            'kategoris' => Kategori::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validatedData = $request -> validate([
            'judul_resep' => 'required|max:255',
            'slug' => 'required|unique:reseps',
            'kategori_id' => 'required',
            'gambar' => 'image|file|max:1024',
            'resepnya' => 'required'
        ]);

        if ($request->file('gambar')) {
            $validatedData['gambar'] = $request->file('gambar')->store('gambar-resep');
        }

        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['deskripsi'] = Str::limit(strip_tags($request->resepnya), 200);

        Resep::create($validatedData);

        return redirect('/dashboard/reseps')->with('success', 'Berhasil Menambah Resep Baru!!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Resep  $resep
     * @return \Illuminate\Http\Response
     */
    public function show(Resep $resep)
    {
        return view('dashboard.reseps.show',[
            'resep' => $resep
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Resep  $resep
     * @return \Illuminate\Http\Response
     */
    public function edit(Resep $resep)
    {
        return view('dashboard.reseps.edit',[
            'resep' => $resep,
            'kategoris' => Kategori::all()
        ]); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Resep  $resep
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Resep $resep)
    {
         $rules =[
            'judul_resep' => 'required|max:255',
            'kategori_id' => 'required',
            'gambar' => 'image|file|max:1024',
            'resepnya' => 'required'
        ];

        if ($request->slug != $resep->slug) {
            $rules['slug'] = 'required|unique:reseps';
        }

        $validatedData = $request->validate($rules);

        if ($request->file('gambar')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['gambar'] = $request->file('gambar')->store('gambar-resep');
        }

        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['deskripsi'] = Str::limit(strip_tags($request->resepnya), 200);

        Resep::where('id', $resep->id)
                ->update($validatedData);

        return redirect('/dashboard/reseps')->with('success', 'Berhasil Mengubah Data Resep!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Resep  $resep
     * @return \Illuminate\Http\Response
     */
    public function destroy(Resep $resep)
    {
        if ($resep->gambar) {
                Storage::delete($resep->gambar);
            }

        Resep::destroy($resep->id);

        return redirect('/dashboard/reseps')->with('success', 'Resep Terhapus!');
    }

    public function cekSlug(Request $request)
    {
        $slug = SlugService::createSlug(Resep::class, 'slug', $request->judul_resep);
        return response()->json(['slug' => $slug]);
    }
}
