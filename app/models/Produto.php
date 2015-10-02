<?php
class Produto extends BaseModel {

  protected $table = 'produtos';

  protected $stiClassField = 'class_name';
  protected $stiBaseClass = 'Produto';

  public function getValorAttribute($valor)
  {
    return $this->calculaFormataValor($valor);
  }

  public function getValorMasculinoAttribute($valor)
  {
    return $this->calculaFormataValor($valor);
  }

  public function getValorFemininoAttribute($valor)
  {
    return $this->calculaFormataValor($valor);
  }

  public function reviews()
  {
  	return $this->hasMany('Review', 'produto_id');
  }

  protected static function similares()
  {
  	return self::with('pais')->orderByRaw("RAND()")->take(3)->get();
  }

  private function calculaFormataValor($valor)
  {
    // if(Session::get('moeda')->moeda == 'USD')
    // {
    //   $valor = $valor / Configuracao::where('param', 'cotacao_dolar')->first()->valor;

    //   $valor = number_format($valor, 2, '.', ',');
    // }
    // else
    // {
    //   $valor = number_format($valor, 2, ',', '.');
    // }

    $valor = number_format($valor, 2, ',', '.');

    return $valor;
  }

}