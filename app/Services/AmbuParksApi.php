<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class AmbuParksApi
{
    protected $http;

    public function __construct()
    {
        // Lee la base desde config/services.php o, si no, del .env
        $base = config('services.ambu_parks.base_url') ?: env('AMBU_API_BASE', '');
        $base = rtrim($base, '/'); //elimina una barra al final para evitar // en las rutas

        $this->http = Http::baseUrl($base)//todas las peticiones van a partir de esta base
            ->acceptJson()//para indicar que se esperan json
            ->withHeaders([ //cabecera personalizada para autenticacion
                'Content-Type'     => 'application/json',
                'Ambu-Public-Key'    => config('services.ambu_parks.public_key')  ?: env('AMBU_PUBLIC_KEY', ''),
                'Ambu-Private-Key' => config('services.ambu_parks.private_key') ?: env('AMBU_PRIVATE_KEY', ''),
            ]);
    }

    /* Listar parques */
    public function index(): array
    {
        return $this->http->get('/parks')->throw()->json();
    }

    /* Detalle por ID */
    public function show(int|string $id): array
    {
        return $this->http->get("/parks/{$id}")->throw()->json();
    }

    /* Crear */
    public function store(array $payload): array
    {
        return $this->http->post('/parks', $payload)->throw()->json();
         //uso del http el cual ya esta configurado en el constructor para hacer la peticion GET a '/parks' con ´payload en json y esto retorna un array con el json de la api

    }

    /* Actualizar */
    public function update(int|string $id, array $payload): array
    {
        return $this->http->put("/parks/{$id}", $payload)->throw()->json();
    }

    /* Eliminar */
    public function destroy(int|string $id): void
    {
        $this->http->delete("/parks/{$id}")->throw();
    }
}
