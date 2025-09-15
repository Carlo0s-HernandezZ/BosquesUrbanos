@extends('plantillas.base')

@section('titulo','base')

@section('content')

<h1 class="text-base/7 font-semibold text-gray-900">Buscar Parques por ID</h1>

<form action="{{route('parques.buscar')}}" method="GET">
    <div class="space-y-12">
        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
            <div class="sm:col-span-4">
                <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                    <input type="number" name="id" value="{{$id ?? ''}}" placeholder="ID" required class="block min-w-0 grow bg-white py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6">
                </div>
                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Buscar</button>
                </div>
            </div>
        </div>
    </div>
</form>

@if (isset($id))
    <br>
    @if ($park)
    <h2 class="text-base/7 font-semibold text-gray-900">{{$park['park_name']?? '-'}}</h2>
        @if (!empty($park['park_img_uri']))
        <div class="max-w-sm bg-white rounded-xl shadow overflow-hidden max-w-md mx-auto bg-white rounded-xl shadow p-6">
            <img class="w-full h-48 object-cover" src="https://azuritaa33.sg-host.com/storage/{{$park['park_img_uri']}}" alt="imagen">
        </div>    
        @endif
        <p class="mt-1 text-sm/6 text-gray-600">{{$park['park_address']?? ''}}</p>
        <div class="mt-6 flex items-center justify-end gap-x-6">
            <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"><a href="{{route('parques.show', ['id' => $park['id']])}}"> Ver los detalles</a></button>
        </div>
        @else
        <p class="mt-1 text-sm/6 text-gray-600">No se encontro el parque con el ID {{$id}}.</p>
    @endif
@endif

@endsection