@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card">
					<div class="card-header">Dashboard</div>

					<div class="card-body">
						@if (session('status'))
							<div class="alert alert-success" role="alert">
								{{ session('status') }}
							</div>
						@endif

						You are logged in!
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<br>
				<br>
				<h4 class="text-center">Deposit Simulator</h4>
				<form action="{{ route('c2b') }}" method="post">
					@csrf
					<input type="hidden" name="referenceCode" id="referenceCode"
					       value="TP{{ random_int(1000,9000) }}">
					<div class="form-group">
						<label for="phone_number">Phone Number</label>
						<input type="text" name="phone_number" id="phone_number" class="form-control"
						       required autofocus value="{{ auth()->user()->phoneNumber }}">
					</div>
					<div class="form-group">
						<label for="amount">Amount</label>
						<input type="number" name="amount" id="amount" class="form-control" required
						       autofocus value="1" min="1" max="70000">
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-outline-primary btn-block">Simulate</button>
					</div>
				</form>
			</div>
			<div class="col-md-6">
				<br>
				<br>
				<h4 class="text-center">WithDraw Simulator</h4>
				<form action="{{ route('b2c') }}" method="post">
					@csrf
					<input type="hidden" name="referenceCode" id="referenceCode"
					       value="TP{{ random_int(1000,9000) }}">
					<div class="form-group">
						<label for="phone_number">Phone Number</label>
						<input type="text" name="phone_number" id="phone_number" class="form-control"
						       required autofocus value="{{ auth()->user()->phoneNumber }}">
					</div>
					<div class="form-group">
						<label for="amount">Amount</label>
						<input type="number" name="amount" id="amount" class="form-control" required
						       autofocus value="10" min="10" max="70000">
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-outline-primary btn-block">Simulate</button>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection
