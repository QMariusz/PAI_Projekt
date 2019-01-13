function showQuestions(){
    const apiUrl = "http://localhost:8001";
    const $list = $('.question_list');
    $.ajax({
        url : apiUrl + '/?page=showQuestions',
        dataType : 'json'
    })
        .done((res) => {
            console.log(res);
        $list.empty();
        //robimy pêtlê po zwróconej kolekcji
        //do³¹czaj¹c do tabeli kolejne wiersze
        res.forEach(el => {
            $list.append(`<tr onclick="showChart()">
                <td>${el.author_id}</td>
                <td>${el.name}</td>
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

    // for(var c in jArray) {
    //     //tutaj dodaæ id usera
    //     if(jArray[c]['authorId']==2) {
    //         var divZObrazer = document.createElement('a');
    //         divZObrazer.id = "questionContainer".concat(jArray[c]['id']);
    //         divZObrazer.href = "?=authorQuestion";
    //         document.getElementById("yourQuestions").appendChild(divZObrazer);
    //
    //         var container = document.createElement('div');
    //         container.className = "authorQuestion";
    //         container.id = "questionContainer";
    //         container.innerHTML = jArray[c]['name'];
    //         document.getElementById("questionContainer".concat(jArray[c]['id'])).appendChild(container);
    //     }
    //
    //     var divZObrazer = document.createElement('a');
    //     divZObrazer.id = "answerContainer".concat(jArray[c]['id']);
    //     divZObrazer.href = "?=authorQuestion".concat(jArray[c]['id']);
    //     document.getElementById("yourAnswers").appendChild(divZObrazer);
    //
    //     var container = document.createElement('div');
    //     container.className = "authorQuestion";
    //     container.id = "answerContainer".concat(jArray[c]['id']);
    //     container.innerHTML = jArray[c]['name'];
    //     document.getElementById("answerContainer".concat(jArray[c]['id'])).appendChild(container);
    // }
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
