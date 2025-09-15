<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('titulo','Ambu')</title>
  @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-100 text-slate-800">

 
  <header class="bg-white border-b">
    <div class="max-w-6xl mx-auto px-4 h-14 flex items-center justify-between">
      <h1 class="text-lg font-semibold">Parques de Guadalajara</h1>

      <nav class="hidden sm:block">
        <ul class="flex items-center gap-1">
          <li>
            <a href="{{ route('parques.index') }}"
               class="px-3 py-2 rounded-md hover:bg-slate-100 {{ request()->routeIs('parques.index') ? 'bg-indigo-600 text-white hover:bg-indigo-600' : 'text-slate-700' }}">
              Inicio
            </a>
          </li>
          <li>
            <a href="{{ route('parques.buscar') }}"
               class="px-3 py-2 rounded-md hover:bg-slate-100 {{ request()->routeIs('parques.buscar') ? 'bg-indigo-600 text-white hover:bg-indigo-600' : 'text-slate-700' }}">
              Buscar
            </a>
          </li>
          <li>
            <a href="{{ route('parques.create') }}"
               class="px-3 py-2 rounded-md hover:bg-slate-100 {{ request()->routeIs('parques.create') ? 'bg-indigo-600 text-white hover:bg-indigo-600' : 'text-slate-700' }}">
              Registrar
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </header>

  
  <main class="max-w-6xl mx-auto px-4 py-6">
    
    @if(session('ok'))
      <div class="mb-4 rounded-md bg-green-50 text-green-700 px-4 py-2">
        {{ session('ok') }}
      </div>
    @endif

    @if($errors->any())
      <ul class="mb-4 rounded-md bg-red-50 text-red-700 px-4 py-3 list-disc list-inside">
        @foreach($errors->all() as $err)
          <li>{{ $err }}</li>
        @endforeach
      </ul>
    @endif

    <div class="bg-white rounded-xl shadow p-6">
      @yield('content')
    </div>
  </main>

  
  <footer class="mt-10 border-t bg-white">
    <div class="max-w-6xl mx-auto px-4 py-6 text-sm text-slate-500">
      © {{ date('Y') }} • Ambu
    </div>
  </footer>

</body>
</html>
