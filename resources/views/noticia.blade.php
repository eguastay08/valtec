@extends('template')

@section('content')


    <div class="container-xxl container-fluid">

        <div class="row">

            <div class="col-12 me-auto">
                <button id="btnFiltrosNoticia" class="btn btn-dark d-lg-none d-xl-block d-xl-none d-xxl-none d-xxl-block bradius mb-4 mt-2" collapse="false"><i class="fa fa-filter"></i> Filtros Noticia</button>
            </div>

            <div class="col-lg-9 order-lg-1 order-md-2 order-2">

                <div class="row">
                    <div class="col-12">
                        <ul class="category-noticias category-noticias-style mb-2">
                            @if(count($noticia['noticia_categorias'])>0)
                                @foreach($noticia['noticia_categorias'] as $knca => $nca)
                                    <li><a href="{{url('noticia_categorias/'.$nca->url)}}">{{$nca->noticia_categoria}}</a></li>
                                @endforeach
                            @endif
                        </ul>
                    </div>

                    <div class="col-12">
                        <h3 class="title-noticia mb-2">{{ $noticia['noticia'] }}</h3>
                    </div>

                    <div class="col-12">
                        <div class="fecha_hora_noticia mb-3">
                            <time>{{ $fechaNoticia }} | {{$horaNoticia}}</time>
                        </div>
                    </div>

                    <div class="col-12">
                        @if(count($noticia['imagenes_noticia'])>0)
                            
                            <div class="noticia-slider">
                                @foreach($noticia['imagenes_noticia'] as $nimm)

                                <div class="slider-item">
                                    <img class="img-fluid d-block w-100" src="{{asset($nimm->url)}}" title="Noticia Imagen">
                                </div>

                                @endforeach
                            </div>

                        @endif
                    </div>

                    <div class="col-md-8 col-12">
                        <ul class="category-products mt-3 mb-3">
                            @if(count($noticia['noticia_tags'])>0)
                            @foreach($noticia['noticia_tags'] as $knta => $nta)
                                <li><a class="bradius" href="{{url('noticia_etiquetas/'.$nta->url)}}">{{$nta->noticia_tag}}</a></li>
                            @endforeach
                            @endif
                        </ul>
                    </div>

                    <div class="col-md-4 col-12 mt-2 d-flex justify-content-end">
                        <div class="shared-container">
                            <a class="btn btn-default btn-whatsapp" href="https://api.whatsapp.com/send?text={{asset('noticias/'.$noticia['url'])}}" target="_blank"><i class="fab fa-whatsapp" style="font-size:18px;"></i></a>
                            <a class="btn btn-default btn-facebook" href="https://wwww.facebook.com/sharer.php?u={{asset('noticias/'.$noticia['url'])}}&t={{$noticia['noticia']}}" target="_blank"><i class="fab fa-facebook-f" style="font-size:18px;"></i></a>
                            <a class="btn btn-default btn-twitter" href="https://twitter.com/intent/tweet?text={{asset('noticias/'.$noticia['url'])}}&via=Empresa&hashtags=#LolStore" target="_blank"><i class="fab fa-twitter" style="font-size:18px;"></i></a>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="dvnoticia-descripcion">
                            {!! $noticia['descripcion'] !!}
                        </div>
                
                    </div>
                </div>

            </div>

            <div class="col-lg-3 order-lg-2 order-md-1 order-1">

                <div id="noticia_filters">

                    <div class="as-categoria-tree">
                        <div class="row mb-3 mt-25">
                            <h3 class="col-12 pb-10 u"><span>CATEGORÍAS</span></h3>
                            <div class="col-lg-12 col-md-12 col-12 mt-3">
                                <ul class="as-categoria-tree-list">
                                    @isset($noticias_categorias)
                                        @foreach($noticias_categorias as $kc=>$nc)

                                            @if(!$nc['sub_menu'])
                                                <li class="mb-2"><span class="stylecat style-category-nav d-block">
                                                    <a href="{{url('noticia_categorias/'.$nc['url'])}}" class="site-nav">{{$nc['noticia_categoria']}}</a></span>
                                                </li> 
                                            @else
                                                <li>
                                                    <span class="stylecat style-category-nav d-flex justify-content-between align-items-center">
                                                        <a href="{{url('noticia_categorias/'.$nc['url'])}}" class="site-nav">{{$nc['noticia_categoria']}}</a>
                                                        <a class="drop-arrow" desplegado ="0">
                                                            <i class="fas fa-plus ct-show"></i>
                                                            <i class="fas fa-minus ct-hide hide"></i>
                                            
                                                        </a>
                                                        </span>
                                                        <ul class="sublinks">
                                                            @foreach($nc['sub_menu'] as $knc=>$nocatsub)
                                                                <li class="level2">
                                                                    <a href="{{url('noticia_categorias/'.$nc['url'].'/'.$nocatsub['url'])}}" class="site-nav level2style">{{$nocatsub['noticia_categoria']}}</a></li>
                                                            @endforeach
                                                        </ul>
                                                </li>
                                                
                                            @endif

                                        @endforeach
                                    @endisset
                                    
                                </ul>
                            </div>
                        </div>
                    </div>

                    <hr>
            
                    <div class="as-etiquetas-tree">
                        <div class="row mb-3 mt-25">
                            <h3 class="col-12 pb-10 u"><span>ETIQUETAS</span></h3>
                            <div class="col-lg-12 col-md-12 col-12 mt-3">
                                <ul class="as-tags-tree-list">

                                @isset($noticias_etiquetas)
                                    @foreach($noticias_etiquetas as $ne)
                                    <li class=""><a href="{{url('noticia_etiquetas/'.$ne->url)}}" title="{{$ne->noticia_tag}}">{{$ne->noticia_tag}}</a></li>
                                    @endforeach
                                @endisset

                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
        
            </div>

        </div>

        @if(count($noticias_relacionadas)>0)

            <hr>

            <div class="row">
                <div class="col-12">
                    <h3 class="text-center title-nr">NOTICIAS RELACIONADAS</h3>
                </div>
            </div>

            <div class="row">
                @foreach($noticias_relacionadas as $nr)
                    <div class="col-md-4 col-12" style="text-align:center; display:flex; flex-wrap:wrap;">
                        <div class="noticia-col shadow-box p-10 mt-4">
                            <div class="bloque-noticias mb-2">
                                <a href="{{asset('noticias/'.$nr->url)}}">
                                    <img src="{{asset($nr->imgnoticia)}}" href="{{asset('noticias/'.$nr->url)}}" alt="{{$nr->noticia}}" class="img-fluid">
                                </a>
                            </div>
                            <a href="{{asset('noticias/'.$nr->url)}}" class="bloque-titulonoticia">{{substr($nr->noticia,0,70)}}</a>
                        </div>
                    </div>  
                @endforeach
            </div>
        
        @endif

    </div>




@endsection

@section('scripts')
   
@endsection