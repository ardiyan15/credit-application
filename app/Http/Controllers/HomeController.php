<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $contracts = DB::table('nasabah')
            ->select(DB::raw('count(*) as total'))
            ->where('approval_lv_1', 1)
            ->where('approval_lv_2', 1)
            ->get();

        $result = [];

        foreach ($contracts as $contract) {
            $result['total'][] = $contract->total;
        }

        $accs = DB::table('nasabah')
            ->select(DB::raw('count(*) as total'))
            ->where('approval_lv_1', 1)
            ->where('approval_lv_2', 1)
            ->get();

        $result_accs = [];

        foreach ($accs as $acc) {
            $result_accs['total'][] = $acc->total;
        }

        $reject_head = DB::table('nasabah')
            ->select(DB::raw('count(*) as total'))
            ->where('approval_lv_2', 3)
            ->get();

        $result_heads = [];

        foreach ($reject_head as $head) {
            $result_heads['total'][] = $head->total;
        }

        $reject_mka = DB::table('nasabah')
            ->select(DB::raw('count(*) as total'))
            ->where('approval_lv_1', 2)
            ->get();

        $result_mkas = [];

        foreach ($reject_mka as $mka) {
            $result_mkas['total'][] = $mka->total;
        }

        $data = [
            'menu' => 'Dashboard',
            'sub_menu' => '',
            'result' => json_encode($result),
            'accs' => json_encode($result_accs),
            'reject_head' => json_encode($result_heads),
            'reject_mka' => json_encode($result_mkas)
        ];

        return view('home')->with($data);
    }
}
