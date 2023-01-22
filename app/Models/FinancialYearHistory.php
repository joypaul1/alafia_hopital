<?php

namespace App\Models;

use App\Traits\GlobalScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class FinancialYearHistory extends Model
{
    use SoftDeletes, GlobalScope;
    protected $table ='financial_year_histories';
    protected $guarded =['id'];

}
