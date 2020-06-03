//Used in the statistics admin page
let canvas1 = document.getElementById('statsCat');
let canvas2 = document.getElementById('statsBid');

function createCharts() {
    if (this.status != 200) {
        window.location = '/';
    }

    let response = JSON.parse(this.responseText);

    console.log(response);

    let labels = [];
    let data = [];

    for (let i = 0; i < response.auctions.length; i++) {
        labels.push(response.auctions[i].name)
        data.push(response.auctions[i].auctions)
    }

    let c1 = new Chart(canvas1, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Auctions Per Category',
                data: data,
                borderWidth: 1,
                backgroundColor: 'rgba(140,45,25,0.8)',
                borderColor: 'rgba(140,45,25,0.8)',
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            },
            responsive: true
        }
    });

    labels = [];
    data = [];

    for (let i = 0; i < response.bids.length; i++) {
        labels.push(response.bids[i].name)
        data.push(response.bids[i].total)
    }

    let c2 = new Chart(canvas2, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Money Per Category',
                data: data,
                borderWidth: 1,
                backgroundColor: 'rgba(133, 187, 101,0.8)',
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            },
            responsive: true
        }
    });
}

sendAjaxRequest('get', '/api/administration/statistics' , null, createCharts);

