<!-- resources/views/employees/create.blade.php -->

@extends('layout')

@section('title', 'Add Employee')

@section('content')
    <div class="container">
        <center><h3>Add Employee</h3></center>

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

        <!-- Employee creation form -->
        <form action="{{ route('employees.store') }}" method="POST">
            @csrf
            @include('employees.form') <!-- Include the form partial -->
            <button type="submit" class="btn btn-success mt-3">Create</button>
        </form>
    </div>
@endsection
