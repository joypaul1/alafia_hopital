<?php

namespace App\Models\Service;


use Illuminate\Database\Eloquent\Model;
use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;
class ServiceInvoiceItems extends Model
{
    use GlobalScope, AutoTimeStamp;
    protected $guarded = ['id'];

}
