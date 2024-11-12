import Chart from 'chart.js/auto';

const data = {
    labels: [
        'cluster 1',
        'cluster 2',
        'cluster 3'
    ],
    datasets: [{
        label: 'total Data ',
        data: [78, 5, 75],
        backgroundColor: [
            'rgb(255, 99, 132)',
            'rgb(54, 162, 235)',
            'rgb(255, 205, 86)'
        ],
        hoverOffset: 4,
        weight: 200
    }]
};

const config = {
    type: 'doughnut',
    data: data,
};

new Chart(
    document.getElementById('myChart'),
    config
);
