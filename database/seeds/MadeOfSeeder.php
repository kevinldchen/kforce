<?php

use Illuminate\Database\Seeder;
use App\Order;

class MadeOfSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      //Pseudocode:
      //Get order_no, contract_no of each order
        //SELECT item_no from to_supply
        //For each item, create a made_of object

        $query = DB::raw('SELECT order_no, contract_no FROM orders');
        $orders = DB::select($query);
        $this->command->info(count($orders) . ' orders found...');
        foreach ($orders as $order) {
          $q = DB::raw('SELECT item_no FROM to_supply WHERE contract_no = :contract_no');
          $items = DB::select($q,['contract_no'=>$order->contract_no]);

          if (count($items) > 0) {
            $count = mt_rand(5,10);

            if ($count > count($items))
              $count = count($items);

            $items = Arr::random($items,$count);

            $insert_arr = [];
            foreach ($items as $item) {
              $insert_arr[] = ['item_no'=>$item->item_no,'order_no'=>$order->order_no,'order_qty'=>mt_rand(1,5)];
            }

            //var_dump($insert_arr);

            DB::table('made_of')->insert($insert_arr);
          }
        }
    }
}
