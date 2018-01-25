<?php
use App\Models\MSetting;
use App\Models\MItemStoryTranslation;
use App\Repositories\ItemTranslateRepository;
use App\Repositories\SettingRepository;
$setting = new MSetting();
$settingRepository = new SettingRepository($setting);
$status = MSetting::where('s_key','STATUS')->get();
    function getContentByLang($item_story,$lang)
    {   
        return MItemStoryTranslation::where([['item_story_id', $item_story],['locale',$lang]])->first();
    }
   
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
                            <h3>Chỉnh sửa danh mục</h3>
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
                                                    <input type="text" name="code" class="form-control" placeholder="Code value" value="{{ old('code',$item_story->code ) }}">
                                                </div>
                                            </div>
                                            

                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Trạng thái</label>
                                                <div class="col-md-9 col-sm-9 col-xs-12">
                                                    <select id="comparison" name="status" class="form-control">
                                                        @foreach($status as $row)
                                                            <option value="{{$row->s_value}}" {{ $row->s_value==$item_story->status ? 'selected' : '' }} >{{ $row->s_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" id="change_img">Hình ảnh hiện tại:</label>
                                                <!-- Hiển thị hình ảnh cũ/khi thay đổi hình ảnh -->
                                                <div class="col-md-9 col-sm-9 col-xs-12">
                                                    <img id="output" src="{{ URL::asset('upload/image/item_Story/'. $item_story->url_image) }}" alt="image" width="100%" class="img-responsive">
                                                </div>
                                                <script>
                                                    var loadFile = function(event) {
                                                        var output = document.getElementById('output');
                                                        output.src = URL.createObjectURL(event.target.files[0]);
                                                        document.getElementById('change_img').innerHTML = "Hình ảnh sẽ thay thế:";
                                                        
                                                    };
                                                </script>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="testName">Hình ảnh</label>
                                                <div class="col-md-9 col-sm-9 col-xs-12">
                                                    <div class="input-group image-preview">
                                                        <!-- file-input -->
                                                        <div class="btn btn-default file-input">
                                                            <span class="pe-7s-upload"></span>
                                                            <span class="file-input-title">Chọn hình</span>
                                                            <input type="file" onchange="loadFile(event)" name="image" multiple="">
                                                           
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            @if($item_story->sound != null)
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" id="change_img">Âm thanh hiện tại:</label>
                                                <!-- Hiển thị hình ảnh cũ/khi thay đổi hình ảnh -->
                                                <div class="col-md-9 col-sm-9 col-xs-12">
                                                    <audio controls id="audiosource" style="width: 100%">
                                                        <source src="{{ URL::asset('upload/audio/item_Story/'. $item_story->sound) }}" type="audio/mp3">
                                                    </audio>
                                                </div>
                                                <script>
                                                    function fileSelected(filelist){
                                                        document.getElementById("audiosource").src = URL.createObjectURL(filelist.files[0]);                
                                                    }
                                                </script>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="testName">Âm thanh</label>
                                                <div class="col-md-9 col-sm-9 col-xs-12">
                                                    <div class="input-group image-preview">
                                                        <!-- file-input -->
                                                        <div class="btn btn-default file-input">
                                                            <span class="pe-7s-upload"></span>
                                                            <span class="file-input-title">Chọn âm thanh</span>
                                                            <input type="file" name="sound" accept="audio/*" onchange="fileSelected(this)"  multiple="">
                                                            @if ($errors->has('sound'))
                                                                <span class="help-block">
                                                                        <strong style="color: red;">{{ $errors->first('sound') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @else                                            
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="testName">Âm thanh</label>
                                                <div class="col-md-9 col-sm-9 col-xs-12">
                                                    <script>
                                                        function fileSelected(filelist){
                                                            document.getElementById("audiosource").src = URL.createObjectURL(filelist.files[0]);
                                                            document.getElementById('audiosource').style.display = "block";
                                                        }
                                                    </script>
                                                    <div class="input-group image-preview">
                                                        <!-- file-input -->
                                                        <div class="btn btn-default file-input">              
                                                            <span class="file-input-title">Chọn âm thanh</span>
                                                            <input type="file" name="sound" accept="audio/*" onchange="fileSelected(this)"  multiple=""> 
                                                        </div>
                                                        <!-- load audio when choose -->
                                                        <audio controls id="audiosource" style="display:none; width: 100%">
                                                            <source type="audio/mp3"  />
                                                        </audio> 
                                                        @if ($errors->has('sound'))
                                                                <span class="help-block">
                                                                        <strong style="color: red;">{{ $errors->first('sound') }}</strong>
                                                                </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>                                    
                                            @endif

                                        </div>
                                        <div role="tabpanel" class="tab-pane fade" id="tab_content2"
                                             aria-labelledby="profile-tab">
                                            <div class="col-xs-3">
                                                <!-- required for floating -->
                                                <!-- Nav tabs -->
                                                <ul class="nav nav-tabs tabs-left">
                                                    <li class="active"><a href="#vietnam_tab" data-toggle="tab"
                                                                          style="text-align: right">Vietnamese</a></li>
                                                    <li><a href="#english_tab" data-toggle="tab" style="text-align: right">English</a>
                                                    </li>
                                                    <li><a href="#japanese_tab" data-toggle="tab" style="text-align: right">Japanese</a>
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
                                                                <input type="text" name="name_vn" class="form-control" placeholder="Tên bối cảnh" value="{{ old('name_vn',getContentByLang($item_story->item_story_id,'vi')->title) }}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                                <input type="text" name="description_vn" class="form-control" placeholder="Mô tả" value="{{ old('description_vn',getContentByLang($item_story->item_story_id,'vi')->description) }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="english_tab">
                                                        <br>
                                                        <div class="form-group">
                                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                                <input type="text" name="name_en" class="form-control" placeholder="Category Name" value="{{ old('name_en',getContentByLang($item_story->item_story_id,'en')->title) }}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                                <input type="text" name="description_en" class="form-control" placeholder="Description" value="{{ old('description_en',getContentByLang($item_story->item_story_id,'en')->description) }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="japanese_tab">
                                                        <br>
                                                        <div class="form-group">
                                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                                <input type="text" name="name_jp" class="form-control" placeholder="Category Name" value="{{ old('name_jp',getContentByLang($item_story->item_story_id,'jp')->title) }}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                                <input type="text" name="description_jp" class="form-control" placeholder="Description" value="{{ old('description_jp',getContentByLang($item_story->item_story_id,'jp')->description) }}">
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
                                    <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                        <button type="button" class="btn btn-primary">Cancel</button>
                                        <button type="reset" class="btn btn-primary">Reset</button>
                                        <button type="submit" class="btn btn-success">Submit</button>
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