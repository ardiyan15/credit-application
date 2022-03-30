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
        if (Auth::user()->roles == 'mka' || Auth::user()->roles == 'superadmin') {
            $customers = Nasabah::where('approval_lv_1', 0)->orderBy('id', 'DESC')->get();
        } elseif (Auth::user()->roles == 'kepala cabang' || Auth::user()->roles == 'superadmin') {
            $customers = Nasabah::where('approval_lv_2', 0)->orderBy('id', 'DESC')->get();
        }

        dd($customers);

        $data = [
            'menu' => $this->menu,
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
            $customer->approval_lv_1 = 1;
            $customer->pesan_approval_lv_1 = $request->message;
            $customer->save();
            DB::commit();
            return redirect('approval')->with('success', 'Berhasil Approve Kredit');
        } catch (\Throwable $err) {
            DB::rollBack();
            return back()->with('error', 'Gagal Approve Kredit');
        }
    }
}
