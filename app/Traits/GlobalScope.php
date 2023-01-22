<?php
namespace App\Traits;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Builder;


//don't remove or edit anything you can add method only
trait GlobalScope
{
    public function scopeActive(Builder $query, $field='status')
    {
        $query->where($field, true);
    }

    public function scopeInActive(Builder $query,  $field='status')
    {
        $query->where($field, false);
    }

    public function scopeDataDesc(Builder $query,  $field='date' )
    {
        return  $query->orderBy($field, 'DESC');
    }

    public function scopeDataAsc(Builder $query, $field='date' )
    {
        return  $query->orderBy($field);
    }

    public function scopeWhereLike(Builder $query, $searchTerm = null,$field ='name',)
    {
        return  $query->orWhere($field, 'LIKE', "%{$searchTerm}%");
    }

    /**
     * Get the created_by that owns the Department
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function createdBy()
    {
        return $this->belongsTo(Admin::class, 'created_by', 'id')->select('id', 'name');
    }
    public function updatedBy()
    {
        return $this->belongsTo(Admin::class, 'updated_by', 'id')->select('id', 'name');
    }
}