<?php
require(dirname(dirname(__FILE__)) . '/init.php');

use App\Course;
use App\Teacher;

$id = $_GET['id'];
$course = new Course('');
$course->setConnection($connection);
$course_info = $course->getById($id);

$teachers = new Teacher('');
$teachers->setConnection($connection);
$teacher = $teachers->getAll();

$template = $mustache->loadTemplate('edit-course');
echo $template->render(compact('course_info', 'teacher'));
?>
