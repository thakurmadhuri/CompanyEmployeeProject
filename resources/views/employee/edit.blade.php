@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                {{ $employee->full_name }}
            </div>
            <div class="card-body">
                <a href="{{ route('employees.index') }}" role="button" class="btn btn-sm btn-success">Back</a>

                @if ($errors->any())
                    <div class="alert alert-danger mt-4">
                        {!! implode('<br>', $errors->all()) !!}
                    </div>
                @endif

                <form action="{{ route('employees.update', ['employee' => $employee->id]) }}" method="post" class="mt-4">
                    @csrf
                    @method('PUT')
                    <div class="form-group col-xs-12 required">
                        <label for="first_name">First Name</label>
                        <input class="form-control" type="text" name="first_name" value="{{ old('first_name', $employee->first_name) }}" id="first_name" required>
                    </div>
                    <div class="form-group col-xs-12 required">
                        <label for="last_name">Last Name</label>
                        <input class="form-control" type="text" name="last_name" value="{{ old('last_name', $employee->last_name) }}" id="last_name" required>
                    </div>
                    <div class="form-group col-xs-12">
                        <label for="phone">Phone Number</label>
                        <input class="form-control" type="text" name="phone" value="{{ old('phone', $employee->phone) }}" id="phone">
                    </div>
                    <div class="form-group col-xs-12">
                        <label for="email">Email</label>
                        <input class="form-control" type="text" name="email" value="{{ old('email', $employee->email) }}" id="email">
                    </div>
                    <div class="form-group col-xs-12">
                        <label for="company_id">Company</label>
                        <select class="form-control" name="company_id" id="company_id">
                            <option value="">...</option>
                            @foreach ($companies as $company)
                                @if ($company->id == old('company_id', $employee->company->id))
                                    <option value="{{ $company->id }}" selected>{{ $company->name }}</option>
                                @else
                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success">Update</button>

                    <a href="{{ route('employees.index') }}" class="btn btn-default">Cancel</a>
                </form>

            </div>
        </div>
    </div>
@endsection
