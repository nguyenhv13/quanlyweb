@extends('layouts.app')
@section('content')
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <h4 class="text-center mb-4">Đăng kí tài khoản</h4>
                                    <form method="POST" action="{{ route('register') }}">
                                        @csrf
                                        <div class="form-group">
                                            <label><strong>Username</strong></label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Enter Your Name">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        {{-- insert defaults --}}
                                        {{-- <input type="hidden" class="image" name="image" value="photo_defaults.jpg"> --}}
                                        <div class="form-group">
                                            <label><strong>Email</strong></label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Enter Your Email">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label><strong>Vai trò</strong></label>
                                            <select class="form-control @error('role_name') is-invalid @enderror" name="role_name" id="role_name">
                                                <option selected disabled>Chọn</option>
                                                {{-- <option value="Admin">Admin</option> --}}
                                                <option value="Student">Học sinh</option>
                                                <option value="Teacher">Giáo viên</option>
                                            </select>
                                        @error('role_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                        <div class="form-group">
                                            <label><strong>Mật khẩu</strong></label>
                                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Enter Password">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Xác nhận mật khẩu</strong></label>
                                            <input type="password" class="form-control" name="password_confirmation" placeholder="Choose Confirm Password">
                                        </div>
                                        <div class="text-center mt-4">
                                            <button type="submit" class="btn btn-primary btn-block">Đăng kí</button>
                                        </div>
                                    </form>
                                    <div class="new-account mt-3">
                                        <p>Đã có tài khoản? <a class="text-primary" href="{{ route('login') }}">Đăng nhập</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
