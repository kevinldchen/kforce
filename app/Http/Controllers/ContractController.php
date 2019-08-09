<?php

namespace App\Http\Controllers;

use App\Contract;
use App\Item;
use Illuminate\Http\Request;
use DB;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $query = DB::raw('SELECT * FROM contracts');
      $contracts = Contract::fromQuery($query);
      return view('contract.index',['contracts'=>$contracts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $query = DB::raw('SELECT * FROM items');
        $items = Item::fromQuery($query);

        $items_ddl = ['0'=>''];
        foreach($items as $item) {
          $items_ddl[$item->item_no] = $item->item_no." - ".$item->item_description;
        }

        return view('contract.create',['items'=>$items_ddl]);
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
        'contract_no' => 'required|unique:contracts|integer|digits_between:1,6',
        'date_of_contract' => 'required|date', //max 6?
        'item_no' => 'required|exists:items|integer|digits_between:1,8',
        'contract_price' => 'required|digits_between:1,8|integer',
        'contract_amount' => 'required|digits_between:1,6|integer'
      ]);

      DB::insert('INSERT INTO contracts (contract_no, date_of_contract) VALUES (?,?)',
        [$request->contract_no, $request->date_of_contract]);

      DB::insert('INSERT INTO to_supply (contract_no, item_no, contract_price, contract_amount) VALUES (?, ?, ?, ?)',
        [$request->contract_no, $request->item_no, $request->contract_price, $request->contract_amount]);

        //->withInput($request)

      return redirect()->back()->with('message', 'Contract created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $query = DB::raw('SELECT *
                        FROM contracts, suppliers
                        WHERE contracts.supplier_no = suppliers.supplier_no
                        AND contract_no = :contract_no');
      $contract = DB::select($query, ['contract_no'=>$id])[0];

      $query = DB::raw('SELECT *
                        FROM orders, made_of
                        WHERE orders.order_no = made_of.order_no
                        AND orders.contract_no = :contract_no');
      $orders = DB::select($query, ['contract_no'=>$id]);

      $query = DB::raw('SELECT *
                        FROM items, to_supply
                        WHERE items.item_no = to_supply.item_no
                        AND to_supply.contract_no = :contract_no');
      $item_supply = DB::select($query, ['contract_no'=>$id]);

      return view('contract.show')
        ->with('contract',$contract)
        ->with('orders',$orders)
        ->with('items', $item_supply);
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
