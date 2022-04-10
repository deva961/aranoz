@extends('admin.layout.main')

@section('style')
	<!-- switchery css -->
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
								<h4>Banner</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Banner</li>
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
                        <a class="btn btn-primary text-white" href="{{ route('admin.banner.create') }}">
                            <i class="icon-copy fa fa-plus mr-2" aria-hidden="true"></i>Add new
                        </a>
					</div>
					<div class="pb-20">
						<table class="data-table table stripe hover nowrap">
							<thead>
								<tr>
									<th class="table-plus datatable-nosort">#</th>
									<th>Image</th>
									<th>Title</th>
									<th>Description</th>
									<th>Link</th>
                                    <th>Button Text</th>
                                    <th>Status</th>
									<th class="datatable-nosort">Action</th>
								</tr>
							</thead>
							<tbody>
                                @foreach ($banners as $i => $banner)
                                    <tr>
                                        <td class="table-plus">{{ ++$i }}</td>
                                        {{-- <td><img src="{{ Storage::url($banner->image) }}" /></td> --}}
                                        <td><img src="/storage/banner/{{ $banner->image }}" height="95" width="95" /></td>
                                        <td>{{ $banner->title }}</td>
                                        <td>{{ $banner->description }}</td>
                                        <td>{{ $banner->banner_link }}</td>
                                        <td>{{ $banner->button_text }}</td>
                                        <td>
                                            <input type="checkbox" data-id="{{ $banner->id }}" name="status" class="switch-btn" data-size="small" data-color="#0099ff" {{ $banner->status == '1' ? 'checked' : '0' }}>
                                        </td>

                                        <td>
                                            <div class="dropdown">
                                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                                    <i class="dw dw-more"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                    {{-- <a class="dropdown-item" href="#"><i class="dw dw-eye"></i> View</a> --}}
                                                    <a class="dropdown-item" href="{{ route('admin.banner.edit',$banner->id) }}"><i class="dw dw-edit2"></i> Edit</a>
                                                    <form action="{{ route('admin.banner.destroy',$banner->id) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        {{-- <a class="dropdown-item" ><i class="dw dw-delete-3"></i> Delete</a> --}}
                                                        <button class="dropdown-item" onclick="return confirm('Are you sure?')" type="submit"><i class="dw dw-delete-3"></i> Delete</button>
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
        $(function() {
          $('.switch-btn').change(function() {
              var status = $(this).prop('checked') == true ? '1' : '0';
              var user_id = $(this).data('id');

              $.ajax({
                  type: "GET",
                  dataType: "json",
                  url: '/admin/changeStatus',
                  data: {'status': status, 'user_id': user_id},
                  success: function(data){
                      if(data.success) {
                        toastr.options =
                        {
                            "closeButton" : true,
                            "progressBar" : true
                        }
                        toastr.success(data.success);
                      }
                  }
              });
          })
        })
    </script>

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

