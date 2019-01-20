<!DOCTYPE html>
<html>

<?php include(dirname(__DIR__) . '/head.html'); ?>

<body>
<div class="container">
    <?php include(dirname(__DIR__) . '/navbar.html'); ?>
    <div class="lewo">
        <h1 class="col-12 pl-0">Your Questions</h1>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Pytania:</th>

            </tr>
            </thead>
            <tbody class="question_list" id="a">
            </tbody>
        </table>
    </div>
    <div class="main" id="main">
        <canvas id="mainChart"></canvas>
    </div>
</div>
<script>
    window.onload = showQuestions("showYourQuestions");
</script>
</body>
</html>