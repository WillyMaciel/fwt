@extends('templates.admin')
@section('breadcrumbs')
<div class="page-title-container">
    <div class="container">
        <div class="page-title pull-left">
            <h2 class="entry-title">Pacotes - Criar</h2>
        </div>
    </div>
</div>
@stop
@section('content')

{{ $form->header }}

	{{ $form->message }}

    @if(!$form->message)

		<div class="block">
			<img id="img" src="uploads/passeios/{{$form->field('imagem')->value or 'no-img.png'}}" alt="" width="570" height="300" style="width: 100%; cursor: pointer;">
		    <div class="tab-container trans-style box">
		        <ul class="tabs full-width">
		            <li class="active"><a href="#first-tab" data-toggle="tab"><i class="circle"><img src="images/icon/flags/pt-br.png"></i>Português</a></li>
		            <li class=""><a href="#second-tab" data-toggle="tab"><i class="circle"><img src="images/icon/flags/en-us.png"></i>Inglês</a></li>
		            <li class=""><a href="#third-tab" data-toggle="tab"><i class="soap-icon-suitcase circle"></i>Infos Adicionais</a></li>
		            <!-- <li class=""><a href="#fourth-tab" data-toggle="tab"><i class="soap-icon-suitcase circle"></i>Caracteristicas</a></li> -->
		            <!-- <li class=""><a href="#fifth-tab" data-toggle="tab"><i class="soap-icon-suitcase circle"></i>Preços</a></li> -->
		            <li class=""><a href="#sixth-tab" data-toggle="tab"><i class="soap-icon-suitcase circle"></i>Imagens</a></li>
		        </ul>
		        <div class="tab-content">
		            <div class="tab-pane fade active in" id="first-tab">
		                <h2 class="tab-content-title"><img src="images/icon/flags/pt-br.png"> - Português Brasileiro</h2>

		                <div class="form-group">
		                	{{$form->render('nome_br')}}
		                </div>

		                <div class="form-group">
		                	{{$form->render('descricao_br')}}
		                </div>
		                
		            </div>
		            <div class="tab-pane fade" id="second-tab">
		                <h2 class="tab-content-title"><img src="images/icon/flags/en-us.png"> - Inglês</h2>

		                <div class="form-group">
		                	{{$form->render('nome_en')}}
		                </div>

		                <div class="form-group">
		                	{{$form->render('descricao_en')}}
		                </div>

		            </div>
		            <div class="tab-pane fade" id="third-tab">
		                <h2 class="tab-content-title">Informações Adicionais</h2>

		                <div class="form-group">
		                	{{$form->render('destinos_id')}}
		                </div>

		                <!-- <div class="form-group">
		                	{{--$form->render('estrelas')--}}
		                </div> -->

		                <div class="form-group">
		                	{{$form->render('publicado')}}
		                </div>

		            </div>
		            <!-- <div class="tab-pane fade" id="fourth-tab">
		                <h2 class="tab-content-title">Fourth Tab</h2>
		            </div>
		            <div class="tab-pane fade" id="fifth-tab">
		                <h2 class="tab-content-title">Preços</h2>

		                <div class="form-group">
		                	{{--$form->render('valor_diaria')--}}
		                </div>

		                <div class="form-group">
		                	{{--$form->render('deposito')--}}
		                </div>

		            </div> -->
		            <div class="tab-pane fade" id="sixth-tab">
		                <h2 class="tab-content-title">Imagens</h2>

		                <div class="form-group" style="display: none;">
		                	{{$form->render('imagem')}}
		                </div>
		            </div>
		        </div>
		    </div>
		</div>

	@endif

{{ $form->footer }}
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
	});

</script>

@stop


