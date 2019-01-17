<!DOCTYPE html>
<html>

<?php include(dirname(__DIR__).'/head.html'); ?>

<body>
<div class="container">
    <?php include(dirname(__DIR__).'/navbar.html'); ?>
    <nav class="navbar navbar-dark default-color">
        <div class="form-group row">
            <div class="col-sm-11">
                <input type="text" name="answer0" class="form-control" id="inputSearch" placeholder="answer" required/>
            </div>
        </div>
        <button class="btn btn-outline-white btn-md my-2 my-sm-0 ml-3" type="submit" id="submit" onclick="showQuestions('searchResult')" >Search</button>
    </nav>
    <div class="lewo">
        <table class="table table-hover">
            <thead class="question_head">
            <tbody class="question_list">
            </tbody>
        </table>
    </div>
    <div class="main" id="main">
        <form action="?page=createQuestion" method="post" id="addForm">
        </form>
        <canvas id="mainChart" width="200" height="250"></canvas>
    </div>
</div>
</body>
</html>