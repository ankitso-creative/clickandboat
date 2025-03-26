@extends('layouts.front.common')

@section('meta')
<title>Contact</title>
@endsection
@section('css')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
@endsection
@section('js')
    
@endsection
@section('content')
    <section class="request_banner_section">
        <div class="request_banner_text">
            <h5>Help Center Booker Boat > Submit a request</h5>
            <h1>Submit a request</h1>
            <form>
                <div id="search-wrapper">
                    <i class="search-icon fas fa-search"></i>
                    <input type="text" id="search" placeholder="Search...">
                    <button id="search-button">Search</button>
                </div>
            </form>
        </div>
    </section>
    <section class="request_submit_form_section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('submit-request') }}" method="post" enctype="multipart/form-data" id="uploadForm">
                        @csrf
                        <div class="form-group">
                            <label>Your Email address</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label class="label-default">Are you a tenant or an owner?<span class="required"></span></label>
                            <select name="label" class="form-control" required>
                                <option value="">-</option>
                                <option value="Tenant">Tenant</option>
                                <option value="Owner">Owner</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Subject</label>
                            <input type="text" name="subjact" class="form-control" id="exampleInputText" aria-describedby="emailHelp" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Description</label>
                            <textarea class="form-control" name="message" id="exampleFormControlTextarea1" rows="3" required> </textarea>
                        </div>
                        <div class="checking_box">
                            <input type="checkbox" id="confirm" name="confirm" value="1">
                            <label for="confirm"> By checking this box you confirm to have read and agree with our Privacy
                                Policy</label>
                        </div>
                        <p class="request_text">Booker Boat processes the data collected solely for answering your questions
                            and providing customer service. For more information on how we process your data and how to
                            exercise your rights, please consult our Privacy Policy.</p>
                        <div class="attachment_box">
                            <p>Attachments(optional)</p>
                            <!-- <div class="file_uploaded_section">
                                <input type="file" id="myfile" class="">
                                <div class="request_file_upload"><p>Add file or drop files here</p></div>
                            </div> -->
                        </div>
                        <div class="p-0 col-sm-12">
                            <div id="imageDropzone" class="dropzone">
                                <div class="dz-message">
                                    <div class="request_file_upload">
                                    <p>Add file or drop files here</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="request_save_btn">
                            <button class="sub_btn" type="submit">submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script>
        Dropzone.autoDiscover = false;
        const imageDropzone = new Dropzone("#imageDropzone", {
            url: "/upload",  
            paramName: 'file', 
            maxFilesize: 2, 
            acceptedFiles: 'image/*',
            autoProcessQueue: false,
            addRemoveLinks: true,
            dictDefaultMessage: 'Drag & Drop or Click to Upload Image',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function(file, response) {
                console.log('File uploaded successfully:', response);
            },
            error: function(file, response) {
                console.error('Error uploading file:', response);
            }
        });
        document.getElementById('uploadForm').addEventListener('submit', function(e) {
            e.preventDefault(); 
            let formData = new FormData(document.getElementById('uploadForm'));
            imageDropzone.files.forEach(function(file) {
                formData.append("files[]", file);
            });
            let formAction = document.getElementById('uploadForm').action;
            fetch(formAction, {
                method: "POST",
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}', 
                }
            })
            .then(response => response.json())
            .then(data => {
                window.location.href = data.redirect_url; 
            })
            .catch(error => {
                console.error('Error submitting form:', error);
            });
        });
    </script>
@endsection