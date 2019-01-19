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
    <?php include(dirname(__DIR__).'/navbar.html'); ?>
    <div class="lewo">
        <h1 class="col-12 pl-0">ADMIN PANEL</h1>

        <h4 class="mt-4">Select Question:</h4>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Pytanie</th>

            </tr>
            </thead>
            <tbody class="question_list" id="a">
            </tbody>
        </table>
    </div>
    <div class="main" id="main">
    <form action="?page=formVote" method="POST" class="voteForm">
        <div class="add_vote">
        </div>
    </form>
        <div class="main2" id="main">
            <form action="?page=createQuestion" method="post" id="addForm">
            </form>
        </div>
    </div>
</div>
<script>
    window.onload = showOtherQuestionsAnswered();
    window.onload = showOtherQuestionsNotAnswered();
</script>
</body>
</html>