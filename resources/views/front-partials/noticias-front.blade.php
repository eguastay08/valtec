<div class="row pb-15" style="overflow:hidden">

    @if(count($noticias) > 0)

        @foreach($noticias as $n)

            <div class="col-md-4 col-12">

                <div class="img-no">
                        <a href="{{asset('noticias/'.$n->link)}}">
                            <img src="{{asset($n->imgnoticia)}}" href="{{asset('noticias/'.$n->link)}}" alt="{{$n->noticia}}" class="img-fluid">
                            <div class="noticias-details">
                                <h5 class="mt-auto">{{$n->noticia}}</h5>
                                <button class="btn btn-primary">Ver más</button>
                            </div>
                        </a>
                </div>
                
            </div>

        @endforeach

    @endif

</div>