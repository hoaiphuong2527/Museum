@extends('Backend.masterpage.masterpage')
@section('content')

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Quản lý danh mục
                        <small></small>
                    </h3>
                </div>

                <div class="title_right">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search for...">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button">Tìm kiếm!</button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Thêm danh mục </h2>
                            
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            @if (session('notify'))
                                <div class="alert alert-error">
                                    {{ session('notify') }}
                                </div>
                            @endif
                            <form class="form-horizontal form-label-left" method="post">
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
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Sort Order</label>
                                                <div class="col-md-9 col-sm-9 col-xs-12">
                                                    <input type="text" name="sort_order" class="form-control" placeholder="Sort Order" value="{{ old('sort_order') }}">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Danh mục cha</label>
                                                <div class="col-md-9 col-sm-9 col-xs-12">
                                                    <select class="select2_group form-control" name="parent_id">
                                                        @foreach($category_list as $row)
                                                            <option value="{{$row['category_id']}}">{{$row['name']}}</option>
                                                            @foreach($row['sub'] as $sub)
                                                                <option value="{{$sub['category_id']}}">&nbsp;&nbsp;---{{$sub['name']}}</option>
                                                            @endforeach
                                                        @endforeach
                                                        
                                                    </select>
                                                </div>
                                            </div>

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
                                                                <input type="text" name="name_en" class="form-control" placeholder="Category Name" value="{{ old('name_en') }}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                                <input type="text" name="description_en" class="form-control" placeholder="Description" value="{{ old('description_en') }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="japanese_tab">
                                                        <br>
                                                        <div class="form-group">
                                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                                <input type="text" name="name_jp" class="form-control" placeholder="Category Name" value="{{ old('name_jp') }}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                                <input type="text" name="description_jp" class="form-control" placeholder="Description" value="{{ old('description_jp') }}">
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