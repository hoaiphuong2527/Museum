<?php

namespace App\Models;

use Dimsav\Translatable\Translatable;
use App\Models\BaseModel;

class MContent extends BaseModel
{
    protected $table = 'm_content';
    
        protected $primaryKey = 'content_id';
    
        public $timestamps = false;
    
        protected $fillable = [
            'slug',
            'status',
            'deleted_flag',
            'created_user',
            'created_time',
            'updated_user',
            'updated_time'
        ];
    
        protected $guarded = [];

        public $translatedAttributes = ['title','description'];
    
}
