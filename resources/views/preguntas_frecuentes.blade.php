@extends('template')

@section('content')

<div class="as-breadcrumb" aria-label="breadcrumb">
    <nav class="container-xxl">
        <ol class="breadcrumb as-breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{url('/')}}" title="E-Shop">Inicio</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                Preguntas Frecuentes
            </li>
        </ol>
    </nav>
</div>

<div class="container-xxl container-fluid">

   <div class="row">
        <div class="col-12">
            <h3 class="text-center pb-10 mb-20 mx-5">PREGUNTAS FRECUENTES</h3>
            <hr>
        </div>
   </div>

    <div class="row mt-3">
        <div class="col-10 offset-1">
       
            <div class="accordion" id="accordionPreguntas">
                @php $i = 1 @endphp
                @foreach($preguntasFrecuentes as $pf)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading{{$i}}">
                        <button class="accordion-button {{$i == 1 ? '' : 'collapsed'}}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$i}}" aria-expanded="true" aria-controls="collapse{{$i}}">
                            <i class="fa fa-question-circle"></i>&nbsp;&nbsp;<b>{{$pf->pregunta}}</b>
                        </button>
                        </h2>
                        <div id="collapse{{$i}}" class="accordion-collapse collapse {{$i == 1 ? 'show' : ''}}" aria-labelledby="heading{{$i}}" data-bs-parent="#accordionPreguntas">
                            <div class="accordion-body">
                            {!! $pf->respuesta !!}
                            </div>
                        </div>
                    </div>
                    @php $i++; @endphp
                
                @endforeach

    
            </div>
            
        </div>
    </div>


</div>

@endsection