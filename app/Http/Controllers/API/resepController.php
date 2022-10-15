<?php

namespace App\Http\Controllers\API;

use App\Models\Resep;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class resepController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Resep::getResep()->paginate(5);
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

        try{
            $fileName = time().$request->file('gambar')->getClientOriginalName();
            $path = $request->file('gambar')->storeAs('gambar-resep', $fileName);
            $validasi['gambar']=$path;
            $response = Resep::create($validasi);
            return response()->json([
                'success' => true,
                'message' => 'success',
                'data' => $response
            ]);
            
        } catch(\Exception $e){
            return response()->json([
                'message'=>'Error',
                'errors'=>$e->getMessage()
                ]);
        }

        // if ($request->file('gambar')) {
        //     $validatedData['gambar'] = $request->file('gambar')->store('gambar-resep');
        // }

        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['deskripsi'] = Str::limit(strip_tags($request->resepnya), 200);


        // function ProductGalleries(){
        //     $data=ProductGalleries::all();
        //     return response()->json($data);
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data=Resep::find($id);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request -> validate([
            'judul_resep' => 'required|max:255',
            'slug' => 'unique:reseps',
            'kategori_id' => 'required',
            'gambar' => 'image|file|max:1024',
            'resepnya' => 'required'
        ]);

        try{
            $fileName = time().$request->file('gambar')->getClientOriginalName();
            $path = $request->file('gambar')->storeAs('gambar-resep', $fileName);
            $validasi['gambar']=$path;
            $response = Resep::create($validasi);
            return response()->json([
                'success' => true,
                'message' => 'success',
                'data' => $response
            ]);
            
        } catch(\Exception $e){
            return response()->json([
                'message'=>'Error',
                'errors'=>$e->getMessage()
                ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $resep=Resep::find($id);
            $resep->delete();
            return response()->json([
                'success'=>true,
                'message'=>'success'
            ]);
        }
        catch(\Exception $e){
            return response()->json([
                'message'=>'Error',
                'errors'=>$e->getMessage()
                ]);
        }
    }
}
