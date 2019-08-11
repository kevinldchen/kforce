<?php

namespace App\Http\Controllers;

use App\Supplier;
use App\Contract;
use Illuminate\Http\Request;
use DB;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = DB::raw('SELECT * FROM suppliers');
        $suppliers = Supplier::fromQuery($query);
        return view('supplier.index',['suppliers'=>$suppliers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
          'supplier_no' => 'required|unique:suppliers|integer|digits_between:1,6|min:1',
          'supplier_address' => 'required|max:30',
          'supplier_name' => 'required|max:20',
        ]);

        DB::insert('insert into suppliers (supplier_no, supplier_address, supplier_name) values (?, ?, ?)',
          [$request->supplier_no, $request->supplier_address, $request->supplier_name]);

        return redirect()->route('supplier.show',['id'=>$request->supplier_no])->with('message', 'Supplier created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $query = DB::raw('SELECT * FROM suppliers WHERE supplier_no = :supplier_no');
        $supplier = Supplier::fromQuery($query, ['supplier_no'=>$id])->first();

        $query = DB::raw('SELECT * FROM contracts WHERE supplier_no = :supplier_no');
        $contracts = Contract::fromQuery($query, ['supplier_no'=>$id]);

        return view('supplier.show')
          ->with('supplier',$supplier)
          ->with('contracts',$contracts);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        //
    }
}
