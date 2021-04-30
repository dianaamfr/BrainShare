@extends('layouts.app')

@section('content')
<div class="my-bg-main-blue mb-4 error text-center">
    <h1>404</h1>
    <p class="lead"> Nothing to find here! Try to find your questions in another page.</p>
</div>

<div class="d-flex justify-content-center my-4">
    <a href="search" class="btn btn-primary mx-3">Search</a>
    <a href="question/add" class="btn btn-primary mx-3">Add Question</a>
</div>
@endsection