@extends('plantillas.base')

@section('titulo','base')

@section('content')


<div class="max-w-6xl mx-auto p-6">
  <h1 class="text-2xl font-semibold mb-4">Parques</h1>

  @isset($error)
    <div class="p-3 mb-4 rounded bg-red-100 text-red-700">
      Error al cargar parques: {{ $error }}
    </div>
  @endisset

  @if (empty($parks))
    <p class="text-gray-600">No hay parques para mostrar.</p>
  @else
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      @foreach ($parks as $p)
        @php
          $img = !empty($p['park_img_uri'])
              ? "https://azuritaa33.sg-host.com/storage/{$p['park_img_uri']}"
              : null;
        @endphp

        <div class="bg-white rounded-xl shadow overflow-hidden">
          @if ($img)
            <img src="{{ $img }}" alt="{{ $p['park_name'] ?? 'Parque' }}" class="w-full h-44 object-cover">
          @else
            <div class="w-full h-44 bg-gray-200 flex items-center justify-center text-gray-500">
              Sin imagen
            </div>
          @endif

          <div class="p-4" @isset($p['id']) data-park="{{$p['id']}}" @endisset>
            <h2 class="text-lg font-semibold">
            {{ $p['park_name'] ?? '—' }} <br><br>
             @if (!empty($p['id'])) 
                   ID: <span>{{$p['id']}}</span>
                @endif
             </h2>
            <p class="text-sm text-gray-600">
             
              {{ $p['park_address'] ?? '' }}
              @if (!empty($p['park_city'])) · {{ $p['park_city'] }} @endif
              @if (!empty($p['park_state'])) , {{ $p['park_state'] }} @endif
            </p>

            @if (isset($p['park_latitude'], $p['park_longitude']))
              <p class="text-xs text-gray-500 mt-1">
                Latitud: {{ $p['park_latitude'] }} · Longitud: {{ $p['park_longitude'] }}
              </p>
            @endif

          </div>
        </div>
      @endforeach
    </div>
  @endif
</div>
@endsection
