<?php

namespace App\Traits;

use App\Models\Agent;

trait AuthScopes{

    public function scopeWhereAuthSeller($q)
    {
        $q->where('seller_id', auth('seller')->id());
    }

    public function scopeWhereAuthUser($q)
    {
        $q->where('user_id', auth('web')->id());
    }

    public function scopeWhereAuthAgent($q)
    {
        // $q->where('agent_id', Agent::where('delivery_id', auth('delivery')->id())->first()->id ?? -1);
    }
}
