@extends('layouts.front.common')
@section('meta')
<title>Motorboat Quicksilver 675 Open 150hp</title>
<style type="text/css">
   .header.header-slider {
   position: relative;
   background: #222222;
   }
</style>
@endsection
@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection
@section('js')
	<script src="https://js.stripe.com/v3/"></script>
	<script>
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
			const quotationID = document.getElementById("quotationID").value;
			const paymentType = document.querySelector('input[name="payment_type"]:checked')?.value;
			try {
				const response = await fetch("{{ route('customer.stripe.createPaymentIntent') }}", {
					method: "POST",
					headers: {
						"Content-Type": "application/json",
						"X-CSRF-TOKEN": "{{ csrf_token() }}"
					},
					body: JSON.stringify({ quotationID,paymentType })
				});
				const data = await response.json();
				if (data.error) {
					document.getElementById("card-errors").innerText = data.error;
					return;
				}
				const { paymentIntent, error } = await stripe.confirmCardPayment(data.clientSecret, {
					payment_method: {
						card: card,
					}
				});
				if (error) {
					document.getElementById("card-errors").innerText = error.message;
				} 
				else {
					const confirmationResponse = await fetch("{{ route('customer.stripe.confirmPaymentIntent') }}", {
						method: "POST",
						headers: {
							"Content-Type": "application/json",
							"X-CSRF-TOKEN": "{{ csrf_token() }}"
						},
						body: JSON.stringify({
							paymentIntentId: paymentIntent.id,
							paymentStatus: paymentIntent.status, 
							quotationID,paymentType
						})
					});
					const confirmationData = await confirmationResponse.json();
					if (confirmationData.error) {
						document.getElementById("card-errors").innerText = confirmationData.error;
					} else {
						window.location.href = confirmationData.url
					}
				}
			} catch (error) {
				document.getElementById("card-errors").innerText = error.message;
			}
		});
	</script>
@endsection
@section('content')
<section class="checkout-section">
   <div class="container">
		<form id="payment-form">
			<div class="row">
				<div class="col-md-8">
					<div class="checkout-title">
						<h1><a href="javascript:history.back()" class="btn-back"><i class="fas fa-arrow-left"></i></a> Booking request</h1>
					</div>
					<div class="rental-type-sec">
						@if($listing->skipper != 'without skipper')
							{{-- <h4>Rental type</h4>
							<div class="rental-form">
								<div class="row">
									<div class="col-md-12">
										<input type="radio" checked="" value="Without skipper" class="form-check-input" name="optradio" id="myRadio1">
										<label for="myRadio1">
											<span class="title-label">Without skipper</span>
											<span class="title-text">You will be the skipper of the boat, a license is required.</span>
										</label>
									</div>
									<div class="col-md-12">
										<input type="radio" checked="" value="With a skipper" class="form-check-input" name="optradio" id="myRadio2">
										<label for="myRadio2">
											<span class="title-label">With a skipper · €100/ day</span>
											<span class="title-text">You will be accompanied by a skipper.</span>
										</label>
									</div>
								</div>
							</div> --}}
						@endif
						{{-- <h4>Additional options</h4>
						<div class="options-form">
							<div class="row">
								<div class="col-md-12">
									<input type="checkbox" checked="" value="Without skipper" class="form-check-input" name="optradio" id="myCheckbox1">
									<label for="myCheckbox1">
										<div class="option-icon">
											<svg name="icon-buoy-48" width="48" height="48" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
												<path d="M25 10.93V2H23V10.93C18.8194 11.1898 14.9041 13.0668 12.0833 16.1632C9.26254 19.2597 7.75779 23.3325 7.88778 27.5192C8.01776 31.7058 9.77227 35.6775 12.7797 38.593C15.7872 41.5085 19.8113 43.139 24 43.139C28.1887 43.139 32.2129 41.5085 35.2203 38.593C38.2278 35.6775 39.9823 31.7058 40.1122 27.5192C40.2422 23.3325 38.7375 19.2597 35.9167 16.1632C33.0959 13.0668 29.1806 11.1898 25 10.93ZM24 41.12C21.2073 41.12 18.4774 40.2919 16.1554 38.7404C13.8333 37.1888 12.0235 34.9836 10.9548 32.4035C9.88612 29.8234 9.6065 26.9843 10.1513 24.2453C10.6961 21.5063 12.0409 18.9904 14.0157 17.0157C15.9904 15.0409 18.5063 13.6961 21.2453 13.1513C23.9844 12.6065 26.8234 12.8861 29.4035 13.9548C31.9836 15.0235 34.1888 16.8333 35.7404 19.1553C37.2919 21.4774 38.12 24.2073 38.12 27C38.1174 30.744 36.6289 34.334 33.9814 36.9814C31.334 39.6289 27.7441 41.1174 24 41.12Z"></path>
												<path d="M24 19.13C22.4435 19.13 20.9219 19.5916 19.6277 20.4563C18.3335 21.3211 17.3247 22.5502 16.7291 23.9883C16.1334 25.4263 15.9776 27.0087 16.2812 28.5354C16.5849 30.062 17.3344 31.4643 18.4351 32.5649C19.5357 33.6656 20.938 34.4151 22.4646 34.7188C23.9913 35.0225 25.5737 34.8666 27.0117 34.2709C28.4498 33.6753 29.6789 32.6666 30.5437 31.3723C31.4084 30.0781 31.87 28.5565 31.87 27C31.8674 24.9136 31.0374 22.9133 29.562 21.438C28.0867 19.9627 26.0865 19.1327 24 19.13ZM24 32.87C22.839 32.87 21.7041 32.5257 20.7388 31.8807C19.7735 31.2357 19.0211 30.319 18.5768 29.2464C18.1326 28.1738 18.0163 26.9935 18.2428 25.8548C18.4693 24.7162 19.0284 23.6702 19.8493 22.8493C20.6702 22.0284 21.7162 21.4693 22.8548 21.2428C23.9935 21.0163 25.1738 21.1325 26.2464 21.5768C27.319 22.0211 28.2357 22.7735 28.8807 23.7388C29.5257 24.7041 29.87 25.839 29.87 27C29.87 28.5568 29.2516 30.0499 28.1507 31.1507C27.0499 32.2516 25.5568 32.87 24 32.87Z"></path>
												<path d="M13 22.28C12.85 22.64 12.71 23 12.59 23.37C12.5479 23.5033 12.5343 23.644 12.5499 23.7829C12.5656 23.9218 12.6102 24.0559 12.6808 24.1765C12.7515 24.2971 12.8467 24.4016 12.9602 24.4831C13.0738 24.5647 13.2031 24.6215 13.34 24.65C13.575 24.6947 13.8182 24.6537 14.0255 24.5344C14.2328 24.4152 14.3905 24.2256 14.47 24C14.57 23.69 14.68 23.39 14.81 23.09C14.94 22.79 15.05 22.56 15.18 22.31C15.2988 22.0899 15.3307 21.8333 15.2697 21.5908C15.2086 21.3484 15.0588 21.1376 14.85 21C14.7342 20.9237 14.6038 20.8724 14.4671 20.8492C14.3303 20.826 14.1903 20.8315 14.0558 20.8654C13.9213 20.8992 13.7953 20.9607 13.6859 21.0458C13.5764 21.131 13.4859 21.238 13.42 21.36C13.26 21.65 13.1 22 13 22.28Z"></path>
												<path d="M30.11 17.92C30.1884 17.8045 30.2417 17.6738 30.2665 17.5365C30.2914 17.3991 30.2871 17.2581 30.2542 17.1224C30.2212 16.9868 30.1602 16.8595 30.0751 16.7489C29.99 16.6383 29.8827 16.5467 29.76 16.48C29.4355 16.2932 29.1017 16.123 28.76 15.97C28.35 15.8 27.93 15.64 27.51 15.51C27.376 15.468 27.2347 15.4547 27.0952 15.471C26.9557 15.4872 26.8212 15.5327 26.7004 15.6044C26.5797 15.6761 26.4754 15.7724 26.3943 15.8871C26.3133 16.0018 26.2573 16.1322 26.23 16.27C26.1816 16.5118 26.2243 16.7629 26.3498 16.9752C26.4753 17.1875 26.6748 17.3459 26.91 17.42C27.2702 17.5307 27.624 17.6609 27.97 17.81C28.27 17.94 28.56 18.08 28.85 18.24C29.0637 18.3456 29.3081 18.3713 29.5391 18.3127C29.7701 18.254 29.9726 18.1147 30.11 17.92Z"></path>
												<path d="M20.28 17.72C20.55 17.61 20.82 17.52 21.1 17.43C21.337 17.3579 21.5389 17.2003 21.6663 16.9878C21.7938 16.7753 21.8379 16.5231 21.79 16.28C21.7625 16.1434 21.7068 16.014 21.6264 15.9002C21.546 15.7864 21.4427 15.6906 21.3231 15.6191C21.2035 15.5475 21.0703 15.5017 20.932 15.4847C20.7937 15.4676 20.6534 15.4796 20.52 15.52C20.19 15.62 19.86 15.74 19.52 15.87C19.1618 16.0115 18.8113 16.1717 18.47 16.35C18.3463 16.4141 18.2374 16.5034 18.1502 16.612C18.0631 16.7207 17.9996 16.8463 17.9638 16.981C17.928 17.1156 17.9207 17.2562 17.9425 17.3938C17.9642 17.5314 18.0145 17.663 18.09 17.78C18.224 17.9872 18.4298 18.1376 18.6679 18.2022C18.9061 18.2668 19.1597 18.2411 19.38 18.13C19.68 18 20 17.84 20.28 17.72Z"></path>
												<path d="M35.13 22.54C34.9699 22.1249 34.7828 21.7207 34.57 21.33C34.5016 21.209 34.4087 21.1036 34.2973 21.0204C34.1859 20.9373 34.0583 20.8784 33.9228 20.8473C33.7873 20.8163 33.6468 20.8138 33.5103 20.8401C33.3738 20.8664 33.2443 20.9209 33.13 21C32.9237 21.1373 32.7757 21.3463 32.7148 21.5865C32.6538 21.8267 32.6842 22.0809 32.8 22.3C32.9794 22.6237 33.1397 22.9576 33.28 23.3C33.4 23.6 33.51 23.91 33.6 24.22C33.67 24.4569 33.8253 24.6595 34.0357 24.7887C34.2462 24.918 34.4971 24.9647 34.74 24.92C34.8773 24.8947 35.0078 24.841 35.123 24.7623C35.2383 24.6836 35.3358 24.5816 35.4093 24.4629C35.4828 24.3442 35.5306 24.2114 35.5496 24.0732C35.5687 23.9349 35.5586 23.7942 35.52 23.66C35.4118 23.2795 35.2816 22.9055 35.13 22.54Z"></path>
											</svg>
										</div>
										<div class="option-box">
											<span class="title-label">Donut</span>
											<span class="title-text"> €30 / day </span>
										</div>
									</label>
								</div>
								<div class="col-md-12">
									<input type="checkbox" checked="" value="With a skipper" class="form-check-input" name="optradio" id="myCheckbox2">
									<label for="myCheckbox2">
										<div class="option-icon">
											<svg name="icon-wakeboard-48" width="48" height="48" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
												<path d="M38.84 26.16L34 22.5V2H32V22.5L27.31 26L27.16 26.14C26.8584 26.4732 26.6606 26.8871 26.5907 27.3311C26.5208 27.7751 26.582 28.2297 26.7667 28.6395C26.9514 29.0492 27.2516 29.3961 27.6305 29.6378C28.0094 29.8794 28.4506 30.0053 28.9 30H37.1C37.5456 30.0018 37.9822 29.8747 38.3572 29.634C38.7321 29.3933 39.0295 29.0493 39.2134 28.6434C39.3973 28.2376 39.4599 27.7872 39.3937 27.3465C39.3274 26.9059 39.1351 26.4938 38.84 26.16ZM37.39 27.81C37.3673 27.8678 37.3272 27.9171 37.2752 27.9511C37.2233 27.9852 37.1621 28.0022 37.1 28H28.9C28.8379 28.0022 28.7767 27.9852 28.7248 27.9511C28.6728 27.9171 28.6327 27.8678 28.61 27.81C28.5901 27.766 28.5798 27.7183 28.5798 27.67C28.5798 27.6217 28.5901 27.574 28.61 27.53L33 24.25L37.38 27.53C37.4015 27.5733 37.4135 27.6206 37.4152 27.6689C37.4169 27.7172 37.4083 27.7653 37.39 27.81Z"></path>
												<path d="M16.81 2H15.19C13.5684 2.03919 12.0175 2.67147 10.8307 3.77716C9.64393 4.88286 8.90366 6.38525 8.75 8C8.18 13 7.5 19.73 7.5 24C7.5 28.27 8.18 35 8.75 40C8.90155 41.6156 9.64118 43.1192 10.8284 44.2253C12.0156 45.3314 13.5678 45.963 15.19 46H16.81C18.4322 45.963 19.9844 45.3314 21.1716 44.2253C22.3588 43.1192 23.0985 41.6156 23.25 40C23.82 35.06 24.5 28.28 24.5 24C24.5 19.72 23.82 13 23.25 8C23.0963 6.38525 22.3561 4.88286 21.1693 3.77716C19.9825 2.67147 18.4316 2.03919 16.81 2ZM21.26 39.76C21.1674 40.8895 20.6629 41.9456 19.8424 42.7274C19.0219 43.5092 17.9427 43.9621 16.81 44H15.19C14.0573 43.9621 12.9781 43.5092 12.1576 42.7274C11.3371 41.9456 10.8326 40.8895 10.74 39.76C10.17 34.87 9.5 28.18 9.5 24C9.5 19.82 10.17 13.13 10.74 8.24C10.8326 7.11048 11.3371 6.05439 12.1576 5.27261C12.9781 4.49083 14.0573 4.03791 15.19 4H16.81C17.9427 4.03791 19.0219 4.49083 19.8424 5.27261C20.6629 6.05439 21.1674 7.11048 21.26 8.24C21.83 13.13 22.5 19.83 22.5 24C22.5 28.17 21.83 34.87 21.26 39.76Z"></path>
												<path d="M17.5 28H14.5C13.7044 28 12.9413 28.3161 12.3787 28.8787C11.8161 29.4413 11.5 30.2044 11.5 31C11.5 31.7956 11.8161 32.5587 12.3787 33.1213C12.9413 33.6839 13.7044 34 14.5 34H17.5C18.2956 34 19.0587 33.6839 19.6213 33.1213C20.1839 32.5587 20.5 31.7956 20.5 31C20.5 30.2044 20.1839 29.4413 19.6213 28.8787C19.0587 28.3161 18.2956 28 17.5 28ZM17.5 32H14.5C14.2348 32 13.9804 31.8946 13.7929 31.7071C13.6054 31.5196 13.5 31.2652 13.5 31C13.5 30.7348 13.6054 30.4804 13.7929 30.2929C13.9804 30.1054 14.2348 30 14.5 30H17.5C17.7652 30 18.0196 30.1054 18.2071 30.2929C18.3946 30.4804 18.5 30.7348 18.5 31C18.5 31.2652 18.3946 31.5196 18.2071 31.7071C18.0196 31.8946 17.7652 32 17.5 32Z"></path>
												<path d="M17.5 14H14.5C13.7044 14 12.9413 14.3161 12.3787 14.8787C11.8161 15.4413 11.5 16.2044 11.5 17C11.5 17.7956 11.8161 18.5587 12.3787 19.1213C12.9413 19.6839 13.7044 20 14.5 20H17.5C18.2956 20 19.0587 19.6839 19.6213 19.1213C20.1839 18.5587 20.5 17.7956 20.5 17C20.5 16.2044 20.1839 15.4413 19.6213 14.8787C19.0587 14.3161 18.2956 14 17.5 14ZM17.5 18H14.5C14.2348 18 13.9804 17.8946 13.7929 17.7071C13.6054 17.5196 13.5 17.2652 13.5 17C13.5 16.7348 13.6054 16.4804 13.7929 16.2929C13.9804 16.1054 14.2348 16 14.5 16H17.5C17.7652 16 18.0196 16.1054 18.2071 16.2929C18.3946 16.4804 18.5 16.7348 18.5 17C18.5 17.2652 18.3946 17.5196 18.2071 17.7071C18.0196 17.8946 17.7652 18 17.5 18Z"></path>
											</svg>
										</div>
										<div class="option-box">
											<span class="title-label">Wakeborad</span>
											<span class="title-text"> €50 / day </span>
										</div>
									</label>
								</div>
								<div class="col-md-12">
									<input type="checkbox" checked="" value="With a skipper" class="form-check-input" name="optradio" id="myCheckbox3">
									<label for="myCheckbox3">
										<div class="option-icon">
											<svg name="icon-waterski-48" width="48" height="48" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
												<path d="M13 2C12.2044 2 11.4413 2.31607 10.8787 2.87868C10.3161 3.44129 10 4.20435 10 5V46H16V5C16 4.20435 15.6839 3.44129 15.1213 2.87868C14.5587 2.31607 13.7956 2 13 2ZM13 4C13.2652 4 13.5196 4.10536 13.7071 4.29289C13.8946 4.48043 14 4.73478 14 5V21H12V5C12 4.73478 12.1054 4.48043 12.2929 4.29289C12.4804 4.10536 12.7348 4 13 4ZM12 33V27H14V33H12ZM14 35V37H12V35H14ZM12 25V23H14V25H12ZM12 44V39H14V44H12Z"></path>
												<path d="M21 2C20.2044 2 19.4413 2.31607 18.8787 2.87868C18.3161 3.44129 18 4.20435 18 5V46H24V5C24 4.20435 23.6839 3.44129 23.1213 2.87868C22.5587 2.31607 21.7956 2 21 2ZM21 4C21.2652 4 21.5196 4.10536 21.7071 4.29289C21.8946 4.48043 22 4.73478 22 5V21H20V5C20 4.73478 20.1054 4.48043 20.2929 4.29289C20.4804 4.10536 20.7348 4 21 4ZM20 33V27H22V33H20ZM22 35V37H20V35H22ZM20 25V23H22V25H20ZM20 44V39H22V44H20Z"></path>
												<path d="M38.84 26.16L34 22.5V2H32V22.5L27.31 26L27.16 26.14C26.8584 26.4732 26.6606 26.8871 26.5907 27.3311C26.5208 27.7751 26.582 28.2297 26.7667 28.6395C26.9514 29.0492 27.2516 29.3961 27.6305 29.6378C28.0094 29.8794 28.4506 30.0053 28.9 30H37.1C37.5456 30.0018 37.9822 29.8747 38.3572 29.634C38.7321 29.3933 39.0295 29.0493 39.2134 28.6434C39.3973 28.2376 39.4599 27.7872 39.3937 27.3465C39.3274 26.9059 39.1351 26.4938 38.84 26.16ZM37.39 27.81C37.3673 27.8678 37.3272 27.9171 37.2752 27.9511C37.2233 27.9852 37.1621 28.0022 37.1 28H28.9C28.8379 28.0022 28.7767 27.9852 28.7248 27.9511C28.6728 27.9171 28.6327 27.8678 28.61 27.81C28.5901 27.766 28.5798 27.7183 28.5798 27.67C28.5798 27.6217 28.5901 27.574 28.61 27.53L33 24.25L37.38 27.53C37.4015 27.5733 37.4135 27.6206 37.4152 27.6689C37.4169 27.7172 37.4083 27.7653 37.39 27.81Z"></path>
											</svg>
										</div>
										<div class="option-box">
											<span class="title-label">Water Skis</span>
											<span class="title-text"> €40 / day </span>
										</div>
									</label>
								</div>
							</div>
						</div> --}}
						
						<div class="insurence-sec">
							<div class="pay-sec">
								<div class="pay-title">
									<h4>Choose how to pay</h4>
								</div>
								<div class="insurance-form ">
									<div class="row">
										@if($listing->security && optional($listing->security)->security_deposit == '1')
											@php
												if($listing->security->type == 1):
													$depositAmount = $listing->security->amount;
												else:
													$amount = $listing->security->amount;
													$depositAmount = $quotation['total'] * $amount / 100;
												endif;
											@endphp
											<div class="col-md-12">
												<input type="radio" value="deposit-payment" class="form-check-input" name="payment_type" id="myRadiodeposit">
												<label for="myRadiodeposit">
													<span class="title-label">Pay the deposit amount</span>
													<span class="title-text">€{{ $depositAmount }}</span>
													<p>Pay the deposit amount of the booking today.</p>
												</label>
											</div>
										@endif
										@php
											if($quotation->currency):
												$symble = priceSymbol($quotation->currency);
											else:
												$symble = priceSymbol('USD');
											endif;
											$fuel_price = 0;
											$skipper_price = 0;
											$fuel_include = '';
											$skipper_include = '';
											if($listing->fuel_include == '1'):
												$fuel_price = getAmountWithoutSymble($listing->fuel_price,$listing->currency,$quotation->currency);
												$fuel_include = 'Fuel Charges: '.$symble.$fuel_price;
											endif;
											if($listing->skipper_include == '1'):
												$skipper_price = getAmountWithoutSymble($listing->skipper_price,$listing->currency,$quotation->currency);
												$skipper_include = 'Skipper Charges: '.$symble.$skipper_price;
											endif;
											$totalAmount = $quotation['total'] + $fuel_price + $skipper_price ;
										@endphp
										<div class="col-md-12">
											<input type="radio" checked="" value="full-payment" class="form-check-input" name="payment_type" id="myRadiofull">
											<label for="myRadiofull">
												<span class="title-label">Pay the total amount</span>
												<span class="title-text">Hire: {{ $symble.$quotation['total'] }}</span>
												<span class="title-text">{{ $fuel_include }}</span>
												<span class="title-text">{{ $skipper_include }}</span>
												<span class="title-text">Total: {{ $symble.$totalAmount }}</span>
												<p>Pay the total amount of the booking today.</p>
											</label>
										</div>
										
										
										{{-- <div class="col-md-12">
											<input type="radio" checked="" value="With a skipper" class="form-check-input" name="optradio" id="myRadio9">
											<label for="myRadio9">
													<span class="title-label">Pay in two parts without any extra fee</span>
													<span class="title-text">€193</span>
													<p>Pay €193 now and the balance (€221) before 31 Dec 2024.</p>
											</label>
										</div> --}}

									</div>
								</div>
								<div class="payment-sec">
									<h4>Secure Payment <span class="text-muted"><i class="ml-2 fas fa-lock"></i></span></h4>
									<p>
										Once the booking request is made, <strong>the owner will have 48 hours to respond.
										You will only be charged if the request is accepted.</strong>
									</p>
									<div id="paymentAccordion">
										<!-- Card Payment -->
										<div class="form-group form-accordion-title">
											<div class="custom-control custom-radio">
												<input type="radio" id="cardPayment" name="paymentMethod" class="custom-control-input" data-toggle="collapse" data-target="#cardDetails" checked>
												<label class="custom-control-label" for="cardPayment"><svg class="p-Icon p-Icon--card Icon p-Icon--md TabIcon p-PaymentAccordionButtonIcon TabIcon--selected" role="presentation" fill="var(--colorIcon)" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"><path fill-rule="evenodd" clip-rule="evenodd" d="M0 4a2 2 0 012-2h12a2 2 0 012 2H0zm0 2v6a2 2 0 002 2h12a2 2 0 002-2V6H0zm3 5a1 1 0 011-1h1a1 1 0 110 2H4a1 1 0 01-1-1z"></path></svg> Card</label>
											</div>
											<input type="hidden" id="quotationID" value="{{ $quotationID }}" >

											<div id="card-element"></div>
										</div>

										<!-- Revolut Pay -->
										{{-- <div class="form-group form-accordion-title">
											<div class="custom-control custom-radio">
												<input type="radio" id="revolutPay" name="paymentMethod" class="custom-control-input" data-toggle="collapse" data-target="#revolutDetails">
												<label class="custom-control-label" for="revolutPay">
												<img src="https://js.stripe.com/v3/fingerprinted/img/payment-methods/icon-pm-revolutpay_short-3130ba1a90028dfe92a44ecb1b206de6.svg" class="img-fluid" alt="Revolut Pay" />	
												Revolut Pay</label>
											</div>
											<div id="revolutDetails" class="collapse" data-parent="#paymentAccordion">
												<p class="mt-3 text-muted">Revolut Pay option will redirect you to the secure Revolut gateway.</p>
											</div>
										</div>

										<!-- PayPal -->
										<div class="form-group form-accordion-title">
											<div class="custom-control custom-radio">
												<input type="radio" id="paypal" name="paymentMethod" class="custom-control-input" data-toggle="collapse" data-target="#paypalDetails">
												<label class="custom-control-label" for="paypal"><img src="https://js.stripe.com/v3/fingerprinted/img/payment-methods/icon-pm-paypal-0383a0ae3febbf0c0d8e721737884ab0.svg" class="img-fluid" alt="PayPal" />	 PayPal</label>
											</div>
											<div id="paypalDetails" class="collapse" data-parent="#paymentAccordion">
												<p class="mt-3 text-muted">PayPal option will redirect you to the secure PayPal gateway.</p>
											</div>
										</div> --}}
									</div>
								</div>
								<div class="cancellation-sec">
									<h4>Cancellation conditions</h4>
									<p>Get 70% back of the booking amount up to 30 days before the start of the rental period, excluding service charges and commission.</p>
									<a href="#">Learn more</a>
								</div>
								<div class="customer-service-sec">
									<div class="custom-icon-box">
										<div class="custom-icon"><i class="fas fa-life-ring"></i></div>
										<div class="custom-text">
											<h3>Customer service available 24/7</h3>
										</div>
									</div>
									<div class="custom-icon-box">
										<div class="custom-icon"><i class="fas fa-lock"></i></div>
										<div class="custom-text">
											<h3>Payment 100% secure</h3>
										</div>
									</div>
									<div class="custom-icon-box">
										<div class="custom-icon"><i class="fas fa-star"></i></div>
										<div class="custom-text">
											<h3>4.9/5 from over 500,000 verified reviews</h3>
										</div>
									</div>
								</div>
								<div class="checkout-btn-sec">
									<p>By selecting the button below, you unconditionally agree to the <a href="#">Terms & Conditions</a>, <a href="#">Cancellation conditions</a>, <a href="#">Insurance conditions</a>. You also agree to pay the total amount of the reservation.</p>
									<div id="card-errors"></div>
									<button class="btn btn-primary btn-checkout" id="submit-button">Booking request · <span>€{{ $quotation['total'] }}</span></button>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="review-order-sec">
						<div class="order-details">
							<div class="order-img">
								<img src="https://static1.clickandboat.com/v1/p/6hzrtzourstqjpci0f3g5azw2dvhd1tb.medium.jpg" class="img-fluid" alt="order title">
							</div>
							<div class="order-text">
								<h2>{{ $listing->boat_name.' '.$listing->manufacturer.' '.$listing->model }}</h2>
								<p>{{ $listing->city }}</p>
							</div>
						</div>
						<div class="date-order-sec">
							<div class="date-icon">
								<i class="fas fa-calendar-week"></i>
							</div>
							<div class="date-text">
								<p> From {{ date('F d, Y', strtotime($quotation->checkin)) }} - <span>9:00 AM</span></p>
								<p>To {{ date('F d, Y', strtotime( $quotation->checkout)) }} - <span>6:00 PM</span></p>
							</div>
						</div>
					</div>
					<div class="price-details-sec">
						<h5>Price details</h5>
						<div class="price-tables">
							<div class="price-heading">Charter price</div>
							<div class="price-amount">€{{ $quotation['total'] }}</div>
						</div>
						{{-- <div class="promotional-sec">
							<a href="#">Add a promotional code</a>
						</div> --}}
						<div class="pay-downpayment-sec">
							<div class="card">
								<div class="card-body">
									{{-- <div class="payment-item">
										<div class="circle active">✔</div>
										<div class="payment-content">
											<h5>Down Payment</h5>
											<small class="text-muted">To be paid now</small>
										</div>
										<div class="payment-amount">€286</div>
									</div> --}}
									{{-- <div class="payment-item">
										<div class="circle active">✔</div>
										<div class="payment-content">
											<h5>Balance payment</h5>
											<small class="text-muted">To be paid before December 31, 2024</small>
										</div>
										<div class="payment-amount">€{{ $price['price'] }}</div>
									</div> --}}
									{{-- <div class="payment-item">
										<div class="circle"></div>
										<div class="payment-content">
											<div>To pay at the harbour</div>
											<small class="text-muted">Due on February 1, 2025</small>
										</div>
										<div class="payment-amount">€{{ $quotation['price'] }}</div>
									</div> --}}
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form> 
   	</div>
</section>
@endsection