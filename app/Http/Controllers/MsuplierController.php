<?php

namespace App\Http\Controllers;

use App\Models\Msuplier;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class MsuplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Msuplier::all();
        return view('pages.m_suplier',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.m_suplier_add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([



            'nm_suplier' => 'required',


        ]);

        $input = $request->all();

        Msuplier::create($input);

        Alert::success('Success Title', 'Success Message');

        return redirect('/suplier')->with('success','Registration Suplier Success!!');
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
        $suplier = Msuplier::where('id',$id)->first();
        return view('pages.m_suplier_edit',compact('suplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $suplier = Msuplier::where('id',$id)->first();

        $suplier->update($request->all());


        Alert::success('Success Title', 'Success Message');

        return redirect('/suplier')->with('success','Edit Suplier Success!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $suplier = Msuplier::where('id',$id)->first();
        $suplier->delete();

        return response()->json(['message' => 'Suplier Deleted']);
    }
}
