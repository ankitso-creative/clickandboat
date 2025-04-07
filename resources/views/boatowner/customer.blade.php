@extends('layouts.boatowner.common')
@section('meta')
<title>Dashboard - {{ config('app.name') }}</title>
@endsection
@section('css')
@endsection
@section('js')
@endsection
@section('content')
<div class="col-lg-9 main-dashboard">
    <div class="page-title">
        <h1>All Your Customers</h1>
    </div>
    <div class="card-section">
        <div class="card-sec-title">
            <h2>Customers</h2>
        </div>
        <div class="card-content">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Sr. No.</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Created At</th>
                            {{-- <th>Action</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @if($results)
                            @foreach($results as $result)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $result->name }}</td>
                                    <td>{{ $result->email }}</td>
                                    <td>{{ $result->phone }}</td>
                                    <td>{{ $result->created_at }}</td>
                                    {{-- <td>
                                        <div class="td-actions">
                                            <button class="btn btn-success"><i class="fas fa-eye"></i></button>
                                        </div>
                                    </td> --}}
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection