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
        $nasabah = Nasabah::orderBy('id', 'DESC')->get();

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
                'skor' => $request->skor,
                'nasabah_id' => $request->nasabah_id
            ]);
            DB::commit();
            return redirect('mks')->with('success', 'Berhasil input data');
        } catch (\Throwable $err) {
            DB::rollBack();
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
