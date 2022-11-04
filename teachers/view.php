<?php
require(dirname(dirname(__FILE__)) . '/init.php');

use App\Teacher;

$id = $_GET['id'];
$displayCourses = new Teacher('');
$displayCourses->setConnection($connection);
$courses = $displayCourses->viewCourses($id);

$teacher_name = new Teacher('');
$teacher_name->setConnection($connection);
$teacher = $teacher_name->getById($id);

$template = $mustache->loadTemplate('view-teacher');
echo $template->render(compact('courses', 'teacher'))
?>