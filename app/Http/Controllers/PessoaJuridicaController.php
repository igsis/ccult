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
		$pessoaJuridica = auth()->user();

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

		$pj = auth()->user();

		$pj->update([
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
		$pj = auth()->user();

		if (!$pj->endereco){
			return view('pessoaJuridica.cadastroEndereco');
		}

		$endereco = PjEndereco::find($pj->id);

		return view('pessoaJuridica.editarEndereco', compact('endereco'));
	}

	public function cadastroEndereco(Request $request)
	{
		$pj = auth()->user();

		$data = $this->validate($request, [
			'cep'=>'required|min:8',
			'logradouro'=>'required',
			'bairro'=>'required',
			'numero'=>'required|numeric',
			'complemento'=>'nullable',
			'cidade'=>'required',
			'uf'=>'required|max:2',
		]);

		$data['pessoa_juridica_id'] = $pj->id;

		$pj->endereco()->create($data);

		return redirect()->route('pessoaJuridica.formEndereco')->with('flash_message',
		'Endereço Foi Cadastrado Com Sucesso!');
	}

	public function atualizarEndereco(Request $request)
	{
		$pj = auth()->user();

		$data = $this->validate($request, [
			'cep'=>'required|min:8',
			'logradouro'=>'required',
			'bairro'=>'required',
			'numero'=>'required|numeric',
			'complemento'=>'nullable',
			'cidade'=>'required',
			'uf'=>'required|max:2',
		]);

		$data['pessoa_juridica_id'] = $pj->id;

		$pj->endereco()->update($data);

		return redirect()->route('pessoaJuridica.formEndereco')->with('flash_message',
		'Seu Endereço Foi Atualizado Com Sucesso!');
	}

	public function formTelefones()
	{
		$pj = auth()->user();

		if($pj->telefone){
			$tel = PjTelefone::find($pj->id);

			return view('pessoaJuridica.editarTelefone', compact('tel'));

		}
		return view('pessoaJuridica.cadastroTelefone');
	}

	public function cadastroTelefone(Request $request)
	{
		$pj = auth()->user();

		$data = $this->validate($request, [
			'telefone' =>'required_without:celular',
			'celular'  =>'required_without:telefone',
		]);
		$data['pessoa_juridica_id'] = $pj->id;

		if ($request->celular && $request->telefone){
			PjTelefone::create($data);

			return redirect()->route('pessoaJuridica.formTelefones')->with('flash_message',
			'Telefones Cadastrados Com Sucesso!');

		}elseif ($request->celular && !$request->telefone) {
			PjTelefone::create($data);

			return redirect()->route('pessoaJuridica.formTelefones')->with('flash_message',
			'Celular cadastrado com Sucesso!');
		}
		elseif (!$request->celular && $request->telefone) {
			PjTelefone::create($data);

			return redirect()->route('pessoaJuridica.formTelefones')->with('flash_message',
			'Telefone cadastrado com Sucesso!');
		}
	}
	public function atualizaTelefone(Request $request)
	{
	
		$pj = auth()->user();

		$data = $this->validate($request, [
			'telefone' =>'required_without:celular',
			'celular'  =>'required_without:telefone',
		]);
		$data['pessoa_juridica_id'] = $pj->id;

		$telefone = PjTelefone::find($pj->id);

		if ($request->celular && $request->telefone){
			$telefone->update($data);

			return redirect()->route('pessoaJuridica.formTelefones')->with('flash_message',
			'Telefones Atualizados Com Sucesso!');

		}elseif ($request->celular && !$request->telefone) {
			$telefone->update($data);

			return redirect()->route('pessoaJuridica.formTelefones')->with('flash_message',
			'Celular Atualizado com Sucesso!');
		}
		elseif (!$request->celular && $request->telefone) {
			$telefone->update($data);

			return redirect()->route('pessoaJuridica.formTelefones')->with('flash_message',
			'Telefone Atualizado com Sucesso!');
		}
	}
	public function formRepresentante()
	{
		$pj = auth()->user();

		$rep = $pj->representanteLegal1;
		$rep2 = $pj->representanteLegal2;

		if($rep && $rep2)
		{
			return view('pessoaJuridica.editarRepresentanteLegal', compact('rep', 'rep2'));

		}elseif ($rep) 
		{
			return view('pessoaJuridica.editarRepresentanteLegal', compact('rep'));
		}

		return view('pessoaJuridica.pesquisarRepresentanteLegal');

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

		if ($pj->representanteLegal2) {

			$mensagem = 'Você removeu o 1º Representante, '.$pj->representanteLegal1->nome 
			. '.<br> O 2º Representante, '. $pj->representanteLegal2->nome . ', Passou a ser o 1º Representante Legal!';

			$pj->update([
				'representante_legal1_id' => $pj->representanteLegal2->id,
				'representante_legal2_id' => null
			]);

			return redirect()->route('pessoaJuridica.formRepresentante')->with('warning',$mensagem);
		}
		$pj->update(['representante_legal1_id' => null]);

		return redirect()->route('pessoaJuridica.formRepresentante')->with('flash_message',
		'1º Representante Legal Foi Removido com Sucesso!');
	}

	public function formRepresentante2()
	{
		$rep = auth()->user()->representanteLegal2;

		if($rep)
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

		# Verifica se existe o 1º Representante legal 
		if($pj->representanteLegal1)
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
		'2º Representante Legal Atualizado com Sucesso!');
	}

	public function removerRepresentante2(Request $request)
	{
		$pj = auth()->user();

		$pj->update(['representante_legal2_id' => null]);

		return redirect()->route('pessoaJuridica.formRepresentante2')->with('flash_message',
		'2º Representante Foi Removido com Sucesso!');
	}

	public function search(Request $request, RepresentanteLegal $representanteLegal)
    {
		$dataForm = $request->except('_token');

		$this->validate($request, [
			'cpf' 		=>	'required|min:14|cpf',
		],
        [
            'required' => 'O campo :attribute é obrigatório para localizar o Representante Legal',
		],[
            'cpf'      => 'CPF',
        ]);

		$rep = $representanteLegal->search($dataForm)->first();

		if ($rep)
        
			return view('pessoaJuridica.cadastroRepresentanteLegal', compact('rep'))
				->with('flash_message', 'Verifique se o Representante Legal corresponde a Pesquisa');

		return view('pessoaJuridica.cadastroRepresentanteLegal')->with('cpf', $request->cpf);

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
		$pj = auth()->user();

		$data = $this->validate($request,[
			'nome' 	=> 'required',
			'rg' 	=> 'required',
		]);
		
		$rep = RepresentanteLegal::find($request->id);

		$rep->update($data);

		$pj->update(['representante_legal1_id' => $rep->id ]);

		return redirect()->route('pessoaJuridica.formRepresentante')->with('flash_message',
		'1º Representante Legal Vinculado com Sucesso!');
	}

	public function vincularRepresentante2(Request $request)
    {
		$data = $this->validate($request,[
			'nome' => 'required',
			'rg' => 'required',
		]);

		$pj = auth()->user();

		$rep = RepresentanteLegal::findOrFail($request->id);

		if($pj->representanteLegal1)
		{
			if($pj->representanteLegal1->id != $rep->id)
			{
				$pj->update(['representante_legal2_id' => $rep->id ]);

				$rep->update($data);

				return redirect()->route('pessoaJuridica.formRepresentante2')->with('flash_message',
					'2º Representante Legal Vinculado com Sucesso!');
			}
			return redirect()->back()
				->with('warning', 'Representate já foi cadastrado como 1º Representante Legal!');
		}

		$pj->update(['representante_legal1_id' => $rep->id ]);
		
		$rep->update($data);

		return redirect()->route('pessoaJuridica.formRepresentante')->with('flash_message',
			'Você tentou Vincular o 2º Representante antes do 1º Representante,<br>
			Devido a isso, esse Representqante foi Vinculado como 1º Representqante Legal!');

	}

	public function pendencias()
	{
		$pj = auth()->user();
		
		$notificacoes = [];

		if(!$pj->endereco){
			
			$notificacao = (object) 
			[
				'titulo'	=>	'Cadastro de Endereço Pendente',
				'aviso' 	=>	'Necessário Cadastrar Endereço',
				'rota' 		=>	 route('pessoaJuridica.formEndereco'),
			];
			array_push($notificacoes, $notificacao);

		}
		
		if(!$pj->telefone){

			$notificacao = (object) 
			[
				'titulo'	=>	'Cadastro de Telefone Pendente',
				'aviso' 	=>	'Necessário Cadastrar Pelo Menos Um Telefone',
				'rota' 		=>	 route('pessoaJuridica.formTelefones'),
			];
			array_push($notificacoes, $notificacao);
		}

		if(!$pj->representanteLegal1){

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
