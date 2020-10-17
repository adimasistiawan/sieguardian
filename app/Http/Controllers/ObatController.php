<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Obat;
use App\Category;
use App\Satuan;
use Illuminate\Support\Str;

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
        $obat = Obat::with('category')->get();
        $category = Category::all();
        $satuan = Satuan::all();
        return view('obat/index', ['obat' => $obat, 'categories' => $category,'satuan' => $satuan]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        $satuan = Satuan::all();
        return view('obat.create', ['categories' => $category, 'satuan' => $satuan]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        

        Obat::create([
            'plu' => $request->plu,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'category' => $request->category,
            'satuan' => $request->satuan,
            'stock' => $request->stock,
            'price' => $request->price,
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

        Obat::findOrFail($id)->update([
            'plu' => $request->plu,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'category' => $request->category,
            'satuan' => $request->satuan,
            'stock' => $request->stock,
            'price' => $request->price,
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
