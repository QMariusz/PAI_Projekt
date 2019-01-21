<!DOCTYPE html>
<html>

<?php include(dirname(__DIR__).'/head.html'); ?>

<body>
<div class="container">
    <?php include(dirname(__DIR__).'/navbar.html'); ?>
    <div class="lewo">
        <h1 class="col-12 pl-0">Vote</h1>
        <hr>
        <?php if(isset($message)): ?>
            <?php foreach($message as $item): ?>
                <div><?= $item ?></div>
            <?php endforeach; ?>
        <?php endif; ?>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Pytania</th>

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