<div class="row">
    <div class="col-md-12">
        <div class="topmenu-left">
            <ul>
                <li><a href="{{asset('lang/vi')}}">VN</a></li>
                <li>|</li>
                <li><a href="{{asset('lang/en')}}">EN</a></li>
                <li>|</li>
                <li><a href="{{asset('lang/jp')}}">JP</a></li>
            </ul>
        </div>
    </div>
    <div class="col-md-12 search">
        <input type="text" name="" id="telNumber" class="search-input" placeholder="{{trans('content.code')}}" /> 
        @include('Frontend.keyboard')  
    </div>
</div>                