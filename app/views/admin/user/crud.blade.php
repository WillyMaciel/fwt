@extends('templates.admin')
@section('breadcrumbs')
<div class="page-title-container">
    <div class="container">
        <div class="page-title pull-left">
            <h2 class="entry-title">
            	@if($form->field('nome') && Input::get('modify') == 1)
            		Editando usuário - {{$form->field('nome')->value}}
            	@elseif($form->field('nome') && Input::get('show') == 1)
            		Visualizando usuário - {{$form->field('nome')->value}}
            	@endif
            </h2>
        </div>
    </div>
</div>
@stop
@section('content')

{{ $form->header }}

	{{ $form->message }}

    @if(!$form->message)

		<div class="tab-container full-width-style arrow-left dashboard">
                        <ul class="tabs">
                            <li class="active"><a data-toggle="tab" href="#dashboard"><i class="soap-icon-user circle"></i>Informações Pessoais</a></li>
                            <li class=""><a data-toggle="tab" href="#profile"><i class="soap-icon-anchor circle"></i>Endereço</a></li>
                            <li class=""><a data-toggle="tab" href="#booking"><i class="soap-icon-businessbag circle"></i>Pedidos</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="dashboard" class="tab-pane fade in active">
                                <div class="form-group">
				                	{{$form->render('nome')}}
				                </div>

				                <div class="form-group">
				                	{{$form->render('email')}}
				                </div>

				                <div class="form-group">
				                	{{$form->render('cpf')}}
				                </div>

				                <div class="form-group">
				                	{{$form->render('telefone_residencial')}}
				                </div>

				                <div class="form-group">
				                	{{$form->render('telefone_celular')}}
				                </div>

				                <div class="form-group">
				                	{{$form->render('telefone_comercial')}}
				                </div>

				                <div class="form-group">
				                	{{$form->render('publicado')}}
				                </div>

				                <div class="form-group">
				                	{{$form->render('confirmed')}}
				                </div>

				                <div class="form-group">
				                	{{$form->render('is_admin')}}
				                </div>
                            </div>
                            <div id="profile" class="tab-pane fade">
                                <div class="form-group">
				                	{{$form->render('pais')}}
				                </div>

				                <div class="form-group">
				                	{{$form->render('estado')}}
				                </div>

				                <div class="form-group">
				                	{{$form->render('cidade')}}
				                </div>
                            </div>
                            <div id="booking" class="tab-pane fade">
                                
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


