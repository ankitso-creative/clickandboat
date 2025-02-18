@extends('layouts.admin.admin')

@section('meta')
    <title>Dashboard - {{ config('app.name') }}</title>    
    <meta content="Dashboard" name="description" />
@endsection
<style type="text/css">

</style>
@section('css')
    
@endsection

@section('js')    
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{ asset('app-assets/pages/scripts/dashboard.min.js') }}" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
@endsection

@section('content')
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <!-- BEGIN THEME PANEL -->            
            <!-- BEGIN PAGE TITLE-->
            <h1 class="page-title">
                Dashboard
            </h1>
            <div class="row widget-row">
                <div class="col-md-3" style="cursor: pointer">
                    <!-- BEGIN WIDGET THUMB -->
                    <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
                        <h4 class="widget-thumb-heading">Total Boat Owners</h4>
                        <div class="widget-thumb-wrap">
                            <i class="widget-thumb-icon bg-green fa fa-file-text-o"></i>
                            <div class="widget-thumb-body">
                                <span class="widget-thumb-body-stat" data-counter="counterup" data-value="{{ $totatBoatOwner }}">{{ $totatBoatOwner }}</span>
                            </div>
                        </div>
                    </div>
                    <!-- END WIDGET THUMB -->
                </div>
                <div class="col-md-3" style="cursor: pointer">
                    <!-- BEGIN WIDGET THUMB -->
                    <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
                        <h4 class="widget-thumb-heading">Total Customer</h4>
                        <div class="widget-thumb-wrap">
                            <i class="widget-thumb-icon bg-green fa fa-file-text-o"></i>
                            <div class="widget-thumb-body">
                                <span class="widget-thumb-body-stat" data-counter="counterup" data-value="{{ $totatCustomer }}">{{ $totatCustomer }}</span>
                            </div>
                        </div>
                    </div>
                    <!-- END WIDGET THUMB -->
                </div>
                <div class="col-md-3" style="cursor: pointer">
                    <!-- BEGIN WIDGET THUMB -->
                    <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
                        <h4 class="widget-thumb-heading">Total Listing</h4>
                        <div class="widget-thumb-wrap">
                            <i class="widget-thumb-icon bg-green fa fa-file-text-o"></i>
                            <div class="widget-thumb-body">
                                <span class="widget-thumb-body-stat" data-counter="counterup" data-value="{{ $totatListing }}">{{ $totatListing }}</span>
                            </div>
                        </div>
                    </div>
                    <!-- END WIDGET THUMB -->
                </div>
                <div class="col-md-3" style="cursor: pointer">
                    <!-- BEGIN WIDGET THUMB -->
                    <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
                        <h4 class="widget-thumb-heading">Total Bookings</h4>
                        <div class="widget-thumb-wrap">
                            <i class="widget-thumb-icon bg-green fa fa-file-text-o"></i>
                            <div class="widget-thumb-body">
                                <span class="widget-thumb-body-stat" data-counter="counterup" data-value="0">0</span>
                            </div>
                        </div>
                    </div>
                    <!-- END WIDGET THUMB -->
                </div>
            </div>
        </div>
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->
@endsection