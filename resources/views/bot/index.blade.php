{{-- Extends layout --}}
@extends('layouts.default')

{{-- Title Page --}}
@section('title', 'Bot Whatsapp')

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
			<h3 class="card-label">Bot Whatsapp</h3>
		</div>
		<div class="card-toolbar">

		</div>
	</div>
	<div class="card-body">
		<div class="row ">
			<div class="col-md-4">
				<center><img src="https://i.pinimg.com/originals/5b/9f/44/5b9f4406699a94237647a1f03834a2ad.jpg" width="240px" alt="QR Code Whatsapp" style="margin: auto 0px;" id="qr_code"></center>
			</div>
			<div class="col-md-8">
				<div class="form-group row align-items-center">
					<label class="col-md-2 col-sm-4">Status</label>
					<div class="col-md-10 col-sm-8">
						<div class="input-group">
							
							<input type="text" name="status" class="form-control form-control-solid" id="status"
							value="{{ $status }}" readonly />
							<div class="input-group-append ml-1">
								<button type="button" class="btn btn-success btn-connect"><i class="la la-refresh"></i></button>
							</div>
						</div>
					</div>
				</div>	
				<div class="form-group row align-items-center">
					<label class="col-md-2 col-sm-4">Token</label>
					<div class="col-md-10 col-sm-8">
						<div class="input-group">
							
							<input type="text" name="token" class="form-control form-control-solid" id="token"
							value="{{ $token }}" readonly />
							<div class="input-group-append ml-1">
								<a href="#" class="btn btn-primary" data-clipboard="true"
								data-clipboard-target="#token"><i class="la la-copy"></i></a>
							</div>
							<div class="input-group-append ml-1">
								<button type="submit" class="btn btn-success" form="bot_form"><i class="la la-refresh"></i></button>
							</div>
						</div>
					</div>
				</div>

				<form action="{{ route('bot.token') }}" method="POST" class="form-inline" id="bot_form">
					@csrf
					@method('PATCH')
				</form>
			</div>
		</div>
	</div>
</div>
@endsection

{{-- Scripts Section --}}
@section('scripts')
{{-- vendors --}}
<script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.js" crossorigin="anonymous"></script>

{{-- page scripts --}}
<script>
	"use strict";

	jQuery(document).ready(function () {
		var socket = io.connect(HOST_API);

		$(".btn-connect").click(function(){
			toastr.success('Reconnect...');

			return new Promise(function (resolve) {
				socket.on('message', function(message) {
					toastr.success(message);
				});

				socket.on('qr', function(src) {
					$('#qr_code').attr('src', src);
				});

				socket.on('ready', function (message) {
					toastr.success(message);
					$('input[name=status]').val('Connected');
				});

				socket.on('disconnected', function (message) {
					toastr.error(message);
					$('input[name=status]').val('Disconnected');
				});
			});
		}); 
	});
</script>
@endsection