@extends('templates.admin')
@section('breadcrumbs')
<div class="page-title-container">
    <div class="container">
        <div class="page-title pull-left">
            <h2 class="entry-title">Configurações</h2>
        </div>
    </div>
</div>
@stop
@section('content')

@include('elements.alerts')

{{Form::open(array('url' => array("admin/configuracao"), 'method' => 'POST', 'files' => true))}}
		<div class="btn-toolbar" role="toolbar">
		    <div class="pull-left">
		    	<h2></h2>
			</div>
		    <div class="pull-right">
			    <a href="{{URL::to('admin/pacote')}}" class="btn btn-default">Voltar para listagem</a>
			    <button type="submit" class="btn btn-success">Salvar</button>
		    </div>
	    </div>
		<div class="block">
			<img id="img" src="images/no-img.png" alt="" width="570" height="300" style="width: 100%; cursor: pointer;">
		    <div class="tab-container trans-style box">
		        <ul class="tabs full-width">
		            <li class="active"><a href="#first-tab" data-toggle="tab"><i class="circle"><img src="images/icon/flags/pt-br.png"></i>Configurações</a></li>
		        </ul>
		        <div class="tab-content">
		            <div class="tab-pane fade active in" id="first-tab">
		                <h2 class="tab-content-title">Configuração</h2>

		                <div class="form-group">
		                	<span id="div_nome_br"><label for="nome_br" class=" required">Cotação Dolar</label>
		                	{{Form::text('cotacao_dolar', $cotacao_dolar->valor, array('class' => 'form-control', 'id' => 'nome_br'))}}
		                </div>

		                <div class="form-group">
		                	<span id="div_descricao_br"><label for="descricao_br" class="">Cotação Euro</label>
		                	{{Form::text('cotacao_euro', $cotacao_euro->valor, array('class' => 'form-control'))}}
		                </div>

	        </div>
	    </div>
	</div>
{{Form::close()}}
@stop