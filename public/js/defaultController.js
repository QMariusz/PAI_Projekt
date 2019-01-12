function showQuestions(){
    const apiUrl = "http://localhost:8001";
    const $list = $('.users-list');
    // alert();
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
            $list.append(`<tr>
                <td>${el.name}</td>
                </tr>`);
        })
    });

    for(var c in jArray) {
        //tutaj dodaæ id usera
        if(jArray[c]['authorId']==2) {
            var divZObrazer = document.createElement('a');
            divZObrazer.id = "questionContainer".concat(jArray[c]['id']);
            divZObrazer.href = "?=authorQuestion";
            document.getElementById("yourQuestions").appendChild(divZObrazer);

            var container = document.createElement('div');
            container.className = "authorQuestion";
            container.id = "questionContainer";
            container.innerHTML = jArray[c]['name'];
            document.getElementById("questionContainer".concat(jArray[c]['id'])).appendChild(container);
        }

        var divZObrazer = document.createElement('a');
        divZObrazer.id = "answerContainer".concat(jArray[c]['id']);
        divZObrazer.href = "?=authorQuestion".concat(jArray[c]['id']);
        document.getElementById("yourAnswers").appendChild(divZObrazer);

        var container = document.createElement('div');
        container.className = "authorQuestion";
        container.id = "answerContainer".concat(jArray[c]['id']);
        container.innerHTML = jArray[c]['name'];
        document.getElementById("answerContainer".concat(jArray[c]['id'])).appendChild(container);
    }
}