<button type="button" id="compraModal" class="button yellow full-width uppercase btn-small" data-toggle="modal" data-target="#dadosCompra">{{trans('hotel.comprar')}}</button>

<!-- Modal -->
<div class="modal fade" id="dadosCompra" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Required Information</h4>
      </div>
      <div class="modal-body">

        <div class="alert alert-help">
            Por favor, insira algumas informações necessárias abaixo para concluir o agendamento deste produto/serviço
            <span class="close"></span>
        </div>

        <div class="row" style="padding: 30px 15px 0;">
            <div class="row">
                <div class="form-group">
                    <div class="datepicker-wrap yellow">
                        <input name="extra[data]" type="text" class="input-text full-width" placeholder="Data planejada" />
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="form-group">
                    <input name="extra[numero_pessoas]" type="text" class="input-text full-width" placeholder="Numero de pessoas" />
                </div>
            </div>


            <div class="row">
                <div class="form-group">
                    <textarea name="extra[hotel]" class="input-text full-width" placeholder="Em qual hotel esta hospedado?"></textarea>
                </div>
            </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="submit" class="button yellow full-width uppercase btn-small">{{trans('hotel.comprar')}}</button>
      </div>
    </div>
  </div>
</div>

@section('scripts')

<script type="text/javascript">

    tjq(document).ready(function()
    {
        tjq("#compraModal").click(function(event)
        {
            event.preventDefault();
        })
    })

</script>

@stop