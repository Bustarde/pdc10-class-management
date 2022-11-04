<?php

require(dirname(dirname(__FILE__)) . '/init.php');

use App\Course;

if (isset($_POST['save_course'])) {

    try {
        $course = new Course($_POST['course_code'], $_POST['name'], $_POST['description'], $_POST['teacher_id']);
        $course->setConnection($connection);
        $course->save(); 
        header("Location: index.php");
        exit();
    } catch (Exception $e) {
        error_log($e->getMessage());
    }
    
}

?>