<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Obat;
use App\Transaction;
use DB;

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
        $obat = Obat::all();
        $transaction = DB::table('transaction')->join('obat','obat.id','transaction.obat_id')->select('transaction.*','obat.price','obat.satuan','obat.name as obat_name')->get();
        
        return view('transaction.index', ['obat' => $obat, 'transactions' => $transaction]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $obat = Obat::where('stock','>',0)->get();
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
                $obat->update([
                    'stock' => $obat->stock - $request->qty
                ]);
            break;
        
            case 'draft': 
                $status = "Draft";
            break;
        }

        Transaction::create([
            'obat_id' => $request->obat,
            'qty' => $request->qty,
            'total' => $request->total,
            'status' => $status
        ]);
        
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

        $obat = Obat::where('stock','>',0)->get();
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
                $obat->update([
                    'stock' => $obat->stock - $request->qty
                ]);
            break;
        
            case 'draft': 
                $status = "Draft";
            break;
        }

        Transaction::findOrFail($id)->update([
            'obat_id' => $request->obat,
            'qty' => $request->qty,
            'total' => $request->total,
            'status' => $status
        ]);
        
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
