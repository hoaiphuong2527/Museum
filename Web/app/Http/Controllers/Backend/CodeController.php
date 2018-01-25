<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\CodeRepository;

class CodeController extends Controller
{

    public function index(Request $request,CodeRepository $codeRepository )
    {
        $codes = $codeRepository->getAllCode();
        return view('Backend.code.index',['codes' => $codes]); 
        
    }
    /*
        *Tạo code tự động.
    */
    public function create(Request $request,CodeRepository $codeRepository )
    {        
        for ($i = 0; $i < 10 ; $i++) { 
            $string = rand (100000,999999); // tạo ngẫu nhiên một số có 6 chữ số
            $code = $codeRepository->create(
                [
                    "code_value"       =>$string,

                ]);
        }
            $codes = $codeRepository->getAllCode();
            return view('Backend.code.index',[
                'codes' => $codes,
                ]); 
    }

    
    /*Thực hiện xóa trực tiếp nhiều mã code*/
    public function deleteall(Request $rq, CodeRepository $codeRepository) {
        $list_id = $rq->get('list_id');
        foreach ($list_id as $id) {
            $codeRepository->destroyCode($id);
        }
        return redirect()->back();
    }
}
