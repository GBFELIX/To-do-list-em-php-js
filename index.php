<?php include 'conect.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>To-Do List</title>
    <!-- css do projeto -->
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        // Exibir tarefas
        function displayTasks() {
            $.ajax({
                url: 'tasks.php',
                type: 'GET',
                success: function(response) {
                    $('#task-list').html(response);
                }
            });
        }

        displayTasks();

        // Adicionar tarefa
        $('#add-task-form').submit(function(e) {
            e.preventDefault();
            var taskName = $('#task-name').val();
            var taskDescription = $('#task-description').val();

            $.ajax({
                url: 'tasks.php',
                type: 'POST',
                data: {
                    'add_task': true,
                    'task_name': taskName,
                    'task_description': taskDescription
                },
                success: function(response) {
                    $('#add-task-form')[0].reset();
                    displayTasks();
                }
            });
        });

        // Editar tarefa
        $(document).on('click', '.edit-btn', function() {
            var taskId = $(this).data('id');
            var taskName = $(this).data('name');
            var taskDescription = $(this).data('description');

            $('#edit-task-form').show();
            $('#edit-task-id').val(taskId);
            $('#edit-task-name').val(taskName);
            $('#edit-task-description').val(taskDescription);
        });

        // Atualizar tarefa
        $('#edit-task-form').submit(function(e) {
            e.preventDefault();
            var taskId = $('#edit-task-id').val();
            var taskName = $('#edit-task-name').val();
            var taskDescription = $('#edit-task-description').val();

            $.ajax({
                url: 'tasks.php',
                type: 'POST',
                data: {
                    'update_task': true,
                    'task_id': taskId,
                    'task_name': taskName,
                    'task_description': taskDescription
                },
                success: function(response) {
                    $('#edit-task-form')[0].reset();
                    $('#edit-task-form').hide();
                    displayTasks();
                }
            });
        });

        // Excluir tarefa
        $(document).on('click', '.delete-btn', function() {
            var taskId = $(this).data('id');

            $.ajax({
                url: 'tasks.php',
                type: 'POST',
                data: {
                    'delete_task': true,
                    'task_id': taskId
                },
                success: function(response) {
                    displayTasks();
                }
            });
        });
    });
    </script>
</head>
<body>
    <div>
        <h1>Sistema de Gerenciamento de Tarefas</h1>
        <form id="add-task-form" method="post" class="first">
            <h2>Adicionar Tarefa</h2>
            <input type="text" name="task_name" id="task-name" placeholder="O que vai fazer?" required>
            <input name="task_description" id="task-description" placeholder="Descrição">
            <input type="submit" class="button"></input>
        </form>
    </div>

    <form id="edit-task-form" method="post" style="display: none;">
        <h2>Editar Tarefa</h2>
        <input type="hidden" name="task_id" id="edit-task-id">
        <input type="text" name="task_name" id="edit-task-name" placeholder="Novo nome da tarefa" required>
        <input name="task_description" id="edit-task-description" placeholder="Nova descrição">
        <input type="submit" class="button" value="Editar"></input>
    </form>

    <h2>Tarefas</h2>
    <div id="task-list" class="list"></div>

    
</body>
</html>
