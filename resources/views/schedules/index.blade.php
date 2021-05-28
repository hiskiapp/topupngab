{{-- Extends layout --}}
@extends('layouts.default')

{{-- Title Page --}}
@section('title', 'Schedule List')

{{-- Styles Section --}}
@section('styles')
<link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection

{{-- Content --}}
@section('content')
<div class="card card-custom gutter-b">
    <div class="card-header">
        <div class="card-title">
            <span class="card-icon">
                <i class="flaticon2-supermarket text-primary"></i>
            </span>
            <h3 class="card-label">Schedule List</h3>
        </div>
        <div class="card-toolbar">
            <!--begin::Button-->
            <a href="{{ route('schedules.create') }}" class="btn btn-primary font-weight-bolder">
                <span class="svg-icon svg-icon-md">
                    {{ Metronic::getSvg('media/svg/icons/Design/Flatten.svg') }}
                </span>New Schedule</a>
            <!--end::Button-->
        </div>
    </div>
    <div class="card-body">
        @if(session('message'))
        <x-alert :type="session('status')" :message="session('message')" />
        @endif
        <!--begin: Datatable-->
        <table class="table table-bordered table-hover table-checkable" id="kt_datatable"
            style="margin-top: 13px !important">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Message</th>
                    <th>Media</th>
                    <th>Send at</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
        </table>
        <!--end: Datatable-->
    </div>
</div>
@endsection

{{-- Scripts Section --}}
@section('scripts')
{{-- vendors --}}
<script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>

{{-- page scripts --}}
<script>
    "use strict";
    var KTDatatablesDataSourceAjaxServer = function () {

        var table = $('#kt_datatable').DataTable({
            responsive: true,
            searchDelay: 500,
            processing: true,
            serverSide: true,
            ajax: {
                url: `${HOST_URL}/data/schedules`,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    columnsDef: ['iteration', 'message', 'media', 'sent_at', 'status', 'id'],
                },
            },
            columns: [{
                    data: 'iteration'
                },
                {
                    data: 'message'
                },
                {
                    data: 'media'
                },
                {
                    data: 'sent_at'
                },
                {
                    data: 'status'
                },
                {
                    data: 'id',
                    responsivePriority: -1
                },
            ],
            columnDefs: [{
                    targets: -1,
                    title: 'Actions',
                    orderable: false,
                    render: function (data, type, full, meta) {
                        return `<a href="${HOST_URL}/schedules/${data}/edit" class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2" title="Edit details">\
                        <span class="svg-icon svg-icon-md">\
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                                    <rect x="0" y="0" width="24" height="24"/>\
                                    <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953) "/>\
                                    <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>\
                                </g>\
                            </svg>\
                        </span>\
                    </a>`;
                    },
                },
                {
                    targets: 2,
                    render: function (data, type, full, meta) {
                        if (data == null) {
                            return '-';
                        } else {
                            return `<a href="${HOST_URL}/storage/${data.replace('public/', '')}" target="_blank"><span class="label label-lg font-weight-bold label-light-primary label-inline">Click to view</span></a>`;
                        }
                    },
                },
                {
                    targets: 4,
                    render: function (data, type, full, meta) {
                        var status = {
                            0: {
                                'title': 'Pending',
                                'class': 'label-light-danger'
                            },
                            1: {
                                'title': 'Success',
                                'class': ' label-light-success'
                            },
                        };

                        if (typeof status[data] === 'undefined') {
                            return data;
                        }

                        return '<span class="label label-lg font-weight-bold' + status[data]
                            .class + ' label-inline">' + status[data].title + '</span>';
                    },
                },
            ],
        });

        return {
            init: function () {
                table;
            },
            reload: function () {
                table.ajax.reload();
            }
        };

    }();

    jQuery(document).ready(function () {
        KTDatatablesDataSourceAjaxServer.init();
    });

</script>
@endsection
