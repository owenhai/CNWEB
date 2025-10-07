<?php
// Bắt đầu session với thời hạn 1 năm
$lifetime = 60 * 60 * 24 * 365; // 1 năm
session_set_cookie_params($lifetime, '/');
session_start();

// Nếu chưa có tasks trong session thì khởi tạo
if (!isset($_SESSION['tasks'])) {
    $_SESSION['tasks'] = array();
}

// Xử lý action
$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        $action = 'list_tasks';
    }
}

switch ($action) {
    case 'add':
        $new_task = filter_input(INPUT_POST, 'newtask');
        if (!empty($new_task)) {
            $_SESSION['tasks'][] = $new_task;
        }
        include('task_list.php');
        break;
    case 'delete':
        $task_index = filter_input(INPUT_POST, 'taskid', FILTER_VALIDATE_INT);
        if ($task_index !== NULL && $task_index !== FALSE) {
            unset($_SESSION['tasks'][$task_index]);
            $_SESSION['tasks'] = array_values($_SESSION['tasks']);
        }
        include('task_list.php');
        break;
    default:
        include('task_list.php');
        break;
}
?>
