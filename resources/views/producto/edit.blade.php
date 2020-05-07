@extends("layouts.app")

@section("body")
<div class="card">
    <div class="card-header">
        <strong>Modificar producto</strong>
    </div>
    <div class="card-body">
        @include('flash::message')
        <form action="/producto/actualizar" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{$producto->id}}" /> 
            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label for="">Nombre</label>
                        <input value="{{$producto->nombre_producto}}" type="text" class="form-control  @error('nombre_producto') is-invalid @enderror"
                            name="nombre_producto">
                        @error('nombre_producto')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="">Categoria</label>
                        <select class="form-control" name="categoria_id">
                            <option value="">Seleccione</option>
                            @foreach($categorias as $key => $value)
                                <option {{$value->id == $producto->categoria_id ? 'selected' : ''}} value="{{$value->id}}">{{$value->nombre_categoria}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="">Precio</label>
                        <input value="{{$producto->precio}}" type="text" class="form-control" name="precio">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-warning float-right">Modificar</button>
        </form>
    </div>
</div>
@endsection
