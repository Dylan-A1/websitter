const dashboardData = {
    residents: 82,
    staff: 24,
    appointments: 15,
    alerts: 2
  };

  function populateDashboard() {
    document.getElementById('residents-count').innerText = dashboardData.residents;
    document.getElementById('staff-count').innerText = dashboardData.staff;
    document.getElementById('appointments-count').innerText = dashboardData.appointments;
    document.getElementById('alerts-count').innerText = dashboardData.alerts;
  }

  function updateVisibility() {
    const role = document.getElementById('roleSelect').value;
    document.getElementById('card-staff').style.display = role === 'admin' ? 'block' : 'none';
    document.getElementById('card-alerts').style.display = role === 'admin' ? 'block' : 'none';
  }

  // Chart.js example
  const ctx = document.getElementById('alertsChart').getContext('2d');
  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri'],
      datasets: [{
        label: 'System Alerts',
        data: [1, 3, 0, 2, 4],
        backgroundColor: 'rgba(30, 94, 255, 0.7)'
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: { display: false }
      }
    }
  });

  // Load data and visibility on start
  populateDashboard();
  updateVisibility();