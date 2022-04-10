@extends('admin.layout.main')

@section('content')
<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Create Banner</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Banner</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right">
                        <a class="btn btn-primary" href="javascript:void(0);">
                            {{ date("j - F - Y") }}
                        </a>
                    </div>
                </div>
            </div>

            <!-- horizontal Basic Forms Start -->
            <div class="pd-20 card-box mb-30">
                <form action="{{ route('admin.banner.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label>Title</label>
                        <input class="form-control  @error('title') is-invalid @enderror" type="text" placeholder="Title" name="title" autofocus>
                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Button Link</label>
                        <input class="form-control @error('banner_link') is-invalid @enderror" type="text" placeholder="Button Link" name="banner_link">
                        @error('banner_link')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Button Text</label>
                        <input class="form-control @error('button_text') is-invalid @enderror" type="text" placeholder="Button Text" name="button_text">
                        @error('button_text')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" name="description" maxlength="90"></textarea>
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" class="form-control-file form-control height-auto @error('image') is-invalid @enderror" name="image">
                        @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <!-- horizontal Basic Forms End -->


        </div>
        <div class="footer-wrap pd-20 mb-20 card-box">
            &copy; <script>document.write(new Date().getFullYear())</script> All rights reserved.
        </div>
    </div>
</div>
@endsection

@section('script')
<script>


    @if(Session::has('success'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
        toastr.success("{{ Session::get('success') }}");

    @endif

    @if(Session::has('error'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
        toastr.error("{{ Session::get('error') }}");

    @endif


</script>
@endsection
