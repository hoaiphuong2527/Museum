<?php

namespace App\Models;

use Dimsav\Translatable\Translatable;
use App\Models\BaseModel;

class MCategory extends BaseModel
{
    protected $table = 'm_category';

    protected $primaryKey = 'category_id';

    public $timestamps = false;

    use Translatable;

    protected $fillable = [
        'sort_order',

        'id_item_story',
        'image',
        'image_description',
        'video',
        'parent_id',
        'deleted_flag',
        'created_user',
        'created_time',
        'updated_user',
        'updated_time'
    ];

    protected $guarded = [];

    public $translatedAttributes = ['name', 'description'];

    public function children()
    {
        return $this->hasMany('App\Models\MCategory', 'parent_id', 'category_id');
    }

    public function parent()
    {
        return $this->belongsTo('App\Models\MCategory', 'parent_id');
    }
}
