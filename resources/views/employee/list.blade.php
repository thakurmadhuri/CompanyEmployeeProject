@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Employees
            </div>
            <div class="card-body">
                <a href="{{ route('employees.create') }}" role="button" class="btn btn-success">Add Employee</a>

                @if (session('success'))
                    <div class="alert alert-success mt-3">
                        {{ session('success') }}
                    </div>
                @endif

                <table class="table table-bordered mt-4">
                    <thead>
                        <tr>
                            <th scope="col">Employee Name</th>
                            <th scope="col">Employee Company</th>
                            <th scope="col">Employee Mobile No</th>
                            <th scope="col">Employee Email</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employees as $employee)
                            <tr>
                                <td>{{ $employee->full_name }}</td>
                                <td>{{ $employee->company->name }}</td>
                                <td>{{ $employee->phone }}</td>
                                <td>{{ $employee->email }}</td>
                                <td style="display: flex;">
                                    <a href="{{ route('employees.edit', ['employee' => $employee->id]) }}" role="button" class="btn btn-primary btn-sm me-2">Edit</a>
                                    <form method="post" action="{{ route('employees.destroy', ['employee' => $employee->id]) }}">
                                        @method('delete')
                                        @csrf
                                        <button onclick="confirm('Are you sure?')" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                    </tbody>
                </table>
                {{ $employees->links() }}
            </div>
        </div>
    </div>
@endsection
