<?php
    use App\Models\MSetting;
    use App\Utils\SessionManager;
    $user_role = MSetting::where('s_key','USER_ROLE')->get();
    $currentLogin = SessionManager::getLoginInfo();

    function findRole($param)
    {
       return MSetting::where('s_value',$param)->where('s_key','USER_ROLE')->first();
    }
?>
@extends('Backend.masterpage.masterpage')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Thông tin quản trị</h4>
                    </div>
                    <div class="content">
                        <form method="post">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Địa chỉ email</label>
                                        <br><b style="color:#104dda; text">{{ $value->email }}</b>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tên</label>
                                        <br><b style="color:#104dda; text">{{ $value->name }}</b>
                                    </div>
                                </div>   
                            </div>

                            <div class="row">                 
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Số điện thoại</label>
                                        <br><b style="color:#104dda; text">{{ $value->phone_num }}</b>
                                    </div>
                                </div>  
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Vị trí</label>         
                                        <br><b style="color:#104dda; text">{{findRole($value->user_role)->s_name}}</b>
                                    </div>
                                </div>                           
                            </div>
                            <?php
                                use App\Models\MUser;
                                $created_user = MUser::find((int) $value->created_user);
                            ?>
                                
                            <div class="row">                 
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Người tạo</label>
                                        <br><b style="color:#104dda; text">{{ $created_user->name }}</b>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Ngày tạo</label>
                                        <br><b style="color:#104dda; text">{{$value->created_time }}</b>                                        
                                    </div>
                                </div>                         
                            </div>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Danh sách quản trị viên</h4>
                        @if ($errors->has('users'))
                            <span class="help-block">
                                <p style="color: red;">{{ $errors->first('users') }}</p>
                            </span>
                        @endif
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table class="table table-hover table-striped">
                            <thead>
                                <th>Tên</th>
                                <th>Hình ảnh</th>
                                <th>Hành động</th>
                            </thead>
                            <tbody>                                        
                                @foreach ($users as $row)                                  
                                    <tr user-id="{{ $row->user_id }}">
                                        <td><a style ="color:#000;" href="{{ URL::asset('/admin/users/'. $row['user_id'])}}">{{$row['name']}}</a></td>
                                        <td><img class="avatar border-gray" src="{{ URL::asset('upload/image/avatar/'.$row['avata']) }}"></td>
                                        <td>
                                            {{-- Nút Chỉnh sửa--}}
                                            <button style="background: none; border: none" title="Chỉnh sửa"
                                                    onclick="location.href='{{ URL::asset('/admin/users/detail/'. $row['user_id'])}}';">
                                                <span class="pe-7s-pen" style="font-size: 20px;font-weight: bold;"></span>
                                            </button>
                                            {{--Nút Xóa--}}
                                            <div class="btn-delete-user pe-7s-trash" style="font-size: 20px;color: red;font-weight: bold;"></div
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if($value->user_role == 0)
                        <hr>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success btn-fill" onclick="location.href='{{ URL::asset('/admin/users/create')}}';">Tạo mới</button>
                        </div>
                        @endif
                    </div>
                </div>
                
            </div>         
        </div>
    </div>
@endsection