<!DOCTYPE html>
<html>

<?php include(dirname(__DIR__).'/head.html'); ?>

<body>
<?php
if(isset($_SESSION) && !empty($_SESSION)) {
    print_r($_SESSION);
}
?>
<div class="container">
    <nav class="navbar navbar-expand-lg navbar-dark navbar-default">

        <!-- Navbar imge -->
        <nav class="navbar navbar-dark danger-color">
            <a class="navbar-brand" href="?page=index">
                <img src="../../public/img/logo.png" height="30" alt="mdb logo">
            </a>
        </nav>

        <!-- Collapse button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
                aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">
            </span>
        </button>

        <!-- Collapsible content -->
        <div class="collapse navbar-collapse" id="basicExampleNav">

            <!-- Links -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="?page=index">Home
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?page=addQuestion">Add Question</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?page=questions">Your Questions</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?page=search">Search</a>
                </li>

                <!-- Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                       aria-expanded="false">Dropdown</a>
                    <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>

            </ul>
            <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="btn btn-info btn-lg float-left" href="?page=logout" role="button">Logout</a>
            </li>
            </ul>
            <!-- Collapsible content -->

    </nav>
    <div class="main" id="main">
        <form action="?page=createQuestion" method="post" id="addForm">
        </form>
        <canvas id="mainChart" width="200" height="250"></canvas>
    </div>
</div>
</body>
</html>