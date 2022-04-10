@extends('admin.layout.main')

@section('style')
    <link rel="stylesheet" href="{{ asset('admin_assets/src/plugins/switchery/switchery.min.css') }}">
@endsection

@section('content')
	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>Categories</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Categories</li>
								</ol>
							</nav>
						</div>
						<div class="col-md-6 col-sm-12 text-right">
								<a class="btn btn-primary text-white" href="javascript:void(0)">
									{{ date("j - F - Y") }}
								</a>
						</div>
					</div>
				</div>
				<!-- Simple Datatable start -->
				<div class="card-box mb-30">
					<div class="pd-20">
                        <a class="btn btn-primary text-white" href="{{ route('admin.categories.create') }}">
                            <i class="icon-copy fa fa-plus mr-2" aria-hidden="true"></i>Add new
                        </a>
					</div>
					<div class="pb-20">
						<table class="data-table table stripe hover nowrap">
							<thead>
								<tr>
									<th class="table-plus datatable-nosort">#</th>
									<th>Name</th>
									<th>Description</th>
                                    <th>Status</th>
									<th class="datatable-nosort">Action</th>
								</tr>
							</thead>
							<tbody>
                                @foreach ($categories as $i => $category)
                                    <tr>
                                        <td class="table-plus">{{ ++$i }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->desc }}</td>
                                        <td>
                                            @if ($category->status == 1)
                                                <input type="checkbox" name="status" value="1" class="switch-btn" data-size="small" data-color="#0099ff" checked>
                                            @else
                                                <input type="checkbox" name="status" value="0" class="switch-btn" data-size="small" data-color="#0099ff">
                                            @endif
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                                    <i class="dw dw-more"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                    {{-- <a class="dropdown-item" href="#"><i class="dw dw-eye"></i> View</a> --}}
                                                    <a class="dropdown-item" href="{{ route('admin.categories.edit',$category->id) }}"><i class="dw dw-edit2"></i> Edit</a>
                                                    <form action="{{ route('admin.categories.destroy',$category->id) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="dropdown-item" type="submit"><i class="dw dw-delete-3"></i> Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
						</table>
					</div>
				</div>
				<!-- Simple Datatable End -->
			</div>
			<div class="footer-wrap pd-20 mb-20 card-box">
				&copy; <script>document.write(new Date().getFullYear())</script> All rights reserved.
			</div>
		</div>
	</div>
@endsection

@section('script')
    <!-- buttons for Export datatable -->
	<script src="{{ asset('admin_assets/src/plugins/datatables/js/dataTables.buttons.min.js') }}"></script>
	<script src="{{ asset('admin_assets/src/plugins/datatables/js/buttons.bootstrap4.min.js') }}"></script>
	<script src="{{ asset('admin_assets/src/plugins/datatables/js/buttons.print.min.js') }}"></script>
	<script src="{{ asset('admin_assets/src/plugins/datatables/js/buttons.html5.min.js') }}"></script>
	<script src="{{ asset('admin_assets/src/plugins/datatables/js/buttons.flash.min.js') }}"></script>
	<script src="{{ asset('admin_assets/src/plugins/datatables/js/pdfmake.min.js') }}"></script>
	<script src="{{ asset('admin_assets/src/plugins/datatables/js/vfs_fonts.js') }}"></script>
	<!-- Datatable Setting js -->
	<script src="{{ asset('admin_assets/vendors/scripts/datatable-setting.js') }}"></script>
    <!-- switchery js -->
	<script src="{{ asset('admin_assets/src/plugins/switchery/switchery.min.js') }}"></script>
    <script src="{{ asset('admin_assets/vendors/scripts/advanced-components.js') }}"></script>

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

