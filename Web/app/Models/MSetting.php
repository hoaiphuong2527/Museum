<?php

namespace App\Models;

use App\Models\BaseModel;

/**
 * Class MSetting
 */
class MSetting extends BaseModel
{
    protected $table = 'm_settings';

    protected $primaryKey = 'setting_id';

	public $timestamps = false;

    protected $fillable = [
        's_key',
        's_value',
        's_name',
        'deleted_flag',
        'created_user',
        'created_time',
        'updated_user',
        'udpated_time'
    ];

    protected $guarded = [];
      
}