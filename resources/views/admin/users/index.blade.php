@extends('layouts.admin.admin')

@section('meta')
    <title>Manage Users</title>
@endsection
@section('css')
    <style>
        .table .bootstrap-switch .change_status {
            width: 66px;
            height: 22px;
            z-index: 1;
            margin: 0px;
            right: 0px;
            left: auto;
        }
        .table .bootstrap-switch-on .change_status {
            right: auto;
            left: 0px;
        }
    </style>
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
            <h1 class="page-title">Manage Boat Owner
                <span style="float: right;">
                    <a href="{{ route('admin.users.create')}}" class="btn green"><i class="fa fa-plus"></i> &nbsp;New</a>
                </span>
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
                    <i class="fa fa-file-text-o"></i> Manage Boat Owner</div>
                    <span style="float: right; margin-top: 3px;">
                        
                    </span>
                </div>
                <div class="portlet-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover table-checkable" id="master-data-table" data-filter-url="#">
                            <thead class=" text-primary">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($allBoatOwner)
                                    @foreach ($allBoatOwner as $boatOwner)
                                        @php
                                            $checked = '';
                                            if($boatOwner->status == 1):
                                                $checked = 'checked';
                                            endif;
                                        @endphp
                                        <tr>
                                            <th>{{ $loop->iteration  }}</th>
                                            <td>{{ $boatOwner->name }}</td>
                                            <td>{{ $boatOwner->email }}</td>
                                            <td>@if(isset($boatOwner->profile->phone)) {{ $boatOwner->profile->phone }} @endif</td>
                                            <td>{{ $boatOwner->created_at }}</td>
                                            <td><input  {{ $checked }} value="{{ $boatOwner->id }}" type="checkbox" data-size="mini" class="make-switch change_status" data-on-color="success" data-off-color="danger"></td>
                                            <td>
                                                <a href="{{ route('admin.users.edit', $boatOwner->id) }}" class="btn btn-circle btn-icon-only btn-default tooltips" title = "Edit" href="javascript:;"> <i class="icon-note"></i></a>
                                                <a href="{{ route('admin.users.destroy', $boatOwner->id) }}" class="btn btn-circle btn-icon-only btn-default tooltips delete_row" title = "Delete" href="javascript:;"> <i class="icon-trash"></i></a>
                                            </td>
                                        </tr> 
                                    @endforeach
                                @else
                                @endif
                            </tbody>
                        </table>                                               
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
        $(document).on('click','.change_status',function(){
            var id = $(this).val();
            var value = 0;
            if ($(this).prop('checked')) {
                value = 1;
            }
            $.ajax({
                url: "{{ route('admin.userchange') }}",
                type: 'POST',
                data: { value: value, id: id},
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if(response.success) 
                    {
                        $('#listing-section').html(response.html);
                    } 
                    else 
                    {
                       $('.message').html(response.message);
                    }
                },
            });
        })
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
                if (isConfirm)
                {
                    $.ajax({
                        type: "DELETE",
                        url: url,
                        data: {
                            "_token": "{{ csrf_token() }}",
                        },
                        success: function (response) {
                            swal("Deleted!", "The user has been removed.", "success");
                            window.location.href = response.url;
                        },
                        error: function (response) {
                            swal("Failed!", "Failed to remove the user.", "error");
                        }
                    });
                }
            });
        });
    </script>
@endsection