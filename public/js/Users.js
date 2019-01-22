function getAllUsersJS(){
    const apiUrl = "http://localhost:8001";
    const $list = $('.user_list');
    const endpoint = '/?page=allUsers';
    $list.empty();
    $.ajax({
        type: 'POST',
        url : apiUrl + endpoint,
        dataType : 'json'
    })
        .done((res) => {
            res.forEach(el => {
                $list.append(`<tr>
                <td>${el.nickname}</td>
                <td>${el.email}</td>
                <td>${el.role_name}</td>
                <td>
                <button class="btn btn-danger" id="${el.role_name}" type="button" onclick="deleteUser(${el.id_user})">
                    <i class="material-icons">delete_forever</i>
                </button>
                <button class="btn btn-danger" id="${el.role_name}_promote" type="button" onclick="promoteUser(${el.id_user})">
                    <i class="material-icons">card_travel</i>
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
            getAllUsersJS();
            getAllQuetionsJS();
        }
    });
}

function promoteUser(id) {
    if (!confirm('Do you want to promote this user?')) {
        return;
    }

    const apiUrl = "http://localhost:8001";

    $.ajax({
        url: apiUrl + '/?page=promoteUser',
        method: "POST",
        data: {
            id: id
        },
        success: function () {
            alert('Selected user successfully promoted!');
            getAllUsersJS();
        }
    });
}