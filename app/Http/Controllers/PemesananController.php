<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pemesanan;
use App\PemesananDetail;
use App\KartuStok;
use App\Obat;
use DB;
use Carbon\Carbon;
use Auth;

use PDF;
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
            $data = Pemesanan::whereBetween('date',array($request->from,$request->to))->orderBy('updated_at','DESC')->with('users')->get();
        }
        else{
            
            $data = Pemesanan::orderBy('updated_at','DESC')->with('users')->get();
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
        if(Auth::user()->role == "kepalatoko"){
            return redirect()->back();
        }
        $obat = Obat::where('status','active')->get();
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
        $check = Pemesanan::where('no_invoice', $request->arr['no_invoice'])->get();
        
        if(count($check) > 0){
            return 2;
        }
            
        $pemesanan = Pemesanan::create([
            'no_invoice' => $request->arr['no_invoice'],
            'user_id' => Auth::user()->id,
            'date' => $request->arr['date'],
            'status' => 'Pending'
        ]);
        foreach($request->item as $value){
            PemesananDetail::create([
                'pemesanan_id' => $pemesanan->id,
                'obat_id' => $value['obat'],
                'qty' => $value['qty'],
                'keterangan' => $value['keterangan']
            ]);
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
        
        $pemesanan = Pemesanan::where('id',$id)->with('users')->first();
        $pemesanan_detail = DB::table('pemesanan_detail')->join('obat','pemesanan_detail.obat_id','obat.id')
                                                         ->select('pemesanan_detail.qty','pemesanan_detail.keterangan','obat.*')
                                                         ->where('obat.status','active')
                                                         ->where('pemesanan_detail.pemesanan_id',$pemesanan->id)->get();
        return view('pemesanan.show',compact('pemesanan','pemesanan_detail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->role == "kepalatoko"){
            return redirect()->back();
        }
        $obat = Obat::where('status','active')->get();
        $pemesanan = Pemesanan::where('id',$id)->with('users')->first();
        $pemesanan_detail = DB::table('pemesanan_detail')->join('obat','pemesanan_detail.obat_id','obat.id')
                                                         ->select('pemesanan_detail.*')
                                                         ->where('obat.status','active')
                                                         ->where('pemesanan_detail.pemesanan_id',$pemesanan->id)->get();
        return view('pemesanan.edit',compact('pemesanan','pemesanan_detail','obat'));
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
        if(Auth::user()->role == "apoteker"){
            $pemesanan = Pemesanan::findOrFail($id);
            $check = Pemesanan::where('no_invoice', $request->arr['no_invoice'])->where('no_invoice','!=',$pemesanan->no_invoice)->get();
            if(count($check) > 0){
                return 2;
            }
            PemesananDetail::where('pemesanan_id',$id)->delete();
            $pemesanan->update([
                'no_invoice' => $request->arr['no_invoice'],
                'user_id' => Auth::user()->id,
                'date' => $request->arr['date'],
                'status' => 'Pending',
                'alasan' => null
            ]);
            foreach($request->item as $value){
                PemesananDetail::create([
                    'pemesanan_id' => $pemesanan->id,
                    'obat_id' => $value['obat'],
                    'qty' => $value['qty'],
                    'keterangan' => $value['keterangan']
                ]);
            }
            session()->put('berhasil','Success');
        }
        else{
            if($request->status == "Approved"){
                $pemesanan_detail = PemesananDetail::where('pemesanan_id',$id)->get();
                foreach($pemesanan_detail as $value){
                    $obat = Obat::find($value->obat_id);
                    $kartu = KartuStok::where('obat_id',$value->obat_id)->whereDate('date',Carbon::now())->get();
                    if(count($kartu) == 0){
                        KartuStok::create([
                            'date' => Carbon::now(),
                            'obat_id' => $value->obat_id,
                            'stock_awal' => $obat->stock,
                            'masuk' => $value->qty,
                            'keluar' => 0,
                            'sisa' => $obat->stock + $value->qty
                        ]);
                    }else{
                        $keluar = KartuStok::where('obat_id',$value->obat_id)->whereDate('date',Carbon::now())->first();
                        KartuStok::where('obat_id',$value->obat_id)->whereDate('date',Carbon::now())->update([
                            'masuk' => $keluar->masuk + $value->qty,
                            'sisa' => $obat->stock + $value->qty
                        ]);
                    }
                    $obat->update([
                        'empty_date' => null,
                        'stock' => $obat->stock + $value->qty
                    ]);

                }
                $pemesanan = Pemesanan::findOrFail($id);
                $pemesanan->update([
                    'receive_date' => Carbon::now(),
                    'status' => $request->status,
                ]);
            }
            else{
                $pemesanan = Pemesanan::findOrFail($id);
                $pemesanan->update([
                    'alasan' => $request->alasan,
                    'status' => $request->status,
                ]);
            }
            
            
            session()->put('berhasil','Success');
        }
        
        return 1;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        PemesananDetail::where('pemesanan_id',$id)->delete();
        Pemesanan::findOrFail($id)->delete();
        return redirect()->route('pemesanan.index')->with('berhasil', 'Success');
    }

    public function pdf($id){
        $pemesanan = Pemesanan::find($id);
        $pemesanan_detail = DB::table('pemesanan_detail')->join('obat','pemesanan_detail.obat_id','obat.id')
                                                        ->where('obat.status','active')
                                                         ->select('pemesanan_detail.qty','pemesanan_detail.keterangan','obat.*')
                                                         ->where('pemesanan_detail.pemesanan_id',$pemesanan->id)->get();
        $pdf =  PDF::loadView('pemesanan.pdf',compact('pemesanan','pemesanan_detail'));

            
            // Finally, you can download the file using download function
        return $pdf->stream();
        // $pdf = new Html2Pdf('P','A2','en');
        // $pdf->pdf->setTitle('Kartu Stock');
        // $pdf->writeHTML(view('pemesanan.pdf',compact('pemesanan','pemesanan_detail')));
        // $pdf->output('kartu-stock.pdf');
    }
}
