<!DOCTYPE html>
<html>

<?php include(dirname(__DIR__).'/head.html'); ?>

<body>
<?php
if(isset($_SESSION) && !empty($_SESSION)) {
    print_r($_SESSION);
}
?>
<div class="container">
    <nav class="navbar navbar-expand-lg navbar-dark navbar-default">

        <!-- Navbar imge -->
        <nav class="navbar navbar-dark danger-color">
            <a class="navbar-brand" href="?page=index">
                <img src="../../public/img/logo.png" height="30" alt="mdb logo">
            </a>
        </nav>

        <!-- Collapse button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
                aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">
            </span>
        </button>

        <!-- Collapsible content -->
        <div class="collapse navbar-collapse" id="basicExampleNav">

            <!-- Links -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="?page=index">Home
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?page=addQuestion">Add Question</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?page=questions">Your Questions</a>
                </li>

                <!-- Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                       aria-expanded="false">Dropdown</a>
                    <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>

            </ul>
            <nav class="navbar navbar-dark default-color">
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-white btn-md my-2 my-sm-0 ml-3" type="submit">Search</button>
                </form>
            </nav>
            <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="btn btn-info btn-lg float-left" href="?page=logout" role="button">Logout</a>
            </li>
            </ul>
            <!-- Collapsible content -->

    </nav>
    <div class="main" id="main">
        <form action="?page=createQuestion" method="post" id="addForm">
        </form>
        <canvas id="mainChart" width="200" height="250"></canvas>
    </div>
</div>
<!--<script>-->
<!---->
<!--    function showChart() {-->
<!--        new Chart(document.getElementById("mainChart"), {-->
<!--            type: 'doughnut',-->
<!--            data: {-->
<!--                labels: ["Africa", "Asia", "Europe", "Latin America", "North America"],-->
<!--                datasets: [{-->
<!--                    label: "Population (millions)",-->
<!--                    backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],-->
<!--                    data: [2478,5267,734,784,433]-->
<!--                }]-->
<!--            },-->
<!--            options: {-->
<!--                title: {-->
<!--                    display: true,-->
<!--                    text: 'Nazwa pytania'-->
<!--                }-->
<!--            }-->
<!--        });-->
<!--    }-->
<!---->
<!--    function addQuestion(){-->
<!--        var array = ["1","2","3","4","5","6","7","8","9"];-->
<!---->
<!--        var dive = document.createElement("div");-->
<!--        dive.innerHTML = "Wybierz ile odpowiedzi";-->
<!--        dive.class = "answers";-->
<!--        dive.color = "blue";-->
<!--        document.getElementById("addForm").appendChild(dive);-->
<!---->
<!--        var select = document.createElement('select');-->
<!--        select.id = "selectAnswers";-->
<!--        select.name = "selectAnswers";-->
<!--        document.getElementById("addForm").appendChild(select);-->
<!---->
<!--        for (var i = 0; i < array.length; i++) {-->
<!--            var option = document.createElement("option");-->
<!--            option.value = array[i];-->
<!--            option.text = array[i];-->
<!--            select.appendChild(option);-->
<!--        }-->
<!---->
<!--        document.getElementById("addForm").appendChild(document.createElement("br"));-->
<!---->
<!--        var newElement = document.createElement('input');-->
<!--        newElement.type = "submit";-->
<!--        newElement.name = "submit";-->
<!--        newElement.value = "Create";-->
<!--        document.getElementById("addForm").appendChild(newElement);-->
<!--    }-->
<!---->
<!--    function createQuestion(){-->
<!---->
<!--         var textarea = document.createElement("textarea");-->
<!--         textarea.id = "text";-->
<!--         textarea.required = "required";-->
<!--         textarea.cols = "32";-->
<!--         textarea.rows = "1";-->
<!--         textarea.name= "textarea";-->
<!--         textarea.placeholder = "Enter Question Name";-->
<!--         document.getElementById("addForm").appendChild(textarea);-->
<!---->
<!--         document.getElementById("addForm").appendChild(document.createElement("br"));-->
<!---->
<!--         for (var i = 1; i <= count; i++) {-->
<!--             var addAnswer = document.createElement('input');-->
<!--             addAnswer.type = 'text';-->
<!--             addAnswer.name = i;-->
<!--             addAnswer.className = "questionInput";-->
<!--             addAnswer.required = "required";-->
<!--             addAnswer.placeholder = "type your question";-->
<!--             document.getElementById("addForm").appendChild(addAnswer);-->
<!--             document.getElementById("addForm").appendChild(document.createElement("br"));-->
<!---->
<!--         }-->
<!---->
<!--         document.getElementById("addForm").appendChild(document.createElement("br"));-->
<!---->
<!--         var newElement = document.createElement('input');-->
<!--         newElement.type = "submit";-->
<!--         newElement.name = "submit";-->
<!--         newElement.value = "Create";-->
<!--         document.getElementById("addForm").appendChild(newElement);-->
<!---->
<!--         document.getElementById("addForm").action = "?page=saveQuestion";-->
<!--    }-->
<!--</script>-->
</body>
</html>