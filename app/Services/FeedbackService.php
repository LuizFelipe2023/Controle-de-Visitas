<?php

namespace App\Services;
use App\Models\Feedback;

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
}