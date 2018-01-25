<?php

namespace App\Models;

use App\Models\BaseModel;

class MItemStoryTranslation extends BaseModel
{
    protected $table = 'm_item_story_translation';

    protected $primaryKey = 'item_story_tran_id';

    public $timestamps = false;

    protected $fillable = [
        'item_story_id',
        'title',
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
