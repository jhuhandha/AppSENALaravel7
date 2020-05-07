@extends("layouts.app")

@section("body")
<div class="card">
    <div class="card-header">
        <strong>Crear producto</strong>
    </div>
    <div class="card-body">
        @include('flash::message')
        <form action="/producto/guardar" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Imagen</label>
                        <input type="file" class="form-control" name="imagen">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Nombre</label>
                        <input type="text" class="form-control  @error('nombre_producto') is-invalid @enderror"
                            name="nombre_producto">
                        @error('nombre_producto')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Categoria</label>
                        <select class="form-control" name="categoria_id">
                            <option value="">Seleccione</option>
                            @foreach($categorias as $key => $value)
                                <option value="{{$value->id}}">{{$value->nombre_categoria}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Precio</label>
                        <input type="text" class="form-control" name="precio">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-success float-right">Guardar</button>
        </form>
    </div>
</div>
@endsection
