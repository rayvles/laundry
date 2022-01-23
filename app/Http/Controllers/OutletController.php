<?php

namespace App\Http\Controllers;

use App\Models\Outlet;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class OutletController extends Controller
{
    public function home(Outlet $outlet)
    {
        return view('outlet.home', [
            'outlet' => $outlet
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $outlet = Outlet::all();
        return view('admin.outlet.index', [
            'title' => 'Outlet',
            'data_outlet' => $outlet,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.outlet.create', [
            'title' => 'Tambah Outlet'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'telepon' => 'required|max:15',
            'alamat' => 'required'
        ]);

        Outlet::create([
            'nama' => $request->nama,
            'telepon' => $request->telepon,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('outlet.index');
    }

    public function edit(Outlet $outlet)
    {
        return view('admin.outlet.edit', [
            'title' => 'Edit Outlet',
            'outlet' => $outlet
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Outlet $outlet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Outlet $outlet)
    {
        $request->validate([
            'nama' => 'required|string',
            'telepon' => 'required|max:15',
            'alamat' => 'required'
        ]);

        $outlet->update([
            'nama' => $request->nama,
            'telepon' => $request->telepon,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('outlet.index');
    }

    public function destroy(Outlet $outlet)
    {
        if ($outlet->delete()) {
            return response()->json([
                'success' => true,
                'message' => 'Outlet berhasil dihapus'
            ], Response::HTTP_OK);
        };

        return response()->json([
            'message' => 'Terjadi kesalahan'
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }

}
