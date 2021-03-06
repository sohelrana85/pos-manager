@extends('layouts.app', ['activePage' => 'manage-stock', 'titlePage' => __('Manage Stock')])

@section('content')
@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
@endpush
<div class="content" id="app">
    <div class="container-fluid">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="card">
					<div
						class="
							card-header card-header-primary
							d-flex
							justify-content-between
							py-1
						"
					>
						<h4 class="card-title m-0 p-2">Manage Stock</h4>
					</div>

                    <manage-stock />
                </div>
			</div>
		</div>
	</div>
</div>



<script src="{{ asset('js/app.js') }}"></script>
@endsection

@push('js')
<script>
    $(document).ready(function() {
	    $("#example").DataTable({
            scrollX: true
        //    dom: 'Bfrtip',
        //     buttons: [
        //     'colvis',
        //     'excel',
        //     'print'
        //     ]
        });
	});
</script>
@endpush
