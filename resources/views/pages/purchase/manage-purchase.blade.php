@extends('layouts.app', ['activePage' => 'manage-purchase', 'titlePage' => __('Manage Purchase')])

@section('content')
<div class="content pt-0" id="app">
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
						<h4 class="card-title m-0 pt-2">Manage Purchase</h4>
					</div>

                    <manage-purchase />
                </div>
			</div>
		</div>
	</div>
</div>
<script src="{{ asset('js/app.js') }}"></script>
@endsection
