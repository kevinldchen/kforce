<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $table = 'contracts';
    protected $primaryKey = 'contract_no';
    protected $fillable = ['contract_no', 'supplier_no', 'date_of_contract'];

    public function supplier() {
      return $this->belongsTo('App\Supplier','supplier_no');
    }

    public function items() {
      return $this->belongsToMany('App\Item','to_supply','contract_no','item_no')
        ->as('tosupply')
        ->withPivot('contract_price','contract_amount');
    }

    public function orders() {
      return $this->hasMany('App\Order','contract_no');
    }

}
