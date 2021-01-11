<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Obat;
use App\Transaction;
use App\TransactionDetail;
use App\KartuStok;
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
            $transaction = DB::table('transaction')->join('users','users.id','transaction.user_id')
                                                   ->select('transaction.*','users.name as user')
                                                   ->whereBetween('transaction.date',array($request->from,$request->to))
                                                   ->orderBy('transaction.created_at','DESC')->get();
        }
        else{
            $transaction = DB::table('transaction')->join('users','users.id','transaction.user_id')->select('transaction.*','users.name as user')->orderBy('transaction.created_at','DESC')->get();
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
        $check = Transaction::where('no_transaction', $request->no_transaction)->get();
        if(count($check) > 0){
            return 2;
        }
        
        $status = "";
        switch($request->save) {

            case 1:
                $status = "Approved";
                $total = 0;
                foreach($request->item as $value){
                    $total += $value['total'];
                }
                $transaction = Transaction::create([
                    'no_transaction' => $request->no_transaction,
                    'user_id' => Auth::user()->id,
                    'date' => Carbon::now(),
                    'total' => $total,
                    'status' => $status
                ]);
                foreach($request->item as $value){
                    
                    $obat = Obat::findOrFail($value['obat']);
                    TransactionDetail::create([
                        'transaction_id' => $transaction->id,
                        'obat_id' => $value['obat'],
                        'price' => $value['price'],
                        'qty' => $value['qty'],
                        'sub_total' => $value['total'],
                    ]);
                    
                    $kartu = KartuStok::where('obat_id',$value['obat'])->whereDate('date',Carbon::now())->get();
                    if(count($kartu) == 0){
                        KartuStok::create([
                            'date' => Carbon::now(),
                            'obat_id' => $value['obat'],
                            'stock_awal' => $obat->stock,
                            'masuk' => 0,
                            'keluar' => $value['qty'],
                            'sisa' => $obat->stock - $value['qty']
                        ]);
                    }else{
                        $keluar = KartuStok::where('obat_id',$value['obat'])->whereDate('date',Carbon::now())->first();
                        KartuStok::where('obat_id',$value['obat'])->whereDate('date',Carbon::now())->update([
                            'keluar' => $keluar->keluar + $value['qty'],
                            'sisa' => $obat->stock - $value['qty']
                        ]);
                    }
                    
                    if($obat->stock - $value['qty'] == 0){
                        $obat->update([
                            'stock' => $obat->stock - $value['qty'],
                            'empty_date' => Carbon::now()
                        ]);
                    }
                    else{
                        $obat->update([
                            'stock' => $obat->stock - $value['qty']
                        ]);
                    }
                }
                
                
                
            break;
        
            case 0: 
                $status = "Draft";
                $total = 0;
                foreach($request->item as $value){
                    $total += $value['total'];
                }
                $transaction = Transaction::create([
                    'no_transaction' => $request->no_transaction,
                    'user_id' => Auth::user()->id,
                    'date' => Carbon::now(),
                    'total' => $total,
                    'status' => $status
                ]);
                foreach($request->item as $value){
                    TransactionDetail::create([
                        'transaction_id' => $transaction->id,
                        'obat_id' => $value['obat'],
                        'price' => $value['price'],
                        'qty' => $value['qty'],
                        'sub_total' => $value['total']
                    ]);
                    
                }
                
                
            break;
        }

        
        
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
        $transaction = Transaction::where('id',$id)->with('users')->first();
        $transaction_detail = DB::table('transaction_detail')->join('obat','transaction_detail.obat_id','obat.id')
                                                         ->select('transaction_detail.qty','transaction_detail.sub_total','transaction_detail.price','obat.name')
                                                         ->where('obat.status','active')
                                                         ->where('transaction_detail.transaction_id',$transaction->id)->get();
        return view('transaction.show',compact('transaction','transaction_detail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $trans = Transaction::find($id);
        $trans_detail = DB::table('transaction_detail')->join('obat','obat.id','transaction_detail.obat_id')
        ->select('transaction_detail.*','obat.price','obat.stock','obat.name as obat_name','obat.id as obat_id')
        ->where('transaction_detail.transaction_id',$trans->id)
        ->where('obat.status','active')
        ->get();

        $obat = Obat::where('status','active')->get();
        return view('transaction.edit',compact('obat','trans','trans_detail'));
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
        $transaction = Transaction::findOrFail($id);
        $check = Transaction::where('no_transaction', $request->no_transaction)->where('no_transaction','!=', $transaction->no_transaction)->get();
        if(count($check) > 0){
            return 2;
        }
        
        $status = "";
        switch($request->save) {

            case 1:
                $status = "Approved";
                $total = 0;
                foreach($request->item as $value){
                    $total += $value['total'];
                }
                $transaction->update([
                    'no_transaction' => $request->no_transaction,
                    'user_id' => Auth::user()->id,
                    'date' => Carbon::now(),
                    'total' => $total,
                    'status' => $status
                ]);
                TransactionDetail::where('transaction_id',$id)->delete();
                foreach($request->item as $value){
                    $obat = Obat::findOrFail($value['obat']);
                    TransactionDetail::create([
                        'transaction_id' => $transaction->id,
                        'obat_id' => $value['obat'],
                        'price' => $value['price'],
                        'qty' => $value['qty'],
                        'sub_total' => $value['total'],
                    ]);

                    $kartu = KartuStok::where('obat_id',$value['obat'])->whereDate('date',Carbon::now())->get();
                    if(count($kartu) == 0){
                        KartuStok::create([
                            'date' => Carbon::now(),
                            'obat_id' => $value['obat'],
                            'stock_awal' => $obat->stock,
                            'masuk' => 0,
                            'keluar' => $value['qty'],
                            'sisa' => $obat->stock - $value['qty']
                        ]);
                    }else{
                        $keluar = KartuStok::where('obat_id',$value['obat'])->whereDate('date',Carbon::now())->first();
                        KartuStok::where('obat_id',$value['obat'])->whereDate('date',Carbon::now())->update([
                            'keluar' => $keluar->keluar + $value['qty'],
                            'sisa' => $obat->stock - $value['qty']
                        ]);
                    }

                
                    if($obat->stock - $value['qty'] == 0){
                        $obat->update([
                            'stock' => $obat->stock - $value['qty'],
                            'empty_date' => Carbon::now()
                        ]);
                    }
                    else{
                        $obat->update([
                            'stock' => $obat->stock - $value['qty']
                        ]);
                    }
                }
                
            break;
        
            case 0: 
                $status = "Draft";
                $total = 0;
                foreach($request->item as $value){
                    $total += $value['total'];
                }
                $transaction->update([
                    'no_transaction' => $request->no_transaction,
                    'user_id' => Auth::user()->id,
                    'date' => Carbon::now(),
                    'total' => $total,
                    'status' => $status
                ]);
                TransactionDetail::where('transaction_id',$id)->delete();
                foreach($request->item as $value){
                    TransactionDetail::create([
                        'transaction_id' => $transaction->id,
                        'obat_id' => $value['obat'],
                        'price' => $value['price'],
                        'qty' => $value['qty'],
                        'sub_total' => $value['total']
                    ]);
                }
            break;
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
        Transaction::findOrFail($id)->delete();
        return redirect()->route('dashboard-transaction.index')->with('success', 'Success');
    }
}
