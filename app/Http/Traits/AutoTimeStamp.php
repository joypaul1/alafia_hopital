<?php
namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;

trait AutoTimeStamp
{

    private static $baseClass = (self::class);

    public static function bootAutoTimeStamp()
    {
        static::creating(function ($model) {
            $model->fill([
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
            if (Schema::hasColumn(self::getBaseTable(), 'created_by')) {
                $model->fill([
                    'created_by' => auth('admin')->id(),
                    'updated_by' => auth('admin')->id(),
                ]);
            }

        });

        static::updating(function ($model) {
            $model->fill([
                'updated_at' => Carbon::now(),
            ]);
            if (Schema::hasColumn(self::getBaseTable(), 'updated_by')) {
                $model->fill([
                    'updated_by' => auth('admin')->id(),
                ]);
            }
        });
        static::deleting(function ($model) {
            if (Schema::hasColumn(self::getBaseTable(), 'deleted_at')) {
                $model->fill([
                    'deleted_at' => Carbon::now(),
                ]);
            }
            if (Schema::hasColumn(self::getBaseTable(), 'updated_by')) {
                $model->fill([
                    'deleted_by' => auth('admin')->id(),
                ]);
            }
        });

    }

    public static function getBaseTable()
    {
        $baseClass  = self::$baseClass;
        $obj        = new $baseClass;
        $table      = $obj->getTable();
        return $table;
    }

    // public static function fillableProperty()
    // {
    //     $fillable = Schema::getColumnListing(self::getBaseTable());
    //     return  json_encode($fillable);

    // }

}
