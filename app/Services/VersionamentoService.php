<?php

namespace App\Services;
use App\Models\Versionamento;

class VersionamentoService
{
      public function getAllVersionamentos()
      {
             return Versionamento::with('usuario')->orderBy('created_at', 'desc')->paginate(9);
      }

      public function getVersionamentoById($id)
      {
             return Versionamento::with(['usuario'])->findOrFail($id);
      }

      public function insertVersionamento(array $data)
      {
             return Versionamento::create($data);
      }

      public function updateVersionamento($id, array $data)
      {
             $versionamento = $this->getVersionamentoById($id);
             $versionamento->update($data);
             return $versionamento;
      }

      public function deleteVersionamento($id)
      {
             $versionamento = $this->getVersionamentoById($id);
             return $versionamento->delete();
      }
}