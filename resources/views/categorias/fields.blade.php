<!-- Nombre Categoria Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nombre_categoria', 'Nombre Categoria:') !!}
    {!! Form::text('nombre_categoria', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('categorias.index') }}" class="btn btn-secondary">Cancel</a>
</div>
