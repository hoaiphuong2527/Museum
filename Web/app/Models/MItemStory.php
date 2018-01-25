<?php

namespace App\Models;

use Dimsav\Translatable\Translatable;
use App\Models\BaseModel;

class MItemStory extends BaseModel
{
    protected $table = 'm_item_story';

    protected $primaryKey = 'item_story_id';

    public $timestamps = false;

    use Translatable;

    protected $fillable = [
        'category_id',
        'code',
        'url_image',
        'sound', 
        'status',
        'deleted_flag',
        'created_user',
        'created_time',
        'updated_user',
        'updated_time'
    ];

    protected $guarded = [];

    public $translatedAttributes = ['title', 'description'];

}
