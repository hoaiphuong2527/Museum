<?php

namespace App\Events;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use App\Utils\SessionManager;

class ModelObserver
{
    /**
     * Listen to the Model creating event.
     *
     * @param  Model  $model
     * @return void
     */
    public function creating(Model $model)
    {
        $loginId = SessionManager::getLoginId();
        if(Schema::hasColumn($model->getTable(), "deleted_flag")) {
            $model->deleted_flag = 0;
        }
        if(Schema::hasColumn($model->getTable(), "created_user")) {
            $model->created_user = $loginId;
        }
        if(Schema::hasColumn($model->getTable(), "created_time")) {
            $model->created_time = date('Y-m-d h:i:s');
        }
        if(Schema::hasColumn($model->getTable(), "updated_user")) {
            $model->updated_user = $loginId;
        }
        if(Schema::hasColumn($model->getTable(), "updated_time")) {
            $model->updated_time = date('Y-m-d h:i:s');
        }
    }

    /**
     * Listen to the Model updating event.
     *
     * @param  Model  $model
     * @return void
     */
    public function updating(Model $model)
    {
        $loginId = SessionManager::getLoginId();
        if(Schema::hasColumn($model->getTable(), "updated_user")) {
            $model->updated_user = $loginId;
        }
        if(Schema::hasColumn($model->getTable(), "updated_time")) {
            $model->updated_time = date('Y-m-d h:i:s');
        }
    }
    
}