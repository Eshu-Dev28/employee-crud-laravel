<!-- resources/views/employees/show.blade.php -->

@extends('layout')

@section('title', 'Show Employee')

@section('content')
    <div class="container">
        <h3>Employee Details</h3><br>

        <table class="table table-bordered">
            <tr>
                <th>First Name</th>
                <td>{{ $employee->first_name }}</td>
            </tr>
            <tr>
                <th>Last Name</th>
                <td>{{ $employee->last_name }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $employee->email }}</td>
            </tr>
            <tr>
                <th>Phone</th>
                <td>{{ $employee->phone }}</td>
            </tr>
            <tr>
                <th>Hire Date</th>
                <td>{{ $employee->hire_date }}</td>
            </tr>
        </table>

        <a href="{{ route('employees.index') }}" class="btn btn-success">Back to List</a>
        </div>
@endsection
