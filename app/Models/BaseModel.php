<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Events\Crud\Created as CrudCreated;
use App\Events\Crud\Updated as CrudUpdated;
use App\Events\Crud\Deleted as CrudDeleted;

class BaseModel extends Model
{
    public function getClassName()
    {
        return get_called_class();
    }

    public static function boot()
    {
        parent::boot();

        self::created(function($item) {
            \Event::fire(new CrudCreated($item));
        });

        self::updated(function($item) {
            \Event::fire(new CrudUpdated($item));
        });

        self::deleted(function($item) {
            \Event::fire(new CrudDeleted($item));
        });
    }

}
