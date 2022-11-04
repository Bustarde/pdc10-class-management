<?php
require(dirname(dirname(__FILE__)) . '/init.php');

use App\Teacher;

$id = $_GET['id'];
$teachers = new Teacher('');
$teachers->setConnection($connection);
$teacher_info = $teachers->getById($id);

if (isset($_POST['edit_teacher'])) {

    try {
        $teachers->update($_POST['id'], $_POST['teacher_code'], $_POST['name'], $_POST['email'], $_POST['contact_number']);
        header("Location: index.php");
        exit();
    } catch (Exception $e) {
        error_log($e->getMessage());
    }
}
