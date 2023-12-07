<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    // app/Http/Controllers/TaskController.php


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'priority' => 'required|in:alta,média,baixa',
        ]);

        // Atribui valores numéricos às prioridades
        $priorityValues = [
            'alta' => 1,
            'média' => 2,
            'baixa' => 3,
        ];

        // Verifica se já existe uma tarefa com a mesma prioridade
        $existingTask = Task::where('priority', $validatedData['priority'])->first();

        if ($existingTask) {
            // Se já existir, cria uma nova tarefa com a mesma prioridade
            $newPriority = $priorityValues[$validatedData['priority']];
        } else {
            // Se não existir, utiliza a prioridade definida
            $newPriority = $priorityValues[$validatedData['priority']];
        }

        $newPriority = $validatedData['priority'];

        // Cria uma nova tarefa
        $newTask = Task::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'priority' => $newPriority,
            'status' => 'a_fazer',
            'user_id' => auth()->user()->id,
        ]);

        // Adiciona a nova tarefa à lista
        $tasks = Task::orderByRaw("FIELD(priority, 'alta', 'média', 'baixa')")->orderBy('created_at', 'asc')->get();


        return view('home', compact('tasks'))->with('success', 'Tarefa adicionada com sucesso!');

    }

    public function updateStatus(Request $request, Task $task)
    {
        $validatedData = $request->validate([
            'status' => 'required|in:a_fazer,fazendo,feito',
        ]);

        $task->update([
            'status' => $validatedData['status'],
            'user_id' => auth()->user()->id,
        ]);

        // Reorganiza as tarefas ao mudar o status do menor para o maior
        $tasks = Task::orderByRaw("FIELD(priority, 'alta', 'média', 'baixa')")->orderBy('created_at', 'asc')->get();

        return view('home', compact('tasks'))->with('success', 'Tarefa adicionada com sucesso!');
    }
    public function destroy(Task $task)
    {
        $task->delete();

        // Redireciona de volta à página inicial após a remoção da tarefa
        $tasks = Task::orderByRaw("FIELD(priority, 'alta', 'média', 'baixa')")->orderBy('created_at', 'asc')->get();

        // Você deve passar as tarefas como parâmetro para a view 'home'
        return view('home', compact('tasks'))->with('success', 'Tarefa removida com sucesso!');
    }

    public function index()
    {
        $tasks = Task::where('user_id', auth()->user()->id)
            ->latest('priority')
            ->latest('created_at')
            ->get();

        return view('home', compact('tasks'));
    }
}

// app/Http/Controllers/TaskController.php
