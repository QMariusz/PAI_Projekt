function getAllQuetionsJS(){
    const apiUrl = "http://localhost:8001";
    const $list = $('.question_list');
    const endpoint = '/?page=allQuestions';

    $.ajax({
        type: 'POST',
        url : apiUrl + endpoint,
        dataType : 'json'
    })
        .done((res) => {
            console.log(res);
            $list.empty();
            res.forEach(el => {
                $list.append(`<tr>
                <td>${el.nickname}</td>
                <td>${el.question_name}</td>
                <td>${el.answers}</td>
                <td>${el.votes}</td>
                <td>${el.add_date}</td>
                <td>${el.modify_date}</td>
                <td>
                <button class="btn btn-danger" type="button" onclick="deleteQuestion(${el.id})">
                    <i class="material-icons">delete_forever</i>
                </button>
                </td>
                </tr>`);
            });
        });
}

function showOtherQuestionsAnswered(){
    const apiUrl = "http://localhost:8001";
    const $list = $('.question_list');
    const endpoint = '/?page=voteSearch';

    $.ajax({
        type: 'POST',
        url : apiUrl + endpoint,
        dataType : 'json'
    })
        .done((res) => {
            $list.empty();
            res.forEach(el => {
                $list.append(`<a class="list-group-item list-group-item-action" onclick=
                'showChart(`+ "\"" + el.question_name + "\"" + "," + "\"" + el.answers + "\"" +  "," + "\"" + el.votes + "\"" +`)')>${el.question_name}</a>`);
            })
        });
}

function showOtherQuestionsNotAnswered(){
    const apiUrl = "http://localhost:8001";
    const $list = $('.question_list');
    const endpoint = '/?page=notAnswered';

    $.ajax({
        type: 'POST',
        url : apiUrl + endpoint,
        dataType : 'json'
    })
        .done((res) => {
            res.forEach(el => {
                if(el.question_name!==undefined) {
                    $list.append(`<a class="list-group-item list-group-item-action" style="background-color: lightgoldenrodyellow" onclick=
                'showAnswersToVote(` + "\"" + el.id + "\"" + "," + "\"" + el.question_name + "\"" + "," + "\"" + el.answers + "\"" + "," + "\"" + el.votes + "\"" + `)')>${el.question_name}</a>`);
                }
            })
        });
}

function showAnswersToVote(id, name, answers, votes) {
    const $list = $('.add_vote');
    const $list2 = $('.main2');

    var odp = answers.split(", ");
    if(checkAnswerToQuestion(id)) {
        $list.empty();
        $list2.empty();
        $list.append(name);
        for (var i = 0; i < odp.length; i++) {
            $list.append(`<div class="form-check">
            <input class="form-check-input" type="radio" name="voteRadio" id="voteRadio" value="` + id + "," + i + `" checked>
            <label class="form-check-label" for="exampleRadios1">
            ` + odp[i] + `
            </label>
            </div>`);
        }
        $list.append(`
        <input type="submit" value="Vote" class="btn btn-primary btn-lg float-right" />`);
        <!--do ajaxa podciagn¹æ to-->
    }
    else{
        $list.append("Already voted, here is result:");
        showChart(name, answers, votes);
    }
}

function checkAnswerToQuestion(question_id) {
    const apiUrl = "http://localhost:8001";
    $.ajax({
        url : apiUrl + '/?page=checkAnswerToQuestion',
        method : "POST",
        data : {
            question_id: question_id
        },
        async: false,
        success:function (response){
            console.log(response);
            if(response.status === 200) {
                return true;
            } else {
                return false;
            }
        }
        });
        return true;
}

function deleteQuestion(id) {
    if (!confirm('Do you want to delete this question?')) {
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
            alert('Selected question successfully deleted from database!');
            showQuestions();
        }
    });
}

function showQuestions(end){
    const apiUrl = "http://localhost:8001";
    const $list = $('.question_list');
    const endpoint = '/?page=' + end;
    var inputSearch = $('#inputSearch').val();
    $list.empty();
    if(end == "searchResult") {
        $list.append(`<tr>
                <th>Wynik wyszukiwania</th>
            </tr>
            </thead>`)
    }
    $.ajax({
        type: 'POST',
        url : apiUrl + endpoint,
        data: {search: inputSearch},
        dataType : 'json'
    })
        .done((res) => {
            res.forEach(el => {
                $list.append(`<a class="list-group-item list-group-item-action" onclick=
            'showChart(`+ "\"" + el.question_name + "\"" + "," + "\"" + el.answers + "\"" + "," + "\"" + el.votes + "\"" + `)')>${el.question_name}</a>`);
            })
        });
}