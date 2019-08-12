<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use DB;
use Route;
use App\Project;
use App\Contract;
use App\Item;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($page = 1)
    {
      $page_size = 2000;
      $offset = ($page-1)*$page_size;
      $query = DB::raw('SELECT * FROM orders LIMIT :page_size OFFSET :offset');
      $orders = Order::fromQuery($query,['page_size'=>$page_size,'offset'=>$offset]);

      $query = DB::raw('SELECT count(*) as totals FROM orders');
      $stats = DB::select($query)[0];

      $total_orders = $stats->totals;
      $num_pages = ceil($total_orders/$page_size);

      $nav_size = 5;
      if ($num_pages < $nav_size)
        $nav_size = $num_pages;


      $nav_offset = $page-floor($nav_size/2);
      if ($page < ceil($nav_size/2)) {
        $nav_offset = 1;
      }
      else if ($page + ceil($nav_size/2) > $num_pages) {
        $nav_offset = $num_pages - (min($nav_size,$num_pages)-1);
      }

      return view('order.index')
        ->with('orders',$orders)
        ->with('num_pages',$num_pages)
        ->with('current_page',$page)
        ->with('nav_offset',$nav_offset)
        ->with('nav_size',$nav_size);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

      $query = DB::raw('SELECT * FROM projects');
      $projects = Project::fromQuery($query);

      $projects_ddl = ['0'=>''];
      foreach($projects as $project) {
        $projects_ddl[$project->project_no] = $project->project_no." - ".$project->project_data;
      }

      $query = DB::raw('SELECT * FROM contracts');
      $contracts = Contract::fromQuery($query);

      $contracts_ddl = ['0'=>''];
      foreach($contracts as $contract) {
        $contracts_ddl[$contract->contract_no] = $contract->contract_no;
      }

      return view('order.create',['projects'=>$projects_ddl,'contracts'=>$contracts_ddl]);
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
        'order_no' => 'required|unique:orders|integer|digits_between:1,6',
        'date_required' => 'required|date',
        'contract_no' => 'required|exists:contracts|integer|digits_between:1,8',
        'project_no' => 'required|exists:projects|integer|digits_between:1,8'
      ]);

      DB::insert('INSERT INTO orders (order_no, date_required, contract_no, project_no) VALUES (?,?,?,?)',
        [$request->order_no, $request->date_required, $request->contract_no, $request->project_no]);

      return redirect()->route('order.additem',['id'=>$request->order_no])->with('message', 'Order created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $query = DB::raw('SELECT * FROM orders WHERE order_no = :order_no');
      $order = Order::fromQuery($query, ['order_no'=>$id])->first();

      $query = DB::raw('SELECT *
                        FROM items, made_of, to_supply
                        WHERE items.item_no = made_of.item_no
                        AND to_supply.item_no = made_of.item_no
                        AND made_of.order_no = :order_no
                        AND to_supply.contract_no = :contract_no');
      $items = DB::select($query, ['order_no'=>$order->order_no,'contract_no'=>$order->contract_no]);

      return view('order.show')
        ->with('order',$order)
        ->with('items',$items);
    }


    public function addItem($id) {
      $query = DB::raw('SELECT * FROM orders WHERE order_no = :order_no');
      $order = Order::fromQuery($query, ['order_no'=>$id])->first();

      $query = DB::raw('SELECT *
                        FROM items, made_of
                        WHERE items.item_no = made_of.item_no
                        AND made_of.order_no = :order_no');
      $madeof_items = DB::select($query, ['order_no'=>$id]);

      $query = DB::raw('SELECT *
                        FROM items, to_supply
                        WHERE items.item_no = to_supply.item_no
                        AND to_supply.contract_no = :contract_no
                        AND items.item_no NOT IN (
                          SELECT item_no
                          FROM made_of
                          WHERE order_no = :order_no
                        )');
      $items = DB::select($query, ['contract_no'=>$order->contract_no,'order_no'=>$order->order_no]);

      $items_ddl = ['0'=>''];
      foreach($items as $item) {
        $items_ddl[$item->item_no] = $item->item_no." - ".$item->item_description;
      }

      return view('order.additem')
        ->with('order',$order)
        ->with('items',$madeof_items)
        ->with('items_ddl',$items_ddl);
    }

    public function createMadeOf(Request $request) {
      $validatedData = $request->validate([
        'item_no' => 'required|exists:items|integer|digits_between:1,6',
        'order_qty' => 'required|integer|min:1|digits_between:1,6'
      ]);

      $order_no = Route::current()->parameter('id');
      $query = DB::raw("SELECT * FROM orders where order_no = :order_no");
      $order = Order::fromQuery($query, ['order_no'=>$order_no])->first();

      //test if number of items is sufficient!
      $query = DB::raw("SELECT contract_amount - IFNULL(total_ordered,0) AS remaining
                        FROM to_supply
                        LEFT JOIN (
                          SELECT SUM(order_qty) AS total_ordered,item_no,contract_no
                          FROM made_of,orders
                          WHERE made_of.order_no = orders.order_no
                          GROUP BY item_no,contract_no
                        ) j
                        ON j.item_no = to_supply.item_no AND j.contract_no = to_supply.contract_no
                        WHERE to_supply.contract_no = :contract_no
                        AND to_supply.item_no = :item_no
                        ");
      $quantity = DB::select($query,['contract_no'=>$order->contract_no,
                                      'item_no'=>$request->item_no]);

      if($quantity[0]->remaining - $request->order_qty < 0) {
        return back()->withErrors('Order quantity exceeds amount available ('.$quantity[0]->remaining.')!')->withInput();
      }


      DB::insert('INSERT INTO made_of (order_no, item_no, order_qty) VALUES (?,?,?)',
        [$order->order_no, $request->item_no, $request->order_qty]);

      return redirect()->back()->with('message', 'Item added to order.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
