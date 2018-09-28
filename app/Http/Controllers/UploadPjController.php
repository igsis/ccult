<?php

namespace ccult\Http\Controllers;

use Illuminate\Http\Request;

use ccult\Models\PessoaJuridica;
use ccult\Models\ListaDocumentos;
use Illuminate\Http\UploadedFileSplFileInfo;

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

    public function upload(Request $request)
    {
        dd($request->hasFile('cpf'));
        // Define o valor default para a variável que contém o nome do upload 
        $nameFile = null;

        // Verifica se informou o arquivo e se é válido
        if ($request->hasFile('cpf') && $request->file('cpf')->isValid()) {
            
            // Define um aleatório para o arquivo baseado no timestamps atual
            $name = uniqid(date('HisYmd'));
    
            // Recupera a extensão do arquivo
            $extension = $request->cpf->extension();
    
            // Define finalmente o nome completo
            $nameFile = "{$name}.{$extension}";
            dd($nameFile);
            // Faz o upload:
            $upload = $request->cpf->storeAs('documentos', $nameFile);
            // Se tiver funcionado o arquivo foi armazenado em storage/app/public/categories/nomedinamicoarquivo.extensao
    
            // Verifica se NÃO deu certo o upload (Redireciona de volta)
            if ( !$upload )
                return redirect()
                            ->back()
                            ->with('warning', 'Falha ao fazer upload do arquivo!');
                            // ->withInput();
            return  redirect()
                ->back()
                ->with('flash_message', 'sucesso ao fazer upload do arquivo!');             
    
        }
        // if ( !$upload )
        return redirect()
                    ->back()
                    ->with('error', 'Falha ao fazer upload do arquivo!');
      

    }
}

        // $docs = ListaDocumentos::all();
        // foreach ($docs as $doc) {
        //    echo $doc->documento . "<br>";
        // }