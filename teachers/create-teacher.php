<?php

require(dirname(dirname(__FILE__)) . '/init.php');

use App\Teacher;

$teachers = new Teacher('');
$teachers->setConnection($connection);
$teacher = $teachers->getAll();

if (isset($_POST['save_teacher'])) {

    try {
        $teacher = new Teacher($_POST['teacher_code'], $_POST['name'], $_POST['email'], $_POST['contact_number']);
        $teacher->setConnection($connection);
        $teacher->save(); 
        header("Location: index.php");
        exit();
    } catch (Exception $e) {
        error_log($e->getMessage());
    }
    
}

?>