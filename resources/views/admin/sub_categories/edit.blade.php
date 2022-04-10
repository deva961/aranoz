@extends('admin.layout.main')

@section('content')
<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            {{-- page header starts --}}
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Edit Sub Category</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Sub Categories</li>
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
            {{-- page header closes --}}

            <div class="pd-20 card-box mb-30">
                <form action="{{ route('admin.sub_categories.update', $sub_category->id) }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label>Category</label>
                        <select class="custom-select2 form-control" name="category" style="width: 100%; height: 38px;">
                            <option value="">Select option</option>
                            @foreach ($categories as $item)
                                <option value="{{ $item->id }}" {{ $item->id == $sub_category->category_id ? 'selected' : ''}}>{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Name</label>
                        <input class="form-control  @error('name') is-invalid @enderror" type="text" placeholder="Name" name="name" value="{{ $sub_category->name }}" autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>



                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>

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