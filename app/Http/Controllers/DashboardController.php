<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Obat;
use App\Pemesanan;
use Carbon\Carbon;
use Auth;
class DashboardController extends Controller
{
    public function index(){
        session()->forget('berhasil');
        $stok = Obat::whereDate('empty_date','<',Carbon::now()->subDays(14))->get();
        if(Auth::user()->role == "apoteker"){
            $data = Pemesanan::where('status','Rejected')->get();
        }
        else{
            $data = Pemesanan::where('status','Pending')->get();
        }
        return view('dashboard.index', compact('stok','data'));
    }
    public function filter(Request $request){
        if($request->val == 3){
            $donut = DB::table('transaction')->join('transaction_detail','transaction.id','transaction_detail.transaction_id')
            ->leftJoin('obat','transaction_detail.obat_id','obat.id')
            ->select('obat.name',DB::raw('SUM(transaction_detail.qty) as qty','obat.id'))
            ->where('transaction.status','Approved')
            ->whereMonth('transaction.date',Carbon::now()->month) //key
            ->groupBy('obat.id')
            ->orderBy('qty','DESC')
            ->take(5)->get();

            $bar = DB::table('transaction')->join('transaction_detail','transaction.id','transaction_detail.transaction_id')
            ->where('transaction.status','Approved')
            ->whereMonth('transaction.date',Carbon::now()->month) //key;
            ->select('transaction.date',DB::raw('SUM(transaction_detail.qty) as qty'))
            ->groupBy('transaction.date')
            ->orderBy('transaction.date')->get();

            $total = DB::table('transaction')->join('transaction_detail','transaction.id','transaction_detail.transaction_id')
            ->where('transaction.status','Approved')
            ->whereMonth('transaction.date',Carbon::now()->month) 
            ->select(DB::raw('SUM(transaction_detail.qty) as qty'))
            ->orderBy('qty','DESC')->first();
            
        }
        else if($request->val == 1){
            $donut = DB::table('transaction')->join('transaction_detail','transaction.id','transaction_detail.transaction_id')
            ->leftJoin('obat','transaction_detail.obat_id','obat.id')
            ->select('obat.name',DB::raw('SUM(transaction_detail.qty) as qty','obat.id'))
            ->where('transaction.status','Approved')
            ->whereDate('transaction.date','>',Carbon::now()->subDays(7)) //key
            ->groupBy('obat.id')
            ->orderBy('qty','DESC')
            ->take(5)->get();

            $bar = DB::table('transaction')->join('transaction_detail','transaction.id','transaction_detail.transaction_id')
            ->where('transaction.status','Approved')
            ->whereDate('transaction.date','>',Carbon::now()->subDays(7)) //key;
            ->select('transaction.date',DB::raw('SUM(transaction_detail.qty) as qty'))
            ->groupBy('transaction.date')
            ->orderBy('transaction.date')->get();

            $total = DB::table('transaction')->join('transaction_detail','transaction.id','transaction_detail.transaction_id')
            ->where('transaction.status','Approved')
            ->whereDate('transaction.date','>',Carbon::now()->subDays(7)) //key;
            ->select(DB::raw('SUM(transaction_detail.qty) as qty'))
            ->orderBy('qty','DESC')->first();
            
        }

        else if($request->val == 2){
            $donut = DB::table('transaction')->join('transaction_detail','transaction.id','transaction_detail.transaction_id')
            ->leftJoin('obat','transaction_detail.obat_id','obat.id')
            ->select('obat.name',DB::raw('SUM(transaction_detail.qty) as qty','obat.id'))
            ->where('transaction.status','Approved')
            ->whereDate('transaction.date','>',Carbon::now()->subDays(30)) //key
            ->groupBy('obat.id')
            ->orderBy('qty','DESC')
            ->take(5)->get();

            $bar = DB::table('transaction')->join('transaction_detail','transaction.id','transaction_detail.transaction_id')
            ->where('transaction.status','Approved')
            ->whereDate('transaction.date','>',Carbon::now()->subDays(30)) //key;
            ->select('transaction.date',DB::raw('SUM(transaction_detail.qty) as qty'))
            ->groupBy('transaction.date')
            ->orderBy('transaction.date')->get();

            $total = DB::table('transaction')->join('transaction_detail','transaction.id','transaction_detail.transaction_id')
            ->where('transaction.status','Approved')
            ->whereDate('transaction.date','>',Carbon::now()->subDays(30)) //key;
            ->select(DB::raw('SUM(transaction_detail.qty) as qty'))
            ->orderBy('qty','DESC')->first();
            
        }

        else if($request->val == 4){
            $donut = DB::table('transaction')->join('transaction_detail','transaction.id','transaction_detail.transaction_id')
            ->leftJoin('obat','transaction_detail.obat_id','obat.id')
            ->select('obat.name',DB::raw('SUM(transaction_detail.qty) as qty','obat.id'))
            ->where('transaction.status','Approved')
            ->whereMonth('transaction.date',Carbon::now()->subMonth()->month) //key
            ->groupBy('obat.id')
            ->orderBy('qty','DESC')
            ->take(5)->get();

            $bar = DB::table('transaction')->join('transaction_detail','transaction.id','transaction_detail.transaction_id')
            ->where('transaction.status','Approved')
            ->whereMonth('transaction.date',Carbon::now()->subMonth()->month) //key;
            ->select('transaction.date',DB::raw('SUM(transaction_detail.qty) as qty'))
            ->groupBy('transaction.date')
            ->orderBy('transaction.date')->get();
            
            $total = DB::table('transaction')->join('transaction_detail','transaction.id','transaction_detail.transaction_id')
            ->where('transaction.status','Approved')
            ->whereMonth('transaction.date',Carbon::now()->subMonth()->month) //key;
            ->select(DB::raw('SUM(transaction_detail.qty) as qty'))
            ->orderBy('qty','DESC')->first();
        }
        else{
            $donut = DB::table('transaction')->join('transaction_detail','transaction.id','transaction_detail.transaction_id')
            ->leftJoin('obat','transaction_detail.obat_id','obat.id')
            ->select('obat.name',DB::raw('SUM(transaction_detail.qty) as qty','obat.id'))
            ->where('transaction.status','Approved')
            ->whereDate('transaction.date','>=',$request->dari)
            ->whereDate('transaction.date','<=',$request->sampai)
            ->groupBy('obat.id')
            ->orderBy('qty','DESC')
            ->take(5)->get();

            $bar = DB::table('transaction')->join('transaction_detail','transaction.id','transaction_detail.transaction_id')
            ->where('transaction.status','Approved')
            ->whereDate('transaction.date','>=',$request->dari)
            ->whereDate('transaction.date','<=',$request->sampai)
            ->select('transaction.date',DB::raw('SUM(transaction_detail.qty) as qty'))
            ->groupBy('transaction.date')
            ->orderBy('transaction.date')->get();
            
            $total = DB::table('transaction')->join('transaction_detail','transaction.id','transaction_detail.transaction_id')
            ->where('transaction.status','Approved')
            ->whereDate('transaction.date','>=',$request->dari)
            ->whereDate('transaction.date','<=',$request->sampai)
            ->select(DB::raw('SUM(transaction_detail.qty) as qty'))
            ->orderBy('qty','DESC')->first();
        }


        

        return ['donut' => $donut, 'bar' => $bar, 'total' => $total];
    }
}
