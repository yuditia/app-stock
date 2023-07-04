<?php

namespace App\Http\Controllers;

use App\Models\Mbarang;
use App\Models\PembelianBarang;
use App\Models\PengambilanBarang;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class ReportController extends Controller
{
    public function index(){
        $data = Mbarang::all();
        return view('pages.report_stock',compact('data'));
    }

    public function indexpengambilan()
    {
        $barang = Mbarang::all();
        $data = PengambilanBarang::with('barang','pengambilan')->get();

        return view('pages.report_pengambilan',compact('data','barang'));
    }

    public function filterpengambilan($start, $end){

        $parse_start = Carbon::parse($start)->format('Y-m-d');
        $parse_end = Carbon::parse($end)->format('Y-m-d');

        $data = DB::table('t_pengambilan_barang')
           ->join('m_barang', 't_pengambilan_barang.barang_id', '=', 'm_barang.id')
           ->join('t_pengambilan', 't_pengambilan_barang.no_transaksi', '=', 't_pengambilan.no_transaksi')
           ->whereBetween('t_pengambilan.tgl_pengambilan', [$parse_start, $parse_end])
           ->get();

           return DataTables::of($data)->toJson();

    }

    public function filterpengambilanbarang($barang_id){
        $data = DB::table('t_pengambilan_barang')
           ->join('m_barang', 't_pengambilan_barang.barang_id', '=', 'm_barang.id')
           ->join('t_pengambilan', 't_pengambilan_barang.no_transaksi', '=', 't_pengambilan.no_transaksi')
           ->where('m_barang.id', $barang_id)
           ->get();

           return DataTables::of($data)->toJson();
    }

    public function indexpembelian()
    {
        $data = PembelianBarang::with('barang','pembelian')->get();

        $barang = Mbarang::all();

        return view('pages.report_pembelian',compact('barang','data'));
    }

    public function filterpembelian($start, $end){

        $parse_start = Carbon::parse($start)->format('Y-m-d');
        $parse_end = Carbon::parse($end)->format('Y-m-d');

        $data = DB::table('t_pembelian_barang')
           ->join('m_barang', 't_pembelian_barang.barang_id', '=', 'm_barang.id')
           ->join('t_pembelian', 't_pembelian_barang.no_transaksi', '=', 't_pembelian.no_transaksi')
           ->whereBetween('t_pembelian.tgl_pembelian', [$parse_start, $parse_end])
           ->get();



           return DataTables::of($data)->toJson();

    }

    public function filterpembelianbarang($barang_id){
        $data = DB::table('t_pembelian_barang')
           ->join('m_barang', 't_pembelian_barang.barang_id', '=', 'm_barang.id')
           ->join('t_pembelian', 't_pembelian_barang.no_transaksi', '=', 't_pembelian.no_transaksi')
           ->where('m_barang.id', $barang_id)
           ->get();

           return DataTables::of($data)->toJson();
    }


}
