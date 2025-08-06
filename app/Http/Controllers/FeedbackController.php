<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreFeedbackRequest;
use App\Services\FeedbackService;
use App\Services\VisitaService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FeedbackController extends Controller
{
    protected $feedbackService;
    protected $visitaService;

    public function __construct(FeedbackService $feedbackService, VisitaService $visitaService)
    {
        $this->feedbackService = $feedbackService;
        $this->visitaService = $visitaService;
    }

    public function painelFeedbacks()
    {
        try {
            $feedbacks = $this->feedbackService->index();
            return view('feedbacks.index', compact('feedbacks'));
        } catch (Exception $e) {
            Log::error('Houve um erro inesperado ao recuperar a lista de feedbacks', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Houve um erro ao recuperar a lista de feedbacks.');
        }
    }

    public function createFeedback($id = null)
    {
        $visita = null;

        if ($id) {
            $visita = $this->visitaService->findVisita($id);

            if (!$visita) {
                return redirect()->route('feedbacks.index')
                    ->with('error', 'Visita não encontrada.');
            }
        }

        return view('feedbacks.create', compact('visita'));
    }

    public function storeFeedback(StoreFeedbackRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $this->feedbackService->insertFeedback($validatedData);
            return redirect()->back()->with('success', 'Feedback inserido com sucesso');
        } catch (Exception $e) {
            Log::error('Houve um erro ao inserir um feedback', ['error' => $e->getMessage()]);
            return redirect()->back()->withInput()->with('error', 'Erro ao inserir feedback. Tente novamente.');
        }
    }

    public function deleteFeedback($id)
    {
        try {
            $this->feedbackService->destroyFeedback($id);
            return redirect()->route('feedbacks.index')->with('success', 'Feedback excluído com sucesso');
        } catch (Exception $e) {
            Log::error('Erro ao excluir feedback', ['error' => $e->getMessage()]);
            return redirect()->route('feedbacks.index')->with('error', 'Erro ao excluir feedback. Tente novamente.');
        }
    }
}
