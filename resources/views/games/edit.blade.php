{{-- Extends layout --}}
@extends('layouts.default')

{{-- Title Page --}}
@section('title', 'Edit Game: ' . $game->name)

{{-- Styles Section --}}
@section('styles')

@endsection

{{-- Content --}}
@section('content')
<div class="card card-custom card-sticky" id="kt_page_sticky_card">
    <div class="card-header">
        <div class="card-title">
            <h3 class="card-label">
                Edit Game: {{ $game->name }} <i class="mr-2"></i>
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
        <form class="form" id="kt_form" method="POST" action="{{ route('games.update', $game->id) }}">
            @csrf
            @method('PATCH')

            <div class="row">
                <div class="col-xl-2"></div>
                <div class="col-xl-8">
                    <div class="my-5">
                        <h3 class=" text-dark font-weight-bold mb-10">Game Info:</h3>
                        <div class="form-group row">
                            <label class="col-3">Code</label>
                            <div class="col-9">
                                <input class="form-control form-control-solid @error('code') is-invalid @enderror"
                                    type="text" name="code" value="{{ old('code', $game->code) }}" required
                                    autocomplete="off" placeholder="Code (ex: ff)" />
                                @error('code')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-3">Name</label>
                            <div class="col-9">
                                <input class="form-control form-control-solid @error('name') is-invalid @enderror"
                                    type="text" name="name" value="{{ old('name', $game->name) }}" required
                                    autocomplete="off" placeholder="Name" />
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-3">Unit</label>
                            <div class="col-9">
                                <input class="form-control form-control-solid @error('unit') is-invalid @enderror"
                                    type="text" name="unit" value="{{ old('unit', $game->unit) }}" required
                                    autocomplete="off" placeholder="Unit (ex: DM)" />
                                @error('unit')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="separator separator-dashed my-8"></div>

                        <div id="items_repeater">
                            <div class="form-group row" id="items_repeater">
                                <label class="col-lg-3 col-form-label">Items</label>
                                <div data-repeater-list="items" class="col-lg-9">
                                    @foreach(old('items', json_decode($game->items)) as $item)
                                    <div data-repeater-item class="form-group row align-items-center">
                                        <div class="col-md-5">
                                            <label>Amount:</label>
                                            <input type="text" name="amount"
                                                value="{{ old('items.'.$loop->index.'.amount', $item->amount ?? $item['amount']) }}"
                                                class="form-control form-control-solid number-format @error('items.'.$loop->index.'.amount') is-invalid @enderror"
                                                placeholder="Enter amount item" required />
                                            @error('items.'.$loop->index.'.amount')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <div class="d-md-none mb-2"></div>
                                        </div>
                                        <div class="col-md-5">
                                            <label>Price:</label>
                                            <input type="text" name="price"
                                                value="{{ old('items.'.$loop->index.'.price', $item->amount ?? $item['amount']) }}"
                                                class="form-control form-control-solid number-format @error('items.'.$loop->index.'.price') is-invalid @enderror"
                                                placeholder="Enter price item" required />
                                            @error('items.'.$loop->index.'.price')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <div class="d-md-none mb-2"></div>
                                        </div>
                                        <div class="col-md-2">
                                            <a href="javascript:;" data-repeater-delete=""
                                                class="btn btn-sm btn-light-danger">
                                                <i class="la la-trash-o"></i>
                                            </a>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label text-right"></label>
                                <div class="col-lg-4">
                                    <a href="javascript:;" data-repeater-create=""
                                        class="btn btn-sm font-weight-bolder btn-light-primary">
                                        <i class="la la-plus"></i>Add
                                    </a>
                                </div>
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
    var KTFormRepeater = function () {

        // Private functions
        var demo1 = function () {
            $('#items_repeater').repeater({
                initEmpty: false,

                defaultValues: {
                    'text-input': 'foo'
                },

                show: function () {
                    $(this).slideDown();
                },

                hide: function (deleteElement) {
                    $(this).slideUp(deleteElement);
                }
            });
        }

        return {
            // public functions
            init: function () {
                demo1();
            }
        };
    }();

    var KTMaskDemo = function () {

        // private functions
        var demos = function () {
            $('.number-format').mask('000000000000000', {
                reverse: true
            });
        }

        return {
            // public functions
            init: function () {
                demos();
            }
        };
    }();

    jQuery(document).ready(function () {
        KTFormRepeater.init();
        KTMaskDemo.init();
    });

</script>
@endsection
