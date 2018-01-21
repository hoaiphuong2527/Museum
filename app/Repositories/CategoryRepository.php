<?php

namespace App\Repositories;
use App\Models\MCategory;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Schema;

class CategoryRepository extends BaseRepository
{
    public function __construct(MCategory $mCategory)
    {
        $this->model = $mCategory;
    }

    public function getListCategory($lang)
    {
        app()->setLocale($lang);
        return $this->model->all()->toArray();
    }

    /*Get list category for index*/
    public function getListCategoryWithLang($lang)
    {
        app()->setLocale($lang);
        return $this->model->where('deleted_flag',0)->get(['category_id', 'parent_id', 'sort_order'])->toArray();
    }
    public function getListCategoryWithLangParentID($lang, $parent_id)
    {
        app()->setLocale($lang);
        return $this->model->where([['deleted_flag',0], ['parent_id', $parent_id]])->get(['category_id', 'parent_id', 'sort_order'])->toArray();
    }


}