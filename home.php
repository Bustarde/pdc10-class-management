<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Class Management Application</title>
    <!-- bootstrap 5 css -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css" integrity="sha384-DhY6onE6f3zzKbjUPRc2hOzGAdEf4/Dz+WJwBvEYL/lkkIsI3ihufq9hk9K4lVoK" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    
    <!-- custom css -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <nav class="navbar navbar-expand d-flex flex-column align-item-start" id="sidebar">
        <a href="home.php" class="navbar-brand text-light mt-5">
            <div class="display-7 font-weight" style="color:yellow;"><i class="bi bi-stars"></i> Class Management</div>
        </a>
        <ul class="navbar-nav d-flex flex-column mt-5 w-100">
            <li class="nav-item w-100">
                <a href="home.php" class="nav-link text-light pl-4"><i class="bi bi-house-door"></i> Home</a>
            </li>
            <li class="nav-item w-100">
                <a href="courses/index.php" class="nav-link text-light pl-4"><i class="bi bi-book"></i> Courses</a>
            </li>
            <li class="nav-item w-100">
                <a href="teachers/index.php" class="nav-link text-light pl-4"><i class="bi bi-person-video3"></i> Teachers</a>
            </li>
            <li class="nav-item w-100">
                <a href="students/index.php" class="nav-link text-light pl-4"><i class="bi bi-person"></i> Students</a>
            </li>
            <li class="nav-item w-100">
                <a href="class-roster/index.php" class="nav-link text-light pl-4"><i class="bi bi-card-list"></i> Class Roster</a>
            </li>
        </ul>
    </nav>
    <section class="p-4 my-container">
        <button class="btn my-4" id="menu-btn"><i class="bi bi-list"></i></button>
        <div class="container">
            <div class="col-md-12" style="padding-left: 100px;  padding-right: 100px;">
            <img src="class-management.png" class="img-fluid" alt="Class Management">
            </div>
        </div>

    </section>


    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.min.js" integrity="sha384-5h4UG+6GOuV9qXh6HqOLwZMY4mnLPraeTrjT5v07o347pj6IkfuoASuGBhfDsp3d" crossorigin="anonymous"></script>
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