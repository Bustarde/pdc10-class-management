<?php
require(dirname(dirname(__FILE__)) . '/init.php');

use App\Course;
use App\Teacher;

$id = $_GET['id'];
$course = new Course('');
$course->setConnection($connection);
$courseInfo = $course->getById($id);

$teachers = new Teacher('');
$teachers->setConnection($connection);
$teacher = $teachers->getAll();

if (isset($_POST['edit_course'])) {

    try {
        $course->update($_POST['id'], $_POST['course_code'], $_POST['name'], $_POST['description'], $_POST['teacher_id']);
        header("Location: index.php");
        exit();
    } catch (Exception $e) {
        error_log($e->getMessage());
    }
}