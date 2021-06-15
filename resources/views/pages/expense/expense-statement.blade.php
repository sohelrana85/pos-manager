@extends('layouts.app', ['activePage' => 'expense-statement', 'titlePage' => __('Expense Statement')])

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
						<h4 class="card-title m-0 pt-2">Expense Statement</h4>
						{{-- <a href="{{ route('product.manage') }}" class="btn btn-info px-3">
							<i class="fa fa-plus pr-1 font-weight-lighter"></i>
							Add Expense
						</a> --}}
					</div>

                    <add-product />

				</div>
			</div>
		</div>
	</div>
</div>
<script src="{{ asset('js/app.js') }}"></script>

@endsection
