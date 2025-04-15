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
            <!-- BEGIN PAGE TITLE-->
            <h1 class="page-title">Manage Blogs
                <span style="float: right;">
                    <a href="{{ route('admin.blog.create')}}" class="btn green"><i class="fa fa-plus"></i> &nbsp;New</a>
                </span>
            </h1>
            <div class="row" style="margin-bottom: 20px">
                {{-- @include('admin.blog.post.components.filters') --}}
                <form>
                    <div class="col-sm-4">
                        <label>Blog Name:</label>
                        <input type="text" name="name" value="" class="form-control"/>
                    </div>
                    <div class="col-sm-4">
                        <label>language:</label>
                        <select name="language" class="form-control">
                            <option value="">Select Language</option>
                            {!! $languages !!}
                        </select>
                    </div>
                    <div class="col-sm-4 sub_reset" style="margin-top: 25px">
                        <button type="submit" class="btn green">Submit</button>
                        <a href="{{ route('admin.blog.index') }}" class="btn red">Reset</a>
                    </div>
                </form>
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
            <div class="clearfix"></div>
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption">
                    <i class="fa fa-file-text-o"></i> Manage Blogs</div>
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
                                    <th>Created At</th>
                                    <th>Order</th>
                                    <th>Active</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($results)
                                    @foreach ($results as $result)
                                        @php
                                            $checked = '';
                                            if($result->status == 1):
                                                $checked = 'checked';
                                            endif;
                                        @endphp 
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $result->title }}</td>
                                            <td>{{ $result->created_at }}</td>
                                            <td><p contenteditable="true" class="order-by" bid="{{ $result->id }}">{{ $result->order_by }}</p></td>
                                            <td><input  {{ $checked }} value="{{ $result->id }}" type="checkbox" data-size="mini" class="make-switch change_status" data-on-color="success" data-off-color="danger"></td>
                                            <td>
                                                <a href="{{ route('admin.blog.edit', $result->id) }}" class="btn btn-circle btn-icon-only btn-default tooltips" title = "Edit" href="javascript:;"> <i class="icon-note"></i></a>
                                                <a href="{{ route('admin.blog.blogcomments', $result->id) }}" class="btn btn-circle btn-icon-only btn-default tooltips" title = "Comments" href="javascript:;"> <i class="icon-note"></i></a>
                                                <a href="{{ route('admin.blog.destroy', $result->id) }}" class="btn btn-circle btn-icon-only btn-default tooltips delete_row" title = "Delete" href="javascript:;"> <i class="icon-trash"></i></a>
                                            </td>
                                        </tr> 
                                    @endforeach
                                @else
                                @endif 
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
        $(document).on('keyup','.order-by',function(){
            var val = $(this).text();
            var bid = $(this).attr('bid');
            $.ajax({
                url: "{{ route('admin.blog.changeorderblog') }}",
                type: 'POST',
                data: { value: val, id: bid},
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
        $(document).on('click','.change_status',function(){
            var id = $(this).val();
            var value = 0;
            if ($(this).prop('checked')) {
                value = 1;
            }
            $.ajax({
                url: "{{ route('admin.changestatus') }}",
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