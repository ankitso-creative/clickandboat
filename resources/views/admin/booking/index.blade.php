@extends('layouts.admin.admin')

@section('meta')
    <title>Manage Users</title>
@endsection
@section('css')
    
@endsection
@section('js')
    
@endsection
@section('content')

    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <div class="row col-md-12">
                {{-- @include('admin.blog.post.components.filters') --}}
            </div>
            <!-- BEGIN PAGE TITLE-->
            <h1 class="page-title">Manage Bookings
                {{-- <span style="float: right;">
                    <a href="{{ route('admin.users.create')}}" class="btn green"><i class="fa fa-plus"></i> &nbsp;New Manage</a>
                </span> --}}
            </h1>
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
            <div class="clear"></div>
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                        <i class="fa fa-file-text-o"></i> Manage Bookings</div>
                        <span style="float: right; margin-top: 3px;">
                            
                        </span>
                    </div>
                    <div class="portlet-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover table-checkable" id="master-data-table" data-filter-url="#">
                                <thead class=" text-primary">
                                    <tr>
                                        <th>#</th>
                                        <th>Customer Name</th>
                                        <th>Owner Name</th>
                                        <th>Boat Name</th>
                                        <th>Pain Amount</th>
                                        <th>Pending Amount</th>
                                        <th>Total Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        @if($results)
                                            @foreach($results as $result)
                                                @php 
                                                    $listing = App\Models\Admin\Listing::where('id',$result->listing_id)->with('user')->first();
                                                    $customer_name = App\Models\User::where('id',$result->user_id)->value('name');
                                                    if($result->currency):
                                                        $symble = priceSymbol($result->currency);
                                                    else:
                                                        $symble = priceSymbol('USD');
                                                    endif;
                                                @endphp
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $customer_name }}</td>
                                                    <td>{{ $listing->user->name }}</td>
                                                    <td>{{ $listing->boat_name }}</td>
                                                    <td>{{ $symble.$result->amount_paid }}</td>
                                                    <td>{{ $symble.$result->pending_amount }}</td>
                                                    <td>{{ $symble.$result->total }}</td>
                                                    
                                                </tr>  
                                            @endforeach
                                        @endif             
                                    </tr> 
                                </tbody>
                            </table>                                               
                        </div>
                        <div class="pagination">
                            {{ $results->appends(request()->all())->links('pagination::default') }}
                        </div>
                    </div>
                </div>
                <!-- END SAMPLE TABLE PORTLET-->

                <div style="display:flex; justify-content:space-between;">
                    <div class ="pagination green" style="margin-top:-20px;">
                        {{-- {{ $blogs->render('components.pagination') }} --}}
                    </div>
                </div> 
           
        </div>
        <!-- END CONTENT BODY -->
    </div>
    <script>
        $(document).on('click','.delete_row',function(e)
        {
            e.preventDefault();
            var url = $(this).attr('href');
            swal(
            {
                title: "Are you sure?",
                text: "You will not be able to recover this!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Yes, I am sure!',
                cancelButtonText: "No, cancel it!",
                closeOnConfirm: false,
                closeOnCancel: true
            },
            function(isConfirm){
    
                if (isConfirm){
                    
                    $.ajax({
                        type: "DELETE",
                        url: url,
                        data: {
                            "_token": "{{ csrf_token() }}",
                        },
                        success: function (response) {
                            window.location.href = response.url;
                        },
                        error: function (response) {
    
                        }
                    });
                }
            });
        });
    </script>
@endsection