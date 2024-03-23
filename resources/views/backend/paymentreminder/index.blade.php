@extends('backend.layouts.app')

@section('title') {{ __($module_action) }} {{ __($module_title) }} @endsection

@section('breadcrumbs')
<x-backend-breadcrumbs>
    <x-backend-breadcrumb-item type="active" icon='{{ $module_icon }}'>{{ __($module_title) }}</x-backend-breadcrumb-item>
</x-backend-breadcrumbs>
@endsection

@section('content')
<div class="card">
    <div class="card-body">

        <x-backend.section-header>
            <i class="{{ $module_icon }}"></i> {{ __($module_title) }} <small class="text-muted">{{ __($module_action) }}</small>

            <x-slot name="subtitle">
                @lang(":module_name Management Dashboard", ['module_name'=>Str::title($module_name)])
            </x-slot>
        </x-backend.section-header>

        <hr>

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table id="datatable" class="table table-hover text-center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Customer Name</th>
                                <th>Company Name</th>
                                <th>Balance</th>
                                <th >Action</th>
                            </tr>
                        </thead>
                        <tbody>
                              @php
                                  $id = 1;
                              @endphp
                         @foreach ($latestBalances as $balance)
                                @php
                                    $latestBalanceRecord = App\Models\customer_total_balance::where('customer', $balance->customer)
                                        ->where('company', $balance->company)
                                        ->where('created_at', $balance->latest_created_at)
                                        ->first();

                                    $customerName = Modules\Customer\Models\Customer::find($balance->customer)->name;
                                    $companyName = Modules\Company\Models\Company::find($balance->company)->name;
                                @endphp

                                @if ($latestBalanceRecord)
                                    @if($loop->first || $customerName !== $previousCustomerName)
                                        <tr>
                                            <td>{{ $id++ }}</td>
                                            <td>{{ $customerName }}</td>
                                            <td>{{ $companyName }}</td>
                                            <td>{{ $latestBalanceRecord->balance }}</td>
                                            <td>
                                                <a href="{{ route("backend.$module_name.send", $latestBalanceRecord->id) }}"><button class="btn btn-primary text-white">Send</button></a>
                                            </td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td style="font-size:0px;">{{ $id }}</td>
                                            <td style="font-size:0px;">{{ $customerName }}</td>
                                            <td>{{ $companyName }}</td>
                                            <td>{{ $latestBalanceRecord->balance }}</td>
                                            <td>
                                                <a href="{{ route("backend.$module_name.send", $latestBalanceRecord->id) }}"><button class="btn btn-primary text-white">Send</button></a>
                                            </td>
                                        </tr>
                                    @endif

                                    @php
                                        $previousCustomerName = $customerName;
                                    @endphp
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
              
            </div>
        </div>
    </div>
    <div class="card-footer">
        <div class="row">

        </div>
    </div>
</div>
@endsection

@push ('after-styles')
<!-- DataTables Core and Extensions -->
<link rel="stylesheet" href="{{ asset('vendor/datatable/datatables.min.css') }}">
@endpush

@push ('after-scripts')
<!-- DataTables Core and Extensions -->
<script type="module" src="{{ asset('vendor/datatable/datatables.min.js') }}"></script>
<script type="module">
    $(document).ready(function () {
        $('#datatable').DataTable({
            processing: true,
            serverSide: false,
            autoWidth: true,
            responsive: true,
        });
    });
    
</script>

@endpush