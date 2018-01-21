<?php

namespace App\Repositories;
use App\Models\MCategoryTranslation;
use App\Repositories\BaseRepository;

class CategoryTranslationRepository extends BaseRepository
{
    public function __construct(MCategoryTranslation $mCategoryTranslation)
    {
        $this->model = $mCategoryTranslation;
    }

}