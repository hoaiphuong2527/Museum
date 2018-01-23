<?php

namespace App\Repositories;
use App\Models\MItemStoryTranslation;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Schema;

class ItemTranslateRepository extends BaseRepository
{
    public function __construct(MItemStoryTranslation $item) 
    {
        $this->model = $item;
    }

    public function getDataItem($lang)
    {
        app()->setLocale($lang);
        return $this->model->where('locale',$lang)->first();
    }

    
}