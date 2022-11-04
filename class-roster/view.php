<?php
require(dirname(dirname(__FILE__)) . '/init.php');

use App\ClassRoster;
use App\Course;

$id = $_GET['id'];
$getRosters = new ClassRoster('');
$getRosters->setConnection($connection);
$rosters = $getRosters->getByClassId($id);

$getCourse = new Course('');
$getCourse->setConnection($connection);
$course = $getCourse->getById($id);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Class Management Application</title>
    <!-- bootstrap 5 css -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css" integrity="sha384-DhY6onE6f3zzKbjUPRc2hOzGAdEf4/Dz+WJwBvEYL/lkkIsI3ihufq9hk9K4lVoK" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- custom css -->
    <link rel="stylesheet" href="/pdc10-classes/css/style.css">
</head>

<body>
    <nav class="navbar navbar-expand d-flex flex-column align-item-start" id="sidebar">
        <a href="/pdc10-classes/home.php" class="navbar-brand text-light mt-5">
            <div class="display-7 font-weight" style="color:yellow;"><i class="bi bi-stars"></i> Class Management</div>
        </a>
        <ul class="navbar-nav d-flex flex-column mt-5 w-100">
            <li class="nav-item w-100">
                <a href="/pdc10-classes/home.php" class="nav-link text-light pl-4"><i class="bi bi-house-door"></i> Home</a>
            </li>
            <li class="nav-item w-100">
                <a href="/pdc10-classes/courses/index.php" class="nav-link text-light pl-4"><i class="bi bi-book"></i> Courses</a>
            </li>
            <li class="nav-item w-100">
                <a href="/pdc10-classes/teachers/index.php" class="nav-link text-light pl-4"><i class="bi bi-person-video3"></i> Teachers</a>
            </li>
            <li class="nav-item w-100">
                <a href="/pdc10-classes/students/index.php" class="nav-link text-light pl-4"><i class="bi bi-person"></i> Students</a>
            </li>
            <li class="nav-item w-100">
                <a href="/pdc10-classes/class-roster/index.php" class="nav-link text-light pl-4"><i class="bi bi-card-list"></i> Class Roster</a>
            </li>
        </ul>
    </nav>
    <section class="p-4 my-container">
        <button class="btn my-4" id="menu-btn"><i class="bi bi-list"></i></button>

        <div class="container mt-4">

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Students in <?php echo $course['name'] ?>
                                <a href="index.php" class="btn btn-primary float-end m-1">Back to Records</a>
                            </h4>
                        </div>
                        <div class="card-body">

                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr class="table-dark">
                                        <th>Student Code</th>
                                        <th>Student Name</th>
                                        <th>Date Enrolled</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($rosters as $info) {
                                        $student_id = $info['student_id'];
                                        $viewStudents = new ClassRoster('');
                                        $viewStudents->setConnection($connection);
                                        $students = $viewStudents->getStudentDetails($student_id);
                                    ?>
                                     <tr> 
                                        <th><?php echo $students['students_code'] ?></th>
                                        <td><?php echo $students['student_name'] ?></td>
                                        <td><?php echo $students['date_enrolled'] ?></td>
                                    </tr>
                                <?php
                                }
                                ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>


    </section>


    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.min.js" integrity="sha384-5h4UG+6GOuV9qXh6HqOLwZMY4mnLPraeTrjT5v07o347pj6IkfuoASuGBhfDsp3d" crossorigin="anonymous"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script> -->
    <!-- custom js -->
    <script>
        var menu_btn = document.querySelector("#menu-btn")
        var sidebar = document.querySelector("#sidebar")
        var container = document.querySelector(".my-container")
        menu_btn.addEventListener("click", () => {
            sidebar.classList.toggle("active-nav")
            container.classList.toggle("active-cont")
        })
    </script>
</body>

</html>