<?php

namespace App\Services;

use App\Models\Visita;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Feedback;

class VisitaService
{
    public function getAll(): Collection
    {
        return Visita::orderBy('nome')
            ->orderBy('instituicao')
            ->get();
    }

    public function getVisitasByDay(): Collection
    {
        return Visita::whereDate('created_at', now()->toDateString())->get();
    }

    public function getById(int $id): Visita
    {
        return Visita::findOrFail($id);
    }

    public function findVisita($id)
    {
        return Visita::find($id);
    }

    public function create(array $data): Visita
    {
        if (isset($data['foto']) && $data['foto']->isValid()) {
            $data['foto'] = $this->uploadFoto($data['foto']);
        }

        return Visita::create($data);
    }

    public function update(int $id, array $data): Visita
    {
        $visita = $this->getById($id);

        if (isset($data['foto']) && $data['foto']->isValid()) {
            if ($visita->foto) {
                Storage::disk('public')->delete($visita->foto);
            }
            $data['foto'] = $this->uploadFoto($data['foto']);
        } else {
            unset($data['foto']);
        }

        $visita->update($data);

        return $visita;
    }

    public function delete(int $id): void
    {
        $visita = $this->getById($id);
        $visita->delete();
    }

    protected function uploadFoto($foto)
    {
        $originalName = $foto->getClientOriginalName();
        $name = time() . '_' . Str::slug(pathinfo($originalName, PATHINFO_FILENAME)) . '.' . $foto->getClientOriginalExtension();

        return $foto->storeAs('visitas', $name, 'public');
    }

    public function downloadPdfVisita(int $id)
    {
        $visita = $this->getById($id);
        $pdf = Pdf::loadView('pdfs.visita', compact('visita'));
        return $pdf->download('visita_do_' . Str::slug($visita->nome) . '.pdf');
    }

    public function downloadPdfRelatorioVisitas()
    {
        $visitas = $this->getAll();
        $pdf = Pdf::loadView('pdfs.visitas', compact('visitas'));
        return $pdf->download('relatorio_visitas.pdf');
    }

    public function downloadPdfRelatorioVisitasDoDia()
    {
        $visitasDoDia = $this->getVisitasByDay();
        $pdf = Pdf::loadView('pdfs.visitasDoDia', compact('visitasDoDia'));
        return $pdf->download('relatorio_visitas_do_dia_' . now()->format('Ymd') . '.pdf');
    }

    public function getChartData(): array
    {
        $visitasPorDia = Visita::selectRaw('DATE(created_at) as data, COUNT(*) as total')
            ->groupBy('data')
            ->orderBy('data', 'asc')
            ->limit(7)
            ->get()
            ->map(fn($row) => [
                'data' => $row->data,
                'total' => $row->total
            ]);

        $visitasPorInstituicao = Visita::selectRaw('instituicao, COUNT(*) as total')
            ->groupBy('instituicao')
            ->orderBy('total', 'desc')
            ->get()
            ->map(fn($row) => [
                'instituicao' => $row->instituicao,
                'total' => $row->total
            ]);

        $totalVisitas = Visita::count();

        $totalFeedbacks = Feedback::count();

        $feedbacksPorNivel = Feedback::selectRaw('nivel_satisfacao, COUNT(*) as total')
            ->groupBy('nivel_satisfacao')
            ->orderBy('nivel_satisfacao')
            ->get()
            ->map(fn($row) => [
                'nivel' => $row->nivel_satisfacao,
                'total' => $row->total
            ]);

        return [
            'por_dia' => $visitasPorDia,
            'por_instituicao' => $visitasPorInstituicao,
            'total' => $totalVisitas,
            'totalFeedbacks' => $totalFeedbacks,
            'por_feedback' => $feedbacksPorNivel,  
        ];

    }

}
