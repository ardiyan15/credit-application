<?php

namespace App\Http\Controllers;

use App\Models\Nasabah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ApprovalController extends Controller
{
    protected $menu = 'approval';

    public function index()
    {
        $customers = [];
        if (Auth::user()->roles == 'mka') {
            $customers = Nasabah::where([
                ['approval_lv_1', '=', 0],
                ['approval_lv_2', '=', 0]
            ])->orderBy('id', 'DESC')->get();
        } else if (Auth::user()->roles == 'kepala cabang') {
            $customers = Nasabah::where([
                ['approval_lv_1', '=', 1],
                ['approval_lv_2', '=', 0],
            ])->orWhere([
                ['approval_lv_1', '=', 1],
                ['approval_lv_2', '=', 2]
            ])->orderBy('id', 'DESC')->get();
        }

        $data = [
            'menu' => $this->menu,
            'sub_menu' => 'approval_credit',
            'customers' => $customers
        ];

        return view('approval.index')->with($data);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        $data = [
            'menu' => $this->menu,
            'sub_menu' => 'approval_credit',
            'customer' => Nasabah::findOrFail($id)
        ];

        return view('approval.detail')->with($data);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function approvalmka(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $customer = Nasabah::findOrFail($id);
            if (Auth::user()->roles == 'mka') {
                $customer->approval_lv_1 = 1;
                $customer->pesan_approval_lv_1 = $request->message;
            } else {
                $customer->approval_lv_2 = $request->kode_approval;
                $customer->pesan_approval_lv_2 = $request->message;
            }
            $customer->save();
            DB::commit();
            return redirect('approval')->with('success', 'Berhasil Approve Kredit');
        } catch (\Throwable $err) {
            DB::rollBack();
            return back()->with('error', 'Gagal Approve Kredit');
        }
    }
}
