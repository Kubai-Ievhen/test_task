<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DailyTransaction extends Model
{
    protected $fillable = ['amount', 'date'];

}
