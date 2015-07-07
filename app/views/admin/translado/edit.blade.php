@extends('templates.admin')
@section('breadcrumbs')
<div class="page-title-container">
    <div class="container">
        <div class="page-title pull-left">
            <h2 class="entry-title">translados - Editando "{{$translado->nome_br}}"</h2>
        </div>
    </div>
</div>
@stop
@section('content')

{{Form::model($translado, array('url' => array("admin/translado", $translado->id), 'method' => 'PUT', 'files' => true))}}
		<div class="btn-toolbar" role="toolbar">
		    <div class="pull-left">
		    	<h2></h2>
			</div>
		    <div class="pull-right">
			    <a href="http://funworldtours.dev/admin/translado" class="btn btn-default">Voltar para listagem</a>
			    <button type="submit" class="btn btn-success">Salvar</button>
		    </div>
	    </div>
		<div class="block">
			<img id="img" src="@if($translado->imagem) uploads/translados/{{$translado->imagem}} @else images/no-img.png @endif" alt="" width="570" height="300" style="width: 100%; cursor: pointer;">
		    <div class="tab-container trans-style box">
		        <ul class="tabs full-width">
		            <li class="active"><a href="#first-tab" data-toggle="tab"><i class="circle"><img src="images/icon/flags/pt-br.png"></i>Português</a></li>
		            <li class=""><a href="#second-tab" data-toggle="tab"><i class="circle"><img src="images/icon/flags/en-us.png"></i>Inglês</a></li>
		            <li class=""><a href="#third-tab" data-toggle="tab"><i class="soap-icon-suitcase circle"></i>Infos Adicionais</a></li>
		            <!-- <li class=""><a href="#fourth-tab" data-toggle="tab"><i class="soap-icon-suitcase circle"></i>Caracteristicas</a></li> -->
		            <li class=""><a href="#fifth-tab" data-toggle="tab"><i class="soap-icon-suitcase circle"></i>Preços</a></li>
		            <li class=""><a href="#sixth-tab" data-toggle="tab"><i class="soap-icon-suitcase circle"></i>Imagens</a></li>
		        </ul>
		        <div class="tab-content">
		            <div class="tab-pane fade active in" id="first-tab">
		                <h2 class="tab-content-title"><img src="images/icon/flags/pt-br.png"> - Português Brasileiro</h2>

		                <div class="form-group">
		                	<span id="div_nome_br"><label for="nome_br" class=" required">Nome PT</label>
		                	{{Form::text('nome_br', null, array('class' => 'form-control', 'id' => 'nome_br'))}}
		                </div>

		                <div class="form-group">
		                	<span id="div_descricao_br"><label for="descricao_br" class="">Descricao PT</label>
		                	{{Form::textarea('descricao_br', null, array('class' => 'form-control', 'id' => 'nome_br', 'cols' => 50, 'rows' => 10))}}
		                </div>

		            </div>
		            <div class="tab-pane fade" id="second-tab">
		                <h2 class="tab-content-title"><img src="images/icon/flags/en-us.png"> - Inglês</h2>

		                <div class="form-group">
		                	<span id="div_nome_en"><label for="nome_en" class=" required">Nome EN</label>
		                	{{Form::text('nome_en', null, array('class' => 'form-control', 'id' => 'nome_en'))}}
		                </div>

		                <div class="form-group">
		                	<span id="div_descricao_en"><label for="descricao_en" class="">Descricao EN</label>
		                	{{Form::textarea('descricao_en', null, array('class' => 'form-control', 'id' => 'nome_en', 'cols' => 50, 'rows' => 10))}}
		                </div>

		            </div>
		            <div class="tab-pane fade" id="third-tab">
		                <h2 class="tab-content-title">Informações Adicionais</h2>

		               <div class="form-group">
		                    <span id="div_pais_id">
		                        <label for="pais_id" class="">Pais</label>
		                        {{Form::select('pais_id', $paises, null, array('class' => 'form-control', 'id' => 'pais_id'))}}
		                    </span>
		                </div>

		                <div class="form-group">
		                    <span id="div_publicado"><label for="publicado" class="">Publicado</label>
		                    {{Form::radio('publicado', 0)}} Não&nbsp;&nbsp;{{Form::radio('publicado', 1, true)}} Sim&nbsp;&nbsp;</span>
		                </div>

		            </div>
		            <!-- <div class="tab-pane fade" id="fourth-tab">
		                <h2 class="tab-content-title">Fourth Tab</h2>
		            </div> -->
		            <div class="tab-pane fade" id="fifth-tab">
		                <h2 class="tab-content-title">Preços</h2>

		            <div class="form-group">
	                    <span id="div_valor_diaria"><label for="valor_diaria" class="">Valor</label>
	                    {{Form::text('valor', null, array('class' => 'form-control', 'id' => 'valor'))}}
	                    </span>
	                </div>

		                <!-- <div class="form-group">
		                	{{--$form->render('deposito')--}}
		                </div> -->

		            </div>
	            <div class="tab-pane fade" id="sixth-tab">
	                <h2 class="tab-content-title">Imagens</h2>


	                <div id="imagens" class="form-group">
	                	<!-- <div class="row">
							<div class="col-md-8">
								<span id="div_imagem"><label for="imagem" class="">Imagem Principal</label>
									<input class="form-control imginput" type="file" id="imagem" name="imagem">
								</span>
							</div>
							<div class="col-md-4">
								<img id="img" src="uploads/hoteis/no-img.png" alt="" style="width: 100%; height: 100%; cursor: pointer;">
							</div>
						</div> -->

						{? $i = 0 ?}
						@foreach($translado->imagens as $img)
						<div class="row">
						    <div class="col-md-6"><span><label class="">Imagem {{$i}}</label><input class="form-control imginput" type="file" id="{{$i}}" name="imagens[{{$img->id}}]"></span></div>
						    <div class="col-md-2"><span><label class="">Deletar Imagem</label> <button type="button" class="btn btn-danger delimg" inputid = "{{$i}}" imgid="{{$img->id}}"> Deletar </button> </div>
						    <div class="col-md-4"><img id="img{{$i}}" src="{{$img->caminho}}{{$img->nome}}" alt="" style="width: 100%; height: 100%; cursor: pointer;"></div>
						</div>
						{? $i++ ?}
						@endforeach

	                </div>

	                <div class="form-group">
	                	<a class="btn btn-default" id="addimg">Adicionar Imagem</a>
	                </div>

	                <!-- <div class="row">
						<div class="col-md-8">
							<span id="div_imagem"><label for="imagem" class="">Imagem Principal</label>
								<input class="form-control" type="file" id="imagem" name="imagem">
							</span>
						</div>
						<div class="col-md-4">
							<img id="img" src="uploads/hoteis/no-img.png" alt="" style="width: 100%; height: 100%; cursor: pointer;">
						</div>
					</div> -->


	                <div class="form-group" style="display: none;">
	                    <span id="div_imagem"><label for="imagem" class="">Imagem Principal</label>
	                    <input class="form-control" type="file" id="imagem" name="imagem">
	                    </span>
	                </div>
	            </div>
	        </div>
	    </div>
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

	function readURL2(input, imgid) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $(imgid).attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
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


		@if($translado->imagens->count() > 1)
			var i = {{$translado->imagens->count()}}
		@else
			var i = 1;
		@endif

		$("#addimg").click(function()
		{
			$("#imagens").append('<div class="row"><div class="col-md-6"><span><label class="">Imagem '+ i +'</label><input class="form-control imginput" type="file" id="'+i+'" name="imagens[]"></span></div><div class="col-md-2"><span><label class="">Deletar Imagem</label> <button type="button" class="btn btn-danger delimg" inputid = "'+i+'"> Deletar </button> </div><div class="col-md-4"><img id="img'+i+'" src="uploads/hoteis/no-img.png" alt="" style="width: 100%; height: 100%; cursor: pointer;"></div></div>');
			i++;
		});

		$(document).on('click', '.delimg', function()
		{
			var id = $(this).attr('imgid');

			var imgdiv = $(this).parent().closest('.row');

			if(id)
			{
				$.post( "{{URL::to('admin/imagem/delete')}}/" + id, { _token: "{{csrf_token()}}"} ).done(function(data)
				{
					imgdiv.remove();
				});
			}
			else
			{
				imgdiv.remove();
			}

		});

	});

</script>

@stop


