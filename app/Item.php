<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
  protected $table = 'items';
  protected $primaryKey = 'item_no';
  protected $fillable = ['item_no', 'item_description'];

  public function contracts() {
    return $this->belongsToMany('App\Contract','to_supply','item_no','contract_no')
      ->as('tosupply')
      ->withPivot('contract_price','contract_amount');
  }

  public function orders() {
    return $this->belongsToMany('App\Order','made_of','item_no','order_no')
      ->as('madeof')
      ->withPivot('order_qty');
  }

}
