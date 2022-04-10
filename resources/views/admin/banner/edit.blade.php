@extends('admin.layout.main')

@section('content')
<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                {{-- @if ($message = Session::get('success'))
                <script>
                    toastr.options =
                        {
                            "closeButton" : true,
                            "progressBar" : true
                        }
                        toastr.success("{{ session('success') }}");
                </script>
                @endif --}}


                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Edit Banner</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Banner</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right">
                        <a class="btn btn-primary" href="#">
                            {{ date("j - F - Y") }}
                        </a>
                    </div>
                </div>
            </div>

            <!-- horizontal Basic Forms Start -->
            <div class="pd-20 card-box mb-30">
                <form action="{{ route('admin.banner.update',$banner->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Title</label>
                        <input class="form-control" type="text" placeholder="Title" name="title" autofocus value="{{ $banner->title }}">
                    </div>
                    <div class="form-group">
                        <label>Button Link</label>
                        <input class="form-control" type="text" placeholder="Button Link" name="banner_link" value="{{ $banner->banner_link }}">
                    </div>
                    <div class="form-group">
                        <label>Button Text</label>
                        <input class="form-control" type="text" placeholder="Button Text" name="button_text"  value="{{ $banner->button_text }}">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" name="description" maxlength="90" >{{ $banner->description }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" class="form-control-file form-control height-auto" name="image" value="{{ $banner->image }}">
                        <img src="/storage/banner/{{ $banner->image }}" height="195" width="195" alt="" srcset="">
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
