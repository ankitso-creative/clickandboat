@extends('layouts.customer.common')
@section('meta')
<title>Dashboard - {{ config('app.name') }}</title>
@endsection
@section('css')
    <link href="{{ asset('app-assets/global/plugins/bootstrap-sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css" />   
@endsection
@section('js')
    <script src="{{ asset('app-assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/pages/scripts/ui-sweetalert.min.js') }}" type="text/javascript"></script>
    <script src="https://js.stripe.com/v3/"></script>
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
                $('#evidence-box').removeClass('d-none');
            }
            else
            {
                $('#reason-select').addClass('d-none');
                $('#reason-box').addClass('d-none');
                $('#evidence-box').addClass('d-none');
            }
        })
        $('#pay-pending-amount').on('click', function() {
            swal({
                title: '',
                text: 'Click to confirm pay pending amount.',
                icon: 'warning', // Use "icon" instead of "type" in SweetAlert 2
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#aaa',
                confirmButtonText: 'Confirm',
                cancelButtonText: 'Cancel',
                allowOutsideClick: false,
            }, function(isConfirm) {
                if (isConfirm) {
                    $('#payment-pending-form').removeClass('d-none');
                }
            });
        });
		const stripe = Stripe("{{ config('services.stripe.key') }}");
		const elements = stripe.elements();
        const card = elements.create("card");
        card.mount("#card-element");
		card.on('change', function(event) {
            const cardErrors = document.getElementById('card-errors');
            if (event.error) {
                cardErrors.textContent = event.error.message;
            } else {
                cardErrors.textContent = ''; 
            }
        });
 		document.getElementById("payment-form").addEventListener("submit", async (event) => {
			event.preventDefault();

			const submitButton = document.getElementById("submit-button");
			submitButton.innerHTML = `<i class="fas fa-spinner fa-spin me-2"></i> Wait Please...`;

			const orderID = document.getElementById("orderID").value;
			try {
				const response = await fetch("{{ route('customer.stripe.createPaymentPending') }}", {
					method: "POST",
					headers: {
						"Content-Type": "application/json",
						"X-CSRF-TOKEN": "{{ csrf_token() }}"
					},
					body: JSON.stringify({ orderID })
				});
				const data = await response.json();
				if (data.error) {
					document.getElementById("card-errors").innerText = data.error;
					submitButton.innerHTML = `Pay`;
					return;
				}
				const { paymentIntent, error } = await stripe.confirmCardPayment(data.clientSecret, {
					payment_method: {
						card: card,
					}
				});
				if (error) {
					document.getElementById("card-errors").innerText = error.message;
					submitButton.innerHTML = `Pay`;
				} 
				else {
					const confirmationResponse = await fetch("{{ route('customer.stripe.confirmPaymentPending') }}", {
						method: "POST",
						headers: {
							"Content-Type": "application/json",
							"X-CSRF-TOKEN": "{{ csrf_token() }}"
						},
						body: JSON.stringify({
							paymentIntentId: paymentIntent.id,
							paymentStatus: paymentIntent.status, 
							orderID
						})
					});
					const confirmationData = await confirmationResponse.json();
					if (confirmationData.error) {
						document.getElementById("card-errors").innerText = confirmationData.error;
						submitButton.innerHTML = `Pay`;
					} else {
						window.location.href = confirmationData.url
					}
				}
			} catch (error) {
				document.getElementById("card-errors").innerText = error.message;
				submitButton.innerHTML = `Pay`;
			}
		});
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
        <form class="personal-details-form" action="{{ route('customer.booking.update', $results->id) }}" method="post" enctype="multipart/form-data">
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
                        <select name="cancel_reason" class="form-control" >
                            <option value="">Please Select Reason</option>
                            <option {{ checkselect($results->cancel_reason,'Severe weather conditions') }} value="Severe weather conditions">Severe weather conditions</option>
                            <option {{ checkselect($results->cancel_reason,'Skipper unavailable') }} value="Skipper unavailable">Skipper unavailable</option>
                            <option {{ checkselect($results->cancel_reason,'Natural disaster') }} value="Natural disaster">Natural disaster</option>
                            <option {{ checkselect($results->cancel_reason,'Renter did not complete payment or deposit') }} value="Renter did not complete payment or deposit">Did not complete payment or deposit</option>
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
                        <textarea name="cancel_message" class="form-control" >{{ $results->cancel_message }}</textarea>
                    </div>
                </div>
                <div class="col-md-6 {{ $dCLsp }}" id="evidence-box">
                    <div class="form-group">
                        <label class="label-default">Provide Evidence<span class="required"></span></label>
                        <input type="file" class="form-control" name="evidence" accept=".jpeg,.jpg,.pdf,.png">
                        @error('evidence')<span class="required">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-md-6 {{ $dCLsp }}">
                    @php 
                        $evidence = $results->getFirstMediaUrl('evidence');
                        $extensionEv = pathinfo($evidence, PATHINFO_EXTENSION);
                    @endphp
                     @if($evidence)
                         <div class="form-group">
                             <label class="label-default">Evidence</label>
                         </div>
                         @if($extensionEv == 'pdf')
                             <div class="user-identity">
                                 <a href="{{ $evidence }}" target="_blank"><img src="{{ asset('app-assets/site_assets/img/pdf-img.png') }}" id="avatar" alt="identity"></a>
                             </div>
                         @else
                             <div class="user-identity">
                                 <img src="{{ $evidence }}" id="avatar" alt="identity">
                             </div>
                         @endif
                     @endif
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
        @if($results->pending_amount)
            <form id="payment-form">
                <div class="row">
                    <div class="col-md-12 payment_heading">
                        <h5> <a href="javascript:;" id="pay-pending-amount">Click Here  </a>To pay Pending Amount</h5>
                    </div>
                    <div class="col-md-12 d-none" id="payment-pending-form">
                        <div id="paymentAccordion" class="cus_payment_method">
                            <!-- Card Payment -->
                            <div class="form-group form-accordion-title">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="cardPayment" name="paymentMethod" class="custom-control-input" data-toggle="collapse" data-target="#cardDetails" checked>
                                    <label class="custom-control-label" for="cardPayment"><svg class="p-Icon p-Icon--card Icon p-Icon--md TabIcon p-PaymentAccordionButtonIcon TabIcon--selected" role="presentation" fill="var(--colorIcon)" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"><path fill-rule="evenodd" clip-rule="evenodd" d="M0 4a2 2 0 012-2h12a2 2 0 012 2H0zm0 2v6a2 2 0 002 2h12a2 2 0 002-2V6H0zm3 5a1 1 0 011-1h1a1 1 0 110 2H4a1 1 0 01-1-1z"></path></svg> Card</label>
                                </div>
                                <input type="hidden" id="orderID" value="{{ $results->id }}">
                                <div id="card-element"></div>
                            </div>
                        </div>
                        <div class="checkout-btn-sec">
                            <div id="card-errors"></div>

                            <button class="btn btn-primary btn-checkout" id="submit-button">Pay Now</button>

                        </div>
                    </div>
                </div>
            </form>
        @endif
    </div>
   
@endsection