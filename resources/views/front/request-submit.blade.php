@extends('layouts.front.common')

@section('meta')
<title>Contact</title>
@endsection
@section('css')

@endsection
@section('js')

@endsection
@section('content')
<section class="request_banner_section">
    <div class="request_banner_text">
        <h5>Help Center Booker Boat > Submit a request</h5>
        <h1>Submit a request</h1>
        <div id="search-wrapper">
            <i class="search-icon fas fa-search"></i>
            <input type="text" id="search" placeholder="Search...">
            <button id="search-button">Search</button>
        </div>
    </div>
</section>
<section class="request_submit_form_section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Your Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                        <label class="label-default">Are you a tenant or an owner?<span class="required"></span></label>
                        <select name="gender" class="form-control">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Subject</label>
                        <input type="text" class="form-control" id="exampleInputText" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Description</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                    <div class="checking_box">
                        <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                        <label for="vehicle1"> By checking this box you confirm to have read and agree with our Privacy
                            Policy</label>
                    </div>
                    <p class="request_text">Booker Boat processes the data collected solely for answering your questions
                        and providing customer service. For more information on how we process your data and how to
                        exercise your rights, please consult our Privacy Policy.</p>
                    <div class="attachment_box">
                        <p>Attachments(optional)</p>
                        <div class="file_uploaded_section">
                            <input type="file" id="myfile" class="">
                            <div class="request_file_upload"><p>Add file or drop files here</p></div>
                        </div>
                    </div>
                    <div class="request_save_btn">
                        <button class="sub_btn">submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection