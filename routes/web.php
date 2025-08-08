<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VisitaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VersionamentoController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\ContatoController;

Route::prefix('contatos')->group(function () {
    Route::get('/', [ContatoController::class, 'index'])->name('contatos.index');
    Route::get('create', [ContatoController::class, 'create'])->name('contatos.create');
    Route::post('store', [ContatoController::class, 'store'])->name('contatos.store');
    Route::get('{id}', [ContatoController::class, 'show'])->name('contatos.show');
    Route::delete('{id}', [ContatoController::class, 'destroy'])->name('contatos.destroy');
});


Route::prefix('feedbacks')->group(function () {
    Route::get('/', [FeedbackController::class, 'painelFeedbacks'])->name('feedbacks.index');
    Route::get('create/{id?}', [FeedbackController::class, 'createFeedback'])->name('feedbacks.create');
    Route::post('store', [FeedbackController::class, 'storeFeedback'])->name('feedbacks.store');
    Route::delete('{id}', [FeedbackController::class, 'deleteFeedback'])->name('feedbacks.delete');
});

Route::prefix('users')->name('users.')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('index');                
    Route::get('/create', [UserController::class, 'createUser'])->name('create');    
    Route::post('/', [UserController::class, 'storeUser'])->name('store');           
    Route::get('/{id}/edit', [UserController::class, 'editUser'])->name('edit');     
    Route::put('/{id}', [UserController::class, 'updateUser'])->name('update');      
    Route::delete('/{id}', [UserController::class, 'deleteUser'])->name('delete'); 
});

Route::prefix('visitas')->name('visitas.')->group(function () {
    Route::get('/', [VisitaController::class, 'index'])->name('index');
    Route::get('/graficos', [VisitaController::class, 'painelVisitas'])->name('graficos');
    Route::get('/relatorio/pdf', [VisitaController::class, 'downloadPdfRelatorioVisitas'])->name('pdf.relatorio');
    Route::get('/relatorio/pdf-dia', [VisitaController::class, 'downloadPdfRelatorioVisitasDoDia'])->name('pdf.relatorio.dia');
    Route::get('/create', [VisitaController::class, 'createVisita'])->name('create');
    Route::post('/store', [VisitaController::class, 'storeVisita'])->name('store');
    Route::get('/dia', [VisitaController::class, 'showVisitasByDay'])->name('dia');
    Route::get('/{id}/edit', [VisitaController::class, 'editVisita'])->name('edit');
    Route::put('/{id}/update', [VisitaController::class, 'updateVisita'])->name('update');
    Route::delete('/{id}/delete', [VisitaController::class, 'deleteVisita'])->name('delete');
    Route::get('/{id}', [VisitaController::class, 'showVisita'])->name('show');
    Route::get('/{id}/pdf', [VisitaController::class, 'downloadPdfVisita'])->name('pdf.visita');
});

Route::prefix('versionamentos')->name('versionamentos.')->group(function () {
    Route::get('/', [VersionamentoController::class, 'index'])->name('index');
    Route::get('/create', [VersionamentoController::class, 'createVersionamento'])->name('create');
    Route::post('/store', [VersionamentoController::class, 'storeVersionamento'])->name('store');
    Route::get('/{id}/edit', [VersionamentoController::class, 'edit'])->name('edit');
    Route::put('/{id}/update', [VersionamentoController::class, 'update'])->name('update');
    Route::delete('/{id}/delete', [VersionamentoController::class, 'destroy'])->name('delete');
    Route::get('/{id}', [VersionamentoController::class, 'show'])->name('show');
});


Route::prefix('logs')->group(function () {
    Route::get('/', [LogController::class, 'index'])->name('logs.index');
    Route::delete('/{id}', [LogController::class, 'deleteLog'])->name('logs.delete');
});

Route::get('/feedback/relatorio/pdf', [FeedbackController::class, 'exportarRelatorioMensal'])->name('feedback.relatorio.pdf');



Route::get('/', function () {
     if(Auth::check()){
        return redirect()->route('visitas.index');
     }else{
        return redirect()->route('login');
     }
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
