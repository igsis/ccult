<?php

namespace ccult\Http\Controllers;

use Illuminate\Http\Request;
use ccult\Models\PjEndereco;
use ccult\Models\PjTelefone;
use ccult\Models\PessoaJuridica;
use ccult\Models\RepresentanteLegal;

class PessoaJuridicaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:pessoaJuridica');
    }

    public function index()
    {
        return view('pessoaJuridica.home');
    }

    public function show()
    {
		$id = auth()->user()->id;
		$pessoaJuridica = PessoaJuridica::find($id);
        return view('pessoaJuridica.cadastro', compact('pessoaJuridica'));
    }

    public function update(Request $request)
    {

		$data = $this->validate($request, [
			'razaoSocial' => 'required|string',
			// 'documento' => 'required',
			'ccm' => 'nullable',
			'email' => 'required|string|email|max:255',
		]);

		$id = auth()->user()->id;

		$pessoaJuridica = PessoaJuridica::findOrFail($id);

		$pessoaJuridica->update([
			'razao_social' => $request->razaoSocial,
			// 'documento_tipo_id' => $request->documento_tipo_id,
			'ccm' => $request->ccm,
			'email' => $request->email,
		]);

    	return redirect()->back()->with('flash_message',
            'Os Dados Foram Atualizados Com Sucesso!');

	}
	
	public function endereco()
	{
		if (!isset(auth()->user()->endereco->cep)){
			return view('pessoaJuridica.cadastroEndereco');
		}
		
		$id = auth()->user()->id;
		$endereco = PjEndereco::where('pessoa_juridica_id', '=', $id)->first();

		return view('pessoaJuridica.editarEndereco', compact('endereco'));
	}

	public function cadastroEndereco(Request $request)
	{
		$id = auth()->user()->id;
		$pj = PessoaJuridica::findOrFail($id);

		$this->validate($request, [
			'cep'=>'required|min:8',
			'logradouro'=>'required',
			'bairro'=>'required',
			'numero'=>'required|numeric',
			'complemento'=>'nullable',
			'cidade'=>'required',
			'uf'=>'required|max:2',
		]);

		$pj->endereco()->create([
			'pessoa_juridica_id' => $id,
			'cep' => $request->cep,
			'logradouro' => $request->logradouro,
			'numero' => $request->numero,
			'complemento' => $request->complemento,
			'bairro' => $request->bairro,
			'cidade' => $request->cidade,
			'uf' => $request->uf
		]);

		return redirect()->route('pessoaJuridica.formEndereco')->with('flash_message',
		'Endereço Foi Cadastrado Com Sucesso!');
	}

	public function atualizarEndereco(Request $request)
	{
		$id = auth()->user()->id;
		$pj = PessoaJuridica::findOrFail($id);

		$this->validate($request, [
			'cep'=>'required|min:8',
			'logradouro'=>'required',
			'bairro'=>'required',
			'numero'=>'required|numeric',
			'complemento'=>'nullable',
			'cidade'=>'required',
			'uf'=>'required|max:2',
		]);

		$pj->endereco()->update([
			'pessoa_juridica_id' => $id,
			'cep' => $request->cep,
			'logradouro' => $request->logradouro,
			'numero' => $request->numero,
			'complemento' => $request->complemento,
			'bairro' => $request->bairro,
			'cidade' => $request->cidade,
			'uf' => $request->uf
		]);

		return redirect()->route('pessoaJuridica.formEndereco')->with('flash_message',
		'Seu Endereço Foi Atualizado Com Sucesso!');
	}

	public function formTelefones()
	{
		$id = auth()->user()->id;

		if(auth()->user()->telefones->count() > 0){
			$tel = PjTelefone::where('pessoa_juridica_id', $id)->first();

			return view('pessoaJuridica.editarTelefone', compact('tel'));

		}
		return view('pessoaJuridica.cadastroTelefone');
	}

	public function cadastroTelefone(Request $request)
	{
		$id = auth()->user()->id;

		$this->validate($request, [
			'telefone' =>'required_without:celular',
			'celular'  =>'required_without:telefone',
		]);

		if ($request->celular && $request->telefone){
			PjTelefone::create([
				'pessoa_juridica_id'	=> $id,
				'telefone' 		  	=> $request->telefone,
				'celular' 		  	=> $request->celular
			]);

			return redirect()->route('pessoaJuridica.formTelefones')->with('flash_message',
			'Telefones Cadastrados Com Sucesso!');

		}elseif ($request->celular && !$request->telefone) {
			PjTelefone::create([
				'pessoa_juridica_id'	=> $id,
				'celular' 		  	=> $request->celular
			]);

			return redirect()->route('pessoaJuridica.formTelefones')->with('flash_message',
			'Celular cadastrado com Sucesso!');
		}
		elseif (!$request->celular && $request->telefone) {
			PjTelefone::create([
				'pessoa_juridica_id'	=> $id,
				'telefone' 		  	=> $request->telefone,
			]);

			return redirect()->route('pessoaJuridica.formTelefones')->with('flash_message',
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
		$telefone = PjTelefone::where('pessoa_juridica_id', $id)->first();

		if ($request->celular && $request->telefone){
			$telefone->update([
				'pessoa_juridica_id'	=> $id,
				'telefone' 		  	=> $request->telefone,
				'celular' 		  	=> $request->celular
			]);

			return redirect()->route('pessoaJuridica.formTelefones')->with('flash_message',
			'Telefones Atualizados Com Sucesso!');

		}elseif ($request->celular && !$request->telefone) {
			$telefone->update([
				'pessoa_juridica_id'	=> $id,
				'telefone' 		  	=> '',
				'celular' 		  	=> $request->celular
			]);

			return redirect()->route('pessoaJuridica.formTelefones')->with('flash_message',
			'Celular Atualizado com Sucesso!');
		}
		elseif (!$request->celular && $request->telefone) {
			$telefone->update([
				'pessoa_juridica_id'	=> $id,
				'telefone' 		  	=> $request->telefone,
				'celular' 		  	=> ''
			]);

			return redirect()->route('pessoaJuridica.formTelefones')->with('flash_message',
			'Telefone Atualizado com Sucesso!');
		}
	}
	public function formRepresentante()
	{
		$rep = auth()->user()->representanteLegal1;

		if(auth()->user()->representanteLegal1)
		{
			return view('pessoaJuridica.editarRepresentanteLegal', compact('rep'));
		}

		return view('pessoaJuridica.cadastroRepresentanteLegal');

	}

	public function cadastroRepresentante(Request $request)
	{
		$pj = auth()->user();
		$data = $this->validate($request, [
			'nome' 		=>	'required|string',
			'rg'  		=>	'required',
			'cpf' 		=>	'required|unique:representante_legais|min:14'
		]);

		$rep = RepresentanteLegal::create($data);	

		$pj->update(['representante_legal1_id' => $rep->id]);

		return redirect()->route('pessoaJuridica.formRepresentante')->with('flash_message',
		'1º Representante Legal Inserido com Sucesso!');
	}

	public function editarRepresentante(Request $request)
	{
		$pj = auth()->user();
		$data = $this->validate($request, [
			'nome' 		=>	'required',
			'rg'  		=>	'required',
		]);

		$pj->representanteLegal1()->update($data);

		return redirect()->route('pessoaJuridica.formRepresentante')->with('flash_message',
		'1º Representante Legal Atualizado com Sucesso!');
	}

	public function removerRepresentante(Request $request)
	{
		$pj = auth()->user();
		$pj->update(['representante_legal1_id' => null]);

		return redirect()->route('pessoaJuridica.formRepresentante')->with('flash_message',
		'1º Representante Legal Foi Removido com Sucesso!');
	}

	public function formRepresentante2()
	{
		$rep = auth()->user()->representanteLegal2;

		if(auth()->user()->representanteLegal2)
		{
			return view('pessoaJuridica.editarRepresentanteLegal2', compact('rep'));
		}
		
		return view('pessoaJuridica.cadastroRepresentanteLegal2');
	}

	public function cadastroRepresentante2(Request $request)
	{
		$pj = auth()->user();
		$data = $this->validate($request, [
			'nome' 		=>	'required|string',
			'rg'  		=>	'required',
			'cpf' 		=>	'required|unique:representante_legais|min:14'
		]);

		$rep = RepresentanteLegal::create($data);	

		if(auth()->user()->representanteLegal1)
		{
			$pj->update(['representante_legal2_id' => $rep->id]);

			return redirect()->route('pessoaJuridica.formRepresentante2')->with('flash_message',
			'2º Representante Legal Inserido com Sucesso!');
		}

		$pj->update(['representante_legal1_id' => $rep->id]);
			
		return redirect()->route('pessoaJuridica.formRepresentante')->with('flash_message',
			'Você tentou cadastrar o 2º Representante antes do 1º Representante,<br>
			Devido a isso, esse Representqante foi inserido como 1º Representqante Legal!');


	}

	public function editarRepresentante2(Request $request)
	{
		$pj = auth()->user();
		$data = $this->validate($request, [
			'nome' 		=>	'required',
			'rg'  		=>	'required',
		]);

		$pj->representanteLegal1()->update($data);

		return redirect()->route('pessoaJuridica.formRepresentante2')->with('flash_message',
		'1º Representante Legal Atualizado com Sucesso!');
	}

	public function removerRepresentante2(Request $request)
	{
		$pj = auth()->user();
		$pj->update(['representante_legal2_id' => null]);

		return redirect()->route('pessoaJuridica.formRepresentante')->with('flash_message',
		'2º Representante Foi Removido com Sucesso!');
	}

	public function search(Request $request, RepresentanteLegal $representanteLegal)
    {
		$dataForm = $request->except('_token');
		
		$this->validate($request, [
			'cpf2' 		=>	'required|min:14',
		],
        [
            'required' => 'O campo :attribute é obrigatório para localizar o Representante Legal',
        ], [
            'cpf2'      => 'CPF',
        ]);

		$rep = $representanteLegal->search($dataForm)->first();

		if ($rep)
        
			return view('pessoaJuridica.cadastroRepresentanteLegal', compact('rep'))
				->with('flash_message', 'Verifique se o Representante Legal corresponde a Pesquisa');

		return redirect()->back()
				->with('warning', 'Não existe Representante Legal Cadastrado Com Esse CPF');


	} 
	
	public function search2(Request $request, RepresentanteLegal $representanteLegal)
    {
		$dataForm = $request->except('_token');
		
		$this->validate($request, [
			'cpf2' 		=>	'required|min:14',
		],
        [
            'required' => 'O campo :attribute é obrigatório para localizar o Representante Legal',
        ], [
            'cpf2'      => 'CPF',
        ]);

		$rep = $representanteLegal->search($dataForm)->first();

		if ($rep)
        
			return view('pessoaJuridica.cadastroRepresentanteLegal2', compact('rep'))
				->with('flash_message', 'Verifique se o Representante Legal corresponde a Pesquisa');

		return redirect()->back()
				->with('warning', 'Não existe Representante Legal Cadastrado Com Esse CPF');
    }  
	
	public function vincularRepresentante(Request $request)
    {
		$data = $this->validate($request,[
			'nome' => 'required',
			'rg' => 'required',
		]);

		$rep = RepresentanteLegal::findOrFail($request->id);

		$rep->update($data);

		$pj = auth()->user();

		$pj->update(['representante_legal1_id' => $request->id ]);

		return redirect()->route('pessoaJuridica.formRepresentante')->with('warning',
		'1º Representante Legal Vinculado com Sucesso!');
	}

	public function vincularRepresentante2(Request $request)
    {
		$data = $this->validate($request,[
			'nome' => 'required',
			'rg' => 'required',
		]);

		$rep = RepresentanteLegal::findOrFail($request->id);

		$rep->update($data);

		$pj = auth()->user();

		if(auth()->user()->representanteLegal1)
		{
			$pj->update(['representante_legal2_id' => $request->id ]);

			return redirect()->route('pessoaJuridica.formRepresentante2')->with('flash_message',
			'2º Representante Legal Vinculado com Sucesso!');
		}

		$pj->update(['representante_legal1_id' => $request->id ]);

		return redirect()->route('pessoaJuridica.formRepresentante')->with('flash_message',
			'Você tentou Vincular o 2º Representante antes do 1º Representante,<br>
			Devido a isso, esse Representqante foi Vinculado como 1º Representqante Legal!');

	}

	public function pendencias()
	{
		$notificacoes = [];

		if(!isset(auth()->user()->endereco->cep)){
			
			$notificacao = (object) 
			[
				'titulo'	=>	'Cadastro de Endereço Pendente',
				'aviso' 	=>	'Necessário Cadastrar Endereço',
				'rota' 		=>	 route('pessoaJuridica.formEndereco'),
			];
			array_push($notificacoes, $notificacao);

		}

		if(!auth()->user()->telefones->count() > 0){

			$notificacao = (object) 
			[
				'titulo'	=>	'Cadastro de Telefone Pendente',
				'aviso' 	=>	'Necessário Cadastrar Pelo Menos Um Telefone',
				'rota' 		=>	 route('pessoaJuridica.formTelefones'),
			];
			array_push($notificacoes, $notificacao);
		}

		if(!auth()->user()->representante_legal1_id){

			$notificacao = (object) 
			[
				'titulo'	=>	'Cadastro de Representante Legal Pendente',
				'aviso' 	=>	'Necessário Cadastrar Pelo Menos Um Representante Legal',
				'rota' 		=>	 route('pessoaJuridica.formRepresentante'),
			];
			array_push($notificacoes, $notificacao);
		}

		return view('pessoaJuridica.pendencias', compact('notificacoes'));
	}
}
