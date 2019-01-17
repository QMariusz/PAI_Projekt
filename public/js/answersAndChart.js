function addAnswerField() {
    const $list = $('.add_question');
    const a = countMyself(true);
    if(a<5) {
        document.getElementById("buttonMinus").className = "btn btn-danger btn-lg float-left";
        $list.append(` <div class="form-group row" id=answer` + a + `>
                    <div class="col-sm-11">
                        <input type="text" name=answer` + a + ` class="form-control" placeholder="answer" required/>
                    </div>
                </div>`);
    }
    else{
        countMyself(false);
    }
    if(a==4){
        document.getElementById("buttonPlus").className = "btn btn-secondary btn-lg float-left";
    }
}

function deleteAnswerField() {
    const a = countMyself(false);
    if(a>0) {
        document.getElementById("answer" + a).remove();
        document.getElementById("buttonPlus").className = "btn btn-success btn-lg float-left";
    }
    else{
        countMyself(true);
    }
    if(a==1){
        document.getElementById("buttonMinus").className = "btn btn-secondary btn-lg float-left";
    }
}

function countMyself($value) {
    if ( typeof countMyself.counter == 'undefined' ) {
        countMyself.counter = 0;
    }
    if($value) {
        return ++countMyself.counter;
    }
    return countMyself.counter--;
}

function showChart(name, answers, votes) {
    answ = answers.split(",");
    vote = votes.split(",");
    allColors = ["#3e95cd", "#8e5ea2", "#3cba9f", "#e8c3b9", "#c45850"];
    const shuffled = allColors.sort(() => .5 - Math.random());// shuffle
    colors = shuffled.slice(0,vote.length);
    new Chart(document.getElementById("mainChart"), {
        type: 'pie',
        data: {
            labels: answ,
            datasets: [{
                backgroundColor: colors,
                data: vote
            }]
        },
        options: {
            title: {
                display: true,
                text: name
            }
        }
    });
}