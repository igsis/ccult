<?php

namespace ccult\Http\Controllers;

use Illuminate\Http\Request;
use ccult\Models\PfEndereco;
use ccult\Models\PessoaFisica;

class PessoaFisicaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:pessoaFisica');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pessoaFisicaAuth.home');
    }

    public function formRegister()
    {
		$id = auth()->user()->id;
		$pessoaFisica = PessoaFisica::find($id);
        return view('pessoaFisica.cadastro', compact('pessoaFisica'));
    }

    public function create(Request $request)
    {

		$data = $this->validate($request, [
			'nome' => 'required',
			'nomeSocial' => 'nullable',
			'nomeArtistico' => 'nullable',
			// 'documento' => 'required',
			'rgRne' => 'required',
			'ccm' => 'nullable',
			'cpf' => 'nullable',
			'passaporte' => 'nullable',
			'dataNascimento' => 'required',
			'email' => 'required',
			'senha' => 'required'
		]);
		
		PessoaFisica::create([
			'nome' => $request->nome,
			'nome_social' => $request->nomeSocial,
			'nome_artistico' => $request->nomeArtistico,
			'documento_tipo_id' => $request->rgRne,
			'rg_rne' => $request->rgRne,
			'ccm' => $request->ccm,
			'cpf' => $request->cpf,
			'passaporte' => $request->passaporte,
			'data_nascimento' => $request->dataNascimento,
			'email' => $request->email,
			'senha' => $request->senha,
			'ultima_atualizacao' => Date('Y-m-d H:m:s')
		]);

    	return redirect()->back()->with('flash_message',
            'Pessoa Física Cadastrada com Sucesso');

    }
}
