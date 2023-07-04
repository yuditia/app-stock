<?php

namespace App\Http\Controllers;

use App\Models\Mbarang;
use App\Models\Msuplier;
use App\Models\Pembelian;
use App\Models\PembelianBarang;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class PembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = PembelianBarang::with('barang','pembelian')->get();

        return view('pages.t_pembelian',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sup = Msuplier::all();
        $barang = Mbarang::all();
        $now = date('Y-m-d');

        $id = IdGenerator::generate(['table' => 't_pembelian','field'=>'no_transaksi', 'length' => 5, 'prefix' =>'T']);
        return view('pages.t_pembelian_add',compact('sup','barang','now','id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $convert = Carbon::parse($request->tgl_pembelian)->format('Y-m-d');

        $pembelian = Pembelian::create([
            'tgl_pembelian'=>$convert,
            'no_transaksi'=>$request->no_transaksi,
            'suplier'=>$request->suplier,
        ]);




        for ($i=0; $i < count($request->barang) ; $i++)
                {

                        PembelianBarang::create([
                                'no_transaksi' => $pembelian->no_transaksi,
                                'barang_id' => $request->barang[$i],
                                'qty' => $request->qty[$i]
                            ]);
                }
        //update stok

        foreach ($request->barang as $key => $value) {

                $data = Mbarang::where('id',$value)->first();

                Mbarang::where('id',$value)->update([
                    'stok_barang'=>$data->stok_barang + $request->qty[$key]
                ]);


        }

        Alert::success('Success Title', 'Success Message');

        return redirect('/pembelian')->with('success','Registration pembelian Success!!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = PembelianBarang::with('barang','pembelian')
                                ->where('id',$id)
                                ->first();

        $sup = Msuplier::all();

        return view('pages.t_pembelian_edit',compact('data','sup'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {


        $con = Carbon::parse($request->tgl_pembelian)->format('Y-m-d');

        $data = pembelianBarang::with('barang','pembelian')
                                    ->where('id',$id)
                                    ->first();

        $updated = Pembelian::where('no_transaksi',$data->no_transaksi)->first();

        $updated->update([
            'no_transaksi'=>$request->no_transaksi,
            'tgl_pembelian'=>$con
        ]);

        // pembelian::where('no_transaksi',$data->no_transasksi)->update([
        //     'no_transaksi'=>$request->no_transaksi,
        //     'tgl_pembelian'=>$request->tgl_pembelian

        // ]);



        //update stok
            $old = $request->old_qty;
            $new = $request->qty;

            if(!$request->qty){
                $new = $data->qty;
            }

            $data->update([
                'qty'=>$new
            ]);

            $stok = Mbarang::where('id',$data->barang_id)->first();

            $balance = $stok->stok_barang + $old;

            $stok->update([
                'stok_barang'=>$balance - $new
            ]);


            Alert::success('Success Title', 'Success Message');

            return redirect('/pembelian')->with('success','Edit pembelian Success!!');




    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = pembelianBarang::where('id',$id)->first();

        $data->delete();

        return response()->json(['message' => 'pembelian Deleted']);
    }
}
