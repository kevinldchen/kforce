<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
  protected $table = 'projects';
  protected $primaryKey = 'project_no';
  protected $fillable = ['project_no', 'project_data'];
}
