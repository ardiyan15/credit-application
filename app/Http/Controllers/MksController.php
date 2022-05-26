<?php

namespace App\Http\Controllers;

use App\Models\Mks;
use App\Models\Nasabah;
use App\Models\Skoring;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class MksController extends Controller
{
    protected $menu = 'mks';

    public function index()
    {
        $customers = Nasabah::with('skoring')->where('approval_lv_1', '1')->orderBy('id', 'DESC')->get();

        $data = [
            'menu' => $this->menu,
            'sub_menu' => 'scoring',
            'customers' => $customers
        ];

        return view('mks.index')->with($data);
    }

    public function create($id)
    {
        $nasabah = Nasabah::findOrFail($id);

        $data = [
            'menu' => $this->menu,
            'sub_menu' => 'scoring',
            'customer' => $nasabah
        ];

        return view('mks.create')->with($data);
    }

    public function store(Request $request)
    {
        $aset = str_replace('.', '', $request->aset);
        $profit_ramai_hari = str_replace('.', '', $request->profit_ramai_hari);
        $profit_ramai = str_replace('.', '', $request->profit_ramai);
        $profit_sepi_hari = str_replace('.', '', $request->profit_sepi_hari);
        $profit_sepi = str_replace('.', '', $request->profit_sepi);
        $profit_normal_hari = str_replace('.', '', $request->profit_normal_hari);
        $profit_normal = str_replace('.', '', $request->profit_normal);
        $persediaan_aset = str_replace('.', '', $request->persediaan_aset);
        $fixed_aset = str_replace('.', '', $request->fixed_aset);
        $laba_perbulan = str_replace('.', '', $request->laba_perbulan);
        $laba_pertahun = str_replace('.', '', $request->laba_pertahun);

        DB::beginTransaction();
        try {
            Mks::create([
                'aset' => $aset,
                'profit_ramai_hari' => $profit_ramai_hari,
                'profit_ramai' => $profit_ramai,
                'profit_sepi_hari' => $profit_sepi_hari,
                'profit_sepi' => $profit_sepi,
                'profit_normal_hari' => $profit_normal_hari,
                'profit_normal' => $profit_normal,
                'persediaan_aset' => $persediaan_aset,
                'fixed_aset' => $fixed_aset,
                'laba_perbulan' => $laba_perbulan,
                'laba_pertahun' => $laba_pertahun,
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
        $score = Mks::with('nasabah')->findOrFail($id);

        $data = [
            'menu' => $this->menu,
            'sub_menu' => 'scoring',
            'score' => $score
        ];

        return view('mks.detail')->with($data);
    }

    public function edit($id)
    {
        $score = Mks::with('nasabah')->findOrFail($id);

        $data = [
            'menu' => $this->menu,
            'sub_menu' => 'scoring',
            'score' => $score
        ];

        return view('mks.edit')->with($data);
    }

    public function update(Request $request, $id)
    {
        $aset = str_replace('.', '', $request->aset);
        $profit_ramai_hari = str_replace('.', '', $request->profit_ramai_hari);
        $profit_ramai = str_replace('.', '', $request->profit_ramai);
        $profit_sepi_hari = str_replace('.', '', $request->profit_sepi_hari);
        $profit_sepi = str_replace('.', '', $request->profit_sepi);
        $profit_normal_hari = str_replace('.', '', $request->profit_normal_hari);
        $profit_normal = str_replace('.', '', $request->profit_normal);
        $persediaan_aset = str_replace('.', '', $request->persediaan_aset);
        $fixed_aset = str_replace('.', '', $request->fixed_aset);
        $laba_perbulan = str_replace('.', '', $request->laba_perbulan);
        $laba_pertahun = str_replace('.', '', $request->laba_pertahun);

        DB::beginTransaction();
        try {
            $score = Mks::findOrFail($id);
            $score->aset = $aset;
            $score->profit_ramai_hari = $profit_ramai_hari;
            $score->profit_ramai = $profit_ramai;
            $score->profit_sepi_hari = $profit_sepi_hari;
            $score->profit_sepi = $profit_sepi;
            $score->profit_normal_hari = $profit_normal_hari;
            $score->profit_normal = $profit_normal;
            $score->persediaan_aset = $persediaan_aset;
            $score->fixed_aset = $fixed_aset;
            $score->laba_perbulan = $laba_perbulan;
            $score->laba_pertahun = $laba_pertahun;
            $score->nasabah_id = $request->nasabah_id;
            $score->save();
            DB::commit();
            return redirect('mks')->with('success', 'Berhasil update data');
        } catch (\Throwable $err) {
            DB::rollBack();
            throw $err;
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

    public function print($id)
    {
        $score = Skoring::with(['nasabah' => function ($nasabah) {
            $nasabah->with('user_created', 'usaha');
        }])->findOrFail($id);

        $pdf = PDF::loadview('mks.print', ['scoring' => $score]);
        return $pdf->stream();
    }
}
