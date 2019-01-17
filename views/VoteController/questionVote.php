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
    <div class="row">
        <h1 class="col-12 pl-0">Question Vote</h1>

        <h4 class="mt-4">Select Question:</h4>
        <table class="table table-hover">
            <thead>
            <tr>
            </tr>
            </thead>
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
<script>
</script>
</body>
</html>