<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
  protected $table = 'orders';
  protected $primaryKey = 'order_no';
  protected $fillable = ['order_no', 'contract_no', 'project_no', 'date_required', 'date_completed'];

  public function items() {
    return $this->belongsToMany('App\Item','made_of','order_no','item_no')
      ->as('madeof')
      ->withPivot('order_qty');
  }

  //belongsTo - project

}
