<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ReportController extends Controller
{
    public function orderqty_aggregate() {
      $query = DB::raw('SELECT contracts.contract_no,item_no,SUM(order_qty) AS sales
                        FROM contracts, orders, made_of
                        WHERE contracts.contract_no = orders.contract_no
                        AND orders.order_no = made_of.order_no
                        GROUP BY contract_no, item_no
                        ORDER BY contract_no, item_no');
      $data = DB::select($query);

      return view('report.qtyagg')
        ->with('data',$data);
    }
}
