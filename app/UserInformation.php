<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserInformation extends Model
{
  protected $fillable = ['id', 'user_id', 'first_name', 'last_name'];
  public $table = 'user_information';
}
