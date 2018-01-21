<?php
use App\Models\MSetting;
use App\Utils\SessionManager;
use App\Repositories\SettingRepository;
$setting = new MSetting();
$settingRepository = new SettingRepository($setting);
$user_role = MSetting::where('s_key','USER_ROLE')->get();                              
$currentLogin = SessionManager::getLoginInfo();
?>
@extends('Backend.masterpage.masterpage')
@section('content')
<div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Tạo mới quản trị</h4>
                    </div>
                    <div class="content">
                        @if (session('notify'))
                            <div class="alert alert-error">
                                {{ session('notify') }}
                            </div>
                        @endif
                        <form method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Địa chỉ email</label>
                                        <input name="email" type="text" class="form-control" value="{{ old('email') }}" placeholder="Email">
                                    </div>
                                    @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="row">      
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tên</label>
                                        <input name="name" type="text" class="form-control" placeholder="Tên" value="{{ old('name') }}">
                                    </div>
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>    
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Số điện thoại</label>
                                        <input name ="phone_num" type="text" class="form-control" value="{{ old('phone_num') }}"  placeholder="Số điện thoại">
                                    </div>
                                    @if ($errors->has('phone_num'))
                                        <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('phone_num') }}</strong>
                                        </span>
                                    @endif
                                </div>                            
                            </div>
    
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Mật khẩu</label>
                                        <input type="password" name="password" class="form-control" placeholder="Mật khẩu">
                                    </div>
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
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
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Vị trí</label>
                                        <select id="comparison" name="user_role" class="form-control">
                                            @foreach($user_role as $type)
                                            <option value="{{ $type->s_value }}" @if (old('user_role') == $type->s_value) selected @endif >{{ $type->s_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @endif
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
        </div>
    </div>
@endsection