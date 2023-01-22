<?php

namespace App\Models\Account;

use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;
use Illuminate\Database\Eloquent\Model;

class AccountOpeningBalance extends Model
{
    use GlobalScope, AutoTimeStamp;
    
    protected $guarded =['id'];
}
