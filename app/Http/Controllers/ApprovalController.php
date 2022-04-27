<?php

namespace App\Http\Controllers;

use App\Models\Calculation;
use App\Models\Nasabah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\SukuBunga;

class ApprovalController extends Controller
{
    protected $menu = 'approval';

    public function index()
    {
        $customers = [];
        // if (Auth::user()->roles == 'mka' || Auth::user()->roles == 'superadmin') {
        //     $customers = Nasabah::where([
        //         ['approval_lv_1', '=', 0],
        //         ['approval_lv_2', '=', 0]
        //     ])->doesntHave('skoring')->orderBy('id', 'DESC')->get();
        // } else if (Auth::user()->roles == 'kepala cabang' || Auth::user()->roles == 'superadmin') {
        $customers = Nasabah::where([
            ['approval_lv_1', '=', 1],
            ['approval_lv_2', '=', 0]
        ])->whereHas('skoring')->orderBy('id', 'DESC')->get();
        // }

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

    public function detail_score($id)
    {
        $nasabah = Nasabah::with('skoring', 'calculation')->findOrFail($id);

        $data = [
            'menu' => $this->menu,
            'sub_menu' => 'approval',
            'customer' => $nasabah
        ];

        return view('approval.detail_skoring')->with($data);
    }

    public function approval_head_division(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            if ($request->type == 'approve') {
                $items = SukuBunga::all();

                $bunga_per_bulan = '';

                foreach ($items as $item) {
                    if ($item->tipe === $request->jenis_kredit && $request->limit_kredit >= $item->kredit_terkecil && $request->limit_kredit < $item->kredit_terbesar) {
                        $bunga_per_bulan = floor(($request->limit_kredit / $request->tenor) + ($request->limit_kredit * $item->per_bulan / 100));
                    }
                }


                if ($request->jenis_kredit === 'kur') {

                    $biaya_provisi_admin = ($request->limit_kredit * 1.5) / 100;

                    if ($request->limit_kredit >= 200000000 || $request->limit_kredit <= 350000000) {
                        $biaya_provisi_admin = ($request->limit_kredit * 0.25) / 100;
                    }

                    $biaya_administrasi = 250000;

                    if ($request->limit_kredit >= 25000000 || $request->limit_kredit <= 350000000) {
                        $biaya_administrasi = 500000;
                    }
                } else {

                    $biaya_provisi_admin = ($request->limit_kredit * 0.5) / 100;

                    $biaya_administrasi = 50000;

                    if ($request->limit_kredit >= 50000000) {
                        $biaya_administrasi = 100000;
                    }
                }
                $customer = Nasabah::findOrFail($id);
                $calculation = Calculation::where('nasabah_id', $id)->first();
                $calculation->bunga_per_bulan = $bunga_per_bulan;
                $calculation->biaya_provisi_admin = $biaya_provisi_admin;
                $calculation->biaya_administrasi = $biaya_administrasi;
                $customer->limit_kredit = $request->limit_kredit;
                $customer->jangka_waktu = $request->tenor;
                $customer->approval_lv_2 = 1;
                $customer->pesan_approval_lv_2 = $request->approval_message;
                $calculation->save();
                $customer->save();
            } else if ($request->type == 'reject') {
                $customer = Nasabah::findOrFail($id);
                $customer->approval_lv_2 = 2;
                $customer->pesan_approval_lv_2 = $request->approval_message;
                $customer->save();
            }
            DB::commit();
            return redirect('approval')->with('success', 'Berhasil Approval Data');
        } catch (\Throwable $err) {
            DB::rollBack();
            throw $err;
            return back()->with('error', 'Gagal Approval Data');
        }
    }

    public function approval_detail($id)
    {
        $customer = Nasabah::with('calculation', 'usaha')->findOrFail($id);

        $data = [
            'menu' => $this->menu,
            'sub_menu' => 'approval',
            'customer' => $customer
        ];

        return view('approval.scoring_approval')->with($data);
    }

    public function reject_credit(Request $request, $id)
    {
        $nasabah = Nasabah::findOrFail($id);

        DB::beginTransaction();
        try {
            $nasabah->approval_lv_2 = 3;
            $nasabah->pesan_approval_lv_2 = $request->approval_message;
            $nasabah->save();
            DB::commit();
            return redirect('approval')->with('success', 'Behasil Reject Data');
        } catch (\Throwable $err) {
            DB::rollBack();
            return back()->with('error', 'Gagal Reject Data');
        }
    }
}
