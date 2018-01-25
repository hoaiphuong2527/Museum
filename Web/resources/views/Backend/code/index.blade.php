
<?php
    use App\Models\MSetting;
    use App\Utils\SessionManager;
    $currentLogin = SessionManager::getLoginInfo();

    function findStatus($param)
    {
       return MSetting::where('s_value',$param)->where('s_key','USED_FLAG')->first();
    }
?>
@extends('Backend.masterpage.masterpage')
@section('content')
    <div class="container-fluid">
        <div class="text-right">
            <button type="submit" class="btn btn-success btn-fill" onclick="location.href='{{ URL::asset('/admin/code/create')}}';">Tạo mới</button>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Quản lý mã đăng nhập</h4>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table class="table table-hover table-striped">
                            <thead>
                                <th class="text-center">
                                    <div class="ckbox">
                                        <input id="cb_All" name="btSelectAll" type="checkbox">  
                                        <label for="cb_All"></label>  
                                    </div>
                                </th> 
                                <th>#</th>
                                <th>Giá trị</th>
                                <th>Trạng thái</th>
                                <th>Thời gian kích hoạt</th>
                                <th>Thời gian kết thúc</th>
                                
                            </thead>
                            <tbody>
                            @foreach($codes as $code)
                                <tr code-id="{{$code->code_id}}" id="code_{{$code->code_id}}">
                                    <td class="text-center">
                                        <div class="ckbox">
                                            <input id="{{$code->code_id}}" class="check-box" name="ckb" type="checkbox">  
                                            <label for="{{$code->code_id}}"></label>  
                                        </div>
                                    </td> 
                                    <td>{{$code->code_id}}</td>
                                    <td>{{$code->code_value}}</td>
                                    @if($code->deleted_flag == 1)
                                        <td style="color:red;">{{findStatus($code->deleted_flag)->s_name}}</td>
                                    @else
                                        <td>{{findStatus($code->deleted_flag)->s_name}}</td>
                                    @endif
                                    <td>{{$code->activated}}</td>
                                    <td>{{$code->expried}}</td>                                        	
                                </tr>
                            @endforeach  
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>   
        </div>
        <div class="text-left">
            <button type="submit" name="btn_delete_all" id="delete_all_code" url="{{ asset('quizs/deleteall') }}" class="btn btn-danger btn-fill" content="{{ csrf_token() }}">Xóa</button>
            <input type="hidden" id="_token" value="{{ csrf_token() }}" />  
        </div>
        
    </div>
@endsection