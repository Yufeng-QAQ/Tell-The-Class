// Example data for grades
const gradeData = {
    labels: ['A', 'B', 'C', 'D', 'F'], // Grade labels
    datasets: [{
        label: 'Number of Students',
        data: grade_data, // Number of students for each grade
        backgroundColor: [
            'rgba(75, 192, 192, 0.6)', // A
            'rgba(54, 162, 235, 0.6)', // B
            'rgba(255, 206, 86, 0.6)', // C
            'rgba(255, 99, 132, 0.6)', // D
            'rgba(153, 102, 255, 0.6)' // F
        ],
        borderColor: [
            'rgba(75, 192, 192, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(255, 99, 132, 1)',
            'rgba(153, 102, 255, 1)'
        ],
        borderWidth: 1
    }]
};

// Bar chart configuration
const config = {
    type: 'bar',
    data: gradeData,
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: {
                // Ensure the y-axis starts at 0
                beginAtZero: true
            }
        }
    }
};

// Render the chart
const gradeChart = new Chart(
    document.getElementById('gradeChart'),
    config
);
