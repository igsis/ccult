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
        return view('pessoaFisica.home');
    }

    public function show()
    {
		$id = auth()->user()->id;
		$pessoaFisica = PessoaFisica::find($id);
        return view('pessoaFisica.cadastro', compact('pessoaFisica'));
    }

    public function update(Request $request)
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
		]);

		$id = auth()->user()->id;

		$pessoaFisica = PessoaFisica::findOrFail($id);

		$pessoaFisica->update([
			'nome' => $request->nome,
			'nome_social' => $request->nomeSocial,
			'nome_artistico' => $request->nomeArtistico,
			// 'documento_tipo_id' => $request->documento_tipo_id,
			'rg_rne' => $request->rgRne,
			'ccm' => $request->ccm,
			'passaporte' => $request->passaporte,
			'data_nascimento' => $request->dataNascimento,
			'email' => $request->email,
			'senha' => $request->senha,
		]);

    	return redirect()->back()->with('flash_message',
            'Seus Dados Foram Atualizados Com Sucesso!');

    }
}
