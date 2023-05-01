<?php

namespace App\Models\Patient;

use App\Models\Appiontment\Appointment as AppiontmentAppointment;
use App\Models\Appointment\Appointment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\AuthScopes;
use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Patient extends Model
{
    use AuthScopes,AutoTimeStamp,GlobalScope;

    protected $guarded =['id'];

    /**
     * Get all of the appoint for the Patient
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function appoints(): HasMany
    {
        return $this->hasMany(Appointment::class, 'patient_id', 'id');
    }

    // get single latest data

}
