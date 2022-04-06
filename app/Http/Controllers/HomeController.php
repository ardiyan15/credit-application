<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
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



        $data = [
            'menu' => 'Dashboard',
            'sub_menu' => '',
            'result' => json_encode($result)
        ];

        return view('home')->with($data);
    }
}
