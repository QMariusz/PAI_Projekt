<!DOCTYPE html>
<html>

<?php include(dirname(__DIR__).'/head.html') ?>

<body>
<?php include(dirname(__DIR__).'/navbar.html'); ?>
<h1>PLAYER</h1>
<canvas id="doughnut-chart" width="800" height="450"></canvas>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js">
    new Chart(document.getElementById("doughnut-chart"), {
        type: 'doughnut',
        data: {
            labels: ["Africa", "Asia", "Europe", "Latin America", "North America"],
            datasets: [
                {
                    label: "Population (millions)",
                    backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
                    data: [2478,5267,734,784,433]
                }
            ]
        },
        options: {
            title: {
                display: true,
                text: 'Predicted world population (millions) in 2050'
            }
        }
    });

</script>
</body>
</html>