<?php

namespace App\Http\Controllers;

use App\Models\Mbarang;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class MbarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Mbarang::all();
        return view('pages.m_barang',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.m_barang_add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([


            'img_barang' => 'required ',
            'nm_barang' => 'required',
            'wr_barang'=>'required',
            'stok_barang'=>'required',


        ]);



        $input = $request->all();



        if ($request->file('img_barang')) {
            $uuid = (string) Str::uuid();

            $nama_file_ori_id = 'Id-'. $uuid. $request->img_barang->getClientOriginalName();

            // $nama_file_id = $uuid . '.' . $request->img_barang->extension();

            $path = public_path('/barang_img');

            // dd($nama_file_ori_id);

            $request->img_barang->move($path, $nama_file_ori_id);
            $input['foto_barang'] = $nama_file_ori_id;
        }


        Mbarang::create($input);

        Alert::success('Success Title', 'Success Message');

        return redirect('/barang')->with('success','Registration Barang Success!!');
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
        $barang = Mbarang::where('id',$id)->first();

        return view('pages.m_barang_edit',compact('barang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([



            'nm_barang' => 'required',
            'wr_barang'=>'required',
            'stok_barang'=>'required',


        ]);






        $input = $request->all();

        if ($request->file('img_barang')) {
            $banner_old = Mbarang::where('id',$id)->first();
            unlink("barang_img/".$banner_old->foto_barang);
            $uuid = (string) Str::uuid();

            $nama_file_ori_id = 'Id-'. $uuid. $request->img_barang->getClientOriginalName();

            // $nama_file_id = $uuid . '.' . $request->img_barang->extension();

            $path = public_path('/barang_img');

            // dd($nama_file_ori_id);

            $request->img_barang->move($path, $nama_file_ori_id);
            $input['foto_barang'] = $nama_file_ori_id;
        }else{

            $banner_old = Mbarang::where('id',$id)->first();
            $input['foto_barang'] = $banner_old->foto_barang;
        }


        $barang_u = Mbarang::where('id',$id)->first();



        $barang_u->update($input);

        Alert::success('Success Title', 'Success Message');

        return redirect('/barang');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $banner = Mbarang::find($id);

        $banner->delete();
        unlink("barang_img/".$banner->foto_barang);

        return response()->json([
            'message' => $banner
        ]);
    }
}
