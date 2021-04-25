{{-- Extends layout --}}
@extends('layouts.default')

{{-- Title Page --}}
@section('title', 'Add New Admin')

{{-- Styles Section --}}
@section('styles')
    
@endsection

{{-- Content --}}
@section('content')
<div class="card card-custom card-sticky" id="kt_page_sticky_card">
    <div class="card-header">
        <div class="card-title">
            <h3 class="card-label">
                Add New Admin <i class="mr-2"></i>
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
        <form class="form" id="kt_form" method="POST" action="{{ route('users.store') }}">
            @csrf

            <div class="row">
                <div class="col-xl-2"></div>
                <div class="col-xl-8">
                    <div class="my-5">
                        <h3 class=" text-dark font-weight-bold mb-10">Admin Info:</h3>
                        <div class="form-group row">
                            <label class="col-3">Name</label>
                            <div class="col-9">
                                <input class="form-control form-control-solid @error('name') is-invalid @enderror"
                                    type="text" name="name" value="{{ old('name') }}" required autocomplete="off" placeholder="Name" />
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-3">Email</label>
                            <div class="col-9">
                                <input class="form-control form-control-solid @error('email') is-invalid @enderror"
                                    type="email" name="email" value="{{ old('email') }}" required autocomplete="off" placeholder="Email" />
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-3">Whatsapp Number</label>
                            <div class="col-9">
                                <input class="form-control form-control-solid @error('number') is-invalid @enderror"
                                    type="text" name="number" value="{{ old('number') }}" required autocomplete="off" placeholder="Whatsapp Number" />
                                @error('number')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-3">Password</label>
                            <div class="col-9">
                                <input class="form-control form-control-solid @error('password') is-invalid @enderror"
                                    type="password" name="password" min="6" required placeholder="Password" />
                                @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <span class="form-text text-muted">Panjang password minimal 6</span>
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
    
@endsection
