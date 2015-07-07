@extends('templates.admin')
@section('breadcrumbs')
<div class="page-title-container">
    <div class="container">
        <div class="page-title pull-left">
            <h2 class="entry-title">Continente - Editando "{{$continente->name_pt}}"</h2>
        </div>
    </div>
</div>
@stop
@section('content')


{{Form::model($continente, array('url' => array("admin/continente", $continente->code), 'method' => 'PUT', 'files' => true))}}
		<div class="btn-toolbar" role="toolbar">
		    <div class="pull-left">
		    	<h2></h2>
			</div>
		    <div class="pull-right">
			    <a href="{{URL::to('admin/continente')}}" class="btn btn-default">Voltar para listagem</a>
			    <button type="submit" class="btn btn-success">Salvar</button>
		    </div>
	    </div>
		<div class="block">
			<img id="img" src="@if($continente->imagem){{$continente->imagem}} @else images/no-img.png @endif" alt="" width="570" height="300" style="width: 100%; cursor: pointer;">
		</div>

		<div class="form-group" style="display: none;">
            <span id="div_imagem"><label for="imagem" class="">Imagem Principal</label>
            <input class="form-control" type="file" id="imagem" name="imagem">
            </span>
        </div>
{{Form::close()}}


@stop


@section('scripts')


<script type="text/javascript">
	function readURL()
	{
		//	rehide the image and remove its current "src",
		//	this way if the new image doesn't load,
		//	then the image element is "gone" for now
		if (this.files && this.files[0])
		{
			var reader = new FileReader();
			$(reader).load(function(e) {
				$('#img')
				//	first we set the attribute of "src" thus changing the image link
				.attr('src', e.target.result)	//	this will now call the load event on the image
			});
			reader.readAsDataURL(this.files[0]);
		}
	}


	$(document).ready(function()
	{
		$("#imagem").change(readURL);

		$("#img").click(function()
		{
			$("#imagem").trigger('click');
		});

		$("#imagens").on("change", ".imginput", function(event)
		{
			event.preventDefault();
			readURL2(this, '#img'+this.id);
		});


	});


</script>


@stop


