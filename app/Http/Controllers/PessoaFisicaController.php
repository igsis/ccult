<?php

namespace ccult\Http\Controllers;

use Illuminate\Http\Request;
use ccult\Models\PfEndereco;
use ccult\Models\PfTelefone;
use ccult\Models\PessoaFisica;

class PessoaFisicaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:pessoaFisica');
    }

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
	
	public function endereco()
	{
		if (!isset(auth()->user()->endereco->cep)){
			return view('pessoaFisica.cadastroEndereco');
		}
		
		$id = auth()->user()->id;
		$endereco = PfEndereco::where('pessoa_fisica_id', '=', $id)->first();

		return view('pessoaFisica.editarEndereco', compact('endereco'));
	}

	public function cadastroEndereco(Request $request)
	{
		$id = auth()->user()->id;
		$pf = PessoaFisica::findOrFail($id);

		$this->validate($request, [
			'cep'=>'required|min:8',
			'logradouro'=>'required',
			'bairro'=>'required',
			'numero'=>'required|numeric',
			'complemento'=>'nullable',
			'cidade'=>'required',
			'uf'=>'required|max:2',
		]);

		$pf->endereco()->create([
			'pessoa_fisica_id' => $id,
			'cep' => $request->cep,
			'logradouro' => $request->logradouro,
			'numero' => $request->numero,
			'complemento' => $request->complemento,
			'bairro' => $request->bairro,
			'cidade' => $request->cidade,
			'uf' => $request->uf
		]);

		return redirect()->route('pessoaFisica.formEndereco')->with('flash_message',
		'Seu Endereço Foi Cadastrado Com Sucesso!');
	}

	public function atualizarEndereco(Request $request)
	{
		$id = auth()->user()->id;
		$pf = PessoaFisica::findOrFail($id);

		$this->validate($request, [
			'cep'=>'required|min:8',
			'logradouro'=>'required',
			'bairro'=>'required',
			'numero'=>'required|numeric',
			'complemento'=>'nullable',
			'cidade'=>'required',
			'uf'=>'required|max:2',
		]);

		$pf->endereco()->update([
			'pessoa_fisica_id' => $id,
			'cep' => $request->cep,
			'logradouro' => $request->logradouro,
			'numero' => $request->numero,
			'complemento' => $request->complemento,
			'bairro' => $request->bairro,
			'cidade' => $request->cidade,
			'uf' => $request->uf
		]);

		return redirect()->route('pessoaFisica.formEndereco')->with('flash_message',
		'Seu Endereço Foi Atualizado Com Sucesso!');
	}

	public function formTelefones()
	{
		$id = auth()->user()->id;

		if(auth()->user()->telefones->count() > 0){
			$tel = PfTelefone::where('pessoa_fisica_id', $id)->first();
			// dd($tel->telefone);
			return view('pessoaFisica.editarTelefone', compact('tel'));

		}
		return view('pessoaFisica.cadastroTelefone');
	}

	public function cadastroTelefone(Request $request)
	{
		$id = auth()->user()->id;

		$this->validate($request, [
			'telefone' =>'required_without:celular',
			'celular'  =>'required_without:telefone',
		]);

		if ($request->celular && $request->telefone){
			PfTelefone::create([
				'pessoa_fisica_id'	=> $id,
				'telefone' 		  	=> $request->telefone,
				'celular' 		  	=> $request->celular
			]);

			return redirect()->route('pessoaFisica.formTelefones')->with('flash_message',
			'Telefones Cadastrados Com Sucesso!');

		}elseif ($request->celular && !$request->telefone) {
			PfTelefone::create([
				'pessoa_fisica_id'	=> $id,
				'celular' 		  	=> $request->celular
			]);

			return redirect()->route('pessoaFisica.formTelefones')->with('flash_message',
			'Celular cadastrado com Sucesso!');
		}
		elseif (!$request->celular && $request->telefone) {
			PfTelefone::create([
				'pessoa_fisica_id'	=> $id,
				'telefone' 		  	=> $request->telefone,
			]);

			return redirect()->route('pessoaFisica.formTelefones')->with('flash_message',
			'Telefone cadastrado com Sucesso!');
		}
	}
	public function atualizaTelefone(Request $request)
	{
	
		$id = auth()->user()->id;

		$this->validate($request, [
			'telefone' =>'required_without:celular',
			'celular'  =>'required_without:telefone',
		]);
		$telefone = PfTelefone::where('pessoa_fisica_id', $id)->first();

		if ($request->celular && $request->telefone){
			$telefone->update([
				'pessoa_fisica_id'	=> $id,
				'telefone' 		  	=> $request->telefone,
				'celular' 		  	=> $request->celular
			]);

			return redirect()->route('pessoaFisica.formTelefones')->with('flash_message',
			'Telefones Atualizados Com Sucesso!');

		}elseif ($request->celular && !$request->telefone) {
			$telefone->update([
				'pessoa_fisica_id'	=> $id,
				'telefone' 		  	=> '',
				'celular' 		  	=> $request->celular
			]);

			return redirect()->route('pessoaFisica.formTelefones')->with('flash_message',
			'Celular Atualizado com Sucesso!');
		}
		elseif (!$request->celular && $request->telefone) {
			$telefone->update([
				'pessoa_fisica_id'	=> $id,
				'telefone' 		  	=> $request->telefone,
				'celular' 		  	=> ''
			]);

			return redirect()->route('pessoaFisica.formTelefones')->with('flash_message',
			'Telefone Atualizado com Sucesso!');
		}
	}
	
}
