(function ($) {
  "use strict";
  // Sidebar Toggler
  $('.sidebar-toggler').click(function () {
    $('.sidebar, .content').toggleClass("open");
    $(this).toggleClass("sidebar-toggler-rotate");
    $('.sidebar .navbar-nav').toggleClass("sidebar-lg-styles");
    $('.sidebar .navbar-nav').toggleClass("sidebar-sm-styles");
    return false;
  });
})(jQuery);

// Dropdown Toggle
(function ($) {
  "use strict";
  $('.profile img.rounded-circle').click(function () {
    $(this).parent('.profile').toggleClass("show");
    return false;
  });
})(jQuery);


// Line Chart
const lc = document.getElementById('line-chart');
let chartWidth; // Variable to store the chart instance

function updateChartAspectRatio() {
  const screenWidth = window.innerWidth;
  const newAspectRatio = screenWidth > 768 ? 1 / 4 : 1 / 1; // Set aspect ratio based on screen width

  if (chartWidth) {
    chart.aspectRatio = newAspectRatio; // Update aspectRatio property
    chart.update(); // Update the chart
  }
}

chartWidth = new Chart(lc, {
  type: 'line',
  data: {
    labels: [1500, 1600, 1700, 1750, 1800, 1850, 1900, 1950, 1999, 2050],
    datasets: [{
      data: [3000, 2000, 3000, 2000, 107, 111, 133, 221, 783, 2478],
      fill: false,
      borderColor: '#875CFF',
      tension: 0.4
    },
    {
      data: [282, 350, 411, 502, 635, 809, 947, 1402, 3700, 5267],
      fill: false,
      borderColor: '#FF4D00',
      tension: 0.4
    },
    {
      data: [168, 170, 178, 190, 203, 276, 408, 547, 675, 734],
      fill: false,
      borderColor: '#FFA800',
      tension: 0.4
    }
    ]
  },
  options: {
    scales: {
      y: {
        display: false,
        beginAtZero: true
      },
      x: {
        display: false,
      }
    },
    plugins: {
      legend: {
        display: false
      }
    },
    maintainAspectRatio: false,
    // aspectRatio: 1|4,
    pointBackgroundColor: '#fff',
    pointBorderColor: '#fff'
  }
});
window.addEventListener('resize', updateChartAspectRatio);

// Bar Chart
const ctx = document.getElementById('bar-chart');

new Chart(ctx, {
  type: 'bar',
  data: {
    labels: ['', ''],
    datasets: [{
      label: '',
      backgroundColor: ["#8D4FCC", "#782C96"],
      data: [80, 20],
      borderWidth: 1,
      categoryPercentage: 0,
      barThickness: 30,
      borderRadius: 8
    }]
  },
  options: {
    scales: {
      y: {
        display: false,
        beginAtZero: true
      }
    },
    plugins: {
      legend: {
        display: false
      }
    },
    maintainAspectRatio: true,
    aspectRatio: 1 | 1
  }
});

// Bar Chart
const dc = document.getElementById('doughnut-chart');

new Chart(dc, {
  type: 'doughnut',
  data: {
    labels: [''],
    datasets: [{
      label: 'lab',
      data: [80, 20],
      backgroundColor: [
        '#9181DB',
        'transparent'
      ],
      borderWidth: 0,
      hoverOffset: 4,
      rotation: -20
    },
    {
      label: '',
      data: [60, 40],
      backgroundColor: [
        '#01B7C5',
        'transparent',
      ],
      borderWidth: 0,
      hoverOffset: 4,
      rotation: -20
    },
    {
      label: '',
      data: [40, 60],
      backgroundColor: [
        '#782C96',
        'transparent',
      ],
      borderWidth: 0,
      hoverOffset: 4,
      rotation: -20
    }]
  },
  options: {
    scales: {
      y: {
        display: false,
        beginAtZero: true
      }
    },
    plugins: {
      legend: {
        display: false
      }
    },
    maintainAspectRatio: true,
    aspectRatio: 1 | 1
  }
});

const rc = document.getElementById('doughnut-chart2');

new Chart(rc, {
  type: 'doughnut',
  data: {
    labels: ['Red', 'Blue', 'Yellow'],
    datasets: [{
      label: 'My First Dataset',
      data: [300, 50, 100],
      backgroundColor: ['#8d4fcc', '#382c45', '#543674'],
      borderWidth: 0,
      borderJoinStyle: 'round',
      borderRadius: 10,
      hoverOffset: 4,
      spacing: 4
    }]
  },
  options: {
    plugins: {
      legend: {
        display: false
      }
    },
    aspectRatio: 1 | 1,
    maintainAspectRatio: true,
    layout: {
      padding: {
        top: 20,
        bottom: 20,
        left: 20,
        right: 20
      }
    },
    cutout: '80%',
    scales: {
      y: {
        display: false
      }
    }
  }
});



/*--- Apex (#spark6) ---*/
var spark6 = {
  chart: {
    id: 'spark6',
    type: 'area',
    height: 30,
    responsive: 'true',
    sparkline: {
      enabled: true
    },
    dropShadow: {
      enabled: false,
      top: 1,
      left: 1,
      blur: 1,
      opacity: 0.1,
    }
  },
  series: [{
    data: [25, 66, 41, 59, 25, 44, 12, 36, 9, 21, 25, 66, 41, 59, 25, 44, 12, 36, 9, 21]
  }],
  stroke: {
    curve: 'smooth'
  },
  markers: {
    size: 0
  },
  grid: {
    padding: {
      top: 10,
      bottom: 0,
      left: 0
    }
  },
  // colors: ['#FFB849','#782C96'],
  stroke: {
    width: 2,
  },
  fill: {
    type: 'gradient',
    gradient: {
      shade: 'dark',
      gradientToColors: ['rgba(123, 113, 240, 0)'],
      shadeIntensity: 1,
      type: 'vertical',
      opacityFrom: 1,
      opacityTo: 1,
      stops: [0, 100, 100, 100]
    },
  },
  tooltip: {
    x: {
      show: false,
      width: 1,
    }
  }
}

const weeklyUpdates = document.getElementById('weekly-updates');

new Chart(weeklyUpdates, {
  type: 'bar',
  data: {
    labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
    datasets: [{
      label: '',
      backgroundColor: ["#f78c0e", "#ef6d94", "#f2a501", "#7bbf30", "#ff701e", "#b2b2b2"],
      data: [80, 20, 30, 40, 10, 60],
      borderWidth: 1,
      categoryPercentage: 0,
      barThickness: 30,
      borderRadius: 8
    }]
  },
  options: {
    scales: {
      y: {
        display: false,
        beginAtZero: true
      }
    },
    plugins: {
      legend: {
        display: false
      }
    },
    maintainAspectRatio: true,
    aspectRatio: 1 | 2
  }
});





//  Analytics page scale start

const recentOrders = document.getElementById('recent-orders');

new Chart(recentOrders, {
  type: 'bar',
  data: {
    labels: ['أسبوع32', 'أسبوع28', 'أسبوع24', 'أسبوع20', 'أسبوع16', 'أسبوع12', 'أسبوع8', 'أسبوع4', 'أسبوع1',],
    datasets: [{
      label: '',
      backgroundColor: ["#8D4FCC", "#8D4FCC", "#8D4FCC", "#8D4FCC", "#8D4FCC", "#8D4FCC", "#8D4FCC", "#8D4FCC", "#8D4FCC"],
      data: [90, 80, 70, 60, 50, 40, 30, 20, 10],
      borderWidth: 1,
      categoryPercentage: 0,
      barThickness: 70,
      borderRadius: 10,
    }]
  },
  options: {
    scales: {
      y: {
        display: false,
        beginAtZero: true
      }
    },
    plugins: {
      legend: {
        display: false
      }
    },
    maintainAspectRatio: true,
    aspectRatio: 1 | 2
  }
});

//  Analytics page scale End







/*--- Apex (#spark6) Closed ---*/

/*--- Apex (#sparkLine) ---*/
var sparkLine1 = {
  chart: {
    id: 'sparkLine1',
    type: 'area',
    height: 100,
    responsive: 'true',
    sparkline: {
      enabled: true
    },
    dropShadow: {
      enabled: false,
      top: 1,
      left: 1,
      blur: 1,
      opacity: 0.1,
    }
  },
  series: [{
    name: 'series 1',
    data: [231, 40, 28, 51, 42, 109, 100]
  },
  {
    name: 'series 2',
    data: [11, 32, 45, 32, 34, 52, 41]
  }],
  stroke: {
    curve: 'smooth',
    width: 2
  },
  xaxis: {
    type: 'datetime',
    categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z", "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z", "2018-09-19T06:30:00.000Z"]
  },
  tooltip: {
    x: {
      format: 'dd/MM/yy HH:mm'
    }
  }
}
/*--- Apex (#sparkLine) Closed ---*/
var options = {
  series: [{
    name: 'This Month',
    type: 'area',
    data: [44, 55, 31, 47, 31, 43, 26, 41, 31, 47, 33]
  }, {
    name: 'Last Month',
    type: 'line',
    data: [55, 69, 45, 61, 43, 54, 37, 52, 44, 61, 43]
  }],
  chart: {
    height: 350,
    type: 'line',
    toolbar: {
      show: false
    }
  },
  colors: ['#4169E1', '#FFBE0A'],
  stroke: {
    curve: 'smooth',
    dashArray: [0, 8]
  },
  fill: {
    type: 'solid',
    opacity: [0.35, 1],
  },
  labels: [],
  markers: {
    size: 0
  },
  yaxis: [
    {
      labels: {
        style: {
          colors: '#fff',
          fontSize: '12px',
          fontFamily: 'Helvetica, Arial, sans-serif',
          fontWeight: 400,
          cssClass: 'apexcharts-yaxis-label',
        }
      }
    }
  ],
  xaxis: {
    labels: {
      style: {
        colors: '#fff',
        fontSize: '12px',
        fontFamily: 'Helvetica, Arial, sans-serif',
        fontWeight: 400,
        cssClass: 'apexcharts-xaxis-label',
      }
    }
  },
  tooltip: {
    shared: true,
    intersect: false,
    y: {
      formatter: function (y) {
        if (typeof y !== "undefined") {
          return y.toFixed(0) + " points";
        }
        return y;
      }
    }
  }
};

var chart = new ApexCharts(document.querySelector("#chart"), options);
chart.render();

new ApexCharts(document.querySelector("#spark6"), spark6).render();






document.addEventListener('DOMContentLoaded', () => {
  // Get the dropdown element
  const dropdown = document.getElementById('inputrole');
  // Get the variant and price sections
  const variantSection = document.getElementById('variant');
  const priceSection = document.getElementById('price');

  // Add event listener to the dropdown for change event
  dropdown.addEventListener('change', () => {
    // Check the selected option
    if (dropdown.value === 'منتج متغير') {
      // Show the variant section and hide the price section
      variantSection.style.display = 'block';
      priceSection.style.display = 'none';
    } else if (dropdown.value === 'منتج بسيط') {
      // Show the price section and hide the variant section
      variantSection.style.display = 'none';
      priceSection.style.display = 'block';
    }
  });
});
