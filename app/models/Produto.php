<?php
class Produto extends BaseModel {

  protected $table = 'produtos';

  protected $stiClassField = 'class_name';
  protected $stiBaseClass = 'Produto';

  public function reviews()
  {
  	return $this->hasMany('Review', 'produto_id');
  }

  protected static function similares()
  {
  	return self::with('pais')->orderByRaw("RAND()")->take(3)->get();
  }

}