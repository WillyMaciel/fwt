@extends('templates.admin')
@section('breadcrumbs')
<div class="page-title-container">
    <div class="container">
        <div class="page-title pull-left">
            <h2 class="entry-title">Hoteis - Criar</h2>
        </div>
    </div>
</div>
@stop
@section('content')

<form method="POST" action="{{URL::to('admin/hotel/')}}" enctype="multipart/form-data">
	<div class="btn-toolbar" role="toolbar">
	    <div class="pull-left">
	    	<h2></h2>
		</div>
	    <div class="pull-right">
		    <a href="http://funworldtours.dev/admin/hotel" class="btn btn-default">Voltar para listagem</a>
		    <button type="submit" class="btn btn-success">Salvar</button>
	    </div>
    </div>

	<div class="block">
	    <img id="img" src="uploads/hoteis/no-img.png" alt="" width="570" height="300" style="width: 100%; cursor: pointer;">
	    <div class="tab-container trans-style box">
	        <ul class="tabs full-width">
	            <li class="active"><a href="#first-tab" data-toggle="tab"><i class="circle"><img src="images/icon/flags/pt-br.png"></i>Português</a></li>
	            <li class=""><a href="#second-tab" data-toggle="tab"><i class="circle"><img src="images/icon/flags/en-us.png"></i>Inglês</a></li>
	            <li class=""><a href="#third-tab" data-toggle="tab"><i class="soap-icon-suitcase circle"></i>Infos Adicionais</a></li>
	            <li class=""><a href="#fourth-tab" data-toggle="tab"><i class="soap-icon-suitcase circle"></i>Caracteristicas</a></li>
	            <li class=""><a href="#fifth-tab" data-toggle="tab"><i class="soap-icon-suitcase circle"></i>Preços</a></li>
	            <li class=""><a href="#sixth-tab" data-toggle="tab"><i class="soap-icon-suitcase circle"></i>Imagens</a></li>
	        </ul>
	        <div class="tab-content">
	            <div class="tab-pane fade active in" id="first-tab">
	                <h2 class="tab-content-title"><img src="images/icon/flags/pt-br.png"> - Português Brasileiro</h2>
	                <div class="form-group">
	                    <span id="div_nome_br"><label for="nome_br" class=" required">Nome PT</label>
	                    <input class="form-control" type="text" id="nome_br" name="nome_br" value="">
	                    </span>
	                </div>
	                <div class="form-group">
	                    <span id="div_descricao_br"><label for="descricao_br" class="">Descricao PT</label>
	                    <textarea class="form-control" type="text" id="descricao_br" name="descricao_br" cols="50" rows="10"></textarea>
	                    </span>
	                </div>
	            </div>
	            <div class="tab-pane fade" id="second-tab">
	                <h2 class="tab-content-title"><img src="images/icon/flags/en-us.png"> - Inglês</h2>
	                <div class="form-group">
	                    <span id="div_nome_en"><label for="nome_en" class=" required">Nome EN</label>
	                    <input class="form-control" type="text" id="nome_en" name="nome_en" value="">
	                    </span>
	                </div>
	                <div class="form-group">
	                    <span id="div_descricao_en"><label for="descricao_en" class="">Descricao EN</label>
	                    <textarea class="form-control" type="text" id="descricao_en" name="descricao_en" cols="50" rows="10"></textarea>
	                    </span>
	                </div>
	            </div>
	            <div class="tab-pane fade" id="third-tab">
	                <h2 class="tab-content-title">Informações Adicionais</h2>
	                <div class="form-group">
	                    <span id="div_pais_id">
	                        <label for="pais_id" class="">Pais</label>
	                        <select class="form-control" type="select" id="pais_id" name="pais_id">
	                        	@foreach($paises as $key => $value)
	                        		<option value="{{$key}}"> {{$value}} </option>
	                        	@endforeach
	                        </select>
	                    </span>
	                </div>
	                <div class="form-group">
	                    <span id="div_nome_br"><label for="nome_br" class=" required">Cidade</label>
	                    	{{Form::text('cidade', null, array('class' => 'form-control', 'id' => 'cidade'))}}
	                    </span>
	                </div>
	                <div class="form-group">
	                    <span id="div_estrelas">
	                        <label for="estrelas" class="">Tipo de Hotel (Estrelas)</label>
	                        <select class="form-control" type="select" id="estrelas" name="estrelas">
	                            <option value="1" selected="selected">1</option>
	                            <option value="2">2</option>
	                            <option value="3">3</option>
	                            <option value="4">4</option>
	                            <option value="5">5</option>
	                        </select>
	                    </span>
	                </div>
	                <div class="form-group">
	                    <span id="div_publicado"><label for="publicado" class="">Publicado</label><input name="publicado" type="radio" value="0"> Não&nbsp;&nbsp;<input name="publicado" type="radio" value="1" checked=""> Sim&nbsp;&nbsp;</span>
	                </div>
	            </div>
	            <div class="tab-pane fade" id="fourth-tab">
	                <h2 class="tab-content-title">{{trans('menu.conveniencias')}}</h2>

	                <div class="tab-pane" id="hotel-amenities">

                       	<ul class="amenities clearfix style1">
                       	@foreach($caracteristicas as $c)	                        
	                            <li class="col-md-4 col-sm-6">
	                                <div class="icon-box style1"><i class="{{$c->icone}}"></i><input type="checkbox" name="caracteristicas[]" value="{{$c->id}}" /> {{$c->nome_br}}</div>
	                            </li>	                        
                        @endforeach   
                        </ul>    
                        
                    </div>

	            </div>
	            <div class="tab-pane fade" id="fifth-tab">
	                <h2 class="tab-content-title">Preços</h2>
	                <div class="form-group">
	                    <span id="div_valor_diaria"><label for="valor_diaria" class="">Valor</label>
	                    <input class="form-control" type="text" id="valor_diaria" name="valor" value="">
	                    </span>
	                </div>
	                <!-- <div class="form-group">
	                    <span id="div_deposito"><label for="deposito" class="">Valor do depósito de segurança</label>
	                    <input class="form-control" type="text" id="deposito" name="deposito" value="">
	                    </span>
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
</form>
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


		var i = 1;


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


