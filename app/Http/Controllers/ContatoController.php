<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContatoRequest;
use App\Services\ContatoService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;

class ContatoController extends Controller
{
    protected $contatoService;

    public function __construct(ContatoService $contatoService)
    {
        $this->contatoService = $contatoService;
    }

    public function index()
    {
        try {
            $contatos = $this->contatoService->index();
            return view('contatos.index', compact('contatos'));
        } catch (Exception $e) {
            Log::error('Erro ao listar contatos: '.$e->getMessage());
            return redirect()->back()->with('error', 'Erro ao carregar contatos.');
        }
    }

    public function create()
    {
        return view('contatos.create');
    }

    public function store(ContatoRequest $request)
    {
        try {
            $this->contatoService->insertContato($request->validated());
            return redirect()->route('contatos.index')->with('success', 'Contato criado com sucesso.');
        } catch (Exception $e) {
            Log::error('Erro ao criar contato: '.$e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Erro ao salvar contato.');
        }
    }

    public function show($id)
    {
        try {
            $contato = $this->contatoService->getContatoById($id);
            return view('contatos.show', compact('contato'));
        } catch (ModelNotFoundException $e) {
            return redirect()->route('contatos.index')->with('error', 'Contato não encontrado.');
        } catch (Exception $e) {
            Log::error('Erro ao mostrar contato: '.$e->getMessage());
            return redirect()->route('contatos.index')->with('error', 'Erro ao carregar contato.');
        }
    }

    public function destroy($id)
    {
        try {
            $this->contatoService->destroyContato($id);
            return redirect()->back()->with('success', 'Contato excluído com sucesso.');
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Contato não encontrado.');
        } catch (Exception $e) {
            Log::error('Erro ao excluir contato: '.$e->getMessage());
            return redirect()->back()->with('error', 'Erro ao excluir contato.');
        }
    }
}
