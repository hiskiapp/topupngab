{{-- Extends layout --}}
@extends('layouts.default')

{{-- Title Page --}}
@section('title', 'Add New Schedule')

{{-- Styles Section --}}
@section('styles')

@endsection

{{-- Content --}}
@section('content')
<div class="card card-custom card-sticky" id="kt_page_sticky_card">
    <div class="card-header">
        <div class="card-title">
            <h3 class="card-label">
                Add New Schedule <i class="mr-2"></i>
                <small class="">fill the form below</small>
            </h3>
        </div>
        <div class="card-toolbar">
            <a href="{{ url()->previous() }}" class="btn btn-light-primary font-weight-bolder mr-2">
                <i class="ki ki-long-arrow-back icon-sm"></i>
                Back
            </a>
            <div class="btn-group">
                <button type="submit" form="kt_form" class="btn btn-primary font-weight-bolder">
                    <i class="ki ki-check icon-sm"></i>
                    Submit
                </button>
            </div>
        </div>
    </div>
    <div class="card-body">
        <!--begin::Form-->
        <form class="form" id="kt_form" method="POST" action="{{ route('schedules.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-xl-2"></div>
                <div class="col-xl-8">
                    <div class="my-5">
                        <h3 class=" text-dark font-weight-bold mb-10">Schedule Info:</h3>
                        <div class="form-group row">
                            <label class="col-3">Message</label>
                            <div class="col-9">
                                <textarea class="form-control form-control-solid @error('message') is-invalid @enderror"
                                    type="text" name="message" required placeholder="Message">{{ old('message') }}</textarea>
                                @error('message')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-3">Media</label>
                            <div class="col-9">
                                <input class="form-control form-control-solid @error('media') is-invalid @enderror"
                                    type="file" name="media" autocomplete="off" placeholder="Media" />
                                @error('media')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-3">Sent at</label>
                            <div class="col-9">
                                <div class="input-group date" id="sent_at" data-target-input="nearest">
                                    <input type="text" name="sent_at"
                                        class="form-control datetimepicker-input @error('sent_at') is-invalid @enderror"
                                        value="{{ old('sent_at') }}"
                                        placeholder="Select sent at" data-target="#sent_at" required />
                                    <div class="input-group-append" data-target="#sent_at" data-toggle="datetimepicker">
                                        <span class="input-group-text">
                                            <i class="ki ki-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                                @error('sent_at')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2"></div>
            </div>
        </form>
        <!--end::Form-->
    </div>
</div>
@endsection

{{-- Scripts Section --}}
@section('scripts')
<script>
    "use strict";

    jQuery(document).ready(function () {
        $('#sent_at').datetimepicker();
    });
</script>
@endsection
