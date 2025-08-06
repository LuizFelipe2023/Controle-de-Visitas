<?php

namespace App\Http\Controllers;

use App\Services\LogService;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LogController extends Controller
{
    protected $log;

    public function __construct(LogService $log)
    {
        $this->log = $log;
    }

    public function index()
    {
        try {
            $logs = $this->log->getAllLogs();
            return view('logs.index', compact('logs'));
        } catch (Exception $e) {
            Log::error('Houve um erro ao recuperar a lista de logs', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Houve um erro ao recuperar a lista de logs.');
        }
    }

    public function deleteLog($id)
    {
        try {
            $this->log->deleteLog($id);
            return redirect()->back()->with('success', 'Log excluído com sucesso.');
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Log não encontrado.');
        } catch (Exception $e) {
            Log::error('Erro ao excluir o log', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Houve um erro ao excluir o log.');
        }
    }
}
