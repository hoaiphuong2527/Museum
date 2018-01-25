<?php

namespace App\Repositories;
use App\Models\MSetting;
use App\Repositories\BaseRepository;

class SettingRepository extends BaseRepository
{
    /**
     * Create a new SettingRepository instance.
     *
     * @param  App\Models\MSetting $mSetting
     * @return void
     */
    public function __construct(MSetting $mSetting) 
    {
        $this->model = $mSetting;
    }

    public function getName($var,$params)
    {
        $Name = MSetting::where('s_key',$params)->where('s_value',$var)->value('s_name');
        return $Name;
    }

    public function getAllSetting($search_query) 
    {
        $settings = $search_query->where("deleted_flag",0)->paginate(20);
        return $settings;
    }
    

}