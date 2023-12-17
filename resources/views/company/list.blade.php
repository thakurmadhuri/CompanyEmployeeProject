@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Companies
            </div>
            <div class="card-body">
                <a href="{{ route('companies.create') }}" role="button" class="btn btn-success">Add Company</a>

                @if (session('success'))
                    <div class="alert alert-success mt-3">
                        {{ session('success') }}
                    </div>
                @endif

                <table class="table table-bordered mt-4">
                    <thead>
                        <tr>
                            <th scope="col">Company Name</th>
                            <th scope="col">Company Website</th>
                            <th scope="col">Company Email</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($companies as $company)
                            <tr>
                                <td>{{ $company->name }}</td>
                                <td>{{ $company->web_site }}</td>
                                <td>{{ $company->email }}</td>
                                <td style="display: flex;">
                                    <a href="{{ route('companies.edit', ['company' => $company->id]) }}" role="button" class="btn btn-primary btn-sm me-2">Edit</a>
                                    <form method="post" action="{{ route('companies.destroy', ['company' => $company->id]) }}">
                                        @method('delete')
                                        @csrf
                                        <button onclick="confirm('Are you sure?')" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                    </tbody>
                </table>

                {{ $companies->links() }}
            </div>
        </div>
    </div>
@endsection
