<?php
include "Classes/ConnectBD.php";

if(isset($_POST['id'])){

    $id = $_POST['id'];

    if(empty($id)){
        echo 'error';
    }else {
        $tasks = $base->prepare("SELECT id, completed FROM tasks WHERE id=?");
        $tasks->execute([$id]);

        $task = $tasks->fetch();
        $uId = $task['id'];
        $completed = $task['completed'];

        $uCompleted = $completed ? 0 : 1;

        $res = $base->query("UPDATE tasks SET completed=$uCompleted WHERE id=$uId");

        if($res){
            echo $completed;
        }else {
            echo "error";
        }
        $base = null;
        exit();
    }
}else {
    header('Location: list-tasks.php?mess=error');
}
?>
