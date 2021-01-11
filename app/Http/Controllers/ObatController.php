<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Obat;
use App\Category;
use App\Satuan;
use Illuminate\Support\Str;
use Auth;
class ObatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        session()->forget('berhasil');
        $obat = Obat::with('category')->orderBy('created_at','DESC')->with('category')->get();
        $category = Category::where('status','active')->get();
        
        return view('obat/index', ['obat' => $obat, 'categories' => $category]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     $category = Category::where('status','active')->get();
        
    //     return view('obat.create', ['categories' => $category]);
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $check = Obat::where('plu', $request->plu)->get();
        $check2 = Obat::where('name', $request->name)->get();
        if(count($check) > 0){
            return redirect()->route('dashboard-obat.index')->with('error', 'Gagal. PLU sudah pernah digunakan ');;
        }
        if(count($check2) > 0){
            return redirect()->route('dashboard-obat.index')->with('error', 'Gagal. Nama obat sudah pernah digunakan ');;
        }
        Obat::create([
            'plu' => $request->plu,
            'name' => $request->name,
            'category_id' => $request->category,
            'satuan' => $request->satuan,
            'stock' => $request->stock,
            'price' => $request->price,
            'status' => $request->status,
        ]);

        return redirect()->route('dashboard-obat.index')->with('success', 'Success');
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
        //
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
        $obat = Obat::find($id);
        $check = Obat::where('plu', $request->plu)->where('plu','!=',$obat->plu)->get();
        $check2 = Obat::where('name', $request->name)->where('name','!=',$obat->name)->get();
        if(count($check) > 0){
            return redirect()->route('dashboard-obat.index')->with('error', 'Gagal. PLU sudah pernah digunakan ');;
        }
        if(count($check2) > 0){
            return redirect()->route('dashboard-obat.index')->with('error', 'Gagal. Nama obat sudah pernah digunakan ');;
        }
        Obat::findOrFail($id)->update([
            'plu' => $request->plu,
            'name' => $request->name,
            'category_id' => $request->category,
            'satuan' => $request->satuan,
            'stock' => $request->stock,
            'price' => $request->price,
            'status' => $request->status,
        ]);
        return redirect()->route('dashboard-obat.index')->with('success', 'Updated Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Obat::findOrFail($id)->delete();
        return redirect()->route('dashboard-obat.index')->with('success', 'Success');
    }

    public function get_obat($id)
    {
        $obat = Obat::findOrFail($id);
        return $obat;
    }
}
