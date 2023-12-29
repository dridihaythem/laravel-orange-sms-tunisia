<?php

namespace DridiHaythem\OrangeSMSTunisia\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Log extends Model
{
    use HasFactory;


    public function getTable()
    {
        return config('orange_sms_tunisia.log_table');
    }

    protected $guarded = [];
}
