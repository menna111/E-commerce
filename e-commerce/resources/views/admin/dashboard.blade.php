    @extends('admin.layouts.admin-dashboard')
	@section('title','dashboard')
	@section('content')
	<div class="card">
        <div class="card-body">
            <h1>dashboard</h1>
        </div>
    </div>
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{session()->get('success')}}
        </div>
    @endif

	@endsection
