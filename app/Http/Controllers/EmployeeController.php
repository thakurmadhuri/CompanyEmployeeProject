<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees=Employee::with('company')->paginate(10);
        return view('employee.list', [
			'employees' => $employees
		]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies=Company::all();
        return view('employee.create', [
			'companies' => $companies
		]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeRequest $request)
    {
        Employee::create($request->all());
        return redirect()->route('employees.index')->with('success','Employee created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        return view('employee.edit', [
            'employee' => $employee
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeRequest $request, $id)
    {
        $input = $request->all();
        $employee = Employee::find($id);
        if($employee){
            $emp = Employee::find($id)->update($input);
            return redirect()->route('employee.index')->with('success', 'Employee updated successfully');
        }
        else{
            return redirect()->route('employee.index')->with('failed', 'Employee not available');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $model = Employee::find($id);
        if($model){
            Employee::destroy($id);
            return redirect()->route('companies.index')->with('success', 'Employee Deleted Successfully');
        }
        else{
            return redirect()->route('companies.index')->with('failed', 'Employee not found');
        }
    }
}
