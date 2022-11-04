<?php

require(dirname(dirname(__FILE__)) . '/init.php');

use App\Teacher;

$teachers = new Teacher('');
$teachers->setConnection($connection);
$teacher = $teachers->getAll();

$template = $mustache->loadTemplate('add-teacher');
echo $template->render();
?>
