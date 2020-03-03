/**
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author         Alfian Imanuddin
 * @copyright      Copyright (c) http://alfianimanuddin.com 
*/

// CMS Sidebar Toggle Button
$(document).ready(function() {
	$("#btn-toggle").click(function () {
		$("body").toggleClass("show-sidebar1");
	});
});

// DROPIFY
$('.dropify').dropify();

// SELECT2
$(document).ready(function() {
    $('.select2').select2();
});

// DISABLE COPAS
document.onkeydown = function(e) {
  if (e.ctrlKey && 
      (e.keyCode === 67 || 
       e.keyCode === 86 || 
       e.keyCode === 85 || 
       e.keyCode === 117)) {
      alert('not allowed');
      return false;
  } else {
      return true;
  }
};

// DISABLE RIGHT CLICK
document.addEventListener('contextmenu', event => event.preventDefault());

// Chart JS
(function ($) {
    'use strict';
    $(function () {
        if ($("#statistics-chart").length) {
            var areaData = {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug"],
                datasets: [{
                    data: [0, 185, 75, 150, 100, 150, 50, 100],
                    backgroundColor: [
                        'rgba(255, 181, 0, 1)'
                    ],
                    borderColor: [
                        'rgba(255, 181, 0, 1)'
                    ],
                    borderWidth: 1,
                    fill: 'origin',
                    label: "purchases"
                },
                {
                    data: [0, 100, 160, 100, 150, 75, 200, 50],
                    backgroundColor: [
                        'rgba(255, 181, 0, 0.3)'
                    ],
                    borderColor: [
                        'rgba(255, 181, 0, 0.3)'
                    ],
                    borderWidth: 1,
                    fill: 'origin',
                    label: "services"
                }
                ]
            };
            var areaOptions = {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    filler: {
                        propagate: false
                    }
                },
                scales: {
                    xAxes: [{
                        display: true,
                        ticks: {
                            display: true
                        },
                        gridLines: {
                            display: false,
                            drawBorder: false,
                            color: 'transparent',
                            zeroLineColor: '#eeeeee'
                        }
                    }],
                    yAxes: [{
                        display: true,
                        ticks: {
                            display: true,
                            autoSkip: false,
                            maxRotation: 0,
                            stepSize: 50,
                            min: 0,
                            max: 250
                        }
                    }]
                },
                legend: {
                    display: false
                },
                tooltips: {
                    enabled: true
                },
                elements: {
                    line: {
                        tension: .25
                    },
                    point: {
                        radius: 0
                    }
                }
            }
            var salesChartCanvas = $("#statistics-chart").get(0).getContext("2d");
            var salesChart = new Chart(salesChartCanvas, {
                type: 'line',
                data: areaData,
                options: areaOptions
            });
            document.getElementById('statistics-legend').innerHTML = salesChart.generateLegend();
        }
        if ($("#statistics-chart-dark").length) {
            var areaData = {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug"],
                datasets: [{
                    data: [0, 185, 75, 150, 100, 150, 50, 100],
                    backgroundColor: [
                        'rgba(255, 181, 0, 1)'
                    ],
                    borderColor: [
                        'rgba(255, 181, 0, 1)'
                    ],
                    borderWidth: 1,
                    fill: 'origin',
                    label: "purchases"
                },
                {
                    data: [0, 100, 160, 100, 150, 75, 200, 50],
                    backgroundColor: [
                        'rgba(255, 181, 0, 1)'
                    ],
                    borderColor: [
                        'rgba(255, 181, 0, 1)'
                    ],
                    borderWidth: 1,
                    fill: 'origin',
                    label: "services"
                }
                ]
            };
            var areaOptions = {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    filler: {
                        propagate: false
                    }
                },
                scales: {
                    xAxes: [{
                        display: true,
                        ticks: {
                            display: true
                        },
                        gridLines: {
                            display: false,
                            drawBorder: false,
                            color: 'transparent',
                            zeroLineColor: '#eeeeee'
                        }
                    }],
                    yAxes: [{
                        display: true,
                        ticks: {
                            display: true,
                            autoSkip: false,
                            maxRotation: 0,
                            stepSize: 50,
                            min: 0,
                            max: 250
                        },
                        gridLines: {
                            color: '#4a4a4a'
                        }
                    }]
                },
                legend: {
                    display: false
                },
                tooltips: {
                    enabled: true
                },
                elements: {
                    line: {
                        tension: .25
                    },
                    point: {
                        radius: 0
                    }
                }
            }
            var salesChartCanvas = $("#statistics-chart-dark").get(0).getContext("2d");
            var salesChart = new Chart(salesChartCanvas, {
                type: 'line',
                data: areaData,
                options: areaOptions
            });
            document.getElementById('statistics-legend').innerHTML = salesChart.generateLegend();
        }
        if ($("#analysis-chart").length) {
            var CurrentChartCanvas = $("#analysis-chart").get(0).getContext("2d");
            var CurrentChart = new Chart(CurrentChartCanvas, {
                type: 'bar',
                data: {
                    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                    datasets: [{
                        label: 'Profit',
                        data: [280, 330, 370, 410, 290, 400, 309, 530, 340, 420, 380, 240],
                        backgroundColor: 'rgba(255, 181, 0, 1)'
                    },
                    {
                        label: 'Target',
                        data: [380, 540, 600, 480, 370, 500, 450, 590, 540, 480, 510, 300],
                        backgroundColor: 'rgba(255, 181, 0, 0.3)'
                    }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    layout: {
                        padding: {
                            left: 0,
                            right: 0,
                            top: 20,
                            bottom: 0
                        }
                    },
                    scales: {
                        yAxes: [{
                            display: false,
                            gridLines: {
                                display: false
                            }
                        }],
                        xAxes: [{
                            stacked: true,
                            ticks: {
                                beginAtZero: true,
                                fontColor: "#354168"
                            },
                            gridLines: {
                                color: "rgba(0, 0, 0, 0)",
                                display: false
                            },
                            barPercentage: 0.4
                        }]
                    },
                    legend: {
                        display: false
                    },
                    elements: {
                        point: {
                            radius: 0
                        }
                    }
                }
            });
        }
    });
})(jQuery);