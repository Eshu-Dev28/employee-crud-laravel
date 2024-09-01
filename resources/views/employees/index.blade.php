@extends('layout')

@section('title', 'Employee List')

@section('content')
<div class="container">
    <center><h2>Employee List</h2></center><br> 

    <!-- Success message -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Search Box -->
    <div class="mb-4" style="max-width: 400px; margin: auto;">
        <form method="GET" action="{{ route('employees.index') }}" class="d-flex align-items-center">
            <input type="text" name="search" class="form-control" placeholder="Search employees" value="{{ request('search') }}" style="flex: 1;">
            <button class="btn btn-success" type="submit">Search</button>
        </form>
    </div>

    <div class="d-flex justify-content-between mb-4" style="max-width: 1200px; max-height: 45px; margin: auto;">
        <form method="GET" action="{{ route('employees.index') }}" class="d-flex align-items-center">
            <label for="pagesize" class="form-label mb-0">Show records:</label>
            <select name="pagesize" id="pagesize" onchange="this.form.submit()" class="form-control custom-select" style="margin-left: 1rem;">
                <option value="5" {{ $employees->perPage() == 5 ? 'selected' : '' }}>5</option>
                <option value="10" {{ $employees->perPage() == 10 ? 'selected' : '' }}>10</option>
                <option value="15" {{ $employees->perPage() == 15 ? 'selected' : '' }}>15</option>
                <option value="20" {{ $employees->perPage() == 20 ? 'selected' : '' }}>20</option>
            </select>
        </form>
        <a href="{{ route('employees.create') }}" class="btn btn-success">Add Employee</a>
    </div>

    <!-- Employee Table -->
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Hire Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
    @foreach($employees as $employee)
        <tr data-id="{{ $employee->id }}">
            <td>{{ $employee->id }}</td>
            <td>{{ $employee->first_name }}</td>
            <td>{{ $employee->last_name }}</td>
            <td>{{ $employee->email }}</td>
            <td>{{ $employee->phone }}</td>
            <td>{{ $employee->hire_date }}</td>
            <td>
                <a href="{{ route('employees.show', $employee->id) }}" class="btn btn-success">View</a>
                <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this employee?')">Delete</button>
                        </form>           
                 </td>
        </tr>
    @endforeach
</tbody>

    </table>
    <div>
    @endsection
    <style>
.table thead th {
    background-color: #d4edda; 
    color: black; 
    text-align: center;
    border-collapse: separate;
    border-spacing: 0;
    box-shadow: 0 4px 8px rgba(131, 42, 127, 0.2);
    border-radius: 6px;
}

.table tbody tr:hover {
    background-color: #f1f1f1; 
}

.table-bordered {
    border: 1px solid #dee2e6;
}

.table-bordered th,
.table-bordered td {
    border: 1px solid #dee2e6;
    padding: 1rem;
    text-align: center;
}

.table th {
    background-color: #c82333;
    color: #fff;
}

.table td {
    background-color: #fff;
}

.custom-select {
    border-radius: 5px;
    border: 1px solid #dee2e6; 
    background-color: #f8f9fa; 
    padding: 0.5rem;
    font-size: 1rem;
    color: #495057; 
}

.input-group {
    background-color: #e9ecef; 
    padding: 0.5rem;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); 
}

.form-label {
    font-weight: bold;
    color: #495057;
}

/* Button Styles */
.btn {
    border-radius: 10px;
    font-weight: 600;
    color: #fff;
    background-color: #28a745; /* Light green */
    border: none;
    padding: 0.5rem 1rem;
    text-align: center;
    margin-right: 0.5rem; /* Space between buttons */
}

.btn:hover {
    background-color: #218838; 
}

/* Adjust button size */
.btn {
    font-size: 0.875rem; /* Smaller font size */
}

/* Alert Styles */
.alert {
    border-radius: 5px;
    padding: 1rem;
    margin-bottom: 1rem;
}

.alert-danger {
    background-color: #f8d7da;
    color: #721c24;
}

</style>


<script>
    document.addEventListener('DOMContentLoaded', function() {
    function handleDelete(button) {
        const id = button.getAttribute('data-id');
        if (confirm('Are you sure you want to delete this employee?')) {
            fetch(`/employees/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.text())  
            .then(data => {
                if (data.includes('success')) { 
                    const row = document.querySelector(`tr[data-id="${id}"]`);
                    if (row) {
                        row.remove();
                    }
                } else {
                    alert('Failed to delete employee.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while trying to delete the employee.');
            });
        }
    }
    
    // Attach the delete handler to all delete buttons
    document.querySelectorAll('.btn-danger').forEach(button => {
        button.addEventListener('click', function() {
            handleDelete(this);
        });
    });
</script>




