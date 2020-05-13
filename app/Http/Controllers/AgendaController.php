<?php

namespace App\Http\Controllers;

use App\Exports\AgendaExport;
use App\Models\Agenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class AgendaController extends Controller
{
    public function index()
    {
        return view("agenda.index");
    }

    public function listar()
    {
        $agenda = Agenda::all();
        $nueva_agenda = [];

        foreach ($agenda as $value) {
            $nueva_agenda[] = [
                "id" => $value->id,
                "start" => $value->fecha . " " . $value->hora_inicio,
                "end" => $value->fecha . " " . $value->hora_final,
                "title" => $value->usuario_id . " " . $value->descripcion,
                "backgroundColor" => $value->estado == 1 ? "#1f7904" : "#7b0205",
                "textColor" => "#fff",
                "extendedProps" => [
                    "usuario_id" => $value->usuario_id,
                ],
            ];
        }

        return response()->json($nueva_agenda);
    }

    public function validarFecha($fecha, $horaInicial, $horaFinal)
    {
        $agenda = Agenda::select("*")
            ->whereDate('fecha', $fecha)
            ->whereBetween('hora_inicio', [$horaInicial, $horaFinal])
            ->orWhereBetween('hora_final', [$horaInicial, $horaFinal])
            ->first();

        return $agenda == null ? true : false;
    }

    public function guardar(Request $request)
    {
        $input = $request->all();

        if ($this->validarFecha($input["txtFecha"], $input["txtHoraInicial"], $input["txtHoraFinal"])) {
            $agenda = Agenda::create([
                "usuario_id" => $input["ddlUsuarios"],
                "fecha" => $input["txtFecha"],
                "hora_inicio" => $input["txtHoraInicial"],
                "hora_final" => $input["txtHoraFinal"],
                "descripcion" => $input["txtDescripcion"],
            ]);

            return response()->json(["ok" => true]);
        } else {
            return response()->json(["ok" => false]);
        }
    }

    public function informe()
    {
        return view("agenda.informe");
    }

    public function generar_informe(Request $request)
    {
        $input = $request->all();
        $agenda = Agenda::select("*")
            ->whereBetween('fecha', [$input["txtFechaInicial"], $input["txtFechaFinal"]])
            ->get();
        if (count($agenda) > 0) {
            if (isset($input["pdf"])) {
                return $this->generar_pdf($agenda, $input);
            } else if (isset($input["excel"])) {
                return $this->generar_excel($agenda, $input);
            }
        } else {
            return redirect("/agenda/informe");
        }
    }

    private function generar_pdf($agenda, $input)
    {
        $pdf = PDF::loadView('pdf.agenda', compact("agenda", "input"));
        Mail::send('email.agenda', compact("agenda"), function ($mail) use ($pdf) {
            $email = \Auth::user()->email;
            $mail->to([$email, "j-deiby@hotmail.com"]);
            $mail->attachData($pdf->output(), 'informe.pdf');
        });
        return $pdf->download('informe.pdf');
    }

    private function generar_excel($agenda, $input)
    {
        $agenda = new AgendaExport($agenda);
        return Excel::download($agenda, 'agenda.xlsx');
    }
}
