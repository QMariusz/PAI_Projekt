<!DOCTYPE html>
<html>

<?php include(dirname(__DIR__).'/head.html'); ?>
<link type="text/css" rel="stylesheet" href="../../style.css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js" type="text/javascript"></script>
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.min.js" type="text/javascript"></script>-->
<body>
<div class="site">
    <div class="menuHeader">

            <!-- Logo -->
            <div id="logoo">
                <a class="logo" href="index.php">
                    <img src="../../public/img/logo.jpg" alt="logo" width="150px" height="100px">
                </a>
            </div>
            <!-- /Logo -->

        <!-- Navigation -->
        <div class="hyperlinks">
            <ul class="main-menu">
                <li><a href="index.php">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Courses</a></li>
                <li><a href="?page=addQuestion">Add Question</a></li>
                <li><a href="contact.html">Contact</a></li>
            </ul>
        </div>
        <!-- /Navigation -->

    </div>
    <div class="questions">
        <div class="leftMenu" id="yourQuestions">
            Twoje glosowania:
        </div>
        <div class="leftMenu" id="yourAnswers">
        Oddane glosy:
        </div>
        <div class="leftMenu" id="allQuestions">
        Wyszukaj gloswania:
        </div>
    </div>
    <div class="main" id="main">
        <form action="?page=createQuestion" method="post" id="addForm">
        </form>
        <canvas id="mainChart" width="200" height="250"></canvas></div>
</div>
<?php
if(isset($_SESSION) && !empty($_SESSION)) {
    print_r($_SESSION);
}
?>

<script>


    var func = <?php echo $function; ?>;
    
    switch(func) {
        case addQuestion:
            addQuestion();
            loadQuestions();
            break;
        case showChart:
            showChart();
            loadQuestions();
            break;
        case createQuestion:
            loadQuestions();
            createQuestion();
            break;
        default:
            loadQuestions();
    }

    function showChart() {
        new Chart(document.getElementById("mainChart"), {
            type: 'doughnut',
            data: {
                labels: ["Africa", "Asia", "Europe", "Latin America", "North America"],
                datasets: [{
                    label: "Population (millions)",
                    backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
                    data: [2478,5267,734,784,433]
                }]
            },
            options: {
                title: {
                    display: true,
                    text: 'Nazwa pytania'
                }
            }
        });
    }

    function addQuestion(){
        var array = ["1","2","3","4","5","6","7","8","9"];

        var dive = document.createElement("div");
        dive.innerHTML = "Wybierz ile odpowiedzi";
        dive.class = "answers";
        dive.color = "blue";
        document.getElementById("addForm").appendChild(dive);

        var select = document.createElement('select');
        select.id = "selectAnswers";
        select.name = "selectAnswers";
        document.getElementById("addForm").appendChild(select);

        for (var i = 0; i < array.length; i++) {
            var option = document.createElement("option");
            option.value = array[i];
            option.text = array[i];
            select.appendChild(option);
        }

        document.getElementById("addForm").appendChild(document.createElement("br"));

        var newElement = document.createElement('input');
        newElement.type = "submit";
        newElement.name = "submit";
        newElement.value = "Create";
        document.getElementById("addForm").appendChild(newElement);
    }

    function createQuestion(){
        var count = <?php echo $number; ?>;

         var textarea = document.createElement("textarea");
         textarea.id = "text";
         textarea.required = "required";
         textarea.cols = "32";
         textarea.rows = "1";
         textarea.name= "textarea";
         textarea.placeholder = "Enter Question Name";
         document.getElementById("addForm").appendChild(textarea);

         document.getElementById("addForm").appendChild(document.createElement("br"));

         for (var i = 1; i <= count; i++) {
             var addAnswer = document.createElement('input');
             addAnswer.type = 'text';
             addAnswer.name = i;
             addAnswer.className = "questionInput";
             addAnswer.required = "required";
             addAnswer.placeholder = "type your question";
             document.getElementById("addForm").appendChild(addAnswer);
             document.getElementById("addForm").appendChild(document.createElement("br"));

         }

         document.getElementById("addForm").appendChild(document.createElement("br"));

         var newElement = document.createElement('input');
         newElement.type = "submit";
         newElement.name = "submit";
         newElement.value = "Create";
         document.getElementById("addForm").appendChild(newElement);

         document.getElementById("addForm").action = "?page=saveQuestion";
    }

    function loadQuestions(){
        var jArray = <?php echo json_encode($variables); ?>;

        for(var c in jArray) {
            //tutaj dodać id usera
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
</script>
</body>
</html>