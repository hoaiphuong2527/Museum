<?php

namespace App\Models;

use App\Models\BaseModel;

class MCategoryTranslation extends BaseModel
{
    protected $table = 'm_cate_translation';

    protected $primaryKey = 'story_tran_id';

    public $timestamps = false;

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'locale',
        'deleted_flag',
        'created_user',
        'created_time',
        'updated_user',
        'updated_time'
    ];

    protected $guarded = [];

}
