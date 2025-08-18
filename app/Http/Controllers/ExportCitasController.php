<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cita;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Storage;

class ExportCitasController extends Controller
{
    public function exportarCitas()
    {
        try {
            $citas = Cita::with(['paciente', 'doctor'])->get();

            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setCellValue('A1', 'Paciente');
            $sheet->setCellValue('B1', 'Doctor');
            $sheet->setCellValue('C1', 'Fecha');
            $sheet->setCellValue('D1', 'Hora');

            $fila = 2;
            foreach ($citas as $cita) {
                $sheet->setCellValue("A$fila", $cita->paciente->name);
                $sheet->setCellValue("B$fila", $cita->doctor->name ?? 'Sin asignar');
                $sheet->setCellValue("C$fila", $cita->fecha);
                $sheet->setCellValue("D$fila", $cita->hora);
                $fila++;
            }

            // Guardar en storage
            $fileName = 'citas_' . now()->format('Ymd_His') . '.xlsx';
            $filePath = storage_path("app/public/{$fileName}");

            $writer = new Xlsx($spreadsheet);
            $writer->save($filePath);

            // Descargar y borrar después de enviar
            return response()->download($filePath)->deleteFileAfterSend(true);

        } catch (\Exception $e) {
            return back()->with('error', 'Error al exportar citas: ' . $e->getMessage());
        }
    }
}
