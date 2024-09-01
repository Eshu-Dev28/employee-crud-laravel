<!-- resources/views/employees/form.blade.php -->

<div class="form-group">
   <b> <label for="first_name">First Name</label></b>
    <input type="text" name="first_name" value="{{ old('first_name', $employee->first_name ?? '') }}" class="form-control" placeholder="First Name" required>
</div>

<div class="form-group">
    <b><label for="last_name">Last Name</label></b>
    <input type="text" name="last_name" value="{{ old('last_name', $employee->last_name ?? '') }}" class="form-control" placeholder="Last Name" required>
</div>

<div class="form-group">
    <b><label for="email">Email</label></b>
    <input type="email" name="email" value="{{ old('email', $employee->email ?? '') }}" class="form-control" placeholder="Email" required>
</div>

<div class="form-group">
    <b><label for="phone">Phone</label></b>
    <input type="text" name="phone" value="{{ old('phone', $employee->phone ?? '') }}" class="form-control"placeholder="phone number" required>
</div>

<div class="form-group">
   <b> <label for="hire_date">Hire Date</label></b>
    <input type="date" name="hire_date" value="{{ old('hire_date', $employee->hire_date ?? '') }}" class="form-control" placeholder="Hire Date" required>
</div>
