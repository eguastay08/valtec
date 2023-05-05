<div class="row banners-container gx-5" style="overflow:hidden">

    @foreach($banners as $b)
    
        <div class="col-md-{{$b['columnas']}} col-12 p-0 banner-item">

            <a href="{{ !empty($b['link']) ? $b['link']:''}}" {{$b['link']!="" ? $b['link'] : ''}} class="as-banner-row">

                <img id="banner-{{$b['banner_id']}}" class="img-fluid banner-main bradius" data-src="{{asset($b['banner'])}}" src="{{asset($b['banner'])}}" style="width: 100%;">

                @if($b['banner__estilo_id'] == 2)
                    <img id="banner-super-{{$b['banner_id']}}" class="img-fluid banner-hoover bradius" data-src="{{asset($b['banner_superpuesto'])}}" src="{{asset($b['banner_superpuesto'])}}" style="width: 100%;">
                @endif

            </a>

        </div>

    @endforeach

</div>