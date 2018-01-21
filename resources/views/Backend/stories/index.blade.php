<?php
    use App\Models\MItemStoryTranslation;
    use App\Models\MCategoryTranslation;
    use App\Models\MCategory;
    function findStory($param,$lang)
    {
        app()->setLocale($lang);
        return MCategoryTranslation::where([['category_id',$param],['locale',$lang]])->first();
    }

    function findRoom($param,$lang)
    {
        app()->setLocale($lang);
        $cate = MCategory::where('category_id',$param)->first();
        return  MCategoryTranslation::where([['category_id',$cate->parent_id],['locale',$lang]])->first();
    }

    /*function findItem($param,$lang)
    {
        app()->setLocale($lang);
        return MItemStoryTranslation::where([['item_story_id',$param],['locale',$lang]])->first();
    }*/
?>
@extends('Backend.masterpage.masterpage')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Danh sách câu chuyện</h4>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Phòng</th>
                                    <th>Câu chuyện</th>
                                    <th>Hành động</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($lists as $row)
                                    <tr story-id="{{$row->item_story_id}}">
                                        <th>{{$row->item_story_id}}</th>
                                        <th>{{findRoom($row->category_id,'en')->name}}</th>
                                        <th>{{findStory($row->category_id,'en')->name}}</th>
                                        <td>
                                            {{-- Xem chỉnh sửa--}}
                                            <button style="background: none; border: none" title="Chỉnh sửa"
                                                    onclick="location.href='{{ URL::asset('/admin/story_item/edit/'. $row['item_story_id'])}}';">
                                                <span class="pe-7s-pen" style="font-size: 20px;font-weight: bold;"></span>
                                            </button>
                                            {{--Nút Xóa--}}
                                            <div class="btn-delete-item pe-7s-delete-user" style="font-size: 20px;color: red;font-weight: bold;"></div>
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
                        <form method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Mã tìm kiếm: </label>
                                        <br><b style="color:#104dda;">sfgsgsfgg</b>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Trạng thái: </label>
                                        <br><b style="color:#104dda;">sfgsgsfgg</b>
                                    </div>
                                </div>
                            </div>

                            <div class="row">      
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Hình ảnh: </label>
                                        <br><img class="" src="{{ URL::asset('upload/image/item_Story/') }}">
                                    </div>
                                </div>    
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Danh mục cha: </label>
                                        <br><b style="color:#104dda;">sfgsgsfgg</b>
                                    </div>
                                    <div class="form-group">
                                        <label>Âm thanh</label>
                                        <audio controls style="width: 100%">
                                            <source src="{{ URL::asset('upload/audio/item_Story/') }}" type="audio/mp3">
                                        </audio>                                 
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