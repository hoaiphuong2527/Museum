<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\CodeRepository;

class CodeController extends Controller
{
    /*
        *Tạo code tự động.
    */
    public function create(Request $request,CodeRepository $codeRepository )
    {
        //Thời gian hết hạn
        $timeout = time() + (60 * 180);
        for ($i = 0; $i < 10 ; $i++) { 
            $string = rand (100000,999999); // tạo ngẫu nhiên một số có 6 chữ số
            $code = $codeRepository->create(
                [
                "code_value"          =>$string,
                "expried"          =>date('d/m/y H:i:s', $timeout), 
                "deleted_flag" => 0,
                "created_user" => 1,
                "created_time" => date("Y-m-d H:i:s"),
                "updated_user" => 1,
                "updated_time" => date("Y-m-d H:i:s"),
                ]);
        }
            $codes = $codeRepository->getAllCode();
            return view('Backend.index',[
                'codes' => $codes,
                ]); 
    }

    /*Thực hiện xóa trực tiếp mã code đã sử dụng khỏi database */
    public function destroy($code_id, CodeRepository $codeRepository)
    {
        $codeRepository->destroyCode($code_id);
        return redirect()->back();
    }

    /*Thực hiện xóa trực tiếp nhiều mã code*/
    public function deleteall(Request $rq, CodeRepository $codeRepository) {
        $list_id = $rq->get('list_id');
        foreach ($list_id as $id) {
            $codeRepository->destroyCode($id);
        }
        return redirect('admin');
    }
}
