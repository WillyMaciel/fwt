<form action="{{URL::to($action)}}" method="POST" class="review-form">
    <input type="hidden" name="produto_id" value="{{$produto_id}}" />
    <div class="form-group col-md-5 no-float no-padding">
        <h4 class="title">Title of your review</h4>
        <input type="text" name="review-titulo" class="input-text full-width" value="" placeholder="enter a review title" />
    </div>
    <div class="form-group">
        <h4 class="title">Your review</h4>
        <textarea name="review-texto" class="input-text full-width" placeholder="enter your review (minimum 200 characters)" rows="5"></textarea>
    </div>   

    <div class="form-group">
        <span id="div_estrelas">
            <label for="review-nota" class="">Sua nota</label>
            {{Form::select('review-nota', array(1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5), null, array('class' => 'form-control', 'id' => 'review-nota'))}}
        </span>
    </div>  

    <div class="form-group col-md-5 no-float no-padding no-margin">
        <button type="submit" class="btn-large full-width">SUBMIT REVIEW</button>
    </div>
</form>