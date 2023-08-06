@extends('web.applicant.layout')
@section('applicant-page-content')
<div class="bt-wizard" id="progresswizard">
    <ul class="nav nav-pills nav-fill mb-3">
        <li class="nav-item"><a href="{{ route('show-applicant-bio-data-form') }}" class="nav-link">Personal-Data</a></li>
        <li class="nav-item"><a href="{{route('show-applicant-qualification-form')}}" class="nav-link">Qualifications</a></li>
        <li class="nav-item"><a href="{{ route('show-applicant-uploaded-document-form') }}" class="nav-link">Document Uploads</a></li>
        <li class="nav-item"><a href="{{ route('show-applicant-preview-data-form') }}" class="nav-link">Preview & Submit</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active show" id="progress-t-tab2">
            @if (session()->has('error'))
            <div class="alert alert-danger alert-dismissible col-md-6" role="alert">
                {{ session('error') }}
            </div>
            @endif
            @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible col-md-6" role="alert">
                {{ session('success') }}
            </div>
            @endif
            <form action="{{ route('process-change-password-form') }}" method="POST">
                @csrf
                <div class="form-group row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <label for="name" class="form-label">Old Password</label>
                        <div>
                            <input type="password" class="form-control" name="old_password"
                                value="{{ old('old_password') }}" placeholder="Old Password">
                            @error('old_password')
                            <div class="p-1 text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <label for="name" class="form-label">New Password</label>
                        <div>
                            <input type="password" class="form-control" name="new_password"
                                value="{{ old('new_password') }}" placeholder="New Password">
                            @error('new_password')
                            <div class="p-1 text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <label for="name" class="form-label">Confirm New Password</label>
                        <div>
                            <input type="password" class="form-control" name="new_password_confirmation"
                                value="{{ old('new_password_confirmation') }}" placeholder="Confirm New Password">
                            @error('new_password_confirmation')
                            <div class="p-1 text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="mb-2">
                    <button type="submit" class="btn btn-primary">Change Password</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
