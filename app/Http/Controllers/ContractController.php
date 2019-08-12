<?php

namespace App\Http\Controllers;

use App\Contract;
use App\Item;
use App\Supplier;
use Illuminate\Http\Request;
use DB;
use Route;

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
        $query = DB::raw('SELECT * FROM suppliers');
        $suppliers = Supplier::fromQuery($query);

        $supplier_ddl = ['0'=>''];
        foreach($suppliers as $supplier) {
          $supplier_ddl[$supplier->supplier_no] = $supplier->supplier_no." - ".$supplier->supplier_name;
        }

        return view('contract.create',['suppliers'=>$supplier_ddl]);
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
        'supplier_no' => 'required|exists:suppliers|integer|digits_between:1,6',
      ]);

      DB::insert('INSERT INTO contracts (contract_no, date_of_contract, supplier_no) VALUES (?,?,?)',
        [$request->contract_no, $request->date_of_contract, $request->supplier_no]);

      return redirect()->route('contract.additem',['id'=>$request->contract_no])->with('message', 'Contract created.');
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
                        FROM contracts
                        LEFT JOIN suppliers
                        ON contracts.supplier_no = suppliers.supplier_no
                        WHERE contract_no = :contract_no');
      $contract = DB::select($query, ['contract_no'=>$id])[0];

      $query = DB::raw('SELECT *
                        FROM orders, made_of
                        WHERE orders.order_no = made_of.order_no
                        AND orders.contract_no = :contract_no');
      $orders = DB::select($query, ['contract_no'=>$id]);

      $query = DB::raw('SELECT items.*,to_supply.*,IFNULL(total_ordered,0) AS total_ordered
                        FROM items
                        INNER JOIN to_supply
	                      ON items.item_no = to_supply.item_no
                        LEFT JOIN (
                          SELECT SUM(order_qty) AS total_ordered,item_no,contract_no
                          FROM made_of,orders
                          WHERE made_of.order_no = orders.order_no
                          GROUP BY item_no,contract_no
                        ) j
                        ON j.item_no = items.item_no
                        AND j.contract_no = to_supply.contract_no
                        WHERE to_supply.contract_no = :contract_no');
      $item_supply = DB::select($query, ['contract_no'=>$id]);

      return view('contract.show')
        ->with('contract',$contract)
        ->with('orders',$orders)
        ->with('items', $item_supply);
    }

    public function addItem($id) {
      $query = DB::raw('SELECT * FROM contracts, suppliers
                        WHERE contracts.supplier_no = suppliers.supplier_no
                        AND contract_no = :contract_no');
      $contract = DB::select($query, ['contract_no'=>$id])[0];

      $query = DB::raw('SELECT *
                        FROM items, to_supply
                        WHERE items.item_no = to_supply.item_no
                        AND to_supply.contract_no = :contract_no');
      $tosupply_items = DB::select($query, ['contract_no'=>$contract->contract_no]);

      $query = DB::raw('SELECT *
                        FROM items
                        WHERE items.item_no
                        NOT IN (SELECT item_no from to_supply WHERE contract_no = :contract_no)');
      $items = DB::select($query, ['contract_no'=>$contract->contract_no]);

      $items_ddl = ['0'=>''];
      foreach($items as $item) {
        $items_ddl[$item->item_no] = $item->item_no." - ".$item->item_description;
      }

      return view('contract.additem')
        ->with('contract',$contract)
        ->with('items',$tosupply_items)
        ->with('items_ddl',$items_ddl);

    }

    public function createToSupply(Request $request) {

      $validatedData = $request->validate([
        'item_no' => 'required|exists:items|integer|digits_between:1,6',
        'contract_price' => 'required|digits_between:1,8|integer',
        'contract_amount' => 'required|digits_between:1,6|integer'
      ]);

      $contract_no = Route::current()->parameter('id');
      $query = DB::raw("SELECT * FROM contracts where contract_no = :contract_no");
      $contract = Contract::fromQuery($query, ['contract_no'=>$contract_no])->first();

      DB::insert('INSERT INTO to_supply (contract_no, item_no, contract_price, contract_amount) VALUES (?, ?, ?, ?)',
        [$contract->contract_no, $request->item_no, $request->contract_price, $request->contract_amount]);

      return redirect()->back()->with('message', 'Item added to contract.');
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
