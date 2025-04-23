@extends('layouts.boatowner.common')
@section('meta')
<title>Dashboard - {{ config('app.name') }}</title>
@endsection
@section('css')

@endsection
@section('js')
   <script>
        $(document).on('change','select[name="cancel_reason"]',function(){
            var val = $(this).val();
            if(val == 'Other')
            {
                $('#reason-box').removeClass('d-none');
            }
            else
            {
                $('#reason-box').addClass('d-none');
            }
        })
        $(document).on('change','select[name="payment_status"]',function(){
            var val = $(this).val();
            if(val == 'cancel')
            {
                $('#reason-select').removeClass('d-none');
            }
            else
            {
                $('#reason-select').addClass('d-none');
                $('#reason-box').addClass('d-none');
            }
        })
   </script>
@endsection
@section('content')
    <div class="col-lg-9 main-dashboard">
        <div class="page-title">
            <h1>Your Order</h1>
        </div>
        @if(session('success'))
            <div class="alert alert-success" style="display: block;">
                <button class="close" data-close="alert"></button>
                <span> {{ session('success') }} </span>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger" style="display: block;">
                <button class="close" data-close="alert"></button>
                <span> {{ session('error') }} </span>
            </div>
        @endif
        @if($errors->any())
            <div style="color: red;">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul> 
            </div>
        @endif
       
        <div class="row">
            <div class="col-md-12">
                <h5>Booking Details</h5>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="label-default">Transactions Id</label>
                    <input type="text" name="" value="{{ $results->payment_intent_id }}" disabled class="form-control " autocomplete="off">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="label-default">Check In<span class="required"></span></label>
                    <input type="text" name="" value="{{ $results->check_in }}" disabled class="form-control " autocomplete="off">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="label-default">Check Out<span class="required"></span></label>
                    <input type="text" name="" value="{{ $results->check_out }}" disabled class="form-control " autocomplete="off">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h5>Payment Details</h5>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="label-default">Amount Paid<span class="required"> </span></label>
                    <input type="text" name="city" id="location" value="{{ $results->amount_paid }}" disabled class="form-control">
                    
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="label-default">Pending Amount<span class="required"> </span></label>
                    <input type="text" name="state" value="{{ $results->pending_amount }}" disabled class="form-control">
                    
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="label-default">Total<span class="required"></span></label>
                    <input type="text" name="state" value="{{ $results->total }}" disabled class="form-control">
                </div>
            </div>
        </div>
        <form class="personal-details-form" action="{{ route('boatowner.booking.update', $results->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-12">
                    <h5>Booking Status</h5>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="label-default">Booking Status<span class="required"></span></label>
                        <select name="payment_status" class="form-control">
                            <option {{ checkselect($results->payment_status,'succeeded') }} value="succeeded">Success</option>
                            <option {{ checkselect($results->payment_status,'cancel') }} value="cancel">cancel</option>
                        </select>
                    </div>
                </div>
                @php
                    $dCLsp = 'd-none';
                    if($results->payment_status == 'cancel'):
                        $dCLsp = '';
                    endif
                @endphp
                <div class="col-md-6 {{ $dCLsp }}" id="reason-select">
                    <div class="form-group">
                        <label class="label-default">Reason For Cancellation<span class="required"></span></label>
                        <select name="cancel_reason" class="form-control">
                            <option value="">Please Select Reason</option>
                            <option {{ checkselect($results->cancel_reason,'Severe weather conditions') }} value="Severe weather conditions">Severe weather conditions</option>
                            <option {{ checkselect($results->cancel_reason,'Mechanical or technical failure') }} value="Mechanical or technical failure">Mechanical or technical failure</option>
                            <option {{ checkselect($results->cancel_reason,'Damage to the boat') }} value="Damage to the boat">Damage to the boat</option>
                            <option {{ checkselect($results->cancel_reason,'Navigation or safety') }} value="Navigation or safety">Navigation or safety</option>
                            <option {{ checkselect($results->cancel_reason,'Skipper unavailable') }} value="Skipper unavailable">Skipper unavailable</option>
                            <option {{ checkselect($results->cancel_reason,'Owner or skipper illness or personal emergency') }} value="Owner or skipper illness or personal emergency">Owner or skipper illness or personal emergency</option>
                            <option {{ checkselect($results->cancel_reason,'Government travel restrictions or lockdown') }} value="Government travel restrictions or lockdown">Government travel restrictions or lockdown</option>
                            <option {{ checkselect($results->cancel_reason,'Natural disaster') }} value="Natural disaster">Natural disaster</option>
                            <option {{ checkselect($results->cancel_reason,'Political unrest or civil emergency') }} value="Political unrest or civil emergency">Political unrest or civil emergency</option>
                            <option {{ checkselect($results->cancel_reason,'Legal or insurance issue preventing the rental') }} value="Legal or insurance issue preventing the rental">Legal or insurance issue preventing the rental</option>
                            <option {{ checkselect($results->cancel_reason,'Renter appears intoxicated or under the influence') }} value="Renter appears intoxicated or under the influence">Renter appears intoxicated or under the influence</option>
                            <option {{ checkselect($results->cancel_reason,'Renter lacks required boating licence') }} value="Renter lacks required boating licence">Renter lacks required boating licence</option>
                            <option {{ checkselect($results->cancel_reason,'Renter displaying unsafe or aggressive behaviour') }} value="Renter displaying unsafe or aggressive behaviour">Renter displaying unsafe or aggressive behaviour</option>
                            <option {{ checkselect($results->cancel_reason,'Renter failed to arrive on time without notice') }} value="Renter failed to arrive on time without notice">Renter failed to arrive on time without notice</option>
                            <option {{ checkselect($results->cancel_reason,'Renter did not complete payment or deposit') }} value="Renter did not complete payment or deposit">Renter did not complete payment or deposit</option>
                            <option {{ checkselect($results->cancel_reason,'Double booking caused by calendar sync error') }} value="Double booking caused by calendar sync error">Double booking caused by calendar sync error</option>
                            <option {{ checkselect($results->cancel_reason,'Platform or listing error') }} value="Platform or listing error">Platform or listing error</option>
                            <option {{ checkselect($results->cancel_reason,'Other') }} value="Other">Other</option>
                        </select>
                    </div>
                </div>
                @php
                    $dCLs = 'd-none';
                    if($results->cancel_reason && $results->cancel_reason=='Other'):
                        $dCLs = '';
                    endif
                @endphp
                
                <div class="col-md-12 {{ $dCLs }}" id="reason-box">
                    <div class="form-group">
                        <label class="label-default">Reason<span class="required"></span></label>
                        <textarea name="cancel_message" class="form-control">{{ $results->cancel_message }}</textarea>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center form-group">
                        <button class="save_btn">Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
   
@endsection