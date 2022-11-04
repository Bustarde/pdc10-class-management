<?php
require(dirname(dirname(__FILE__)) . '/init.php');

use App\Student;

if (isset($_POST['save_student'])) {

    try {

        $student = new Student($_POST['student_code'], $_POST['name'], $_POST['email'], $_POST['contact_number'], $_POST['program']);
        $student->setConnection($connection);
        $student->save();
        header("Location: index.php");
        exit();
    } catch (Exception $e) {
        error_log($e->getMessage());
    }
}