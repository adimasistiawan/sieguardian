<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Obat;
use App\Transaction;
use DB;
use Auth;
use Carbon\Carbon;

class TransactionController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('user');
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        session()->forget('berhasil');
        // $date = Carbon::createFromFormat('Y-m-d', $request->from);
        // $daysToAdd = 5;
        // $date = $date->addDays($daysToAdd);
        // dd($date);
        $obat = Obat::where('status','active')->get();
        if($request->from != null && $request->to != null)
        {
            $transaction = DB::table('transaction')->join('obat','obat.id','transaction.obat_id')
                                                    ->join('users','users.id','transaction.user_id')
                                                   ->select('transaction.*','obat.price','obat.satuan','obat.name as obat_name','users.name as user')
                                                   ->whereBetween('transaction.date',array($request->from,$request->to))
                                                   ->orderBy('transaction.created_at','DESC')->get();
        }
        else{
            $transaction = DB::table('transaction')->join('obat','obat.id','transaction.obat_id')->join('users','users.id','transaction.user_id')->select('transaction.*','obat.price','obat.satuan','obat.name as obat_name','users.name as user')->orderBy('transaction.created_at','DESC')->get();
        }
        
        
        return view('transaction.index', ['obat' => $obat, 'transactions' => $transaction]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $obat = Obat::where('status','active')->get();
        return view('transaction.create',compact('obat'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $obat = Obat::findOrFail($request->obat);
        $status = "";
        switch($request->submit) {

            case 'approved':
                $status = "Approved";
                
                Transaction::create([
                    'obat_id' => $request->obat,
                    'user_id' => Auth::user()->id,
                    'qty' => $request->qty,
                    'date' => Carbon::now(),
                    'total' => $request->total,
                    'sisa_stock' => $obat->stock - $request->qty,
                    'status' => $status
                ]);
                if($obat->stock - $request->qty == 0){
                    $obat->update([
                        'stock' => $obat->stock - $request->qty,
                        'empty_date' => Carbon::now()
                    ]);
                }
                else{
                    $obat->update([
                        'stock' => $obat->stock - $request->qty
                    ]);
                }
                
            break;
        
            case 'draft': 
                $status = "Draft";
                Transaction::create([
                    'obat_id' => $request->obat,
                    'user_id' => Auth::user()->id,
                    'qty' => $request->qty,
                    'date' =>  Carbon::now(),
                    'total' => $request->total,
                    'status' => $status
                ]);
            break;
        }

        
        
        return redirect()->route('dashboard-transaction.index')->with('success','Success');
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
        $trans = $transaction = DB::table('transaction')->join('obat','obat.id','transaction.obat_id')
        ->select('transaction.*','obat.price','obat.stock','obat.name as obat_name','obat.id as obat_id')
        ->where('transaction.id',$id)
        ->first();

        $obat = Obat::where('stock','>',0)->where('status','active')->get();
        return view('transaction.edit',compact('obat','trans'));
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
        $obat = Obat::findOrFail($request->obat);
        $status = "";
        switch($request->submit) {

            case 'approved':
                $status = "Approved";
                
                Transaction::findOrFail($id)->update([
                    'obat_id' => $request->obat,
                    'user_id' => Auth::user()->id,
                    'qty' => $request->qty,
                    'date' =>  Carbon::now(),
                    'total' => $request->total,
                    'sisa_stock' => $obat->stock - $request->qty,
                    'status' => $status
                ]);
                if($obat->stock - $request->qty == 0){
                    $obat->update([
                        'stock' => $obat->stock - $request->qty,
                        'empty_date' => Carbon::now()
                    ]);
                }
                else{
                    $obat->update([
                        'stock' => $obat->stock - $request->qty
                    ]);
                }
                
            break;
        
            case 'draft': 
                $status = "Draft";
                Transaction::findOrFail($id)->update([
                    'obat_id' => $request->obat,
                    'user_id' => Auth::user()->id,
                    'qty' => $request->qty,
                    'date' =>  Carbon::now(),
                    'total' => $request->total,
                    'status' => $status
                ]);
            break;
        }

        
        
        return redirect()->route('dashboard-transaction.index')->with('success','Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Transaction::findOrFail($id)->delete();
        return redirect()->route('dashboard-transaction.index')->with('success', 'Success');
    }
}
