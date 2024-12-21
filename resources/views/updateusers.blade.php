@include('templates.Adminheader')

<div class="container py-5">
    <div class="col py-3">
        <h2 class="mb-4 text-center">User Management</h2>
        <form action="{{ route('users.update', $user->id) }}" method="POST" class="shadow p-4 rounded bg-light">
            @csrf <!-- CSRF token for security -->

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <div class="row g-3">
                <div class="col">
                    <label for="firstname" class="form-label">First Name<span class="required">*</span></label>
                    <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name" value="{{ old('firstname', $user->firstname) }}" required>
                </div>
                <div class="col">
                    <label for="middlename" class="form-label">Middle Name<span class="required">*</span></label>
                    <input type="text" class="form-control" id="middlename" name="middlename" placeholder="Middle Name" value="{{ old('middlename', $user->middlename) }}" required>
                </div>
                <div class="col">
                    <label for="lastname" class="form-label">Last Name<span class="required">*</span></label>
                    <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name" value="{{ old('lastname', $user->lastname) }}" required>
                </div>
                <div class="col">
                    <label for="suffix" class="form-label">Suffix<span class="required">*</span></label>
                    <input type="text" class="form-control" id="suffix" name="suffix" placeholder="Suffix" value="{{ old('suffix', $user->suffix) }}" required>
                </div>
            </div>
            <div class="row g-3 mt-3">
                <div class="col">
                    <label for="password" class="form-label">Password (leave blank to keep current)</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    <br>
                    <input type="checkbox" class="form-check-input" id="showPassword">
                    <label class="form-check-label" for="showPassword">Show Password</label>
                </div>

                <div class="col">
                    <label for="email" class="form-label">Email<span class="required">*</span></label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ old('email', $user->email) }}" required>
                </div>
                <div class="col">
                    <label for="role" class="form-label">Role<span class="required">*</span></label>
                    <select name="role" id="role" class="form-select" required>
                        <option value="">Select Role</option>
                        <option value="Teacher" {{ $user->role == 'Teacher' ? 'selected' : '' }}>Teacher</option>
                        <option value="Cashier" {{ $user->role == 'Cashier' ? 'selected' : '' }}>Cashier</option>
                        <option value="Record" {{ $user->role == 'Record' ? 'selected' : '' }}>Record</option>
                        <option value="Accounting" {{ $user->role == 'Accounting' ? 'selected' : '' }}>Accounting</option>
                        <option value="Principal" {{ $user->role == 'Principal' ? 'selected' : '' }}>Principal</option>
                    </select>
                </div>
            </div>
            <div class="row g-4 mt-4">
                <div class="col text-center">
                    <button type="submit" class="btn btn-primary">Update Account</button>
                </div>
            </div>
        </form>
    </div>
</div>

@include('templates.Adminfooter')

<style>
    /* Custom styles for better design */
    .container {
        max-width: 1200px;
    }

    .required {
        color: red;
    }

    .table th, .table td {
        vertical-align: middle;
    }

    .btn-outline-secondary {
        margin-left: 10px;
    }

    .input-group {
        margin-bottom: 1.5rem;
    }

    .shadow {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    @media (max-width: 768px) {
        .container {
            padding: 0 15px;
        }
    }
</style>

<script>
    const passwordInput = document.getElementById('password');
    const showPasswordCheckbox = document.getElementById('showPassword');

    showPasswordCheckbox.addEventListener('change', () => {
        passwordInput.type = showPasswordCheckbox.checked ? 'text' : 'password';
    });
</script>