<table>
            <thead>
                <tr>
                    <th colspan="6" style="text-align: center;">
                        Agendas
                    </th>
                </tr>
                <tr>
                    <th><b>Codigo</b></th>
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
