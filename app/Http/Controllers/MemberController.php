<?php

namespace App\Http\Controllers;

use App\Models\member;
use App\Models\Outlet;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yajra\DataTables\DataTables;

class MemberController extends Controller
{
    public function index(Outlet $outlet)
    {
        return view('outlet.member', [
            'title' => 'Member',
            'outlet' => $outlet,
        ]);
    }

    public function data(Outlet $outlet)
    {
        $member = Member::all();
        return DataTables::of($member)
            ->addIndexColumn()
            ->addColumn('action', function ($member) use ($outlet) {
                $whatsappBtn = '<a href="https://wa.me/' . $member->telepon . '" target="_blank" class="btn btn-success">
                    <i class="fab fa-whatsapp mr-1"></i>
                    <span>Whatsapp</span>
                </a>';
                $menuBtn = '<div class="dropdown d-inline">
                    <button class="btn btn-primary" type="button" id="dropdownMenuButton"
                        data-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-ellipsis-v"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a onclick="editHandler(' . "'" . route('member.update', [$outlet->id, $member->id]) . "'" . ')" class="dropdown-item">
                            <i class="fas fa-edit"></i>
                            <span>Edit</span>
                        </a>
                        <button onclick="deleteHandler(' . "'" . route('member.destroy', [$outlet->id, $member->id]) . "'" . ')" class="dropdown-item" id="deleteBtn">
                            <i class="fas fa-trash"></i>
                            <span>Delete</span>
                        </button>
                    </div>
                </div>';
                return $whatsappBtn . $menuBtn;
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
            'nama' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required|in:L,P',
            'telepon' => 'required|max:15'
        ]);

        Member::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'jenis_kelamin' => $request->jenis_kelamin,
            'telepon' => $request->telepon,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Member berhasil ditambahkan'
        ], Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Outlet  $outlet
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function show(Outlet $outlet, Member $member)
    {
        return response()->json([
            'success' => true,
            'message' => 'Data member',
            'member' => $member
        ], Response::HTTP_OK);
    }

    public function update(Request $request, Outlet $outlet, Member $member)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required|in:L,P',
            'telepon' => 'required|max:15'
        ]);

        $member->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'jenis_kelamin' => $request->jenis_kelamin,
            'telepon' => $request->telepon,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Member berhasil diupdate'
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Outlet  $outlet
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(Outlet $outlet, Member $member)
    {
        if ($member->delete()) {
            return response()->json([
                'message' => 'Member berhasil dihapus'
            ], Response::HTTP_OK);
        };

        return response()->json([
            'message' => 'Error'
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
