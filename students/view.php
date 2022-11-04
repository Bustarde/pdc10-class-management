<?php
require(dirname(dirname(__FILE__)) . '/init.php');

use App\Student;
use App\Course;

$id = $_GET['id'];
$getCourses = new Student('');
$getCourses->setConnection($connection);
$courses = $getCourses->viewCourses($id);

$student_name = new Student('');
$student_name->setConnection($connection);
$student = $student_name->getById($id);

$template = $mustache->loadTemplate('view-student');
echo $template->render(compact('student', 'courses'))
?>
