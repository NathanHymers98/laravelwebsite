<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
       protected $fillable = ['orderdate','username','firstname','lastname','address','city','county','postalcode','telephone','email','total'];
}
