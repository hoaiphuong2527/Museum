<?php

namespace App\Repositories;
use App\Models\MItemStory;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Schema;

class ItemStoryRepository extends BaseRepository
{
    public function __construct(MItemStory $itemStory) 
    {
        $this->model = $itemStory;
    }

    public function getAllItem($lang)
    {
        app()->setLocale($lang);
        return $this->model->where('deleted_flag',0)->get();
    }

    public function getFirstItemInDB($lang)
    {
        app()->setLocale($lang);
        return $this->model->where('deleted_flag',0)->first();
    }

    public static function findItem($id,$lang)
    {
        app()->setLocale($lang);
        return MItemStory::where('item_story_id', $id)->first();
    }

}