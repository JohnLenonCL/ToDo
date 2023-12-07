// public/js/kanban.js
import dragula from 'dragula';

document.addEventListener('DOMContentLoaded', function () {
    const containers = document.querySelectorAll('.kanban-container');

    const drake = dragula(containers);

    drake.on('drop', (el, target, source) => {
        // Aqui, você pode enviar uma requisição para atualizar o status da tarefa no backend
        const taskId = el.dataset.taskId;
        const newStatus = target.dataset.status;

        // Exemplo de requisição usando fetch
        fetch(`/tasks/${taskId}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            },
            body: JSON.stringify({ status: newStatus }),
        })
        .then(response => response.json())
        .then(data => console.log(data))
        .catch(error => console.error(error));
    });
});
