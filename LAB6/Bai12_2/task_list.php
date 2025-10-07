<?php
// Lấy danh sách tasks từ session
$tasks = $_SESSION['tasks'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Task List Manager</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
    <header><h1>Task List Manager</h1></header>
    <main>
        <h2>Task List</h2>
        <?php if (count($tasks) == 0) : ?>
            <p>There are no tasks in the list.</p>
        <?php else: ?>
            <ul>
                <?php foreach ($tasks as $id => $task) : ?>
                    <li>
                        <?php echo htmlspecialchars($task); ?>
                        <form action="index.php" method="post" style="display:inline;">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="taskid" value="<?php echo $id; ?>">
                            <input type="submit" value="Remove">
                        </form>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <h2>Add Task</h2>
        <form action="index.php" method="post">
            <input type="hidden" name="action" value="add">
            <label>Task:</label>
            <input type="text" name="newtask">
            <input type="submit" value="Add Task">
        </form>
    </main>
</body>
</html>
