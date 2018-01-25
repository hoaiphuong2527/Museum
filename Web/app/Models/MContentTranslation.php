<?php

namespace App\Models;

use App\Models\BaseModel;

class MContentTranslation extends BaseModel
{
    protected $table = 'm_content_translation';
    
        protected $primaryKey = 'trans_id';
    
        public $timestamps = false;
    
        protected $fillable = [
            'content_id',
            'value',
            'locale',
            'deleted_flag',
            'created_user',
            'created_time',
            'updated_user',
            'updated_time'
        ];
    
        protected $guarded = [];
    
}