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
}