<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Makanan;

class MakananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Makanan::latest()->paginate(5);
        return view('menu.index',compact('menus'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('menu.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_makanan' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required'
        ]);

        $makanan = new Makanan();
        $makanan->nama_makanan = $request->input('nama_makanan');
        $makanan->deskripsi = $request->input('deskripsi');
        $makanan->harga = $request->input('harga');
        $makanan->save();
        
        return redirect()->route('makanan.index')
                        ->with('success','Article created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $menu = Makanan::find($id);
        return view('menu.show',compact('menu'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menu = Makanan::find($id);
        return view('menu.edit',compact('menu'));
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
        $this->validate($request, [
            'nama_makanan' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required'
        ]);
        $makanan = Makanan::find($id);
        $makanan->nama_makanan = $request->input('nama_makanan');
        $makanan->deskripsi = $request->input('deskripsi');
        $makanan->harga = $request->input('harga');
        $makanan->save();
        return redirect()->route('makanan.index')
                        ->with('success','Article updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Makanan::find($id)->delete();
        return redirect()->route('makanan.index')
                        ->with('success','Article deleted successfully');
    }
}
