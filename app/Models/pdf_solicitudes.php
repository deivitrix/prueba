<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pdf_solicitudes extends Model
{
    use HasFactory;
    protected $connection = 'pgsql';
    public $timestamps = false;
    protected $fillable = ['id','solicitud_id','pdfcertificado_matricula','pdfcopia_record','pdfsolicitud_carta','pdfcartas_recomendacion',
    'pdfno_sancion','pdffotos','pdfseguro','pdfexamen_psicometrico','pdfdominio_idioma','pdfdocumentos_udestino','pdfcomprobante_solvencia'
    ,'pdfcarta_aceptacion','pdftitulo','tipo'];


      //Relacion de uno a muchos
public function soli(){
    return $this->hasMany('App\Models\solicitudes','solicitud_id');
}
}