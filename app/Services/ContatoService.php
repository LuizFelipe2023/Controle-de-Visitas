<?php

namespace App\Services;

use App\Models\Contato;

class ContatoService
{
    public function index()
    {
        return Contato::orderBy('nome')
            ->paginate(15);
    }

    public function getContatoById($id)
    {
        return Contato::findOrFail($id);
    }

    public function findContato($id)
    {
        return Contato::find($id);
    }

    public function insertContato(array $data)
    {
        return Contato::create($data);
    }

    public function destroyContato($id)
    {
        $contato = $this->getContatoById($id);
        return $contato->delete();
    }
}
