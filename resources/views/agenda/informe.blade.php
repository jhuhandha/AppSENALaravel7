@extends("layouts.app")

@section("body")
<form class="card" action="/agenda/generar/informe" method="POST">
    <div class="row">
        @csrf
        <div class="col-lg-6">
            <div class="form-group">
                <label for="">Fecha Inicial</label>
                <input type="date" class="form-control" name="txtFechaInicial" />
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="">Fecha Final</label>
                <input type="date" class="form-control" name="txtFechaFinal" />
            </div>
        </div>
    </div>
    <button name="pdf" type="submit" class="btn btn-primary float-right" value="Generar PDF">Generar PDF</button>
    <button name="excel" type="submit" class="btn btn-success float-right" value="Generar EXCEL">Generar EXCEL</button>
    
</form>
@endsection
