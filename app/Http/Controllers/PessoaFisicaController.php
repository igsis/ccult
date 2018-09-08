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
		$pessoaFisica = auth()->user();

        return view('pessoaFisica.cadastro', compact('pessoaFisica'));
    }

    public function update(Request $request)
    {
		$pf = auth()->user();

		$data = $this->validate($request, [
			'nome' => 'required',
			'nome_social' => 'nullable',
			'nome_artistico' => 'nullable',
			// 'documento' => 'required',
			'rg_rne' => 'required',
			'ccm' => 'nullable',
			'cpf' => 'nullable',
			'passaporte' => 'nullable',
			'data_nascimento' => 'required',
			'email' => 'required',
		]);
		# Melhorar erros

		$pf->update($data);

    	return redirect()->back()->with('flash_message',
            'Seus Dados Foram Atualizados Com Sucesso!');

	}
	
	public function endereco()
	{
		$pf = auth()->user();

		if (!$pf->endereco){
			return view('pessoaFisica.cadastroEndereco');
		}

		$endereco = PfEndereco::find($pf->id);

		return view('pessoaFisica.editarEndereco', compact('endereco'));
	}

	public function cadastroEndereco(Request $request)
	{
		$pf = auth()->user();

		$data = $this->validate($request, [
			'cep'=>'required|min:8',
			'logradouro'=>'required',
			'bairro'=>'required',
			'numero'=>'required|numeric',
			'complemento'=>'nullable',
			'cidade'=>'required',
			'uf'=>'required|max:2',
		]);
		$data['pessoa_fisica_id'] = $pf->id;

		$pf->endereco()->create($data);

		return redirect()->route('pessoaFisica.formEndereco')->with('flash_message',
		'Seu Endereço Foi Cadastrado Com Sucesso!');
	}

	public function atualizarEndereco(Request $request)
	{
		$pf = auth()->user();

		$data = $this->validate($request, [
			'cep'=>'required|min:8',
			'logradouro'=>'required',
			'bairro'=>'required',
			'numero'=>'required|numeric',
			'complemento'=>'nullable',
			'cidade'=>'required',
			'uf'=>'required|max:2',
		]);
		$data['pessoa_fisica_id'] = $pf->id;

		$pf->endereco()->update($data);

		return redirect()->route('pessoaFisica.formEndereco')->with('flash_message',
		'Seu Endereço Foi Atualizado Com Sucesso!');
	}

	public function formTelefones()
	{
		$tel = auth()->user()->telefone;

		if($tel){

			return view('pessoaFisica.editarTelefone', compact('tel'));
		}

		return view('pessoaFisica.cadastroTelefone');
	}

	public function cadastroTelefone(Request $request)
	{
		$pf = auth()->user();

		$data = $this->validate($request, [
			'telefone' =>'required_without:celular',
			'celular'  =>'required_without:telefone',
		]);
		$data['pessoa_fisica_id'] = $pf->id;


		if ($request->celular && $request->telefone){
			PfTelefone::create($data);

			$mensagem = 'Telefones Cadastrados';

		}elseif ($request->celular && !$request->telefone) {
			PfTelefone::create($data);

			$mensagem = 'Celular Cadastrados';
		}
		elseif (!$request->celular && $request->telefone) {
			PfTelefone::create($data);

			$mensagem = 'Telefone cadastrado';
		}

		return redirect()->route('pessoaFisica.formTelefones')->with('flash_message', "$mensagem com Sucesso!");
	}
	public function atualizaTelefone(Request $request)
	{
		$pf = auth()->user();

		$data = $this->validate($request, [
			'telefone' =>'required_without:celular',
			'celular'  =>'required_without:telefone',
		]);
		$data['pessoa_fisica_id'] = $pf->id;
			
		$telefone = PfTelefone::find($pf->id);

		if ($request->celular && $request->telefone){
			$telefone->update($data);

			$mensagem = 'Telefones Atualizados';
		}
		elseif ($request->celular && !$request->telefone){
			$telefone->update($data);

			$mensagem = 'Celular Atualizado';
		}
		elseif (!$request->celular && $request->telefone){
			$telefone->update($data);

			$mensagem = 'Telefone Atualizado';
		}
		
		return redirect()->route('pessoaFisica.formTelefones')->with('flash_message', "$mensagem com Sucesso!");

	}

	public function pendencias()
	{
		$pf = auth()->user();
		
		$notificacoes = [];

		if(!$pf->endereco){
			
			$notificacao = (object) 
			[
				'titulo'	=>	'Cadastro de Endereço Pendente',
				'aviso' 	=>	'Necessário Cadastrar Endereço',
				'rota' 		=>	 route('pessoaFisica.formEndereco'),
			];
			array_push($notificacoes, $notificacao);

		}

		if(!$pf->telefone){

			$notificacao = (object) 
			[
				'titulo'	=>	'Cadastro de Telefone Pendente',
				'aviso' 	=>	'Necessário Cadastrar Pelo Menos Um Telefone',
				'rota' 		=>	 route('pessoaFisica.formTelefones'),
			];
			array_push($notificacoes, $notificacao);
		}

		return view('pessoaFisica.pendencias', compact('notificacoes'));		
	}
	
}
