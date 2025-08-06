<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Services\LogService;
use App\Services\UserService;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $userService, $logService;

    public function __construct(UserService $userService, LogService $logService)
    {
        $this->userService = $userService;
        $this->logService = $logService;
    }

    public function index()
    {
        try {
            $users = $this->userService->usersIndex();
            return view('users.index', compact('users'));
        } catch (Exception $e) {
            Log::error('Houve um erro ao recuperar a lista de usuários', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Erro ao recuperar lista de usuários');
        }
    }

    public function createUser()
    {
        return view('users.create');
    }

    public function storeUser(StoreUserRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $this->userService->storeUser($validatedData);

            $this->logService->insertLog([
                'user_id' => Auth::id(),
                'action' => 'inserção',
                'description' => 'Inserção de um novo usuário: ' . $validatedData['name']
            ]);

            return redirect()->route('users.index')->with('success', 'Usuário cadastrado com sucesso');
        } catch (Exception $e) {
            Log::error('Erro ao inserir usuário', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Erro ao inserir usuário, verifique o formulário e tente novamente');
        }
    }

    public function editUser($id)
    {
        try {
            $user = $this->userService->getUserById($id);
            return view('users.edit', compact('user'));
        } catch (ModelNotFoundException $e) {
            Log::error('Usuário não encontrado', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Usuário não encontrado');
        } catch (Exception $e) {
            Log::error('Erro ao buscar usuário', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Erro ao buscar usuário');
        }
    }

    public function updateUser(UpdateUserRequest $request, $id)
    {
        try {
            $validatedData = $request->validated();
            $this->userService->updateUser($id, $validatedData);

            $this->logService->insertLog([
                'user_id' => Auth::id(),
                'action' => 'edição',
                'description' => 'Edição do usuário: ' . $validatedData['name']
            ]);

            return redirect()->route('users.index')->with('success', 'Usuário atualizado com sucesso');
        } catch (ModelNotFoundException $e) {
            Log::error('Usuário não encontrado para atualização', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Usuário não encontrado');
        } catch (Exception $e) {
            Log::error('Erro ao atualizar usuário', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Erro ao atualizar usuário');
        }
    }

    public function deleteUser($id)
    {
        try {
            $user = $this->userService->getUserById($id);
            $this->userService->deleteUser($id);

            $this->logService->insertLog([
                'user_id' => Auth::id(),
                'action' => 'exclusão',
                'description' => 'Exclusão do usuário: ' . $user->name
            ]);

            return redirect()->route('users.index')->with('success', 'Usuário excluído com sucesso');
        } catch (ModelNotFoundException $e) {
            Log::error('Usuário não encontrado para exclusão', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Usuário não encontrado');
        } catch (Exception $e) {
            Log::error('Erro ao excluir usuário', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Erro ao excluir usuário');
        }
    }
}
