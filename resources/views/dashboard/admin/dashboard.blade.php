@extends('dashboard.layouts.master')
@section('title')
لوحة تحكم الادمن
@stop
@section('css')
<!--  Owl-carousel css-->
<link href="{{URL::asset('assetsdashboard/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet" />
<!-- Maps css -->
<link href="{{URL::asset('assetsdashboard/plugins/jqvmap/jqvmap.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="left-content">
        <div>
            <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">لوحة التحكم الادمن</h2>
        </div>
    </div>
    <div class="main-dashboard-header-right">
        <div>
            <label class="tx-13">عدد الخدمات المفردة</label>
            <h5>{{ \App\Models\Service::count() }}</h5>
        </div>
        <div>
            <label class="tx-13">عدد الخدمات المجمعة</label>
            <h5>{{ \App\Models\Group::count() }}</h5>
        </div>
    </div>
</div>
<!-- /breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row row-sm">
    <div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
        <div class="card overflow-hidden sales-card bg-primary-gradient">
            <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                <div class="">
                    <h6 class="mb-3 tx-12 text-white">عدد الاطباء</h6>
                </div>
                <div class="pb-0 mt-0">
                    <div class="d-flex">
                        <div class="">
                            <h4 class="tx-20 font-weight-bold mb-1 text-white">{{ App\Models\Doctor::count() }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
        <div class="card overflow-hidden sales-card bg-danger-gradient">
            <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                <div class="">
                    <h6 class="mb-3 tx-12 text-white">عدد المرضي</h6>
                </div>
                <div class="pb-0 mt-0">
                    <div class="d-flex">
                        <div class="">
                            <h4 class="tx-20 font-weight-bold mb-1 text-white">{{ App\Models\Patient::count() }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
        <div class="card overflow-hidden sales-card bg-success-gradient">
            <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                <div class="">
                    <h6 class="mb-3 tx-12 text-white">عدد الاقسام</h6>
                </div>
                <div class="pb-0 mt-0">
                    <div class="d-flex">
                        <div class="">
                            <h4 class="tx-20 font-weight-bold mb-1 text-white">{{ App\Models\Section::count() }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->

<!-- row opened -->
@php
    $randomDoctors = App\Models\Doctor::inRandomOrder()->take(6)->get();
    $flags = ['us', 'nl', 'gb', 'ca', 'in', 'au'];
    $countries = ['United States', 'Netherlands', 'United Kingdom', 'Canada', 'India', 'Australia'];

    $invoices = App\Models\Invoice::orderBy('created_at', 'desc')->take(5)->get();
    
    $today = \Carbon\Carbon::today();
    $totalDebitToday = \App\Models\FundAccount::whereDate('created_at', $today)->sum('Debit');
@endphp

<div class="container-fluid">
    <div class="row">
        <!-- قسم الدكاترة والأعلام والدول -->
        <div class="col-md-6 col-lg-4">
            <div class="card card-dashboard-eight pb-2">
                <h6 class="card-title">دكاتره من الخارج</h6>
                <span class="d-block mg-b-10 text-muted tx-12"></span>
                <div class="list-group">
                    @foreach($randomDoctors as $index => $randomDoctor)
                        <div class="list-group-item @if($index === 0) border-top-0 @endif">
                            <i class="flag-icon flag-icon-{{ $flags[$index] }} flag-icon-squared"></i>
                            <p>{{ $countries[$index] }}</p><span>{{ $randomDoctor->name }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- قسم الفواتير -->
        <div class="col-md-6 col-lg-8">
            <div class="card card-table-two">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mb-1">اخر 5 فواتير علي النظام</h4>
                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                </div>
                <span class="tx-12 tx-muted mb-3"></span>
                <div class="table-responsive country-table">
                    <table class="table table-striped table-bordered mb-0 text-sm-nowrap text-lg-nowrap text-xl-nowrap">
                        <thead>
                            <tr>
                                <th class="wd-lg-25p">تاريخ الفاتورة</th>
                                <th class="wd-lg-25p tx-right">اسم الخدمة</th>
                                <th class="wd-lg-25p tx-right">اسم المريض</th>
                                <th class="wd-lg-25p tx-right">اسم الدكتور</th>
                                <th class="wd-lg-25p tx-right">السعر</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($invoices as $invoice)
                                <tr>
                                    <td>{{ $invoice->invoice_date }}</td>
                                    <td class="tx-right tx-medium tx-inverse">{{ $invoice->Service->name }}</td>
                                    <td class="tx-right tx-medium tx-inverse">{{ $invoice->Patient->name }}</td>
                                    <td class="tx-right tx-medium tx-inverse">{{ $invoice->Doctor->name }}</td>
                                    <td class="tx-right tx-medium tx-danger">{{ number_format($invoice->total_with_tax, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- قسم التحصيل اليومي -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card card-dashboard-eight pb-2">
                <h6 class="card-title">المبلغ المحصل اليوم</h6>
                <div class="d-flex align-items-center">
                    <div class="ml-auto">
                        <h4 class="tx-20 font-weight-bold mb-1 text-success">${{ number_format($totalDebitToday, 2) }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{ URL::asset('assetsdashboard/plugins/chart.js/Chart.bundle.min.js') }}"></script>
<script src="{{ URL::asset('assetsdashboard/plugins/raphael/raphael.min.js') }}"></script>
<script src="{{ URL::asset('assetsdashboard/plugins/jquery.flot/jquery.flot.js') }}"></script>
@endsection
