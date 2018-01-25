<?php
    use App\Models\MSetting;
    use App\Models\MCategoryTranslation;
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
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Danh sách bối cảnh</h4>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên</yh>
                                    <th>Danh mục cha</th>
                                    <th>Sort Order</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($category_list as $row)
                                    <tr>
                                        <td>{{$row['category_id']}}</td>
                                        <td>{{$row['name']}}</td>
                                        <td>
                                                @foreach($row->children as $sub)
                                                    @if($sub['category_id'] == $row['parent_id'])
                                                        {{$sub['name']}}
                                                    @endif
                                                    @foreach($sub->children as $subchild)
                                                        @if($subchild['category_id'] == $row['parent_id'])
                                                            {{$subchild['name']}}
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                        
                                        </td>
                                        <td>{{$row['sort_order']}}</td>
                                        <td>
                                            {{-- Nút Xem chi tiết--}}
                                            <button style="background: none; border: none" title="Xem chi tiết"
                                                    onclick="location.href='{{ URL::asset('/admin/category/detail/1')}}';">
                                                <span class="fa fa-eye"></span>
                                            </button>

                                            {{-- Nút Chỉnh sửa--}}
                                            <button style="background: none; border: none" title="Chỉnh sửa"
                                                    onclick="location.href='{{ URL::asset('/admin/category/edit/1')}}';">
                                                <span class="fa fa-pencil-square-o"></span>
                                            </button>

                                            {{--Nút Xóa--}}
                                            <button style="background: none; border: none" title="Xóa"
                                                    onclick="location.href='{{ URL::asset('/admin/category/delete/1')}}';">
                                                <span class="fa fa-remove"></span>
                                            </button>
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
                          
        </div>
    </div>
@endsection