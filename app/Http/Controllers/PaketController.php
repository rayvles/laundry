<?php

namespace App\Http\Controllers;

use App\Models\Outlet;
use App\Models\Paket;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yajra\DataTables\DataTables;

class PaketController extends Controller
{
    public function index(Outlet $outlet)
    {
        return view('outlet.paket', [
            'title' => 'Paket',
            'outlet' => $outlet,
        ]);
    }

    /**
     * Datatable
     *
     * @param \App\Models\Outlet  $outlet
     * @return \Illuminate\Http\Response
     */
    public function data(Outlet $outlet)
    {
        $paket = $outlet->paket;
        return DataTables::of($paket)
            ->addIndexColumn()
            ->addColumn('nama_outlet', function () use ($outlet) {
                return $outlet->nama;
            })
            ->addColumn('action', function ($paket) use ($outlet) {
                $editBtn = '<button onclick="editHandler(' . "'" . route('paket.update', [$outlet->id, $paket->id]) . "'" . ')" class="btn btn-success mx-1">
                    <i class="fas fa-edit"></i>
                    <span>Edit Packet</span>
                </button>';
                $deletBtn = '<button onclick="deleteHandler(' . "'" . route('paket.destroy', [$outlet->id, $paket->id]) . "'" . ')" class="btn btn-danger mx-1">
                    <i class="fas fa-trash"></i>
                    <span>Delete Packet</span>
                </button>';
                return $editBtn . $deletBtn;
            })->rawColumns(['action'])->make(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param \App\Models\Outlet  $outlet
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Outlet $outlet)
    {
        $request->validate([
            'nama_paket' => 'required',
            'jenis' => 'required|in:kaos,bed_cover,selimut,lainnya',
            'harga' => 'numeric|min:0'
        ]);

        $outlet->paket()->create([
            'nama_paket' => $request->nama_paket,
            'jenis' => $request->jenis,
            'harga' => $request->harga,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Paket berhasil ditambahkan'
        ], Response::HTTP_OK);
    }

    public function show(Outlet $outlet, Paket $paket)
    {
        return response()->json([
            'success' => true,
            'message' => 'Data paket',
            'paket' => $paket
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param \App\Models\Outlet  $outlet
     * @param \App\Models\Paket  $paket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Outlet $outlet, Paket $paket)
    {
        $request->validate([
            'nama_paket' => 'required',
            'jenis' => 'required|in:kaos,bed_cover,selimut,lainnya',
            'harga' => 'numeric|min:0'
        ]);

        $paket->update([
            'nama_paket' => $request->nama_paket,
            'jenis' => $request->jenis,
            'harga' => $request->harga,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Paket berhasil diupdate'
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Outlet  $outlet
     * @param \App\Models\Paket  $paket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Outlet $outlet, Paket $paket)
    {
        if ($paket->delete()) {
            return response()->json([
                'success' => true,
                'message' => 'Paket berhasil dihapus'
            ], Response::HTTP_OK);
        };

        return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan'
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }

}
