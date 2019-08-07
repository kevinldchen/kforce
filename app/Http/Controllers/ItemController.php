<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;
use DB;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $query = DB::raw('SELECT * FROM items');
      $items = Item::fromQuery($query);
      return view('item.index',['items'=>$items]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('item.create');
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
        'item_no' => 'required|unique:items|integer|digits_between:1,8|min:1',
        'item_description' => 'required|max:20',
      ]);

      DB::insert('INSERT INTO items (item_no, item_description) VALUES (?, ?)',
        [$request->item_no, $request->item_description]);

      return redirect()->back()->with('message', 'Item created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $query = DB::raw('SELECT * FROM items WHERE item_no = :item_no');
      $item = Item::fromQuery($query, ['item_no'=>$id])->first();

      $query = DB::raw('SELECT *
                        FROM contracts, to_supply
                        WHERE contracts.contract_no = to_supply.contract_no
                        AND to_supply.item_no = :item_no');
      $contract_supply = DB::select($query, ['item_no'=>$id]);

      $query = DB::raw('SELECT *
                        FROM orders, made_of
                        WHERE orders.order_no = made_of.order_no
                        AND made_of.item_no = :item_no');
      $order_madeof = DB::select($query, ['item_no'=>$id]);

      //$item = Item::with('contracts')->with('orders')->find($id);
      return view('item.show')
        ->with('item',$item)
        ->with('contracts',$contract_supply)
        ->with('orders',$order_madeof);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        //
    }
}
