@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="card border-primary mb-3">
        @include('users.data')
      </div>
    </div>
  </div>
</div>
</div>
@endsection