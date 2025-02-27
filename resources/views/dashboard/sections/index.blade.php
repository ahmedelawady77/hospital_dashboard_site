@extends('dashboard.layouts.master')
@section('title')
    {{trans('Dashboard/main-sidebar_trans.sections')}} 
@stop
@section('css')
  <!-- Internal Data table css -->
<link href="{{URL::asset('assetsdashboard/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assetsdashboard/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assetsdashboard/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assetsdashboard/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assetsdashboard/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assetsdashboard/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">{{trans('Dashboard/main-sidebar_trans.sections')}}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{trans('Dashboard/main-sidebar_trans.view_all')}}</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
@include('dashboard.messages_alert')
				<!-- row -->
                    <!-- row opened -->
                    <div class="row row-sm">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-header pb-0">
                                    <div class="d-flex justify-content-between">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add">
                                            {{trans('Dashboard/sections_trans.add_sections')}}
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table text-md-nowrap" id="example2">
                                            <thead>
                                            <tr>
                                                <th class="wd-15p border-bottom-0">#</th>
                                                <th class="wd-15p border-bottom-0">{{trans('Dashboard/sections_trans.name_sections')}}</th>
                                                <th class="wd-15p border-bottom-0">{{trans('Dashboard/sections_trans.description')}}</th>
                                                <th class="wd-20p border-bottom-0">{{trans('Dashboard/sections_trans.created_at')}}</th>
                                                <th class="wd-20p border-bottom-0">{{trans('Dashboard/sections_trans.Processes')}}</th>
                                                <th class="wd-20p border-bottom-0"> </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                           @foreach($sections as $section)
                                               <tr>
                                                   <td>{{$loop->iteration}}</td>
                                                   <td><a href="{{route('sections.show',$section->id)}}">{{$section->name}}</a> </td>
                                                   <td>{{ \Str::limit($section->description, 50) }}</td>
                                                   <td>{{ $section->created_at->diffForHumans() }}</td>
                                                   <td>
                                                       <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"  data-toggle="modal" href="#edit{{$section->id}}"><i class="las la-pen"></i></a>
                                                       <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"  data-toggle="modal" href="#delete{{$section->id}}"><i class="las la-trash"></i></a>
                                                   </td>
                                               </tr>

                                               @include('dashboard.Sections.edit')
                                               @include('dashboard.Sections.delete')

                                           @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div><!-- bd -->
                            </div><!-- bd -->
                        </div>
                        <!--/div-->

                     @include('dashboard.Sections.add')
                    <!-- /row -->
               
				</div>
				<!-- row closed -->

			<!-- Container closed -->

		<!-- main-content closed -->
@endsection
@section('js')
<!-- Internal Data tables -->
<script src="{{URL::asset('assetsdashboard/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assetsdashboard/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assetsdashboard/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assetsdashboard/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assetsdashboard/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('assetsdashboard/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('assetsdashboard/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assetsdashboard/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assetsdashboard/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('assetsdashboard/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assetsdashboard/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('assetsdashboard/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assetsdashboard/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assetsdashboard/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('assetsdashboard/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assetsdashboard/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('assetsdashboard/js/table-data.js')}}"></script>
@endsection
