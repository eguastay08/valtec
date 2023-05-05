<div class="row" style="margin: -2px; margin-bottom: -18px;overflow:hidden">

    @foreach($banners as $b)

        <div class="col-md-{{$b['columnas']}} col-sm-{{$b['columnas']}} nopadding" style="padding:2px 2px 20px 2px !important">

            <a href="{{ !empty($b['link']) ? $b['link']:''}}" {{$b['link']!="" ? $b['link'] : ''}} class="bri-banner">

                <img id="banner-{{$b['banner_id']}}" class="primary blur-up lazyload banner-main" data-src="{{asset($b['banner'])}}" src="{{asset($b['banner'])}}" style="width: 100%;">

                @if($b['banner__estilo_id'] == 2)
                    <img id="banner-super-{{$b['banner_id']}}" class="hover blur-up lazyload banner-hoover" data-src="{{asset($b['banner_superpuesto'])}}" src="{{asset($b['banner_superpuesto'])}}" style="width: 100%;">
                @endif

            </a>

        </div>

    @endforeach

</div>