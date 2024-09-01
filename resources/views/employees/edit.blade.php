@extends('layout')

@section('title', 'Edit Employee')

@section('content')
    <div class="container">
     <center><h3>Edit Employee</h3></center>

        <!-- Display validation errors -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('employees.update', $employee->id) }}" method="POST">
            @csrf
            @method('PUT')
            @include('employees.form')
            <button type="submit" class="btn btn-success mt-3">Update</button>
        </form>
    </div>
@endsection

@section('customstyles')
<style>
    /* Full background white */
    body {
        background-color: #fff; /* White background for the whole page */
    }
    /* Button styles */
    .btn {
        border-radius: 5px;
        font-weight: 600;
    }

    .btn-success {
        background-color: #28a745; /* Light green background */
        border: none;
    }

    .btn-success:hover {
        background-color: #218838; /* Darker green on hover */
    }
</style>
@endsection
