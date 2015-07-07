@extends('templates.admin')
@section('breadcrumbs')
<div class="page-title-container">
    <div class="container">
        <div class="page-title pull-left">
            <h2 class="entry-title">Pedido - Editando "{{$pedido->id}}"</h2>
        </div>
    </div>
</div>
@stop
@section('content')

{{Form::model($pedido, array('url' => array("admin/pedido", $pedido->id), 'method' => 'PUT', 'files' => true))}}
		<div class="btn-toolbar" role="toolbar">
		    <div class="pull-left">
		    	<h2></h2>
			</div>
		    <div class="pull-right">
			    <a href="http://funworldtours.dev/admin/pedido" class="btn btn-default">Voltar para listagem</a>
			    <button type="submit" class="btn btn-success">Salvar</button>
		    </div>
	    </div>
	    <div style="clear: both; margin-bottom: 50px;">
	    </div>
		<div class="block">
		    <div class="tab-container trans-style box">
		        <ul class="tabs full-width">
		            <li class="active"><a href="#first-tab" data-toggle="tab"><i class="soap-icon-suitcase circle"></i>Dados do Pedido</a></li>
		            <li class=""><a href="#second-tab" data-toggle="tab"><i class="soap-icon-suitcase circle"></i>Produtos do Pedido</a></li>
		            <li class=""><a href="#third-tab" data-toggle="tab"><i class="soap-icon-suitcase circle"></i>Histórico do Pedido</a></li>
		        </ul>
		        <div class="tab-content">
		            <div class="tab-pane fade active in" id="first-tab">
		                <h2 class="tab-content-title"> Dados do Pedido</h2>

		                <div class="form-group">
		                	<span id="div_nome_br"><label for="nome_br" class=" required">Id Pedido</label>
		                	{{Form::text('id', null, array('class' => 'form-control', 'id' => 'id', 'disabled' => 'disabled'))}}
		                </div>

		                <div class="form-group">
		                	<span id="div_descricao_br"><label for="descricao_br" class="">Nome do Cliente</label>
		                	{{Form::text('nome', null, array('class' => 'form-control', 'id' => 'nome', 'disabled' => 'disabled'))}}
		                </div>

		                <div class="form-group">
		                	<span id="div_descricao_br"><label for="descricao_br" class="">Email do Cliente</label>
		                	{{Form::text('email', null, array('class' => 'form-control', 'id' => 'email', 'disabled' => 'disabled'))}}
		                </div>

		                <div class="form-group">
		                	<span id="div_descricao_br"><label for="descricao_br" class="">Status do Pedido</label>

		                	<select class="form-control" name="status">
		                		@foreach($status as $s)
		                			<option value="{{$s->id}}" @if($s->id == $pedido->status->id) selected="selected" @endif > {{$s->nome_br}} </option>
		                		@endforeach
		                	</select>
		                </div>

		                <div class="form-group">
		                	<span id="div_descricao_br"><label for="descricao_br" class="">Observação</label>
		                	<textarea name="observacao" class="form-control"></textarea>
		                </div>
		                
		            </div>
		            <div class="tab-pane fade" id="second-tab">
		                <h2 class="tab-content-title"> Produtos do Pedido</h2>

		                <table class="table table-striped table-hover"> 
		                	<thead>
		                		<tr>
			                		<th>ID</th>
			                		<th>Nome (momento da compra)</th>
			                		<th>Preço (momento da compra)</th>
			                	</tr>
		                	</thead>
		                	<tbody>
			                	@foreach($pedido->produtos as $produto)
			                		<tr>
			                			<td>{{$produto->id}}</td>
			                			<td><a href="{{URL::to(strtolower($produto->class_name) . "/show/$produto->id")}}"> {{$produto->pivot->nome_br}} </a></td>
			                			<td>{{$produto->pivot->preco}}</td>
			                		</tr>
			                	@endforeach
		                	</tbody>
		                </table>

		            </div>

		            <div class="tab-pane fade" id="third-tab">
		                <h2 class="tab-content-title"> Histórico do Pedido</h2>

		                <table class="table table-striped table-hover"> 
		                	<thead>
		                		<tr>
			                		<th>ID</th>
			                		<th>Status</th>
			                		<th>Observacao</th>
			                		<th>Data</th>
			                	</tr>
		                	</thead>
		                	<tbody>
			                	@foreach($pedido->historico as $h)
			                		<tr>
			                			<td>{{$h->id}}</td>
			                			<td>{{$h->status->nome_br}}</td>
			                			<td>{{$h->observacao}}</td>
			                			<td>{{$h->created_at}}</td>
			                		</tr>
			                	@endforeach
		                	</tbody>
		                </table>

		            </div>		            
	        </div>
	    </div>
	</div>
{{Form::close()}}
@stop


@section('scripts')



@stop


