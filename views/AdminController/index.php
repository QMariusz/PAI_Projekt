<!DOCTYPE html>
<html>

<?php include(dirname(__DIR__).'/head.html'); ?>

<body>
<div class="container">
    <div class="row">
        <h1 class="col-12 pl-0">ADMIN PANEL </h1>
        <h4 class="mt-4">Questions:</h4>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Author</th>
                <th>Question</th>
                <th>Answers</th>
                <th>Votes</th>
                <th>Add Date</th>
                <th>Modify Date</th>
            </tr>
            </thead>
            <tbody class="question_list">
            </tbody>
        </table>
    </div>
    <div class="row">
        <h4 class="mt-4">Users:</h4>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Nickname</th>
                <th>Email</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody class="user_list">
            </tbody>
        </table>
    </div>
    <div>
    <a class="btn btn-primary btn-lg float-center" href="?page=index" role="button">Back</a>
    </div>
    <div class="main" id="main">
        <form action="?page=createQuestion" method="post" id="addForm">
        </form>
        <canvas id="mainChart" width="200" height="250"></canvas>
    </div>
</div>
<script>
//    chyba to ajaxem trzeba zrobic
    window.onload = getAllQuetionsJS();
    window.onload = getAllUsersJS();
</script>
</body>
</html>