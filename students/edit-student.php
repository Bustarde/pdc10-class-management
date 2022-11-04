<?php
require(dirname(dirname(__FILE__)) . '/init.php');

use App\Student;

$id = $_GET['id'];
$student = new Student('');
$student->setConnection($connection);
$student_info = $student->getById($id);

if (isset($_POST['edit_student'])) {

    try {
        $student->update($_POST['id'], $_POST['student_code'], $_POST['name'], $_POST['email'], $_POST['contact_number'], $_POST['program']);
        header("Location: index.php");
        exit();
    } catch (Exception $e) {
        error_log($e->getMessage());
    }
}
