<?php

namespace App\Http\Controllers;

use App\Services\VersionamentoService;
use App\Services\LogService;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Http\Requests\VersionamentoRequest;

class VersionamentoController extends Controller
{
    protected $versionamento, $logService;

    public function __construct(VersionamentoService $versionamento, LogService $logService)
    {
        $this->versionamento = $versionamento;
        $this->logService = $logService;
    }

    public function index()
    {
        try {
            $versionamentos = $this->versionamento->getAllVersionamentos();
            return view('versionamentos.index', compact('versionamentos'));
        } catch (Exception $e) {
            Log::error('Houve um erro ao recuperar a lista de versionamentos', ['error' => $e->getMessage()]);
            return redirect()->route('versionamentos.index')->with('error', 'Houve um erro ao recuperar a lista de versionamento, recarregue a página e tente novamente');
        }
    }

    public function show($id)
    {
        try {
            $versionamento = $this->versionamento->getVersionamentoById($id);
            return view('versionamentos.show', compact('versionamento'));
        } catch (ModelNotFoundException $e) {
            Log::warning("Versionamento não encontrado. ID: {$id}", ['error' => $e->getMessage()]);
            return redirect()->route('versionamentos.index')
                ->with('error', 'Versionamento não encontrado.');
        } catch (Exception $e) {
            Log::error("Erro ao exibir versionamento. ID: {$id}", ['error' => $e->getMessage()]);
            return redirect()->route('versionamentos.index')
                ->with('error', 'Ocorreu um erro ao tentar exibir o versionamento.');
        }
    }

    public function createVersionamento()
    {
        return view('versionamentos.create');
    }

    public function storeVersionamento(VersionamentoRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $validatedData['usuario_id'] = auth()->id();

            $versionamento = $this->versionamento->insertVersionamento($validatedData);

            $this->logService->insertLog([
                'user_id' => auth()->id(),
                'action' => 'inserção',
                'description' => 'Inserção de versionamento: ' . ($versionamento->titulo ?? 'Sem título')
            ]);

            return redirect()->route('versionamentos.index')
                ->with('success', 'Versionamento inserido com sucesso.');
        } catch (Exception $e) {
            Log::error('Erro ao inserir versionamento', ['error' => $e->getMessage()]);
            return redirect()->back()
                ->withInput()
                ->with('error', 'Erro ao inserir versionamento. Tente novamente.');
        }
    }

    public function edit($id)
    {
        try {
            $versionamento = $this->versionamento->getVersionamentoById($id);

            if (!$versionamento) {
                return redirect()->route('versionamentos.index')
                    ->with('error', 'Versionamento não encontrado.');
            }

            return view('versionamentos.edit', compact('versionamento'));
        } catch (Exception $e) {
            Log::error('Erro ao buscar versionamento para edição', ['error' => $e->getMessage()]);
            return redirect()->route('versionamentos.index')
                ->with('error', 'Erro ao carregar dados para edição.');
        }
    }

    public function update(VersionamentoRequest $request, $id)
    {
        try {
            $validatedData = $request->validated();
            $validatedData['usuario_id'] = auth()->id();

            $versionamento = $this->versionamento->updateVersionamento($id, $validatedData);

            $this->logService->insertLog([
                'user_id' => auth()->id(),
                'action' => 'edição',
                'description' => 'Edição de versionamento: ' . ($versionamento->titulo ?? 'ID ' . $id)
            ]);

            return redirect()->route('versionamentos.index')
                ->with('success', 'Versionamento atualizado com sucesso.');
        } catch (Exception $e) {
            Log::error('Erro ao atualizar versionamento', ['error' => $e->getMessage()]);
            return redirect()->back()
                ->withInput()
                ->with('error', 'Erro ao atualizar versionamento. Tente novamente.');
        }
    }

    public function destroy($id)
    {
        try {
            $versionamento = $this->versionamento->getVersionamentoById($id);
            $this->versionamento->deleteVersionamento($id);

            $this->logService->insertLog([
                'user_id' => auth()->id(),
                'action' => 'exclusão',
                'description' => 'Exclusão de versionamento: ' . ($versionamento->titulo ?? 'ID ' . $id)
            ]);

            return redirect()->route('versionamentos.index')
                ->with('success', 'Versionamento removido com sucesso.');
        } catch (Exception $e) {
            Log::error('Erro ao remover versionamento', ['error' => $e->getMessage()]);
            return redirect()->route('versionamentos.index')
                ->with('error', 'Erro ao remover versionamento. Tente novamente.');
        }
    }
}
