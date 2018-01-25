<?php
    use App\Models\MSetting;
    use App\Models\MCategoryTranslation;
    use App\Models\MCategory;
    function findStory($param,$lang)
    {
        app()->setLocale($lang);
        return MCategoryTranslation::where([['category_id',$param],['locale',$lang]])->first();
    }

    function findStatus($param)
    {
       return MSetting::where('s_value',$param)->where('s_key','STATUS')->first();
    }
?>
@extends('Backend.masterpage.masterpage')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Danh sách bối cảnh</h4>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th width=300px class="text-center">Ảnh</th>
                                    <th>Hành động</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($lists as $row)
                                    <tr story-id="{{$row->item_story_id}}">
                                        <th>{{$row->item_story_id}}</th>
                                        <th><a href="{{ URL::asset('/admin/story_item/des/'.$row->item_story_id)}}"><img class="img-responsive" src="{{ URL::asset('upload/image/item_Story/'.$row->url_image) }}" width=50%></a></th>

                                        <td>
                                            {{-- Xem chỉnh sửa--}}
                                            <button style="background: none; border: none" title="Chỉnh sửa"
                                                    onclick="location.href='{{ URL::asset('/admin/story_item/edit/'. $row['item_story_id'])}}';">
                                                <span class="pe-7s-tools" style="font-size: 20px;font-weight: bold;"></span>
                                            </button>
                                            {{--Nút Xóa--}}
                                            <div class="btn-delete-item pe-7s-trash" style="font-size: 20px;color: red;font-weight: bold;"></div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <hr>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success btn-fill" onclick="location.href='{{ URL::asset('/admin/story_item/create')}}';">Tạo mới</button>
                        </div>
                    </div>
                </div>
                
            </div> 
            <div class="col-md-6">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Thông tin cơ bản</h4>
                    </div>
                    <div class="content">
                        <form method="post" >
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Mã tìm kiếm: </label>
                                        <br><b style="color:#104dda;">{{$firstObj->code}}</b>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Trạng thái: </label>
                                        <br><b style="color:#104dda;">{{findStatus($firstObj->status)->s_name}}</b>
                                    </div>
                                </div>
                            </div>

                            <div class="row">      
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Hình ảnh: </label>
                                        <br><img class="img-responsive" src="{{ URL::asset('upload/image/item_Story/'.$firstObj->url_image) }}">
                                    </div>
                                </div>    
                                <div class="col-md-6">
                                    
                                    <div class="form-group">
                                        <label>Âm thanh</label>
                                        @if($firstObj->sound != null)
                                        <audio controls style="width: 100%">
                                            <source src="{{ URL::asset('upload/audio/item_Story/.$firstObj->sound') }}" type="audio/mp3">
                                        </audio>      
                                        @endif                           
                                    </div>
                                </div>                            
                            </div>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>                
        </div>
    </div>
@endsection