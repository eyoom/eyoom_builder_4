$(function() {
    "use strict";

    var main_chart_formatter = function (value) {
        var parts = value.toString().split('.');
        var regexp = /\B(?=(\d{3})+(?!\d))/g;
        return parts[0].toString().replace(regexp, ',');
    };

    // 오늘의 시간별 접속자, 회원가입, 로그인
    var main_chart5_colors = ['#00897b', '#1a237E', '#fb8c00'];
    var main_chart5_options = {
        chart: {
            height: 270,
            type: 'area',
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
        colors: main_chart5_colors,
        dataLabels: {
            enabled: false
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '70%'
            }
        },
        series: main_chart5_series,
        stroke: {
            curve: 'smooth',
            width: 2,
            colors: ['transparent']
        },
        markers: {
            size: 0
        },
        fill: {
            type: 'solid',
            opacity: [0.2, 1, 1]
        },
        xaxis: {
            type: 'text',
            categories: main_chart5_xaxis_cate,
            axisBorder: {
                show: false
            },
            axisTicks: {
                show: false
            },
            labels: {
                style: {
                    colors: '#000000',
                    fontSize: '11px'
                }
            },
            crosshairs: {
                stroke: {
                    color: '#2979ff'
                }
            }
        },
        yaxis: [
            {
                seriesName: '접속자',
                axisTicks: {
                    show: true,
                    color: '#00897b'
                },
                axisBorder: {
                    show: true,
                    color: '#00897b'
                },
                labels: {
                    formatter: main_chart_formatter,
                    style: {
                        color: '#00897b'
                    },
                    offsetX: -20
                },
                title: {
                    text: "접속자",
                    style: {
                        color: '#00897b'
                    }
                },
                tooltip: {
                    enabled: true
                },
                crosshairs: {
                    stroke: {
                        color: '#2979ff'
                    }
                }
            },
            {
                seriesName: '회원가입',
                show: false,
                labels: {
                    formatter: main_chart_formatter
                },
                max: main_chart5_max_count
            },
            {
                seriesName: '로그인',
                opposite: true,
                axisTicks: {
                    show: true,
                    color: '#3949ab'
                },
                axisBorder: {
                    show: true,
                    color: '#3949ab'
                },
                labels: {
                    formatter: main_chart_formatter,
                    style: {
                        color: '#3949ab'
                    },
                    offsetX: -20
                },
                title: {
                    text: "회원가입 / 로그인",
                    style: {
                        color: '#3949ab'
                    }
                },
                max: main_chart5_max_count
            },
        ],
        tooltip: {
            theme: 'light'
        },
        legend: {
            position: 'bottom',
            horizontalAlign: 'center',
            offsetY: 5,
            labels: {
                colors: '#000000'
            }
        },
        grid: {
            borderColor: '#eaeaea'
        }
    }
    var main_chart5 = new ApexCharts(
        document.querySelector("#main_chart5"),
        main_chart5_options
    );
    main_chart5.render();

    // 오늘의 브라우저별 접속자 비율
    var main_chart6_colors = ['#1a237E', '#5e35b1', '#00897b', '#ab0000', '#1e88e5', '#8e24aa', '#fb8c00', '#d81b60'];
    var main_chart6_options = {
        chart: {
            height: 270,
            type: 'pie'
        },
        colors: main_chart6_colors,
        series: main_chart6_series,
        labels: main_chart6_labels,
        stroke: {
            width: 0
        },
        legend: {
            position: 'bottom',
            horizontalAlign: 'center',
            offsetY: 5,
            labels: {
                colors: '#000000'
            }
        }
    }
    var main_chart6 = new ApexCharts(
        document.querySelector("#main_chart6"),
        main_chart6_options
    );
    main_chart6.render();

    // 오늘의 OS별 접속자 비율
    var main_chart7_colors = ['#1a237E', '#5e35b1', '#00897b', '#ab0000', '#1e88e5', '#8e24aa', '#fb8c00', '#d81b60'];
    var main_chart7_options = {
        chart: {
            height: 270,
            type: 'pie'
        },
        colors: main_chart7_colors,
        series: main_chart7_series,
        labels: main_chart7_labels,
        stroke: {
            width: 0
        },
        legend: {
            position: 'bottom',
            horizontalAlign: 'center',
            offsetY: 5,
            labels: {
                colors: '#000000'
            }
        }
    }
    var main_chart7 = new ApexCharts(
        document.querySelector("#main_chart7"),
        main_chart7_options
    );
    main_chart7.render();

    // 오늘의 도메인별 접속자
    var main_chart8_colors = ['#55555a', '#35353a', '#1d2152', '#3a2b59', '#1a423e', '#4f1c1c', '#26547e', '#622773', '#714b1c', '#7f314e', '#3a6c3d'];
    var main_chart8_options = {
        chart: {
            height: 270,
            type: 'treemap',
            toolbar: {
                show: false
            }
        },
        plotOptions: {
            treemap: {
                distributed: true,
                enableShades: false
            }
        },
        colors: main_chart8_colors,
        series: main_chart8_series,
        stroke: {
            width: 0
        },
        tooltip: {
            theme: 'light'
        }
    }
    var main_chart8 = new ApexCharts(
        document.querySelector("#main_chart8"),
        main_chart8_options
    );
    main_chart8.render();

    // 오늘의 게시글, 댓글 현황
    var main_chart9_colors = ['#ab0000', '#95959a'];

    var main_chart9_options = {
        chart: {
            height: 270,
            type: 'area',
            toolbar: {
                show: true,
                tools: {
                    zoom: false,
                    pan: false,
                    reset: false
                }
            }
        },
        colors: main_chart9_colors,
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'smooth',
            width: 2
        },
        series: main_chart9_series,
        xaxis: {
            type: 'text',
            categories: main_chart9_xaxis_cate,
            axisBorder: {
                show: false
            },
            axisTicks: {
                show: false
            },
            labels: {
                style: {
                    colors: '#000000',
                    fontSize: '11px'
                }
            },
            crosshairs: {
                stroke: {
                    color: '#2979ff'
                }
            }
        },
        yaxis: {
            axisBorder: {
                show: false
            },
            axisTicks: {
                show: false
            },
            labels: {
                formatter: main_chart_formatter,
                style: {
                    color: '#000000'
                },
                offsetX: -15
            },
            tooltip: {
                enabled: true
            },
            crosshairs: {
                stroke: {
                    color: '#2979ff'
                }
            }
        },
        tooltip: {
            theme: 'light'
        },
        legend: {
            position: 'top',
            horizontalAlign: 'left',
            offsetX: -30
        },
        grid: {
            borderColor: '#eaeaea',
            padding: {
                left: 0
            }
        }
    }

    var main_chart9 = new ApexCharts(
        document.querySelector("#main_chart9"),
        main_chart9_options
    );

    main_chart9.render();

    // 주간 일-게시글, 댓글 현황
    var main_chart10_colors = ['#00897B', '#95959a'];

    var main_chart10_options = {
        chart: {
            height: 270,
            type: 'bar',
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
        colors: main_chart10_colors,
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '55%'
            }
        },
        dataLabels: {
            enabled: false
        },
        series: main_chart10_series,
        stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
        },
        xaxis: {
            type: 'datetime',
            categories: main_chart10_xaxis_cate,
            axisBorder: {
                show: false
            },
            axisTicks: {
                show: false
            },
            labels: {
                style: {
                    colors: '#000000',
                    fontSize: '11px'
                }
            },
            crosshairs: {
                stroke: {
                    color: '#2979ff'
                }
            }
        },
        yaxis: {
            axisBorder: {
                show: false
            },
            axisTicks: {
                show: false
            },
            labels: {
                formatter: main_chart_formatter,
                style: {
                    color: '#000000'
                },
                offsetX: -15
            },
            tooltip: {
                enabled: true
            },
            crosshairs: {
                stroke: {
                    color: '#2979ff'
                }
            }
        },
        tooltip: {
            theme: 'light',
            x: {
                format: 'yyyy-MM-dd'
            }
        },
        legend: {
            position: 'top',
            horizontalAlign: 'left',
            offsetX: -30
        },
        grid: {
            borderColor: '#eaeaea',
            padding: {
                left: 0
            }
        },
        fill: {
            opacity: 1
        }
    }

    var main_chart10 = new ApexCharts(
        document.querySelector("#main_chart10"),
        main_chart10_options
    );
    
    main_chart10.render();
});