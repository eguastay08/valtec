@extends('template')

@section('content')

    <div class="container-xxl container-fluid">

        <div class="row">

            <div class="col-12">
                <h2 class="Noticias-title" style="margin-top:3%;">Noticias {{$noticia_categoria_title}} </h2> 
                <hr>
            </div>
            
            <div class="col-12 me-auto">
                <button id="btnFiltrosNoticia" class="btn btn-dark d-lg-none d-xl-block d-xl-none d-xxl-none d-xxl-block bradius mb-4 mt-2" collapse="false"><i class="fa fa-filter"></i> Filtros Noticia</button>
            </div>

            <div class="col-lg-9 order-lg-1 order-md-2 order-2">
                
                <div class="row">
                    @foreach($noticiasxcategoria as $nc)
                        <div class="col-md-6 col-12" style="text-align:center; display:flex; flex-wrap:wrap;">
                            <div class="noticia-col shadow-box p-10 mt-4">
                                <div class="bloque-noticias mb-2">
                                    <a href="{{asset('noticias/'.$nc->url)}}">
                                        <img src="{{asset($nc->imgnoticia)}}" href="{{asset('noticias/'.$nc->url)}}" alt="{{$nc->noticia}}" class="img-fluid">
                                    </a>
                                </div>
                                <a href="{{asset('noticias/'.$nc->url)}}" class="bloque-titulonoticia">{{substr($nc->noticia,0,70)}}</a>
                            </div>
                        </div>  
                    @endforeach
                </div>

                {{ $noticiasxcategoria->appends(request()->query())->links('front-partials.pagination-front') }}
                
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
                                                <li class="mb-2"><span class="{{ $nc['url'] == $url_actual ? 'stylecatactive style-category-nav-active' : 'stylecat style-category-nav'}} d-block">
                                                    <a href="{{url('noticia_categorias/'.$nc['url'])}}" class="site-nav">{{$nc['noticia_categoria']}}</a></span>
                                                </li> 
                                            @else
                                                <li>
                                                    <span class="{{ $nc['url'] == $url_actual ? 'stylecatactive style-category-nav-active' : 'stylecat style-category-nav'}} d-flex justify-content-between align-items-center">
                                                        <a href="{{url('noticia_categorias/'.$nc['url'])}}" class="site-nav">{{$nc['noticia_categoria']}}</a>
                                                        <a class="drop-arrow" desplegado ="{{ $nc['url'] == $url_actual ? '1' : '0'}}">
                                                            <i class="fas fa-plus ct-show {{ $nc['url'] == $url_actual ? 'hide' : ''}}"></i>
                                                            <i class="fas fa-minus ct-hide {{ $nc['url'] == $url_actual ? 'show' : 'hide'}}"></i>
                                            
                                                        </a>
                                                        </span>
                                                        <ul class="sublinks {{ $nc['url'] == $url_actual ? 'active-sublinks' : ''}}">
                                                            @foreach($nc['sub_menu'] as $knc=>$nocatsub)
                                                                <li class="level2">
                                                                    <a href="{{url('noticia_categorias/'.$nc['url'].'/'.$nocatsub['url'])}}" class="site-nav {{ $nocatsub['url'] == $sub_actual ? 'level2-active' : 'level2style'}}">{{$nocatsub['noticia_categoria']}}</a></li>
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

    </div>

@endsection