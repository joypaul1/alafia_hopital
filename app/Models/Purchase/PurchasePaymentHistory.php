<?php
namespace App\Models\Purchase;

use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchasePaymentHistory extends Model
{
    use AutoTimeStamp,GlobalScope;
    protected $guarded =['id'];
}
