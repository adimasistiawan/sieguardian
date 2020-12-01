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
            $donut = DB::table('transaction')->leftJoin('obat','transaction.obat_id','obat.id')
            ->select('obat.name',DB::raw('SUM(transaction.qty) as qty'))
            ->where('transaction.status','Approved')
            ->whereMonth('transaction.date',Carbon::now()->month) //key
            ->groupBy('obat.name')
            ->orderBy('qty','DESC')
            ->take(5)->get();

            // $first = new Carbon('first day of this month');
            // $first2 = $first->addDays(6);
            
            // $second = $first2->addDays(1);
            // $second2 = $second->addDays(6);

            // $third = $second2->addDays(1);
            // $third2 = $third->addDays(6);

            // $minggu1 = DB::table('transaction')->leftJoin('obat','transaction.obat_id','obat.id')
            // ->select('obat.name',DB::raw('SUM(transaction.qty) as qty'))
            // ->where('transaction.status','Approved')
            // ->whereMonth('transaction.date',Carbon::now()->month) //key
            // ->groupBy('obat.name')
            // ->orderBy('qty','DESC')
            // ->take(5)->get();

            $bar = DB::table('transaction')->where('status','Approved')
            ->whereMonth('date',Carbon::now()->month) //key;
            ->select('date',DB::raw('SUM(qty) as qty'))
            ->groupBy('date')
            ->orderBy('date')->get();

            $total = DB::table('transaction')->where('status','Approved')
            ->whereMonth('date',Carbon::now()->month) //key;
            ->select(DB::raw('SUM(qty) as qty'))
            ->orderBy('qty','DESC')->first();

            
        }
        else if($request->val == 1){
            $donut = DB::table('transaction')->leftJoin('obat','transaction.obat_id','obat.id')
            ->select('obat.name',DB::raw('SUM(transaction.qty) as qty'))
            ->where('transaction.status','Approved')
            ->whereDate('transaction.date','>',Carbon::now()->subDays(7)) //key
            ->groupBy('obat.name')
            ->orderBy('qty','DESC')
            ->take(5)->get();

            $bar = DB::table('transaction')->where('status','Approved')
            ->whereDate('date','>',Carbon::now()->subDays(7)) //key;
            ->select('date',DB::raw('SUM(qty) as qty'))
            ->groupBy('date')
            ->orderBy('date')->get();

            $total = DB::table('transaction')->where('status','Approved')
            ->whereDate('date','>',Carbon::now()->subDays(7)) //key;
            ->select(DB::raw('SUM(qty) as qty'))
            ->orderBy('qty','DESC')->first();
            
        }

        else if($request->val == 2){
            $donut = DB::table('transaction')->leftJoin('obat','transaction.obat_id','obat.id')
            ->select('obat.name',DB::raw('SUM(transaction.qty) as qty'))
            ->where('transaction.status','Approved')
            ->whereDate('transaction.date','>',Carbon::now()->subDays(30)) //key
            ->groupBy('obat.name')
            ->orderBy('qty','DESC')
            ->take(5)->get();

            $bar = DB::table('transaction')->where('status','Approved')
            ->whereDate('date','>',Carbon::now()->subDays(30)) //key;
            ->select('date',DB::raw('SUM(qty) as qty'))
            ->groupBy('date')
            ->orderBy('date')->get();

            $total = DB::table('transaction')->where('status','Approved')
            ->whereDate('date','>',Carbon::now()->subDays(30)) //key;
            ->select(DB::raw('SUM(qty) as qty'))
            ->orderBy('qty','DESC')->first();
            
        }

        else if($request->val == 4){
            $donut = DB::table('transaction')->leftJoin('obat','transaction.obat_id','obat.id')
            ->select('obat.name',DB::raw('SUM(transaction.qty) as qty'))
            ->where('transaction.status','Approved')
            ->whereMonth('transaction.date',Carbon::now()->subMonth()->month) //key
            ->groupBy('obat.name')
            ->orderBy('qty','DESC')
            ->take(5)->get();

            $bar = DB::table('transaction')->where('status','Approved')
            ->whereMonth('date',Carbon::now()->subMonth()->month) //key;
            ->select('date',DB::raw('SUM(qty) as qty'))
            ->groupBy('date')
            ->orderBy('date')->get();
            
            $total = DB::table('transaction')->where('status','Approved')
            ->whereMonth('date',Carbon::now()->subMonth()->month) //key;
            ->select(DB::raw('SUM(qty) as qty'))
            ->orderBy('qty','DESC')->first();
        }
        else{
            $donut = DB::table('transaction')->leftJoin('obat','transaction.obat_id','obat.id')
            ->select('obat.name',DB::raw('SUM(transaction.qty) as qty'))
            ->where('transaction.status','Approved')
            ->whereDate('transaction.date','>=',$request->dari)
            ->whereDate('transaction.date','<=',$request->sampai)
            ->groupBy('obat.name')
            ->orderBy('qty','DESC')
            ->take(5)->get();

            $bar = DB::table('transaction')->where('status','Approved')
            ->whereDate('date','>=',$request->dari)
            ->whereDate('date','<=',$request->sampai)
            ->select('date',DB::raw('SUM(qty) as qty'))
            ->groupBy('date')
            ->orderBy('date')->get();
            
            $total = DB::table('transaction')->where('status','Approved')
            ->whereDate('date','>=',$request->dari)
            ->whereDate('date','<=',$request->sampai)
            ->select(DB::raw('SUM(qty) as qty'))
            ->orderBy('qty','DESC')->first();
        }


        

        return ['donut' => $donut, 'bar' => $bar, 'total' => $total];
    }
}
