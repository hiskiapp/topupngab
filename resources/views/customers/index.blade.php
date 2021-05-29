{{-- Extends layout --}}
@extends('layouts.default')

{{-- Title Page --}}
@section('title', 'Customer List')

{{-- Styles Section --}}
@section('styles')
<link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection

{{-- Content --}}
@section('content')
<div class="card card-custom">
    <div class="card-header">
        <div class="card-title">
            <span class="card-icon">
                <i class="flaticon2-supermarket text-primary"></i>
            </span>
            <h3 class="card-label">Customer List</h3>
        </div>
    </div>
    <div class="card-body">
        <!--begin: Datatable-->
        <table class="table table-bordered table-hover table-checkable" id="kt_datatable"
        style="margin-top: 13px !important">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Number</th>
                <th>Transactions</th>
                <th>Is Subscribe</th>
                <th>Created at</th>
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
                url: `${HOST_URL}/data/customers`,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    columnsDef: ['iteration', 'name', 'number', 'transactions_count', 'is_subscribe', 'created_at', 'id'],
                },
            },
            columns: [{
                data: 'iteration'
            },
            {
                data: 'name'
            },
            {
                data: 'number'
            },
            {
                data: 'transactions_count'
            },
            {
                data: 'is_subscribe'
            },
            {
                data: 'created_at'
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
                    return `<a href="${HOST_URL}/customers/${data}" class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2" title="Show details">\
                    <span class="svg-icon svg-icon-md">\
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                    <rect x="0" y="0" width="24" height="24"/>\
                    <path d="M4.5,3 L19.5,3 C20.3284271,3 21,3.67157288 21,4.5 L21,19.5 C21,20.3284271 20.3284271,21 19.5,21 L4.5,21 C3.67157288,21 3,20.3284271 3,19.5 L3,4.5 C3,3.67157288 3.67157288,3 4.5,3 Z M8,5 C7.44771525,5 7,5.44771525 7,6 C7,6.55228475 7.44771525,7 8,7 L16,7 C16.5522847,7 17,6.55228475 17,6 C17,5.44771525 16.5522847,5 16,5 L8,5 Z" fill="#000000"/>\
                    </g>\
                    </svg>\
                    </span>\
                    </a>\
                    `;
                },
            }, 
            {
                targets: 4,
                render: function (data, type, full, meta) {
                    var status = {
                        0: {
                            'title': 'No',
                            'class': 'label-light-danger'
                        },
                        1: {
                            'title': 'Yes',
                            'class': ' label-light-success'
                        },
                    };

                    if (typeof status[data] === 'undefined') {
                        return data;
                    }

                    return '<span class="label label-lg font-weight-bold' + status[data]
                    .class + ' label-inline">' + status[data].title + '</span>';
                },
            }],
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
