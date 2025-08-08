<?php

namespace App\Services;
use App\Models\Feedback;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;


class FeedbackService
{
    public function index()
    {
        return Feedback::with('visita')
            ->orderBy('nome')
            ->orderBy('nivel_satisfacao')
            ->paginate(15);
    }

    public function getFeedbackById($id)
    {
        return Feedback::findOrFail($id);
    }

    public function findFeedback($id)
    {
        return Feedback::find($id);
    }

    public function insertFeedback(array $data)
    {
        return Feedback::create($data);
    }

    public function destroyFeedback($id)
    {
        $feedback = $this->getFeedbackById($id);
        return $feedback->delete();
    }

    public function gerarRelatorioMensal()
    {
        $inicioMes = Carbon::now()->startOfMonth();
        $fimMes = Carbon::now()->endOfMonth();

        $bons = Feedback::whereBetween('created_at', [$inicioMes, $fimMes])
            ->whereIn('nivel_satisfacao', [4, 5])
            ->count();

        $neutros = Feedback::whereBetween('created_at', [$inicioMes, $fimMes])
            ->where('nivel_satisfacao', 3)
            ->count();

        $ruins = Feedback::whereBetween('created_at', [$inicioMes, $fimMes])
            ->whereIn('nivel_satisfacao', [1, 2])
            ->count();

        $total = $bons + $neutros + $ruins;

        return [
            'bons' => $bons,
            'neutros' => $neutros,
            'ruins' => $ruins,
            'total' => $total,
        ];
    }

}