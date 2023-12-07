<!-- resources/views/components/task-column.blade.php -->
@props(['tasks', 'status'])

<div class="card">
    <div class="card-header">{{ ucfirst($status) }}</div>
    <div class="card-body">
        @isset($tasks)
            <!-- Exibir tarefas existentes -->
            @foreach ($tasks->where('status', $status) as $task)
                <div class="task p-3 border border-dark rounded" data-task-id="{{ $task->id }}">
                    <h5>{{ $task->title }}</h5>
                    <p>{{ $task->description }}</p>
                    <p>Prioridade: {{ ucfirst($task->priority) }}</p>

                    <!-- Formulário para mover a tarefa entre os estados -->
                    <form action="{{ route('tasks.updateStatus', $task->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <select name="status" class="form-control" onchange="this.form.submit()">
                            <option value="a_fazer" {{ $task->status === 'a_fazer' ? 'selected' : '' }}>A Fazer</option>
                            <option value="fazendo" {{ $task->status === 'fazendo' ? 'selected' : '' }}>Fazendo</option>
                            <option value="feito" {{ $task->status === 'feito' ? 'selected' : '' }}>Feito</option>
                        </select>
                    </form>

                    <!-- Formulário para remover a tarefa -->
                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <br>
                        <button type="submit" class="btn btn-danger btn-sm">Remover</button>
                    </form>
                </div>
                <br><br><br>
            @endforeach
        @else
            <p>No tasks found.</p>
        @endisset
    </div>
</div>
