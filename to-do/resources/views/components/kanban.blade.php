@props(['tasks'])

<!-- resources/views/components/kanban.blade.php -->
@isset($tasks)
<!-- resources/views/components/kanban.blade.php -->
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <!-- Incluindo a coluna de tarefas a fazer -->
            <x-task-column :tasks="$tasks" status="a_fazer" />
        </div>
        <div class="col-md-4">
            <!-- Incluindo a coluna de tarefas fazendo -->
            <x-task-column :tasks="$tasks" status="fazendo" />
        </div>
        <div class="col-md-4">
            <!-- Incluindo a coluna de tarefas feito -->
            <x-task-column :tasks="$tasks" status="feito" />
        </div>
    </div>
</div>

@endisset
