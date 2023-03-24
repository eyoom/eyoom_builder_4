$(function() {
    "use strict";

    var main_chart_formatter = function (value) {
        var parts = value.toString().split('.');
        var regexp = /\B(?=(\d{3})+(?!\d))/g;
        return parts[0].toString().replace(regexp, ',');
    };

    // 쇼핑몰 주간 일-매출 주문 현황
    var main_chart1_colors = ['#ab0000', '#65656a', '#303f9f'];
    var main_chart1_options = {
        chart: {
            height: 270,
            type: 'area',
            stacked: true,
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
                columnWidth: '60%'
            }
        },
        series: main_chart1_series,
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
            categories: main_chart1_xaxis_cate,
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
                    color: '#3d5afe'
                }
            }
        },
        yaxis: [
            {
                seriesName: '주문금액',
                axisTicks: {
                    show: true,
                    color: '#ab0000'
                },
                axisBorder: {
                    show: true,
                    color: '#ab0000'
                },
                labels: {
                    formatter: main_chart_formatter,
                    style: {
                        color: '#ab0000'
                    },
                    offsetX: -20
                },
                title: {
                    text: "주문금액",
                    style: {
                        color: '#ab0000'
                    }
                },
                tooltip: {
                    enabled: true
                },
                crosshairs: {
                    stroke: {
                        color: '#3d5afe'
                    }
                },
                min: main_chart1_max_cancel
            },
            {
                seriesName: '취소금액',
                show: false,
                labels: {
                    formatter: main_chart_formatter
                }
            },
            {
                seriesName: '주문건수',
                opposite: true,
                axisTicks: {
                    show: true,
                    color: '#303f9f'
                },
                axisBorder: {
                    show: true,
                    color: '#303f9f'
                },
                labels: {
                    formatter: main_chart_formatter,
                    style: {
                        color: '#303f9f'
                    },
                    offsetX: -20
                },
                title: {
                    text: "주문건수",
                    style: {
                        color: '#303f9f'
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
            position: 'bottom',
            horizontalAlign: 'center',
            offsetY: 5,
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

    // 쇼핑몰 주간 일-매출 결제수단별 현황
    var main_chart2_colors = ['#5e35b1', '#00897b', '#d81b60', '#1e88e5', '#8e24aa', '#fb8c00', '#cc2300', '#43a047', '#75757a', '#303f9f'];
    var main_chart2_options = {
        chart: {
            height: 270,
            type: 'area',
            stacked: true,
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
            enabled: true,
            formatter: main_chart_formatter,
            enabledOnSeries: [9]
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '60%'
            }
        },
        series: main_chart2_series,
        stroke: {
            curve: 'straight',
            width: 2
        },
        markers: {
            size: 0
        },
        fill: {
            type: 'solid',
            opacity: [1, 1, 1, 1, 1, 1, 1, 1, 1, 0.7]
        },
        xaxis: {
            type: 'datetime',
            categories: main_chart2_xaxis_cate,
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
                    color: '#3d5afe'
                }
            }
        },
        yaxis: [
            {
                axisTicks: {
                    show: true,
                    color: '#ab0000'
                },
                axisBorder: {
                    show: true,
                    color: '#ab0000'
                },
                labels: {
                    formatter: main_chart_formatter,
                    style: {
                        color: '#ab0000'
                    }
                },
                title: {
                    text: "결제금액",
                    style: {
                        color: '#ab0000'
                    }
                },
                tooltip: {
                    enabled: true
                },
                crosshairs: {
                    stroke: {
                        color: '#2979ff'
                    }
                },
                max: main_chart2_max_order
            }
        ],
        tooltip: {
            theme: 'dark',
            x: {
                format: 'yyyy-MM-dd'
            }
        },
        legend: {
            position: 'bottom',
            horizontalAlign: 'center',
            offsetY: 5,
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

    // 쇼핑몰 년간 월-매출 주문 현황
    var main_chart3_colors = ['#3949ab', '#303f9f'];
    var main_chart3_options = {
        chart: {
            height: 270,
            type: 'area',
            stacked: true,
            toolbar: {
                show: true,
                tools: {
                    zoom: false,
                    pan: false,
                    reset: false
                }
            }
        },
        colors: main_chart3_colors,
        dataLabels: {
            enabled: false
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '70%'
            }
        },
        series: main_chart3_series,
        stroke: {
            curve: 'smooth',
            width: 2
        },
        markers: {
            size: 0
        },
        fill: {
            type: 'solid',
            opacity: [1, 0.3]
        },
        xaxis: {
            type: 'text',
            categories: main_chart3_xaxis_cate,
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
                    color: '#3d5afe'
                }
            }
        },
        yaxis: [
            {
                seriesName: '주문금액',
                axisTicks: {
                    show: true,
                    color: '#5e35b1'
                },
                axisBorder: {
                    show: true,
                    color: '#5e35b1'
                },
                labels: {
                    formatter: main_chart_formatter,
                    style: {
                        color: '#5e35b1'
                    },
                    offsetX: -20
                },
                title: {
                    text: "주문금액",
                    style: {
                        color: '#5e35b1'
                    }
                },
                tooltip: {
                    enabled: true
                },
                crosshairs: {
                    stroke: {
                        color: '#3d5afe'
                    }
                },
                min: main_chart3_max_cancel
            },
            {
                seriesName: '주문건수',
                opposite: true,
                axisTicks: {
                    show: true,
                    color: '#303f9f'
                },
                axisBorder: {
                    show: true,
                    color: '#303f9f'
                },
                labels: {
                    formatter: main_chart_formatter,
                    style: {
                        color: '#303f9f'
                    },
                    offsetX: -20
                },
                title: {
                    text: "주문건수",
                    style: {
                        color: '#303f9f'
                    }
                }
            }
        ],
        tooltip: {
            theme: 'dark'
        },
        legend: {
            position: 'bottom',
            horizontalAlign: 'center',
            offsetY: 5,
            labels: {
                colors: '#6c757d'
            }
        },
        grid: {
            borderColor: '#262738'
        }
    }
    var main_chart3 = new ApexCharts(
        document.querySelector("#main_chart3"),
        main_chart3_options
    );
    main_chart3.render();

    // 쇼핑몰 년간 월-매출 결제수단별 현황
    var main_chart4_colors = ['#5e35b1', '#00897b', '#d81b60', '#1e88e5', '#8e24aa', '#fb8c00', '#cc2300', '#43a047', '#75757a', '#303f9f'];
    var main_chart4_options = {
        chart: {
            height: 270,
            type: 'area',
            stacked: true,
            toolbar: {
                show: true,
                tools: {
                    zoom: false,
                    pan: false,
                    reset: false
                }
            }
        },
        colors: main_chart4_colors,
        dataLabels: {
            enabled: true,
            formatter: main_chart_formatter,
            enabledOnSeries: [9]
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '60%'
            }
        },
        series: main_chart4_series,
        stroke: {
            curve: 'straight',
            width: 2
        },
        markers: {
            size: 0
        },
        fill: {
            type: 'solid',
            opacity: [1, 1, 1, 1, 1, 1, 1, 1, 1, 0.7]
        },
        xaxis: {
            type: 'text',
            categories: main_chart4_xaxis_cate,
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
                    color: '#3d5afe'
                }
            }
        },
        yaxis: [
            {
                axisTicks: {
                    show: true,
                    color: '#5e35b1'
                },
                axisBorder: {
                    show: true,
                    color: '#5e35b1'
                },
                labels: {
                    formatter: main_chart_formatter,
                    style: {
                        color: '#5e35b1'
                    }
                },
                title: {
                    text: "결제금액",
                    style: {
                        color: '#5e35b1'
                    }
                },
                tooltip: {
                    enabled: true
                },
                crosshairs: {
                    stroke: {
                        color: '#3d5afe'
                    }
                },
                max: main_chart4_max_order
            }
        ],
        tooltip: {
            theme: 'dark'
        },
        legend: {
            position: 'bottom',
            horizontalAlign: 'center',
            offsetY: 5,
            labels: {
                colors: '#6c757d'
            }
        },
        grid: {
            borderColor: '#262738'
        }
    }
    var main_chart4 = new ApexCharts(
        document.querySelector("#main_chart4"),
        main_chart4_options
    );
    main_chart4.render();
});