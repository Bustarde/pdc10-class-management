<?php
require(dirname(dirname(__FILE__)) . '/init.php');

use App\ClassRoster;
use App\Course;
use App\Student;

$id = $_GET['id'];
$rosters = new ClassRoster('');
$rosters->setConnection($connection);
$roster = $rosters->getById($id);

$courses = new Course('');
$courses->setConnection($connection);
$course = $courses->getAll();

$students = new Student('');
$students->setConnection($connection);
$student = $students->getAll();

if (isset($_POST['edit_roster'])) {

    try {
        $rosters->update($_POST['id'], $_POST['course_code'], $_POST['student_id'], $_POST['date_enrolled']);
        header("Location: index.php");
        exit();
    } catch (Exception $e) {
        error_log($e->getMessage());
    }
}
