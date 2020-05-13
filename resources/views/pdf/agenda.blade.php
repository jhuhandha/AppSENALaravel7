<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        body{
            padding: 0;
            margin: 0;
        }
        .page-break {
            page-break-after: always;
        }
        .titulo {
            border:2px solid #701375;
            border-radius: 15px;
            padding: 15px;
        }
        .titulo h1 {
            text-align: center;
        }
        .titulo p {
            text-align: right;
        }

        .table {
            width: 100%;
            border: 1px solid #701375;
            text-align: center;
        }

        .table tr, td {
            border: 1px solid #701375;
            height: 60px;
        }
    </style>
</head>

<body>
    <header class="titulo">
        <h1>Informe de agenda</h1>
        <p>De: {{$input["txtFechaInicial"]}} hasta {{$input["txtFechaFinal"]}}</p>
    </header>
    <div style="margin-top: 20px;">
        <table class="table">
            <thead>
                <tr>
                    <th>Codigo</th>
                    <th>Usuario</th>
                    <th>Fecha</th>
                    <th>Hora Inicial</th>
                    <th>Hora Final</th>
                    <th>Descripcion</th>
                </tr>
            </thead>
            <tbody>
                @foreach($agenda as $value)
                    <tr>
                        <td>{{$value->id}}</td>
                        <td>{{$value->usuario_id}}</td>
                        <td>{{$value->fecha}}</td>
                        <td>{{$value->hora_inicio}}</td>
                        <td>{{$value->hora_final}}</td>
                        <td>{{$value->descripcion}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- <div class="page-break"></div> -->
    <footer style="position: absolute; bottom: 0;">
        <p style="text-align: center;">Informe generado {{date("Y-m-d")}}</p>
    </footer>
</body>

</html>
