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
            });
        });
}

function showOtherQuestions(){
    const apiUrl = "http://localhost:8001";
    const $list = $('.question_list');
    const endpoint = '/?page=voteSearch';

    $.ajax({
        type: 'POST',
        url : apiUrl + endpoint,
        dataType : 'json'
    })
        .done((res) => {
            console.log(res);
            $list.empty();
            res.forEach(el => {
                $list.append(`<a class="list-group-item list-group-item-action" onclick=
                'showAnswersToVote(`+ "\"" + el.id + "\"" + "," + "\"" + el.question_name + "\"" + "," + "\"" + el.answers + "\"" + `)')>${el.question_name}</a>`);
            })
        });
}

function showAnswersToVote(id, name, answers) {
    const $list = $('.add_vote');
    var odp = answers.split(", ");

    $list.empty();
    $list.append(name);
    for (var i = 0; i < odp.length; i++) {
        $list.append(`<div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="`+id + "," + i +`" checked>
            <label class="form-check-label" for="exampleRadios1">
            ` + odp[i]+ `
            </label>
            </div>`);
    }
    $list.append(`
        <input type="submit" value="Vote" class="btn btn-primary btn-lg float-right" />
        <!--do ajaxa podciagn¹æ to-->
        <a class="btn btn-secondary btn-lg float-right" href="?page=vote" role="button">Cancel</a>`);
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