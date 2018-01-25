<?php

namespace App\Models;

use App\Models\BaseModel;

/**
 * Class MUser
 */
class MUser extends BaseModel
{
    protected $table = 'm_user';

    protected $primaryKey = 'user_id';

	public $timestamps = false;

    protected $fillable = [
        'email',
        'phone_num',
        'name',
        'password',
        'user_role',
        'avata',
        'remember_token',
        'deleted_flag',
        'created_user',
        'created_time',
        'updated_user',
        'updated_time'
    ];

    protected $guarded = [];
    
}
