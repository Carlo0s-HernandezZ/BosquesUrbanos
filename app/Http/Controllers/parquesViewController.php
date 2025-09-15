<?php

namespace App\Http\Controllers;

use App\Services\AmbuParksApi;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Http\Client\RequestException;
use Illuminate\Validation\Rule as ValidationRule;
use Illuminate\View\View;

class ParquesViewController extends Controller
{
    public function index(AmbuParksApi $api): View
    {
        $parks = [];
        $error = null;

        try {
            $res = $api->index(); // GET /parks externo
            $parks = array_map(function ($p) {
                $p['image_url'] = !empty($p['park_img_uri'])//arma una URL
                    ? "https://azuritaa33.sg-host.com/storage/{$p['park_img_uri']}"
                    : null;//si no hay imagen queda como nulo
                return $p;
            }, $res['data'] ?? []);
        } catch (\Throwable $e) {
            $error = $e->getMessage();//si algo falla se captura con el catch
        }

        return view('parques.index', compact('parks', 'error'));//retorno de la vista de parques o mensaje de error
    }


    //formulario para buscar por medio del id y muestra los datos del parque
    public function buscar(Request $request, AmbuParksApi $api): View{

       $id = $request->query('id'); //toma de parametro
       $park = null;

       if($id){
        try{
            $res = $api->show($id); //llama a la api
            $park = $res['data'] ?? null; //toma data y si no exista manda a null
        }catch(\Throwable $e){ // control de fallas
        $park = null; //se deja nulo para que no interrumpir la vista
    } 
    }
        return view('parques.buscar', compact('park', 'id')); //muestra la vista parques.buscar con los datos requeridos
    }


    public function show(AmbuParksApi $api, int $id): View{
        $park = null;
        try{
            $res = $api->show($id);//llama a la api
            $park = $res['data'] ?? null; //toma data y si no exista manda a null

            if(!$park){
                abort(404);
            }

        }catch(\Throwable $e){
            $park = null;//se deja nulo para que no interrumpir la vista
            abort(404);
        }
        return view('parques.show', compact('park', 'id'));
    }



public function edit(AmbuParksApi $api, int $id): View
{
    $park = $api->show($id)['data'] ?? null; //requerimiento a la api el parque con x id y se toma el dato
    return view('parques.actualizarParque', compact('park','id')); //muetra la vista del form con el parque buscado por el id
}

public function update(Request $request, AmbuParksApi $api, int $id)
{
    $data = $request->validate([ //validacion de datos
        'park_name'         => ['sometimes','nullable','string','max:100'],
        'park_abbreviation' => ['sometimes','nullable','string','max:10'],
        'park_img_url'      => ['sometimes','nullable','url'],
        'park_address'      => ['sometimes','nullable','string','max:150'],
        'park_city'         => ['sometimes','nullable','string'],
        'park_state'        => ['sometimes','nullable','string','max:100'],
        'park_zip_code'     => ['sometimes','nullable'],
        'park_latitude'     => ['sometimes','nullable'],
        'park_longitude'    => ['sometimes','nullable'],
    ]);

    //evita quese reemplace datos por vacios
    $data = array_filter($data, fn($v) => $v !== '' && $v !== null);
    //se llama la api para actulaizar los datos presentes
    $api->update($id, $data); 
    return redirect()->route('parques.show', $id)->with('ok','Parque actualizado');
}

public function destroy(AmbuParksApi $api, int $id){
    try {
        $api->destroy($id);//solicitud de eliminar el parque con x id
        return redirect()->route('parques.index')->with('ok', 'Parque Eliminado');//respuesta de éxito
    } catch (RequestException $e) {//errore de la api
        $res = $e->response?->json();
        return back()->withErrors($res['message']?? $e->getMessage());
    }catch (\Throwable $e){//otros errores
        return back()->withErrors($e->getMessage()); //mensaje de error
    }
}


public function create(){
    return view('parques.crearParque');//vista para agregar un parque
}

public function store(Request $request, AmbuParksApi $api){
     //validacion antes de ingresar en la api
    $data = $request->validate([
        'park_name' =>['required', 'string','max:100'],
        'park_abbreviation' =>['required', 'string', 'max:10'],
        'park_img_url' => ['required', 'url', 'regex:/\.(jpe?g|png)$/i'],
        'park_address' => ['required','string','max:150'],
        'park_city' => ['required','string', ValidationRule::in(['Guadalajara','Zapopan','San Pedro Tlaquepaque','Tonalá'])],
        'park_state' => ['required','string','max:100'],
        'park_zip_code' => ['required'],
        'park_latitude' => ['required'],
        'park_longitude' => ['required'],
    ]);
    try { //llamado de api
        $res = $api->store($data);//llama a la api
        $park = $res['data'] ?? null; //datos del parque creado
        return redirect()
            ->route('parques.show', $park['id'] ?? null)
            ->with('ok', 'Parque creado');
    } catch (RequestException $e) { //si falla la api responde error y se muestra
        $resp = $e->response?->json();
        $errs = $resp['errors'] ?? ($resp['message'] ?? $e->getMessage());
        return back()->withErrors($errs)->withInput();
    }
}
  
}
