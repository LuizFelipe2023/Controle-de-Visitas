<?php

namespace App\Services;
use App\Models\Log;

class LogService
{
      public function getAllLogs()
      {
             return Log::orderBy('created_at')->get();
      }

      public function insertLog(array $data)
      {
             return Log::create($data);
      }

      public function deleteLog($id)
      {
             $log = Log::findOrFail($id);
             return $log->delete();
      }
}