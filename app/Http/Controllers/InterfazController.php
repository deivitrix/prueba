<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\interfaz;
use App\Models\interfaz_contenido;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class InterfazController extends Controller
{
    //método con json para probar si funciona con postman
    private $baseCtrl;

    public function __construct(){
        $this->baseCtrl = new BaseController();
    }

    public function getInterfaz()
    {
        return response()->json(interfaz::all(), 200);
    }


    public function showpagina(interfaz $pagina)
    {

        return response()->json($pagina);
    }


    public function getInterfazxid($id)
    {
        $interfaz = interfaz::find($id);
        if (is_null($interfaz)) {
            return response()->json(['Mensaje' => 'Registro no encontrado'], 404);
        }
        return response()->json($interfaz::find($id), 200);
    }

    public function insertInterfaz(Request $request)
    {
        $interfaz = interfaz::create($request->all());
        return response($interfaz, 200);
    }

    public function updateInterfaz(Request $request, $id)
    {
        $interfaz = interfaz::find($id);
        if (is_null($interfaz)) {
            return response()->json(['Mensaje' => 'Registro no encontrado'], 404);
        }
        $interfaz->update($request->all());
        return response($interfaz, 200);
    }

    public function deleteInterfaz($id)
    {
        $interfaz = interfaz::find($id);
        if (is_null($interfaz)) {
            return response()->json(['Mensaje' => 'Registro no encontrado'], 404);
        }
        $interfaz->delete();
        return response()->json(['Mensaje' => 'Registro Eliminado'], 200);
    }

    public function getInterfazContenidos($params)
    {

        $interfaz = interfaz::where('pagina', $params)->get();
        $response = false;
        $array = [];

        if ($interfaz->count() > 0) {
            foreach ($interfaz as $i) {
                $contenidos = interfaz_contenido::where('id_interfazs', $i->id)
                    ->orderBy('nombre', 'asc')->get();

                if ($contenidos->count() > 0)
                    foreach ($contenidos as $c)     $array[] = $c;
            }

            if ($array)
                foreach ($array as $c)  $c->interfaz;

            $response = $array;
            return response()->json($response);
        }
    }
    public function subirImagenServidor(Request $request){

        if($request->hasFile('img_carrusel')){
            $imagen = $request->file('img_carrusel');

            $filenamewithextension = $imagen->getClientOriginalName();   //Archivo con su extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);            //Sin extension
            $extension = $request->file('img_carrusel')->getClientOriginalExtension();    //Obtener extesion de archivo
            $filenametostore = $filename.'_'.uniqid().'.'.$extension;

            Storage::disk('ftp3')->put($filenametostore, fopen($request->file('img_carrusel'), 'r+'));

           $url = $this->baseCtrl->getUrlServer('/Contenido/Imagenes/');

            $response = [
                'estado' => true,
                'imagen' => $url.$filenametostore,
                'mensaje' => 'La imagen se ha subido al servidor'
            ];
        }else{
            $response = [
                'estado' => false,
                'imagen' => '',
                'mensaje' => 'No hay un archivo para procesar'
            ];
        }

        return response()->json($response);
    }
    public function updateCarrosel(Request $request)
    {
        $carrosel = (object)$request->carrosel;
        if($carrosel->id==0)
        {
            $newInterfaz=new interfaz_contenido();
            $newInterfaz->id_interfazs=intval($carrosel->id_interfaz);
            $newInterfaz->usuario_id=intval($carrosel->usuario_id);
            $newInterfaz->nombre= ucfirst(trim($carrosel->nombre));
            $newInterfaz->descripcion= ucfirst(trim($carrosel->descripcion));
            $newInterfaz->urlimagen=$carrosel->urlimagen;
            $newInterfaz->estado='A';
            $newInterfaz->save();
            $response=[
                'estado'  => true,
                'mensaje' => 'Imagen Insertada o Modificado'
            ];
        }
        else
        {
            $update = interfaz_contenido::find(intval($carrosel->id));
            $update->nombre=ucfirst(trim($carrosel->nombre));
            $update->descripcion=ucfirst(trim($carrosel->descripcion));
            $update->urlimagen=$carrosel->urlimagen;
            $update->save();
            $response=[
                'estado'  => true,
                'mensaje' => 'Imagen Insertada o Modificado'
            ];
        }


        return response()->json($response);

    }
    public function deleteCarrosel(Request $request)
    {
        $carrosel = (object)$request->data;
        $con=0;
        foreach($carrosel->eliminar as $eli)
        {
            $eliObj = (object)$eli;
            $update = interfaz_contenido::find(intval($eliObj->id));
            if($update){
                $con++;
                $update->estado='D';
                $update->save();
            }
        }
        $response=[
            'estado'  => true,
            'numero'=>$con,
            'mensaje' => 'Se Elimino los carruseles!!...'
        ];

        return response()->json($response);


    }

}
