<?php

namespace App\Models;

use App\Models\BaseModel;

class MCode extends BaseModel
{
    protected $table = 'm_code';
    
        protected $primaryKey = 'code_id';
    
        public $timestamps = false;
    
        protected $fillable = [
            'code_value',
            'expried',
            'used_flag',
            'deleted_flag',
            'created_user',
            'created_time',
            'updated_user',
            'updated_time'
        ];
    
        protected $guarded = [];
    
}
