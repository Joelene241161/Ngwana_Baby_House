<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Chart.js Donut Chart</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>
<body>

<div class="chart-card">
    <canvas id="myDonutChart"></canvas>
</div>

<script>
    const ctx = document.getElementById('myDonutChart').getContext('2d');
    
    const myDonutChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Cuddle Therapy', 'Tummy time', 'Feeding', 'Play', 'Reading'], // task categories
            datasets: [{
                data: [40, 20, 15, 15, 10], // Corresponding hours
                backgroundColor: [
                    '#F26A21',
                    '#F7B731',
                    '#FFB89A',
                    '#36B4E8',
                    '#CAF0FF'
                ],
                borderWidth: 2,
                borderColor: '#ffffff'
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        boxWidth: 12,
                        font: {
                            size: 14
                        }
                    }
                }
            },
            cutout: '55%'
        }
    });
</script>

</body>
</html>