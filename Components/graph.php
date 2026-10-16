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
    
    // dataset values
    const chartData = [
        <?php echo isset($taskHoursMap['cuddle']) ? $taskHoursMap['cuddle'] : 0; ?>,
        <?php echo isset($taskHoursMap['tummy']) ? $taskHoursMap['tummy'] : 0; ?>,
        <?php echo isset($taskHoursMap['feed']) ? $taskHoursMap['feed'] : 0; ?>,
        <?php echo isset($taskHoursMap['play']) ? $taskHoursMap['play'] : 0; ?>,
        <?php echo isset($taskHoursMap['reading']) ? $taskHoursMap['reading'] : 0; ?>
    ];

    const myDonutChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Cuddle Therapy', 'Tummy time', 'Feeding support', 'Play time', 'Reading & stories'],
            datasets: [{
                data: chartData,
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
            responsive: false,
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