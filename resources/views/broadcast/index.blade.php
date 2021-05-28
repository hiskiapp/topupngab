{{-- Extends layout --}}
@extends('layouts.default')

{{-- Title Page --}}
@section('title', 'Broadcast')

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
                <i class="flaticon2-delivery-package text-primary"></i>
            </span>
            <h3 class="card-label">Broadcast</h3>
        </div>
    </div>
    <div class="card-body mt-0">
        @if(session('message'))
        <x-alert :type="session('status')" :message="session('message')" />
        @endif
        <form class="form" method="POST" action="{{ route('broadcast.store') }}"
            enctype="multipart/form-data">
            @csrf

            <div class="card-body">
                <div class="form-group row">
                    <div class="col-lg-6">
                        <label>Message: </label>
                        <textarea rows="3" name="message"
                            class="form-control @error('message') is-invalid @enderror">{{ old('message') }}</textarea>
                        @error('message')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <span class="form-text text-muted">Masukan pesan untuk penerima.</span>
                    </div>
                    <div class="col-lg-6">
                        <label>Media: </label>
                        <input type="file" name="media" class="form-control @error('media') is-invalid @enderror"
                            value="{{ old('media') }}" />
                        @error('media')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <span class="form-text text-muted">Kosongkan jika tidak ingin mengirim media.
                        </span>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-lg-6">
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card card-custom gutter-b">
    <div class="card-header">
        <div class="card-title">
            <span class="card-icon">
                <i class="flaticon2-supermarket text-primary"></i>
            </span>
            <h3 class="card-label">History</h3>
        </div>
        <div class="card-toolbar">

        </div>
    </div>
        <div class="card-body">
            <!--begin: Datatable-->
            <table class="table table-bordered table-hover table-checkable" id="kt_datatable"
                style="margin-top: 13px !important">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Message</th>
                        <th>Media</th>
                        <th>Sent at</th>
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
                url: `${HOST_URL}/data/broadcasts`,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    columnsDef: ['iteration', 'message', 'media', 'created_at'],
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
                    data: 'created_at'
                },
            ],
            columnDefs: [{
                targets: 2,
                render: function (data, type, full, meta) {
                    if (data == null) {
                            return '-';
                    } else {
                            return `<a href="${HOST_URL}/storage/${data.replace('public/', '')}" target="_blank"><span class="label label-lg font-weight-bold label-light-primary label-inline">Click to view</span></a>`;
                    }
                },
            }, ],
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
