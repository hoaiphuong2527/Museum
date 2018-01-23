<?php
    use App\Models\MSetting;
    use App\Utils\SessionManager;
    $currentLogin = SessionManager::getLoginInfo();
    $user_role = MSetting::where('s_key','USER_ROLE')->get();
?>
@extends('Backend.masterpage.masterpage')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="header">
                        @if($user->user_id == $currentLogin->user_id)
                        <h4 class="title">Thông tin của bạn</h4>
                        @else
                        <h4 class="title">Thông tin của {{$user->name}}</h4>
                        @endif
                    </div>
                    <div class="content">
                        <form method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Địa chỉ email</label>
                                        <input name="email" type="text" class="form-control" value="{{  $user->email }}" disabled placeholder="Email">
                                    </div>
                                </div>
                            </div>

                            <div class="row">      
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tên</label>
                                        <input name="name" type="text" class="form-control" placeholder="Tên" value="{{ old('name',$user->name) }}">
                                    </div>
                                </div>    
                                <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Số điện thoại</label>
                                            <input name ="phone_num" type="text" class="form-control" value="{{ old('phone_num',$user->phone_num) }}"  placeholder="Số điện thoại">
                                        </div>
                                    </div>                            
                            </div>
    
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Mật khẩu</label>
                                        <input type="password" name="password" class="form-control" placeholder="Mật khẩu">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Xác thực mật khẩu</label>
                                        <input type="password" name="password_confirmation" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                @if($currentLogin->user_role == 0)
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Vị trí</label>
                                        <select id="comparison" name="user_role" class="form-control">
                                            @foreach($user_role as $role)
                                            <option value="{{$role->s_value}}" {{ $role->s_value==$user->user_role ? 'selected' : '' }} >{{ $role->s_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @else 
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Vị trí</label>
                                        <select id="comparison" name="user_role" class="form-control" disabled>
                                            @foreach($user_role as $role)
                                            <option value="{{$role->s_value}}" {{ $role->s_value==$user->user_role ? 'selected' : '' }} >{{ $role->s_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @endif
                                <?php
                                    use App\Models\MUser;
                                    $created_user = MUser::find((int) $user->created_user);
                                ?>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Người tạo</label>
                                        <input type="text" class="form-control" disabled value="{{ $created_user->name }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Ngày tạo</label>
                                        <input type="text" class="form-control" disabled value="{{ $user->created_time}}" >
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Ảnh đại diện</label>                                        
                                        <label class="form-control btn-file col-md-12">
                                                <input type="file" accept="image/png, image/jpeg, image/gif ,image/jpg" id="testImageIcon" name="image"/> 
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-info btn-fill pull-right">Lưu</button>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-user">
                        <div class="image">
                                <img  src="{{ URL::asset('backend/images/photo-1431578500526-4d9613015464.jpg ') }}" alt="..."/>
                            </div>
                    <div class="content">
                        <div class="author">
                             <a href="#">
                                @if( $user->avata == "default_avt.png" ||  $user->avata == "")
                                <img class="avatar border-gray" src="{{ URL::asset('upload/image/avatar/default_avt.png') }}" alt="...">
                                @else
                                <img class="avatar border-gray" src="{{ URL::asset('upload/image/avatar/'.$user->avata) }}" alt="...">
                                @endif

                              <h4 class="title">{{ $user->name}}<br />
                                 <small>{{ $user->email}}</small>
                              </h4>
                            </a>
                        </div>
                        <p class="description text-center"> 
                            @if($user->user_role == 0 )
                            <p class="description text-center"> Super admin</p>
                            @else
                            <p class="description text-center"> Admin </p>
                            @endif
                        </p>
                    </div>
                    <hr>
                    
                </div>
            </div>

        </div>
    </div>
@endsection