<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserssModel extends Model
{
    //
    protected $table = 'userss';
    protected $primaryKey='u_id';
    public $timestamps = false;
}
