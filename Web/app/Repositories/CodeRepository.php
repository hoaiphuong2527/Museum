<?php

namespace App\Repositories;
use App\Models\MCode;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Schema;

class CodeRepository extends BaseRepository
{
    public function __construct(MCode $code) 
    {
        $this->model = $code;
    }

    public function getAllCode()
    {
        return $this->model->all();
    }

    public function findCode($code)
    {
        return MCode::where('code_value', $code)->first(); 
    }

    public function destroyCode($id)
    {
        $code = $this->model->find((int) $id);
        $code->delete();
    }
    
}