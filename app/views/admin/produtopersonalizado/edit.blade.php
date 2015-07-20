@extends('templates.admin')
@section('breadcrumbs')
<div class="page-title-container">
    <div class="container">
        <div class="page-title pull-left">
            <h2 class="entry-title">Criando Produtos personalizados para - "{{$cliente->nome}}"</h2>
        </div>
    </div>
</div>
@stop
@section('content')

{{Form::model($cliente, array('url' => array("admin/produto-personalizado"), 'method' => 'POST', 'files' => true))}}
		<input type="hidden" name="cliente_id" value="{{$cliente->id}}" />
		<div class="btn-toolbar" role="toolbar">
		    <div class="pull-left">
		    	<h2></h2>
			</div>
		    <div class="pull-right">
			    <a href="http://funworldtours.dev/admin/produto-personalizado" class="btn btn-default">Voltar para listagem</a>
			    <button type="submit" class="btn btn-success">Salvar</button>
		    </div>
	    </div>
	    <div style="clear: both; margin-bottom: 50px;">
	    </div>
		<div class="block">
		    <div class="tab-container trans-style box">
		        <ul class="tabs full-width">
		            <li class="active"><a href="#first-tab" data-toggle="tab"><i class="soap-icon-suitcase circle"></i>Dados do Cliente</a></li>
		            <li class=""><a href="#second-tab" data-toggle="tab"><i class="soap-icon-suitcase circle"></i>Produtos Personalizados</a></li>
		        </ul>
		        <div class="tab-content">
		            <div class="tab-pane fade active in" id="first-tab">
		                <h2 class="tab-content-title"> Dados do Cliente</h2>

		                <div class="form-group">
		                	<span id="div_nome_br"><label for="nome_br" class=" required">Id Cliente</label>
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
		                			<option value="{{$s->id}}" @if($s->id == 12) selected="selected" @endif > {{$s->nome_br}} </option>
		                		@endforeach
		                	</select>
		                </div>

       
		            </div>
		            <div class="tab-pane fade" id="second-tab">
		                <h2 class="tab-content-title"> Produtos do Pedido</h2>

		                <table class="table table-striped table-hover"> 
		                	<thead>
		                		<tr>
			                		<th>Nome</th>
			                		<th>Preço</th>
			                		<th>Quantidade</th>
			                		<th>Ações</th>
			                	</tr>
		                	</thead>
		                	<tbody id="produtos">


		                	</tbody>
		                </table>

		                <div>
		                	<button id="addproduto">Add produto</button>
		                </div>

		               <!--  <div id="total">
		                	<h2> Total: {{--$pedido->total--}} </h2>
		                </div> -->

		            </div>
            
	        </div>
	    </div>
	</div>
{{Form::close()}}
@stop


@section('scripts')

<script type="text/javascript">

		var i = 1;

		function addProduto()
		{
			tjq("#produtos").append(
									'<tr id="tr'+i+'">'+
			                			'<td><input type="text" name="produtos['+i+'][nome]" value="" /> </td>'+
			                			'<td><input type="text" name="produtos['+i+'][preco]"  value="" /></td>'+
			                			'<td><input type="text" name="produtos['+i+'][quantidade]" value="" /></td>'+
			                			'<td><button type="button" class="btn btn-danger remover" id="btn'+i+'" onClick="removeProduto('+i+');">-</button></td>'+
			                		 '</tr>'
									);

			i++;
		}

		function removeProduto(id)
		{
			tjq("#tr"+id).remove();

			console.log(id);
		}
	
	tjq(document).ready(function()
	{		

		tjq("#addproduto").click(function(event)
		{
			event.preventDefault();

			console.log(i);

			addProduto();

		});

		tjq(".remover").on('click', function(event)
		{
			event.preventDefault();

			alert(tjq(this));
			removeProduto(tjq(this).attr('id'));	
		});

	});

</script>

@stop


