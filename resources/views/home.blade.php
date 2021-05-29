{{-- Extends layout --}}
@extends('layouts.default')

{{-- Title Page --}}
@section('title', 'Home')

{{-- Styles Section --}}
@section('styles')
    
@endsection

{{-- Content --}}
@section('content')
<div class="row">
    <div class="col-lg-6 col-xxl-4">
        {{-- Mixed Widget 1 --}}

        <div class="card card-custom bg-gray-100 card-stretch gutter-b">
            {{-- Header --}}
            <div class="card-header border-0 bg-danger py-5">
                <h3 class="card-title font-weight-bolder text-white">Transactions This Week</h3>
            </div>
            {{-- Body --}}
            <div class="card-body p-0 position-relative overflow-hidden">
                {{-- Chart --}}
                <div id="messages_stat" class="card-rounded-bottom bg-danger" style="height: 200px"
                    data-messages=""></div>

                {{-- Stats --}}
                <div class="card-spacer mt-n25">
                    {{-- Row --}}
                    <div class="row m-0">
                        <div class="col bg-light-warning px-6 py-8 rounded-xl mr-7 mb-7">
                            {{ Metronic::getSVG("media/svg/icons/Communication/Sending.svg", "svg-icon-3x svg-icon-warning d-block my-2") }}
                            <a href="{{ route('transactions.index') }}" class="text-warning font-weight-bold font-size-h6">
                                Transactions
                            </a>
                        </div>
                        <div class="col bg-light-primary px-6 py-8 rounded-xl mb-7">
                            {{ Metronic::getSVG("media/svg/icons/Communication/Contact1.svg", "svg-icon-3x svg-icon-primary d-block my-2") }}
                            <a href="{{ route('report.index') }}" class="text-primary font-weight-bold font-size-h6 mt-2">
                                Report
                            </a>
                        </div>
                    </div>
                    {{-- Row --}}
                    <div class="row m-0">
                        <div class="col bg-light-danger px-6 py-8 rounded-xl mr-7">
                            {{ Metronic::getSVG("media/svg/icons/Media/Playlist2.svg", "svg-icon-3x svg-icon-danger d-block my-2") }}
                            <a href="{{ route('broadcast.index') }}" class="text-danger font-weight-bold font-size-h6 mt-2">
                                Broadcast
                            </a>
                        </div>
                        <div class="col bg-light-success px-6 py-8 rounded-xl">
                            {{ Metronic::getSVG("media/svg/icons/Code/Time-schedule.svg", "svg-icon-3x svg-icon-success d-block my-2") }}
                            <a href="{{ route('schedules.index') }}" class="text-success font-weight-bold font-size-h6 mt-2">
                                Schedullar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="col-lg-6 col-xxl-4">
    </div>
</div>
@endsection

{{-- Scripts Section --}}
@section('scripts')
<script type="text/javascript">
	"use strict";

var MessagesStat = function () {
    var stats = function () {
        var element = document.getElementById("messages_stat");
        var height = parseInt(KTUtil.css(element, 'height'));

        if (!element) {
            return;
        }

        var strokeColor = '#D13647';

        var options = {
            series: [{
                name: 'Messages',
                // data: JSON.parse(element.getAttribute("data-messages"))
                data: [],
            }],
            chart: {
                type: 'area',
                height: height,
                toolbar: {
                    show: false
                },
                zoom: {
                    enabled: false
                },
                sparkline: {
                    enabled: true
                },
                dropShadow: {
                    enabled: true,
                    enabledOnSeries: undefined,
                    top: 5,
                    left: 0,
                    blur: 3,
                    color: strokeColor,
                    opacity: 0.5
                }
            },
            plotOptions: {},
            legend: {
                show: false
            },
            dataLabels: {
                enabled: false
            },
            fill: {
                type: 'solid',
                opacity: 0
            },
            stroke: {
                curve: 'smooth',
                show: true,
                width: 3,
                colors: [strokeColor]
            },
            xaxis: {
                categories: ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'],
                axisBorder: {
                    show: false,
                },
                axisTicks: {
                    show: false
                },
                labels: {
                    show: false,
                    style: {
                        colors: KTApp.getSettings()['colors']['gray']['gray-500'],
                        fontSize: '12px',
                        fontFamily: KTApp.getSettings()['font-family']
                    }
                },
                crosshairs: {
                    show: false,
                    position: 'front',
                    stroke: {
                        color: KTApp.getSettings()['colors']['gray']['gray-300'],
                        width: 1,
                        dashArray: 3
                    }
                }
            },
            yaxis: {
                min: 0,
                max: 80,
                labels: {
                    show: false,
                    style: {
                        colors: KTApp.getSettings()['colors']['gray']['gray-500'],
                        fontSize: '12px',
                        fontFamily: KTApp.getSettings()['font-family']
                    }
                }
            },
            states: {
                normal: {
                    filter: {
                        type: 'none',
                        value: 0
                    }
                },
                hover: {
                    filter: {
                        type: 'none',
                        value: 0
                    }
                },
                active: {
                    allowMultipleDataPointsSelection: false,
                    filter: {
                        type: 'none',
                        value: 0
                    }
                }
            },
            tooltip: {
                style: {
                    fontSize: '12px',
                    fontFamily: KTApp.getSettings()['font-family']
                },
                y: {
                    formatter: function (val) {
                        return `${val} pesan terkirim.`;
                    }
                },
                marker: {
                    show: false
                }
            },
            colors: ['transparent'],
            markers: {
                colors: [KTApp.getSettings()['colors']['theme']['light']['danger']],
                strokeColor: [strokeColor],
                strokeWidth: 3
            }
        };

        var chart = new ApexCharts(element, options);
        chart.render();
    }

    return {
        init: function () {
            stats();
        }
    }
}();

jQuery(document).ready(function () {
    MessagesStat.init();
});

</script>
@endsection
