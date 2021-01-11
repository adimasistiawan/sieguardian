<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pemesanan;
use App\PemesananDetail;
use App\Obat;
use App\Transaction;
use DB;
use PDF;
use Auth;
class KartustockController extends Controller
{
    public function index(){
        $obat = Obat::all();
        return view('kartu-stock.index',compact('obat'));
    }

    public function search(Request $request){
        $report = DB::table('kartu_stok')->join('obat','kartu_stok.obat_id','obat.id')
                                        ->select('kartu_stok.*','obat.name')
                                        ->where('kartu_stok.obat_id',$request->arr['obat'])
                                        ->whereDate('kartu_stok.date','>=',$request->arr['from'])
                                        ->whereDate('kartu_stok.date','<=',$request->arr['to'])->get();
        // $data = DB::table('obat')->join('transaction_detail','transaction_detail.obat_id','obat.id')
        //                          ->join('transaction','transaction.id','transaction_detail.transaction_id')
        //                          ->select(
        //                              'obat.plu',
        //                              'obat.name',
        //                              'obat.satuan',
        //                              'transaction.date',
        //                              \DB::raw('(CASE WHEN transaction_detail.qty = null THEN 0 ELSE 0 END) AS masuk'),
        //                              'transaction_detail.qty as keluar',
        //                              'transaction_detail.sisa_stock as sisa'
        //                          )->where('transaction.status',"Approved")
        //                          ->orderBy('transaction.date')
        //                          ->where('transaction_detail.obat_id',$request->arr['obat'])
        //                          ->whereDate('transaction.date','>=',$request->arr['from'])
        //                          ->whereDate('transaction.date','<=',$request->arr['to']);
                                 
        // $data2 = DB::table('obat')->join('pemesanan_detail','pemesanan_detail.obat_id','obat.id')
        //                           ->join('pemesanan','pemesanan.id','pemesanan_detail.pemesanan_id')
        //                         ->select(
        //                             'obat.plu',
        //                             'obat.name',
        //                             'obat.satuan',
        //                             'pemesanan.receive_date as date',
        //                             'pemesanan_detail.qty as masuk',
        //                             \DB::raw('(CASE WHEN pemesanan_detail.qty = null THEN 0 ELSE 0 END) AS keluar'),
        //                             'pemesanan_detail.sisa_stock as sisa'
        //                         )
        //                         ->orderBy('pemesanan.receive_date')
        //                         ->where('pemesanan_detail.obat_id',$request->arr['obat'])
        //                         ->whereDate('pemesanan.receive_date','>=',$request->arr['from'])
        //                          ->whereDate('pemesanan.receive_date','<=',$request->arr['to'])
        //                         ->where('pemesanan.status',"Approved");
                                 
        // $report=$data->union($data2)->get();
        $obat = Obat::where('id',$request->arr['obat'])->with('category')->first();
        return ['report' => $report, 'obat' => $obat];
    }

    public function pdf($id,$from,$to){
        $report = DB::table('kartu_stok')->join('obat','kartu_stok.obat_id','obat.id')
                                        ->select('kartu_stok.*','obat.name')
                                        ->where('kartu_stok.obat_id',$id)
                                        ->whereDate('kartu_stok.date','>=',$from)
                                        ->whereDate('kartu_stok.date','<=',$to)->get();
        // $data = DB::table('obat')->join('transaction_detail','transaction_detail.obat_id','obat.id')
        //                          ->join('transaction','transaction.id','transaction_detail.transaction_id')
        //                          ->select(
        //                              'obat.plu',
        //                              'obat.name',
        //                              'obat.satuan',
        //                              'transaction.date',
        //                              \DB::raw('(CASE WHEN transaction_detail.qty = null THEN 0 ELSE 0 END) AS masuk'),
        //                              'transaction_detail.qty as keluar',
        //                              'transaction_detail.sisa_stock as sisa'
        //                          )->where('transaction.status',"Approved")
        //                          ->orderBy('transaction.date')
        //                          ->where('transaction_detail.obat_id',$id)
        //                          ->whereDate('transaction.date','>=',$from)
        //                          ->whereDate('transaction.date','<=',$to);
        // $data2 = DB::table('obat')->join('pemesanan_detail','pemesanan_detail.obat_id','obat.id')
        //                           ->join('pemesanan','pemesanan.id','pemesanan_detail.pemesanan_id')
        //                         ->select(
        //                             'obat.plu',
        //                             'obat.name',
        //                             'obat.satuan',
        //                             'pemesanan.receive_date as date',
        //                             'pemesanan_detail.qty as masuk',
        //                             \DB::raw('(CASE WHEN pemesanan_detail.qty = null THEN 0 ELSE 0 END) AS keluar'),
        //                             'pemesanan_detail.sisa_stock as sisa'
        //                         )
        //                         ->orderBy('pemesanan.receive_date')
        //                         ->where('pemesanan_detail.obat_id',$id)
        //                         ->whereDate('pemesanan.receive_date','>=',$from)
        //                          ->whereDate('pemesanan.receive_date','<=',$to)
        //                         ->where('pemesanan.status',"Approved");
                                 
        // $report=$data->union($data2)->get();
        $obat = Obat::where('id',$id)->with('category')->first();

      
        $pdf =  PDF::loadView('kartu-stock.pdf',compact('report','obat','from','to'));

            
            // Finally, you can download the file using download function
        return $pdf->stream();
    }
}
