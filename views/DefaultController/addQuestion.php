<!DOCTYPE html>
<html>

<?php include(dirname(__DIR__).'/head.html') ?>

<body>

<div class="container">
    <div clas="row">
        <div class="col-sm-6 offset-sm-3">
            <h1 class="panel-header">QUESTION</h1>
            <hr>
            <?php if(isset($message)): ?>
                <?php foreach($message as $item): ?>
                    <div><?= $item ?></div>
                <?php endforeach; ?>
            <?php endif; ?>

            <form action="?page=addQuestion" method="POST">
                <div class="add_question">
                <div class="form-group row">
                    <div class="col-sm-11">
                        <input type="text" class="form-control" id="inputQuestionName" name="questionName" placeholder="Question" required/>
                    </div>
                </div>
                    <input class="form-control" type="search" placeholder="Search" aria-label="Search" id="search" name="search" required>
                <div class="form-group row">
                    <div class="col-sm-11">
                    </div>
                </div>
                </div>
                <input type="submit" value="Create Question" class="btn btn-primary btn-lg float-right" />
                <a class="btn btn-secondary btn-lg float-right" href="?page=index" role="button">Back</a>
                <a class="btn btn-success btn-lg float-left" onclick="addAnswerField()" role="button" id="buttonPlus">+</a>
                <a class="btn btn-secondary btn-lg float-left" onclick="deleteAnswerField()" role="button" id="buttonMinus">-</a>
            </form>
        </div>
    </div>
</div>

</body>
</html>