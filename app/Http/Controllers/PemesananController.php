<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pemesanan;
use App\PemesananDetail;
use App\Obat;
class PemesananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        
        if($request->from != null && $request->to != null){
            Pemesanan::whereBeetwen('date',array($request->from,$request->to))->get();
        }
        else{
            
            $data = Pemesanan::all();
        }
        return view('pemesanan.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $obat = Obat::all();
        return view('pemesanan.create',compact('obat'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pemesanan = Pemesanan::create([
            'no_invoice' => $request->arr['no_invoice'],
            'date' => $request->arr['date'],
            'status' => $request->arr['status']
        ]);
        switch($request->arr['status']) {

            case 'Pending':
                foreach($request->item as $value){
                    PemesananDetail::create([
                        'pemesanan_id' => $pemesanan->id,
                        'obat_id' => $value['obat'],
                        'qty' => $value['qty'],
                        'keterangan' => $value['keterangan']
                    ]);
                }
            break;
        
            case 'Received':
                foreach($request->item as $value){
                    PemesananDetail::create([
                        'pemesanan_id' => $pemesanan->id,
                        'obat_id' => $value['obat'],
                        'qty' => $value['qty'],
                        'keterangan' => $value['keterangan']
                    ]);
                    $obat = Obat::findOrFail($value['obat']);
                    $obat->update([
                        'stock' => $obat->stock + $value['qty']
                    ]);
                }
            break;
        }
        session()->put('berhasil','Success');
        return 1;
        
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
