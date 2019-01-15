function showQuestions(end){
    const apiUrl = "http://localhost:8001";
    const $list = $('.question_list');
    const endpoint = '/?page=' + end;
    var inputSearch = $('#inputSearch').val();
    $.ajax({
        type: 'POST',
        url : apiUrl + endpoint,
        data: {search: inputSearch},
        dataType : 'json'
    })
        .done((res) => {
            console.log(res);
        $list.empty();
        res.forEach(el => {
            $list.append(`<tr onclick='showChart(`+ "\"" + el.question_name + "\"" + "," + "\"" + el.answers + "\"" + "," + "\"" + el.votes + "\"" + `)'>
                <td>${el.author_id}</td>
                <td>${el.question_name}</td>
                <td>${el.answers}</td>
                <td>${el.votes}</td>
                <td>
                <button class="btn btn-danger" type="button" onclick="deleteQuestion(${el.id})">
                    <i class="material-icons">delete_forever</i>
                </button>
                </td>
                </tr>`);
        })
    });
}

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


function deleteQuestion(id) {
    if (!confirm('Do you want to delete this user?')) {
        return;
    }

    const apiUrl = "http://localhost:8001";

    $.ajax({
        url : apiUrl + '/?page=deleteQuestion',
        method : "POST",
        data : {
            id : id
        },
        success: function() {
            alert('Selected user successfully deleted from database!');
            showQuestions();
        }
    });
}

function showChart(name, answers, votes) {
    answ = answers.split(",");
    vote = votes.split(",");
    allColors = ["#3e95cd", "#8e5ea2", "#3cba9f", "#e8c3b9", "#c45850"];
    const shuffled = allColors.sort(() => .5 - Math.random());// shuffle
    colors = shuffled.slice(0,vote.length);
    new Chart(document.getElementById("mainChart"), {
        type: 'doughnut',
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

