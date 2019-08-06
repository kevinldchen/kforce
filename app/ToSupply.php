<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ToSupply extends Model
{
  protected $table = 'to_supply';
  protected $fillable = ['item_no', 'contract_no', 'contract_price', 'contract_amount'];


}
