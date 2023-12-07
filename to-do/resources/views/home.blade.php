<!-- resources/views/home.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Home</div>
                    <div class="card-body">

                        @isset($tasks)
                            <!-- Adicionar novo formulário de tarefa -->
                            <form action="{{ route('tasks.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="title">Título da Tarefa:</label>
                                    <input type="text" name="title" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="description">Descrição:</label>
                                    <textarea name="description" class="form-control" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="priority">Prioridade:</label>
                                    <select name="priority" class="form-control" required>
                                        <option value="alta">Alta</option>
                                        <option value="média">Média</option>
                                        <option value="baixa">Baixa</option>
                                    </select>
                                </div>
                                <br>
                                <button type="submit" class="btn btn-primary">Adicionar Tarefa</button>
                            </form>
                            <br><br>
                            <x-kanban :tasks="$tasks" />
                        @else
                            <p>No tasks found.</p>
                        @endisset
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
