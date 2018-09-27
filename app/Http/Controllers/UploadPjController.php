<?php

namespace ccult\Http\Controllers;

use Illuminate\Http\Request;

use ccult\Models\PessoaJuridica;
use ccult\Models\ListaDocumentos;

class UploadPjController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:pessoaJuridica');
    }

    public function viewUploads()
    {
       return view('pessoaJuridica.documentos.index');
    }

    public function upload()
    {
        $docs = ListaDocumentos::all();
        foreach ($docs as $doc) {
           echo $doc->documento . "<br>";
        }
    }
}
