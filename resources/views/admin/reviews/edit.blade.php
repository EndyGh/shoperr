{!! Form::open(['route' => ['reviews.update',$review->id], 'method'=>'PUT']) !!}

    <div class="form-group">
        {!! Form::label('comment','Текст отзыва',['class' => 'control-label']) !!}
        {!! Form::textarea('comment',$review->comment,['class'=>'form-control input-sm','placeholder'=>'Отзыв']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('spam','Отметить как спам',['class' => 'control-label']) !!}
        {!! Form::checkbox('spam', $review->spam, $review->spam) !!}
    </div>

    <div class="form-group">
        {!! Form::label('approved','Отзыв проверен',['class' => 'control-label']) !!}
        {!! Form::checkbox('approved', $review->approved, $review->approved) !!}
    </div>
    {!! Form::submit('Редактировать',['class'=>'btn btn-success']) !!}

{!! Form::close() !!}

<script>
  $('#edit-modal input[type=checkbox]').change(function(e){
     var val = +$(this).val();
      $(this).val(val == 1? 0 : 1 );
  });
</script>