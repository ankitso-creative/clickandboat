@extends('layouts.customer.common')

@section('meta')
<title>Dashboard - {{ config('app.name') }}</title>
@endsection

@section('css')

@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $(document).on('click','.favorite_item', function(){
                var list = $(this).attr('list');
                var self =  $(this)
                $.ajax({
                    url: "{{ route('ajax.favorite') }}",  
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        item_id: list,
                        _token: '{{ csrf_token() }}'  
                    },
                    success: function(response) {
                        if (response.success) 
                        {
                            if(response.action=='save')
                            {
                                self.html('<i class="fa-solid fa-heart"></i>');
                            }
                            else
                            {
                                self.parents('.single-item').remove();
                            }
                        } else
                        {
                            
                        }
                    },
                    error: function() 
                    {
                        
                    }
                });
            });
        })
    </script>
@endsection

@section('content')
    <div class="col-lg-9 main-dashboard">
        <div class="page-title">
            <h1>All Your Bookings Support</h1>
        </div>
        {{-- <div class="no-booking-yet">
            <p>You haven't made a booking yet, <a href="#">search for a boat</a>.</p>
        </div> --}}
        <div class="card-section">
            <div class="card-sec-title">
                <h2>Booking Owner Lists</h2>
            </div>
            <div class="card-content">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Sr. No.</th>
                                <th>Booking Date</th>
                                <th>Boat Owner Name</th>
                                <th>Boat Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>22-11-2024</td>
                                <td>Maxi Dolphin 100ft Finot Conq (2013) - NOMAD IV</td>
                                <td>12-01-2024</td>
                                <td>
                                    <div class="td-actions">
                                        <button class="btn btn-success"><i class="fas fa-eye"></i></button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection