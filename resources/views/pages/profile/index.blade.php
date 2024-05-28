@extends('layouts.template', ['title' => 'Profile'])
@push('css')
@endpush
@section('content')
    <div class="row">
        <div class="col-12 col-md-12 col-lg-7">
            <div class="card">
                <form method="post" class="needs-validation" novalidate="" action="{{ route('profile.update') }}">
                    @csrf
                    <div class="card-header">
                        <h4>Edit Profile</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-6 col-12">
                                <label for="name">Name</label>
                                <input name="name" type="text" id="name"
                                    class="form-control @error('name') is-invalid @enderror" value="{{ $user->name }}"
                                    required autofocus>
                                <div class="invalid-feedback">
                                    Please fill in the Name
                                </div>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label for="email">Email</label>
                                <input type="text" id="email"
                                    class="form-control @error('email') is-invalid @enderror" value="{{ $user->email }}"
                                    required readonly disabled>
                                <div class="invalid-feedback">
                                    Please fill in the Email
                                </div>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-12 col-md-12 col-lg-5">
            <div class="card">
                <form method="post" class="needs-validation" novalidate="" action="{{ route('password.update') }}">
                    @csrf
                    @method('PUT')
                    <div class="card-header">
                        <h4>Edit Password</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-6 col-12">
                                <label for="password">New Password</label>
                                <input name="password" type="password" id="password"
                                    class="form-control @error('password') is-invalid @enderror" value="" required
                                    autofocus>
                                <div class="invalid-feedback">
                                    Please fill in the Password
                                </div>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label for="password_confirmation">Confirm Password</label>
                                <input name="password_confirmation" type="password_confirmation" id="password_confirmation"
                                    class="form-control @error('password_confirmation') is-invalid @enderror" value=""
                                    required>
                                <div class="invalid-feedback">
                                    Please fill in the Password Confirmation
                                </div>
                                @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
@endpush
