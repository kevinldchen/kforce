<?php

namespace App\Http\Controllers;

use App\Contract;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('contract.index',['contracts'=>Contract::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contract.create');
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
        'contract_no' => 'required|unique:contracts|integer|digits_between:1,6|min:1',
        'date_of_contract' => 'required|date', //max 6?
        'item_no' => 'required|exists:items|integer|digits_between:1,8|min:1',
        'contract_price' => 'required|digits_between:1,8|integer|min:1',
        'contract_amount' => 'required|digits_between:1,6|integer|min:1'
      ]);

      DB::insert('insert into contracts (contract_no, date_of_contract) values (?,?)',
        [$request->contract_no, $request->date_of_contract]);

      DB::insert('insert into to_supply (contract_no, item_no, contract_price, contract_amount) values (?, ?, ?, ?)',
        [$request->contract_no, $request->item_no, $request->contract_price, $request->contract_amount]);

      return redirect()->back()->with('message', 'Contract created.')->withInput($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $contract = Contract::with('items')->find($id);
      return view('contract.show')
        ->with('contract',$contract);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function edit(Contract $contract)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contract $contract)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contract $contract)
    {
        //
    }
}
