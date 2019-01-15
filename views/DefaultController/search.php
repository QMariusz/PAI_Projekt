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
                    <a class="nav-link" href="?page=showQuestions">Your Questions</a>
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
            <nav class="navbar navbar-dark default-color">
                <form class="form-inline my-2 my-lg-0" method="POST" >
                    <input class="form-control" type="search" placeholder="Search" aria-label="Search" id="search" name="search">
                    <button class="btn btn-outline-white btn-md my-2 my-sm-0 ml-3" type="submit" id="sumbit" onclick=showQuestions('searchResult')>Search</button>
                </form>
            </nav>
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="btn btn-info btn-lg float-left" href="?page=logout" role="button">Logout</a>
                </li>
            </ul>
            <!-- Collapsible content -->

    </nav>
    <div class="row">
        <h1 class="col-12 pl-0">Search result for </h1>
        <h3 class="col-12 pl-0" id="searchText"></h3>
        <h4 class="mt-4">Your data:</h4>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Author</th>
                <th>Question</th>
                <th>Answers</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody class="question_list">
            </tbody>
        </table>
    </div>
    <nav class="navbar navbar-dark default-color">
        <form class="form-inline my-2 my-lg-0" action="?page=search" method="POST">
            <div class="form-group row">
                <div class="col-sm-11">
                    <input type="text" name="answer0" class="form-control" id="inputSearch" placeholder="answer" required/>
                </div>
            </div>
            <button class="btn btn-outline-white btn-md my-2 my-sm-0 ml-3" type="submit" id="submit" onclick="showQuestions('searchResult')" >Search</button>
        </form>
    </nav>
    <div class="main" id="main">
        <form action="?page=createQuestion" method="post" id="addForm">
        </form>
        <canvas id="mainChart" width="200" height="250"></canvas>
    </div>
</div>
</body>
</html>