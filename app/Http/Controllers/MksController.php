<?php

namespace App\Http\Controllers;

use App\Models\Mks;
use App\Models\Nasabah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MksController extends Controller
{
    protected $menu = 'mks';

    public function index()
    {
        $scores = Mks::with('nasabah')->orderBy('id', 'DESC')->get();

        $data = [
            'menu' => $this->menu,
            'sub_menu' => 'scoring',
            'scores' => $scores
        ];

        return view('mks.index')->with($data);
    }

    public function create()
    {
        $nasabah = Nasabah::doesntHave('skoring')->where('approval_lv_1', '1')->orderBy('id', 'DESC')->get();

        $data = [
            'menu' => $this->menu,
            'sub_menu' => 'scoring',
            'customers' => $nasabah
        ];

        return view('mks.create')->with($data);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            Mks::create([
                'aset' => $request->aset,
                'profit_ramai' => $request->profit_ramai,
                'profit_sepi' => $request->profit_sepi,
                'profit_normal' => $request->profit_normal,
                'persediaan_aset' => $request->persediaan_aset,
                'fixed_aset' => $request->fixed_aset,
                'laba_perbulan' => $request->laba_perbulan,
                'laba_pertahun' => $request->laba_pertahun,
                'nasabah_id' => $request->nasabah_id,
            ]);

            $customer = Nasabah::findOrFail($request->nasabah_id);
            $customer->approval_lv_1 = 1;
            $customer->pesan_approval_lv_1 = 'OK';
            $customer->save();
            DB::commit();
            return redirect('mks')->with('success', 'Berhasil input data');
        } catch (\Throwable $err) {
            DB::rollBack();
            throw $err;
            return back()->with('error' . 'Gagal input data');
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $score = Mks::findOrFail($id);
        $customers = Nasabah::orderBy('id', 'DESC')->get();

        $data = [
            'menu' => $this->menu,
            'sub_menu' => 'scoring',
            'score' => $score,
            'customers' => $customers
        ];

        return view('mks.edit')->with($data);
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $score = Mks::findOrFail($id);
            $score->skor = $request->skor;
            $score->nasabah_id = $request->nasabah_id;
            $score->save();
            DB::commit();
            return redirect('mks')->with('success', 'Berhasil update data');
        } catch (\Throwable $err) {
            DB::rollBack();
            return back()->with('error', 'Gagal update data');
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $mks = Mks::findOrFail($id);
            $mks->delete();
            DB::commit();
            return back()->with('success', 'Berhasil hapus data');
        } catch (\Throwable $err) {
            DB::rollBack();
            return back()->with('error', 'Gagal hapus data');
        }
    }
}
