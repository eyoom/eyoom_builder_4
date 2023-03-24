<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/admin.main_chart.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
?>

<script>
$(function() {
    "use strict";

    // 2 Weeks Visitors Analytics
    var main_chart1_colors = ['#AB0000', '#65656A', '#303F9F'];

    var main_chart1_options = {
        chart: {
            height: 300,
            type: 'line',
            stacked: false,
            toolbar: {
                show: true,
                tools: {
                    zoom: false,
                    pan: false,
                    reset: false
                }
            }
        },
        colors: main_chart1_colors,
        dataLabels: {
            enabled: false
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '55%'
            }
        },
        series: [{
            name: 'Sign up',
            type: 'column',
            data: [0,1,3,0,0,2,6,0,1,2,4,2,2,1]
        }, {
            name: 'Leave account',
            type: 'column',
            data: [0,0,0,1,0,2,0,0,4,3,0,1,0,0]
        }, {
            name: 'Visitors',
            type: 'area',
            data: [716,696,600,574,619,563,753,771,656,638,549,643,595,556]
        }],
        stroke: {
            curve: 'straight',
            width: 2
        },
        markers: {
            size: 0
        },
        fill: {
            type: 'solid',
            opacity: [1, 1, 0.3]
        },
        xaxis: {
            type: 'datetime',
            categories: ["2020-09-01", "2020-09-02", "2020-09-03", "2020-09-04", "2020-09-05", "2020-09-06", "2020-09-07", "2020-09-08", "2020-09-09", "2020-09-10", "2020-09-11", "2020-09-12", "2020-09-13", "2020-09-14"],
            axisBorder: {
                show: false
            },
            axisTicks: {
                show: false
            },
            labels: {
                style: {
                    colors: '#6c757d',
                    fontSize: '11px'
                }
            },
            crosshairs: {
                stroke: {
                    color: '#3D5AFE'
                }
            }
        },
        yaxis: [
            {
                axisTicks: {
                    show: true
                },
                axisBorder: {
                    show: true,
                    color: '#D50000'
                },
                labels: {
                    style: {
                        color: '#D50000'
                    },
                    offsetX: -20
                },
                title: {
                    text: "Sign up",
                    style: {
                        color: '#D50000'
                    }
                },
                tooltip: {
                    enabled: true
                },
                crosshairs: {
                    stroke: {
                        color: '#3D5AFE'
                    }
                }
            },
            {
                seriesName: 'Leave account',
                opposite: true,
                axisTicks: {
                    show: true
                },
                axisBorder: {
                    show: true,
                    color: '#65656A'
                },
                labels: {
                    style: {
                        color: '#65656A'
                    },
                    offsetX: -20
                },
                title: {
                    text: "Leave account",
                    style: {
                        color: '#65656A'
                    }
                }
            },
            {
                seriesName: 'Visitors',
                opposite: true,
                axisTicks: {
                    show: true
                },
                axisBorder: {
                    show: true,
                    color: '#303F9F'
                },
                labels: {
                    style: {
                        color: '#303F9F'
                    },
                    offsetX: -20
                },
                title: {
                    text: "Visitors",
                    style: {
                        color: '#303F9F'
                    }
                }
            },
        ],
        tooltip: {
            theme: 'dark',
            x: {
                format: 'yyyy-MM-dd'
            }
        },
        legend: {
            position: 'top',
            horizontalAlign: 'left',
            offsetX: -35,
            labels: {
                colors: '#6c757d'
            }
        },
        grid: {
            borderColor: '#262738'
        }
    }

    var main_chart1 = new ApexCharts(
        document.querySelector("#main_chart1"),
        main_chart1_options
    );

    main_chart1.render();

    // Today's Visitors Analytics
    var main_chart2_colors = ['#3949ab', '#65656A', '#512DA8'];

    var main_chart2_options = {
        chart: {
            height: 300,
            type: 'line',
            stacked: false,
            toolbar: {
                show: true,
                tools: {
                    zoom: false,
                    pan: false,
                    reset: false
                }
            }
        },
        colors: main_chart2_colors,
        dataLabels: {
            enabled: false
        },
        series: [{
            name: 'Sign up',
            type: 'column',
            data: [0,0,0,0,0,0,3,0,2,0,0,0,0,2,5,0,0,0,2,0,0,0,0,0]
        }, {
            name: 'Leave account',
            type: 'column',
            data: [0,0,0,0,0,0,1,0,0,0,2,0,3,0,0,0,1,0,0,0,0,0,0,0]
        }, {
            name: 'Visitors',
            type: 'area',
            data: [12,16,29,33,40,24,29,43,46,39,47,35,42,29,50,46,48,20,36,37,12,23,8,5]
        }],
        stroke: {
            curve: 'smooth',
            width: 2
        },
        markers: {
            size: 0
        },
        fill: {
            type: 'solid',
            opacity: [1, 1, 0.3]
        },
        xaxis: {
            type: 'datetime',
            categories: ["2020-09-14T00:00:00", "2020-09-14T02:00:00", "2020-09-14T03:00:00", "2020-09-14T04:00:00", "2020-09-14T05:00:00", "2020-09-14T06:00:00", "2020-09-14T07:00:00", "2020-09-14T08:00:00", "2020-09-14T09:00:00", "2020-09-14T10:00:00", "2020-09-14T11:00:00", "2020-09-14T12:00:00", "2020-09-14T13:00:00", "2020-09-14T14:00:00", "2020-09-14T15:00:00", "2020-09-14T16:00:00", "2020-09-14T17:00:00", "2020-09-14T18:00:00", "2020-09-14T19:00:00", "2020-09-14T20:00:00", "2020-09-14T21:00:00", "2020-09-14T22:00:00", "2020-09-14T23:00:00"],
            axisBorder: {
                show: false
            },
            axisTicks: {
                show: false
            },
            labels: {
                style: {
                    colors: '#6c757d',
                    fontSize: '11px'
                }
            },
            crosshairs: {
                stroke: {
                    color: '#3D5AFE'
                }
            }
        },
        yaxis: [
            {
                axisTicks: {
                    show: true
                },
                axisBorder: {
                    show: true,
                    color: '#00ACC1'
                },
                labels: {
                    style: {
                        color: '#00ACC1'
                    },
                    offsetX: -20
                },
                title: {
                    text: "Sign up",
                    style: {
                        color: '#00ACC1'
                    }
                },
                tooltip: {
                    enabled: true
                },
                crosshairs: {
                    stroke: {
                        color: '#3D5AFE'
                    }
                }
            },
            {
                seriesName: 'Leave account',
                opposite: true,
                axisTicks: {
                    show: true
                },
                axisBorder: {
                    show: true,
                    color: '#65656A'
                },
                labels: {
                    style: {
                        color: '#65656A'
                    },
                    offsetX: -20
                },
                title: {
                    text: "Leave account",
                    style: {
                        color: '#65656A'
                    }
                }
            },
            {
                seriesName: 'Visitors',
                opposite: true,
                axisTicks: {
                    show: true
                },
                axisBorder: {
                    show: true,
                    color: '#512DA8'
                },
                labels: {
                    style: {
                        color: '#512DA8'
                    },
                    offsetX: -20
                },
                title: {
                    text: "Visitors",
                    style: {
                        color: '#512DA8'
                    }
                }
            }
        ],
        tooltip: {
            theme: 'dark',
            x: {
                format: 'yyyy-MM-dd HH:mm'
            }
        },
        legend: {
            position: 'top',
            horizontalAlign: 'left',
            offsetX: -35,
            labels: {
                colors: '#6c757d'
            }
        },
        grid: {
            borderColor: '#262738'
        }
    }

    var main_chart2 = new ApexCharts(
        document.querySelector("#main_chart2"),
        main_chart2_options
    );

    main_chart2.render();
});
</script>