<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'suppliers';
    protected $primaryKey = 'supplier_no';
    protected $fillable = ['supplier_no', 'supplier_address', 'supplier_name'];

    public function contracts() {
      return $this->hasMany('App\Contract','supplier_no');
    }

}
