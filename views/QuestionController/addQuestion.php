<!DOCTYPE html>
<html>

<?php include(dirname(__DIR__) . '/head.html') ?>

<body>
<div class="container" >
    <?php include(dirname(__DIR__).'/navbar.html'); ?>
    <div clas="row">
        <div class="col-sm-6 offset-sm-3">
            <h1 class="panel-header">Create Question</h1>
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
                <div class="form-group row">
                    <div class="col-sm-11">
                        <input class="form-control" type="search" name="answer" placeholder="answer"  required>
                    </div>
                </div>
                </div>
                <input type="submit" value="Create Question" class="btn btn-success btn-lg float-right" id="createButton"/>
                <a class="btn btn-warning btn-lg float-left" onclick="addAnswerField()" role="button" id="buttonPlus">+</a>
                <a class="btn btn-secondary btn-lg float-left" onclick="deleteAnswerField()" role="button" id="buttonMinus">-</a>
            </form>
        </div>
    </div>
</div>

</body>
</html>