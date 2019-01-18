function getAllUsersJS(){
    const apiUrl = "http://localhost:8001";
    const $list = $('.user_list');
    const endpoint = '/?page=allUsers';

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
                <td>${el.email}</td>
                <td>${el.role}</td>
                <td>
                <button class="btn btn-danger" type="button" onclick="deleteUser(${el.id})">
                    <i class="material-icons">delete_forever</i>
                </button>
                </td>
                </tr>`);
            });
        });
}

function deleteUser(id) {
    if (!confirm('Do you want to delete this user?')) {
        return;
    }

    const apiUrl = "http://localhost:8001";

    $.ajax({
        url : apiUrl + '/?page=deleteUser',
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