<?php
require(dirname(dirname(__FILE__)) . '/init.php');

use App\Teacher;

$teacher = new Teacher('');
$teacher->setConnection($connection);
$allTeachers = $teacher->getAll();

$template = $mustache->loadTemplate('list-teachers');
echo $template->render(compact('allTeachers'));
?>