{{-- Header --}}
@if (config('layout.extras.quick-actions.dropdown.style') == 'light')
    <div class="d-flex flex-column flex-center py-10 bg-dark-o-5 rounded-top bg-light">
        <h4 class="text-dark font-weight-bold">
            Quick Actions
        </h4>
        <span class="btn btn-success btn-sm font-weight-bold font-size-sm mt-2">{{ topup_waiting() }} transaksi menunggu</span>
    </div>
@else
    <div class="d-flex flex-column flex-center py-10 bgi-size-cover bgi-no-repeat rounded-top" style="background-image: url('{{ asset('media/misc/bg-1.jpg') }}')">
        <h4 class="text-white font-weight-bold">
            Quick Actions
        </h4>
        <span class="btn btn-success btn-sm font-weight-bold font-size-sm mt-2">{{ topup_waiting() }} transaksi menunggu</span>
    </div>
@endif

{{-- Nav --}}
<div class="row row-paddingless">
    {{-- Item --}}
    <div class="col-6">
        <a href="{{ route('transactions.index') }}" class="d-block py-10 px-5 text-center bg-hover-light border-right border-bottom">
            {{ Metronic::getSVG("media/svg/icons/Communication/Clipboard-list.svg", "svg-icon-3x svg-icon-success") }}
            <span class="d-block text-dark-75 font-weight-bold font-size-h6 mt-2 mb-1">Transaksi</span>
            <span class="d-block text-dark-50 font-size-lg">Top Up</span>
        </a>
    </div>

    {{-- Item --}}
    <div class="col-6">
        <a href="{{ route('report.index') }}" class="d-block py-10 px-5 text-center bg-hover-light border-bottom">
            {{ Metronic::getSVG("media/svg/icons/Home/Book-open.svg", "svg-icon-3x svg-icon-success") }}
            <span class="d-block text-dark-75 font-weight-bold font-size-h6 mt-2 mb-1">Laporan</span>
            <span class="d-block text-dark-50 font-size-lg">Keuangan</span>
        </a>
    </div>
</div>
