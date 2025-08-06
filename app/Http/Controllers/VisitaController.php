<?php

namespace App\Http\Controllers;

use App\Http\Requests\InsertVisita;
use App\Http\Requests\UpdateVisita;
use App\Services\VisitaService;
use App\Services\LogService;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

class VisitaController extends Controller
{
    protected $visita;
    protected $logService;

    public function __construct(VisitaService $visita, LogService $logService)
    {
        $this->visita = $visita;
        $this->logService = $logService;
    }

    public function index()
    {
        try {
            $visitas = $this->visita->getAll();
            return view('visitas.index', compact('visitas'));
        } catch (Exception $e) {
            Log::error('Erro ao carregar visitas: ', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Erro ao carregar visitas');
        }
    }

    public function showVisitasbyDay()
    {
        try {
            $visitasDoDia = $this->visita->getvisitasByDay();
            return view('visitas.dia', compact('visitasDoDia'));
        } catch (Exception $e) {
            Log::error('Erro ao carregar visitas do dia: ', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Erro ao carregar visitas do dia');
        }
    }

    public function showVisita($id)
    {
        try {
            $visita = $this->visita->getById($id);
            return view('visitas.show', compact('visita'));
        } catch (ModelNotFoundException $e) {
            Log::error('Visita não encontrada', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Visita não encontrada');
        }
    }

    public function downloadPdfVisita(int $id)
    {
        try {
            return $this->visita->downloadPdfVisita($id);
        } catch (Exception $e) {
            Log::error('Erro ao gerar PDF da visita', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Houve um erro ao gerar o PDF da visita selecionada.');
        }
    }

    public function downloadPdfRelatorioVisitas()
    {
        try {
            return $this->visita->downloadPdfRelatorioVisitas();
        } catch (Exception $e) {
            Log::error('Erro ao gerar PDF do relatório de visitas', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Houve um erro inesperado ao gerar o PDF do relatório de visitas.');
        }
    }

    public function downloadPdfRelatorioVisitasDoDia()
    {
        try {
            return $this->visita->downloadPdfRelatorioVisitasDoDia();
        } catch (Exception $e) {
            Log::error('Erro ao gerar PDF do relatório de visitas do dia', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Houve um erro inesperado ao gerar o PDF do relatório de visitas do dia.');
        }
    }

    public function painelVisitas()
    {
        try {
            $chartData = $this->visita->getChartData();
            return view('painel.graficos', compact('chartData'));
        } catch (Exception $e) {
            Log::error('Houve um erro ao gerar a página de gráficos relacionados a visitas: ' . $e->getMessage());
            return back()->with('error', 'Erro ao carregar os gráficos. Por favor, tente novamente mais tarde.');
        }
    }

    public function createVisita()
    {
        return view('visitas.create');
    }

    public function storeVisita(InsertVisita $request)
    {
        try {
            $validatedData = $request->validated();
            $visita = $this->visita->create($validatedData);

            $this->logService->insertLog([
                'user_id' => auth()->id(),
                'action' => 'inserção',
                'description' => 'Visita criada: ' . ($visita->nome ?? 'ID ' . $visita->id)
            ]);

            return redirect()->route('visitas.index')->with('success', 'Visita criada com sucesso');
        } catch (Exception $e) {
            Log::error('Erro ao criar visita', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Erro ao criar visita')->withInput();
        }
    }

    public function editVisita($id)
    {
        try {
            $visita = $this->visita->getById($id);
            return view('visitas.edit', compact('visita'));
        } catch (ModelNotFoundException $e) {
            Log::error('Visita não encontrada para edição', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Visita não encontrada');
        }
    }

    public function updateVisita($id, UpdateVisita $request)
    {
        try {
            $validatedData = $request->validated();
            $visita = $this->visita->update($id, $validatedData);

            $this->logService->insertLog([
                'user_id' => auth()->id(),
                'action' => 'edição',
                'description' => 'Visita atualizada: ' . ($visita->nome ?? 'ID ' . $id)
            ]);

            return redirect()->route('visitas.index')->with('success', 'Visita atualizada com sucesso');
        } catch (ModelNotFoundException $e) {
            Log::error('Visita não encontrada para atualização', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Visita não encontrada')->withInput();
        } catch (Exception $e) {
            Log::error('Erro ao atualizar visita', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Erro ao atualizar visita')->withInput();
        }
    }

    public function deleteVisita($id)
    {
        try {
            $visita = $this->visita->getById($id);
            $this->visita->delete($id);

            $this->logService->insertLog([
                'user_id' => auth()->id(),
                'action' => 'exclusão',
                'description' => 'Visita excluída: ' . ($visita->nome ?? 'ID ' . $id)
            ]);

            return redirect()->route('visitas.index')->with('success', 'Visita deletada com sucesso');
        } catch (ModelNotFoundException $e) {
            Log::error('Visita não encontrada para exclusão', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Visita não encontrada');
        } catch (Exception $e) {
            Log::error('Erro ao deletar visita', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Erro ao deletar visita');
        }
    }
}
