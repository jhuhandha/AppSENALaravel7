@extends("layouts.app")

@section("body")
<div class="row">
    <div class="card col">
        <div id='calendar'></div>
    </div>
</div>

<div class="modal fade" id="agenda_modal" data-backdrop="static" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Agendar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formulario_agenda">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Fecha</label>
                                <input type="date" class="form-control" id="txtFecha" name="txtFecha">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="">Hora inicial</label>
                                <input type="time" class="form-control" id="txtHoraInicial">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="">Tiempo (minutos)</label>
                                <input type="number" class="form-control" id="txtTiempo">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Usuario</label>
                                <select id="ddlUsuarios" class="form-control" name="ddlUsuarios">
                                    <option value="">Selccione</option>
                                    <option value="1">Juan</option>
                                    <option value="2">Hector</option>
                                    <option value="3">Jeremias</option>
                                    <option value="4">Andrea</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Descripción</label>
                                <textarea class="form-control" name="txtDescripcion" id="txtDescripcion" cols="30"
                                    rows="10"></textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button onclick="guardar()" type="button" class="btn btn-success">Guardar</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section("style")
<link href='{{ asset("assets/dashboard/vendors/fullcalendar/core/main.css") }}' rel='stylesheet' />
<link href='{{ asset("assets/dashboard/vendors/fullcalendar/daygrid/main.css") }}' rel='stylesheet' />
<link href='{{ asset("assets/dashboard/vendors/fullcalendar/timegrid/main.css") }}' rel='stylesheet' />
<link href='{{ asset("assets/dashboard/vendors/fullcalendar/bootstrap/main.css") }}' rel='stylesheet' />
@endsection

@section("scripts")
<script src='{{ asset("assets/dashboard/vendors/fullcalendar/core/main.js") }}'></script>
<script src='{{ asset("assets/dashboard/vendors/fullcalendar/interaction/main.js") }}'></script>
<script src='{{ asset("assets/dashboard/vendors/fullcalendar/daygrid/main.js") }}'></script>
<script src='{{ asset("assets/dashboard/vendors/fullcalendar/timegrid/main.js") }}'></script>
<script src='{{ asset("assets/dashboard/vendors/fullcalendar/bootstrap/main.js") }}'></script>
<script src='{{ asset("assets/dashboard/vendors/fullcalendar/core/locales/es.js") }}'></script>
<script src='{{ asset("assets/dashboard/vendors/moment.min.js") }}'></script>

<script>
    var calendar = null;
    $(function () {
        var calendarEl = document.getElementById('calendar');
        calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: ['interaction', 'dayGrid', 'timeGrid', 'bootstrap'],
            locale: 'es',
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            navLinks: true, // can click day/week names to navigate views
            selectable: true,
            selectMirror: true,
            select: function (arg) {
                let fecha = moment(arg.start).format("YYYY-MM-DD")
                let hora_inicial = moment(arg.start).format("HH:mm:ss")

                $("#txtFecha").val(fecha);
                $("#txtHoraInicial").val(hora_inicial);
                $("#txtTiempo").val("30");

                $("#agenda_modal").modal();
                calendar.unselect()
            },
            eventClick: function (info) {
                console.log(info.event.extendedProps)
            },
            editable: true,
            events: '/agenda/listar'
        });

        calendar.render();
    })

    function limpiar() {
        $("#agenda_modal").modal('hide');
        $("#txtFecha").val("");
        $("#txtHoraInicial").val("");
        $("#txtTiempo").val("");
        $("#ddlUsuarios").val("");
    }


    function guardar() {
        var fd = new FormData(document.getElementById("formulario_agenda"));
        let fecha = $("#txtFecha").val();
        let hora = $("#txtHoraInicial").val();
        let tiempo = $("#txtTiempo").val();
        let hora_inicial = moment(fecha + " " + hora).format('HH:mm:ss');
        let hora_final = moment(fecha + " " + hora).add(tiempo, 'm').format('HH:mm:ss');

        fd.append("txtHoraInicial", hora_inicial);
        fd.append("txtHoraFinal", hora_final);

        $.ajax({
            url: "/agenda/guardar",
            type: "POST",
            data: fd,
            processData: false, // tell jQuery not to process the data
            contentType: false // tell jQuery not to set contentType
        }).done(function (respuesta) {
            if (respuesta && respuesta.ok) {
                calendar.refetchEvents();
                alert("Se registro la agenda");
                limpiar();
            } else {
                alert("La agenda ya contiene la fecha seleccionada");
            }
        })
    }

</script>
@endsection
