<?php
require(dirname(dirname(__FILE__)) . '/init.php');

use App\ClassRoster;
use App\Course;
use App\Student;

$id = $_GET['id'];
$courses = new Course('');
$courses->setConnection($connection);
$course = $courses->getAll();

$students = new Student('');
$students->setConnection($connection);
$student = $students->getAll();

if (isset($_POST['save_student_roster'])) {

    try {
        $roster = new ClassRoster($_POST['course_code'], $_POST['student_id']);
        $roster->setConnection($connection);
        $roster->save();
        header("Location: index.php");
        exit();
    } catch (Exception $e) {
        error_log($e->getMessage());
    }
}