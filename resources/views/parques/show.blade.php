@extends('plantillas.base')

@section('titulo','base')

@section('content')


<h1 class="text-base/7 font-semibold text-dark-900">Detallles del Parque {{$id}}</h1>




@if ($park)
    <h2 class="text-base/7 font-semibold text-gray-900">Nombre del Parque: {{$park['park_name'] ?? '-'}}</h2>
    <h3 class="text-base/7 font-semibold text-gray-900">Abreviacion: {{$park['park_abbreviation'] ?? '-'}}</h3>
    @if (!empty($park['park_img_uri']))
    <div class="max-w-sm bg-white rounded-xl shadow overflow-hidden max-w-md mx-auto bg-white rounded-xl shadow p-6">
        <img  class="w-full h-48 object-cover" src="https://azuritaa33.sg-host.com/storage/{{$park['park_img_uri']}}" alt="imagen" width="800">  
    </div>
    @endif
    <br><br>
    <p class="text-gray-500 dark:text-gray-400">Direccion {{$park ['park_address'] ?? ''}}</p>
    <p class="text-gray-500 dark:text-gray-400">Ciudad 
    {{ $park['park_city'] ?? '' }}
    {{ !empty($park['park_state']) ? ', '.$park['park_state'] : '' }}
    </p>
    <p class="text-gray-500 dark:text-gray-400">{{$park ['park_zip_code'] ?? ''}}</p>
    <p class="text-gray-500 dark:text-gray-400">Latitud {{$park ['park_latitude' ?? '']}}</p>
    <p class="text-gray-500 dark:text-gray-400">Longitud {{$park ['park_longitude'] ?? ''}}</p>
    @else
    <p class="mt-1 text-sm/6 text-gray-600">No encontrado</p>
@endif


<ol>
<li>
    <div class="mt-6 flex items-center justify-end gap-x-6">
        <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"><a href="{{ route('parques.edit', $park['id']) }}">Editar</a></button>
    </div>
</li>
<li>
    <form method="POST" action="{{route('parques.destroy', $park['id'])}}"
    onsubmit="return confirm('¿Eliminar este Parque?');"
    style="display:inline">
    @csrf
    @method('DELETE')
    <div class="mt-6 flex items-center justify-end gap-x-6">
        <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Eliminar</button>
    </div>
</form>
</li>

</ol>

<form method="POST" action="{{url('/')}}"></form>
@endsection