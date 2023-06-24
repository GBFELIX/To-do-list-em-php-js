<?php include 'conect.php';

// Adicionar tarefa
if (isset($_POST['add_task'])) {
    $taskName = $_POST['task_name'];
    $taskDescription = $_POST['task_description'];

    $stmt = $db->prepare("INSERT INTO tasks (task_name, task_description) VALUES (?, ?)");
    $stmt->execute([$taskName, $taskDescription]);
}

// Atualizar tarefa
if (isset($_POST['update_task'])) {
    $taskId = $_POST['task_id'];
    $taskName = $_POST['task_name'];
    $taskDescription = $_POST['task_description'];

    $stmt = $db->prepare("UPDATE tasks SET task_name = ?, task_description = ? WHERE id = ?");
    $stmt->execute([$taskName, $taskDescription, $taskId]);
}

// Excluir tarefa
if (isset($_POST['delete_task'])) {
    $taskId = $_POST['task_id'];

    $stmt = $db->prepare("DELETE FROM tasks WHERE id = ?");
    $stmt->execute([$taskId]);
}

// Exibir tarefas
$stmt = $db->query("SELECT * FROM tasks ORDER BY id DESC");
$tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($tasks as $task) {
    echo '<div>';
    echo '<h3>' . $task['task_name'] . '</h3>';
    echo '<p>' . $task['task_description'] . '</p>';
    echo '<button class="edit-btn" data-id="' . $task['id'] . '" data-name="' . $task['task_name'] . '" data-description="' . $task['task_description'] . '">Editar</button>';
    echo '<button class="delete-btn" data-id="' . $task['id'] . '">Excluir</button>';
    echo '</div>';
}
?>
