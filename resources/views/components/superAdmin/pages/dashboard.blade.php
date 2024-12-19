<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    @section('dashboard')
        <h1>Dashboard</h1>
        
        <form id="loginForm" action="{{ route('admin.register') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="branchname" class="form-label text-black">Branch</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-warning text-white">
                                        <i class="fas fa-user"></i>
                                    </span>
                                   <input type="text" placeholder="Enter Branch" class="form-control @error('branchname') is-invalid @enderror"
                                   id="branchname" name="branchname" required>
                                    @error('branchname')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="firstname" class="form-label text-black">First Name</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-warning text-white">
                                        <i class="fas fa-user"></i>
                                    </span>
                                    <input type="text" class="form-control @error('firstname') is-invalid @enderror"
                                        id="firstname" name="firstname" required placeholder="First Name">
                                    @error('firstname')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="lastname" class="form-label text-black">Last Name</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-warning text-white">
                                        <i class="fas fa-user"></i>
                                    </span>
                                    <input type="text" class="form-control @error('lastname') is-invalid @enderror"
                                        id="lastname" name="lastname" required placeholder="Last Name">
                                    @error('lastname')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="address" class="form-label text-black">Address</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-warning text-white">
                                        <i class="fas fa-user"></i>
                                    </span>
                                    <Select name="address" class="form-control @error('address') is-invalid @enderror"
                                        id="address" required>
                                        <option value="Compostela Cebu">Compostela Cebu</option>
                                        <option value="Liloan Cebu">Liloan Cebu</option>
                                        <option value="Consolacion Cebu">Consolacion Cebu</option>
                                        <option value="Mandaue City">Mandaue Cebu City</option>
                                        <option value="Lapu-Lapu City">Lapu-Lapu City</option>
                                        <option value="Banilad City">Banilad City</option>
                                        <option value="Talisay City">Talisay City</option>
                                        <option value="Cebu City">Cebu City</option>
                                    </Select>
                                    @error('address')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="phone_number" class="form-label text-black">Phone Number</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-warning text-white">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                    <input type="phone_number"
                                        class="form-control @error('phone_number') is-invalid @enderror"
                                        id="phone_number" name="phone_number" required placeholder="Phone Number">
                                    @error('phone_number')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>


                            <div class="mb-3">
                                <label for="email" class="form-label text-black">Email</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-warning text-white">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email" required placeholder="Email">
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>


                            <div class="mb-3">
                                <label for="password" class="form-label text-black">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-warning text-white">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                    <input type="password"
                                        class="form-control @error('password') is-invalid @enderror" id="password"
                                        name="password" required placeholder="Password">
                                    <button class="btn btn-outline-warning" type="button"
                                        onclick="togglePassword()">
                                        <i class="fas fa-eye-slash" id="passwordToggle"></i>
                                    </button>
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="confirm_password" class="form-label text-black">Confirm Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-warning text-white">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                    <input type="password"
                                        class="form-control @error('confirm_password') is-invalid @enderror"
                                        id="confirm_password" name="confirm_password" required
                                        placeholder="Confirm_password">
                                    <button class="btn btn-outline-warning" type="button"
                                        onclick="toggleConfirmPassword()">
                                        <i class="fas fa-eye-slash" id="confirm_passwordToggle"></i>
                                    </button>
                                    @error('confirm_password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            {{-- <div class="d-grid gap-2 mt-3">
                                <p>
                                    Already have an account?
                                    <a href="{{ route('LoginPage') }}" class="text-primary  text-decoration-none">
                                        Sign in
                                    </a>
                                </p>
                            </div> --}}

                            <div class="d-grid gap-2 mb-3">
                                <button type="submit" class="btn btn-warning">
                                    <i class="fas fa-user-plus me-2 text-black"></i>Add Branch
                                </button>
                            </div>

                        </form>
        <form action="{{route('SuperAdmin.logout')}}" method="post">
            @csrf
            <button type="submit">Logout</button>
        </form>
    @endsection
</body>
</html>