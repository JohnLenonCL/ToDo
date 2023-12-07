<!-- resources/views/components/task-column.blade.php -->
@props(['tasks', 'status'])

<div class="card">
    <div class="card-header">{{ ucfirst($status) }}</div>
    <div class="card-body">
        @isset($tasks)
            <!-- Exibir tarefas existentes -->
            @foreach ($tasks->where('status', $status) as $task)
                <div class="task" data-task-id="{{ $task->id }}">
                    <h5>{{ $task->title }}</h5>
                    <p>{{ $task->description }}</p>
                    <p>Priority: {{ ucfirst($task->priority) }}</p>

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
                </div>
            @endforeach

            <!-- Adicionar novo formulário de tarefa -->
            <form action="{{ route('tasks.store') }}" method="POST">
                @csrf
                <!-- ... (campos do formulário para adicionar tarefa) -->
                <button type="submit" class="btn btn-primary">Adicionar Tarefa</button>
            </form>
        @else
            <p>No tasks found.</p>
        @endisset
    </div>
</div>
