<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ViaCEP 
{
    public function buscar(string $cep)
    {
        $url = sprintf('https://viacep.com.br/ws/%s/json/',$cep);
        $resposta = Http::get($url);
        dd($resposta);
        // if($resposta->failed()){
        //     return false;
        // }
        // $dados = $resposta->json();
        // dd($dados);
    }
}