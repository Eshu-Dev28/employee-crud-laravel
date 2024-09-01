<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    
    public function index(Request $request)
    {
        $query = Employee::query();
        
        // Search functionality
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'LIKE', "%{$search}%")
                  ->orWhere('last_name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%")
                  ->orWhere('phone', 'LIKE', "%{$search}%");
            });
        }
        
        // Pagination
        $pageSize = $request->input('pagesize', 5); 
        $employees = $query->paginate($pageSize);
        
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        return view('employees.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => ['required', 'string', 'max:50', 'regex:/^[a-zA-Z-_]+$/'],
            'last_name' => ['required', 'string', 'max:50', 'regex:/^[a-zA-Z.]+$/'], 
            'email' => 'required|email|max:100',
            'phone' => ['required', 'numeric', 'digits:10', 'regex:/^[6-9]\d{9}$/'],
            'hire_date' => 'required|date',
        ]);
              
            
        Employee::create($validatedData);
    
        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
    }
    

    public function show(Employee $employee)
    {
        return view('employees.show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, Employee $employee)
    {
        $validatedData = $request->validate([
            'first_name' => ['required', 'string', 'max:50', 'regex:/^[a-zA-Z]+$/'],
            'last_name' => ['required', 'string', 'max:50', 'regex:/^[a-zA-Z.]+$/'], 
            'email' => 'required|email|max:100',
            'phone' => ['required', 'numeric', 'digits:10', 'regex:/^[6-9]\d{9}$/'],
            'hire_date' => 'required|date',
        ]);        
        
        $employee->update($validatedData);
    
        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }
    
    public function destroy(Employee $employee)
    {
        try {
            $employee->delete();
            return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('employees.index')->with('error', 'Failed to delete employee.');
        }
    }
    
    
}
