<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diarista extends Model
{
    use HasFactory;
    /**
     * define os campos que podem ser gravados
     *
     * @var array
     */
    protected $fillable = ['nome_completo', 'cpf', 'email', 'telefone', 'logradouro', 'numero','complemento', 'bairro', 'cidade', 'estado', 'cep', 'codigo_ibge', 'foto_usuario'];

    /**
     * define os campos que serão usados na serialização
     *
     * @var array
     */
    protected $visible = ['nome_completo','cidade','foto_usuario','reputacao'];
    
    /**
     * adciona campos na serialização
     *
     * @var array
     */
    protected $appends = ['reputacao'];

    /**
     * monta a url da imagem
     *
     * @param string $valor
     * @return void
     */
    public function getFotoUsuarioAttribute(string $valor)
    {
        return config('app.url') . '/' . $valor;
    }

    /**
     * retorna a serialização randomica
     *
     * @param [type] $valor
     * @return void
     */
    public function getReputacaoAttribute($valor)
    {
        return mt_rand(1,5);
    }

    /**
     * busca diaristas por codigo ibge
     *
     * @param integer $codigoIbge
     * @return void
     */
    static public function buscaPorCodigoIbge(int $codigoIbge)
    {
       return self::where('codigo_ibge',$codigoIbge)->limit(6)->get();
    }

    /**
     * retorna a quantidade de diaristas
     *
     * @param integer $codigoIbge
     * @return void
     */
     static public function quantidadePorCodigoIbge(int $codigoIbge)
    {
       $quantidade =  self::where('codigo_ibge',$codigoIbge)->count();
       return $quantidade > 6 ? $quantidade - 6 : 0;
    }
}