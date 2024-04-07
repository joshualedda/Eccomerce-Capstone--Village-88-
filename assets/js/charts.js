function getFixedColors() {
    return [
      'rgba(255, 99, 132, 0.5)', // Red
      'rgba(54, 162, 235, 0.5)', // Blue
      'rgba(255, 206, 86, 0.5)', // Yellow
      'rgba(75, 192, 192, 0.5)', // Green
      'rgba(153, 102, 255, 0.5)', // Purple
      'rgba(255, 159, 64, 0.5)' // Orange
    ];
  }

  function getStatusLabel(status) {
    switch (status) {
      case 0:
        return 'Pending';
      case 1:
        return 'In Process';
      case 2:
        return 'Shipped';
      case 3:
        return 'Delivered';
      case 4:
        return 'Cancelled';
      case 5:
        return 'Refund';
      default:
        console.log('Unknown status:', status); 
        return 'Unknown';
    }
  }

  document.addEventListener("DOMContentLoaded", () => {
    $.ajax({
      url: 'dashboards/fetchOrdersData', 
      type: 'GET',
      dataType: 'json',
      success: function (data) {
        updateChart(data);
      },
      error: function (xhr, status, error) {
        console.error(error);
      }
    });

    function updateChart(data) {
      var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
      var labels = months;

      var datasets = [];
      var colors = getFixedColors(); 
      for (var status = 0; status <= 5; status++) {
        var orders = Array(12).fill(0);
        data.forEach(item => {
          if (parseInt(item.status) === status) {
            var index = parseInt(item.month) - 1; 
            orders[index] = parseInt(item.total_orders);
          }
        });
        datasets.push({
          label: getStatusLabel(status),
          data: orders,
          backgroundColor: colors[status], 
          borderColor: 'rgb(255, 255, 255)',
          borderWidth: 1
        });
      }

      var ctx = document.getElementById('barChart').getContext('2d');

      var barChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: labels,
          datasets: datasets
        },
        options: {
          scales: {
            y: {
              beginAtZero: true
            }
          }
        }
      });
    }
  });