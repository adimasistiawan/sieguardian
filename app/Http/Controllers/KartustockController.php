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
        
        $data = DB::table('obat')->join('transaction','transaction.obat_id','obat.id')
                                 ->select(
                                     'obat.plu',
                                     'obat.name',
                                     'obat.satuan',
                                     'transaction.date',
                                     \DB::raw('(CASE WHEN transaction.qty = null THEN 0 ELSE 0 END) AS masuk'),
                                     'transaction.qty as keluar',
                                     'transaction.sisa_stock as sisa'
                                 )->where('transaction.status',"Approved")
                                 ->orderBy('transaction.date')
                                 ->where('transaction.obat_id',$request->arr['obat'])
                                 ->whereDate('transaction.date','>=',$request->arr['from'])
                                 ->whereDate('transaction.date','<=',$request->arr['to']);
                                 
        $data2 = DB::table('obat')->join('pemesanan_detail','pemesanan_detail.obat_id','obat.id')
                                  ->join('pemesanan','pemesanan.id','pemesanan_detail.pemesanan_id')
                                ->select(
                                    'obat.plu',
                                    'obat.name',
                                    'obat.satuan',
                                    'pemesanan.receive_date as date',
                                    'pemesanan_detail.qty as masuk',
                                    \DB::raw('(CASE WHEN pemesanan_detail.qty = null THEN 0 ELSE 0 END) AS keluar'),
                                    'pemesanan_detail.sisa_stock as sisa'
                                )
                                ->orderBy('pemesanan.receive_date')
                                ->where('pemesanan_detail.obat_id',$request->arr['obat'])
                                ->whereDate('pemesanan.receive_date','>=',$request->arr['from'])
                                 ->whereDate('pemesanan.receive_date','<=',$request->arr['to'])
                                ->where('pemesanan.status',"Approved");
                                 
        $report=$data->union($data2)->get();
        $obat = Obat::where('id',$request->arr['obat'])->with('category')->first();
        return ['report' => $report, 'obat' => $obat];
    }

    public function pdf($id,$from,$to){
        $data = DB::table('obat')->join('transaction','transaction.obat_id','obat.id')
                                 ->select(
                                     'obat.plu',
                                     'obat.name',
                                     'obat.satuan',
                                     'transaction.date',
                                     \DB::raw('(CASE WHEN transaction.qty = null THEN 0 ELSE 0 END) AS masuk'),
                                     'transaction.qty as keluar',
                                     'transaction.sisa_stock as sisa'
                                 )->where('transaction.status',"Approved")
                                 ->orderBy('transaction.date')
                                 ->where('transaction.obat_id',$id)
                                 ->whereDate('transaction.date','>=',$from)
                                 ->whereDate('transaction.date','<=',$to);
        $data2 = DB::table('obat')->join('pemesanan_detail','pemesanan_detail.obat_id','obat.id')
                                  ->join('pemesanan','pemesanan.id','pemesanan_detail.pemesanan_id')
                                ->select(
                                    'obat.plu',
                                    'obat.name',
                                    'obat.satuan',
                                    'pemesanan.receive_date as date',
                                    'pemesanan_detail.qty as masuk',
                                    \DB::raw('(CASE WHEN pemesanan_detail.qty = null THEN 0 ELSE 0 END) AS keluar'),
                                    'pemesanan_detail.sisa_stock as sisa'
                                )
                                ->orderBy('pemesanan.receive_date')
                                ->where('pemesanan_detail.obat_id',$id)
                                ->whereDate('pemesanan.receive_date','>=',$from)
                                 ->whereDate('pemesanan.receive_date','<=',$to)
                                ->where('pemesanan.status',"Approved");
                                 
        $report=$data->union($data2)->get();
        $obat = Obat::where('id',$id)->with('category')->first();

      
        $pdf =  PDF::loadView('kartu-stock.pdf',compact('report','obat','from','to'));

            
            // Finally, you can download the file using download function
        return $pdf->stream();
    }
}
