<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    protected $menu = "master";

    public function index()
    {
        $data = [
            'menu' => $this->menu,
            'sub_menu' => 'employee',
            'employees' => Employee::orderBy('id', 'DESC')->get()
        ];

        return view('employee.index')->with($data);
    }

    public function create()
    {
        $data = [
            'menu' => $this->menu,
            'sub_menu' => 'employee',
        ];

        return view('employee.create')->with($data);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            Employee::create([
                'nip' => $request->nip,
                'nama' => $request->nama,
                'no_telepon' => $request->no_telepon,
                'alamat' => $request->alamat,
                'jabatan' => $request->jabatan
            ]);
            DB::commit();
            return redirect('employee')->with('success', 'Berhasil Tambah Employee');
        } catch (\Throwable $err) {
            DB::rollBack();
            throw $err;
            return back()->with('error', 'Gagal Tambah Employee');
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $employee = Employee::findOrFail($id);

        $positions = [
            [
                'value' => 'MKS',
                'name' => 'MKS'
            ],
            [
                'value' => 'MKA',
                'name' => 'MKA'
            ],
            [
                'value' => 'BOS',
                'name' => 'BOS'
            ],
            [
                'value' => 'Teller',
                'name' => 'Teller'
            ],
            [
                'value' => 'Customer Service Representative',
                'name' => 'Customer Service Representative'
            ],
            [
                'value' => 'Mikro Branch Manager',
                'name' => 'Mikro Branch Manager'
            ],
            [
                'value' => 'Branch Manager',
                'name' => 'Branch Manager'
            ]
        ];

        $data = [
            'menu' => $this->menu,
            'sub_menu' => 'employee',
            'employee' => $employee,
            'positions' => $positions
        ];

        return view('employee.edit')->with($data);
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $employee = Employee::findOrFail($id);

            $employee->nip = $request->nip;
            $employee->no_telepon = $request->no_telepon;
            $employee->nama = $request->nama;
            $employee->alamat = $request->alamat;
            $employee->jabatan = $request->jabatan;

            $employee->save();

            DB::commit();
            return redirect('employee')->with('success', 'Berhasil update employee');
        } catch (\Throwable $err) {
            DB::rollBack();
            return back()->with('error', 'Gagal update employee');
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $employee = Employee::findOrFail($id);
            $employee->delete();
            DB::commit();
            return back()->with('success', 'Berhasil hapus employee');
        } catch (\Throwable $err) {
            DB::rollBack();
            return back()->with('error', 'Gagal hapus employee');
        }
    }
}
