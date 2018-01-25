
<?php
use App\Models\MSetting;
use App\Repositories\SettingRepository;
$setting = new MSetting();
$settingRepository = new SettingRepository($setting);
$status = MSetting::where('s_key','STATUS')->get();
?>
@extends('Backend.masterpage.masterpage')
@section('content')

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
        
            <div class="clearfix"></div>

            <div class="row">

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Tạo mới danh mục </h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            @if (session('notify'))
                                <div class="alert alert-error" style="color:red;">
                                    {{ session('notify') }}
                                </div>
                            @endif
                            <form class="form-horizontal form-label-left" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                    <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                        <li role="presentation" class="active"><a href="#tab_content1" id="home-tab"
                                                                                  role="tab" data-toggle="tab"
                                                                                  aria-expanded="true">Chung</a>
                                        </li>
                                        <li role="presentation" class=""><a href="#tab_content2" role="tab"
                                                                            id="profile-tab" data-toggle="tab"
                                                                            aria-expanded="false">Đa ngôn ngữ</a>
                                        </li>
                                    </ul>
                                    <div id="myTabContent" class="tab-content">
                                        <div role="tabpanel" class="tab-pane fade active in" id="tab_content1"
                                             aria-labelledby="home-tab">
                                            <br/>
                                            

                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Code</label>
                                                <div class="col-md-9 col-sm-9 col-xs-12">
                                                    <input type="text" name="code" class="form-control" placeholder="Code value" value="{{ old('code') }}">
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Trạng thái</label>
                                                <div class="col-md-9 col-sm-9 col-xs-12">
                                                    <select id="comparison" name="status" class="form-control">
                                                        @foreach($status as $row)
                                                        <option value="{{ $row->s_value }}" @if (old('status') == $row->s_value) selected @endif >{{ $row->s_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="testName">Hình ảnh</label>
                                                <div class="col-md-9 col-sm-9 col-xs-12">
                                                    <div class="input-group image-preview">
                                                        <!-- file-input -->
                                                        <div class="btn btn-default file-input">
                                                            <span class="pe-7s-upload"></span>
                                                            <span class="file-input-title">Chọn hình</span>
                                                            <input type="file" accept="image/png, image/jpeg, image/gif" id="testImageIcon" name="image"/> 
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="testName">Âm thanh</label>
                                                <div class="col-md-9 col-sm-9 col-xs-12">
                                                    <div class="input-group image-preview">
                                                        <!-- file-input -->
                                                        <div class="btn btn-default file-input">
                                                            <span class="pe-7s-upload"></span>
                                                            <span class="file-input-title">Chọn âm thanh</span>
                                                            <input type="file"accept="audio/*" id="testImageIcon" name="sound"/> 
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div role="tabpanel" class="tab-pane fade" id="tab_content2"
                                             aria-labelledby="profile-tab">
                                            <div class="col-xs-3">
                                                <!-- required for floating -->
                                                <!-- Nav tabs -->
                                                <ul class="nav nav-tabs tabs-left">
                                                    <li class="active"><a href="#vietnam_tab" data-toggle="tab"style="text-align: right">Tiếng Việt</a></li>
                                                    <li><a href="#english_tab" data-toggle="tab" style="text-align: right">Tiếng Anh</a>
                                                    </li>
                                                    <li><a href="#japanese_tab" data-toggle="tab" style="text-align: right">Tiếng Nhật</a>
                                                    </li>
                                                </ul>
                                            </div>

                                            <div class="col-xs-9">
                                                <!-- Tab panes -->
                                                <div class="tab-content">
                                                    <div class="tab-pane active" id="vietnam_tab">
                                                        <br>
                                                        <div class="form-group">
                                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                                <input type="text" name="name_vn" class="form-control" placeholder="Tên danh mục" value="{{ old('name_vn') }}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                                <input type="text" name="description_vn" class="form-control" placeholder="Mô tả" value="{{ old('description_vn') }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="english_tab">
                                                        <br>
                                                        <div class="form-group">
                                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                                <input type="text" name="name_en" class="form-control" placeholder="Tên danh mục" value="{{ old('name_en') }}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                                <input type="text" name="description_en" class="form-control" placeholder="Mô tả" value="{{ old('description_en') }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="japanese_tab">
                                                        <br>
                                                        <div class="form-group">
                                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                                <input type="text" name="name_jp" class="form-control" placeholder="Tên danh mục" value="{{ old('name_jp') }}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                                <input type="text" name="description_jp" class="form-control" placeholder="Mô tả" value="{{ old('description_jp') }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-7">
                                        <button type="button" class="btn btn-primary pull-right" onclick="location.href='{{ URL::asset('/admin/story_item')}}';">Cancel</button>
                                        <button type="submit" class="btn btn-success pull-right" style=" margin-right: 10px;">Lưu</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->



@endsection