@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
            New company
            </div>
            <div class="card-body">
                <a href="{{ route('companies.index') }}" role="button" class="btn btn-sm btn-success"> Back</a>

                @if ($errors->any())
                    <div class="alert alert-danger mt-4">
                        {!! implode('<br>', $errors->all()) !!}
                    </div>
                @endif

                <form action="{{ route('companies.store') }}" method="post" class="mt-4" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group col-xs-12 required">
                        <label for="name">Company Name</label>
                        <input class="form-control" type="text" name="name" value="{{ old('name') }}" id="name" required>
                    </div>
                    <div class="form-group col-xs-12">
                        <label for="web_site">Company Website</label>
                        <input class="form-control" type="text" name="web_site" value="{{ old('web_site') }}" id="web_site">
                    </div>
                    <div class="form-group col-xs-12">
                        <label for="email">Company Email</label>
                        <input class="form-control" type="text" name="email" value="{{ old('email') }}" id="email">
                    </div>
                    <div class="form-group col-xs-12">
                        <label for="logo">Company Logo</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="logo" name="logo">
                            <label class="custom-file-label" for="logo">Choose File</label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success">Save</button>

                    <a href="{{ route('companies.index') }}" class="btn btn-default">Cancel</a>
                </form>

            </div>
        </div>
    </div>
@endsection
