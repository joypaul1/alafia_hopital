<?php

namespace App\Models\Order;

use App\Models\Order;
use App\Models\TableName;
use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderTable extends Model
{
    use AutoTimeStamp;

    protected $guarded = ['id'];

    /**
     * Get the table that owns the OrderTable
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function table(): BelongsTo
    {
        return $this->belongsTo(TableName::class, 'table_id', 'id');
    }

    /**
     * Get the order that owns the OrderTable
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }
}
