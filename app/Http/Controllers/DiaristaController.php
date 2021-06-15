<?php

namespace App\Http\Controllers;

use App\Models\Diarista;
use Illuminate\Http\Request;

class DiaristaController extends Controller
{
    /**
     * Lista as diaristas
     *
     * @return void
     */
    public function index(){
        $diaristas = Diarista::get();
        return view('index', [
            'diaristas' => $diaristas
        ]);
    }
    /**
     * Mostra o formulario de criação
     *
     * @return void
     */
    public function create(){
        return view('create');
    }
    /**
     * cria uma diarista no banco de dados
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request){
        $dados = $request->except('_token');//nao pega o valor do token
        $dados['foto_usuario'] = $request->foto_usuario->store('public');
        //faz upload do arquivo e salva dentro do campo 'foto_usuario'
        $dados['cpf'] = str_replace(['.' , '-'],'',$dados['cpf']); // remove a mascara
        $dados['cep'] = str_replace(['-'],'',$dados['cep']); // remove a mascara
        $dados['telefone'] = str_replace(['(' , ')',' ', '-'],'',$dados['telefone']); // remove a mascara
        Diarista::create($dados);//recebe os dados que quero criar
        return redirect()->route('diaristas.index'); // redireciona para a pagina que eu quero
    }
    /**
     * mostra o formulario de edição populado
     *
     * @param integer $id
     * @return void
     */
    public function edit(int $id){
        $diarista = Diarista::findOrFail($id);
        return view('edit', [
            'diarista' => $diarista
        ]);
    }
    /**
     * atualiza uma diarista no banco de dados
     *
     * @param integer $id
     * @param Request $request
     * @return void
     */
    public function update(int $id, Request $request){
        $diarista = Diarista::findOrFail($id);
        $dados = $request->except(['_token', '_method']);
        $dados['cpf'] = str_replace(['.' , '-'],'',$dados['cpf']); // remove a mascara
        $dados['cep'] = str_replace(['-'],'',$dados['cep']); // remove a mascara
        $dados['telefone'] = str_replace(['(' , ')',' ', '-'],'',$dados['telefone']); // remove a mascara
        if($request->hasFile('foto_usuario')){
            $dados['foto_usuario'] = $request->foto_usuario->store('public');
        };
        $diarista->update($dados);
        return redirect()->route('diaristas.index');
    }
    /**
     * apaga uma diarista no banco de dados
     *
     * @param integer $id
     * @return void
     */
    public function destroy(int $id){
        $diarista = Diarista::findOrFail($id);
        $diarista->delete();
        return redirect()->route('diaristas.index');
    }
}