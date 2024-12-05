<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Partial Account</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <style>
        .card-registration .select-input.form-control[readonly]:not([disabled]) {
            font-size: 1rem;
            line-height: 2.15;
            padding-left: .75em;
            padding-right: .75em;
        }

        .card-registration .select-arrow {
            top: 13px;
        }
    </style>
</head>

<body>
    <section class="h-100 bg-dark">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col">
                    <div class="card card-registration my-4">
                        <div class="row g-0">
                            <div class="col-xl-6 d-none d-xl-block">
                                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/img4.webp"
                                    alt="Sample photo" class="img-fluid"
                                    style="border-top-left-radius: .25rem; border-bottom-left-radius: .25rem;" />
                            </div>
                            <div class="col-xl-6">
                                <form id="registrationForm" action="/partialaccount" method="POST">
                                    @csrf
                                    <div class="card-body p-md-5 text-black">
                                        <h3 class="mb-5 text-uppercase">Student Registration Form</h3>

                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        <h5>
                                            <p>Please fill out all the marked fields <svg
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    fill="#e74c3c" class="bi bi-exclamation-circle-fill"
                                                    viewBox="0 0 16 16">
                                                    <path
                                                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                                                </svg> if possible.</p>
                                        </h5>

                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="form-outline">
                                                    <input type="text" id="firstname" name="firstname"
                                                        class="form-control form-control-lg"
                                                        value="{{ old('firstname') }}" pattern="[A-Za-z\s]*"
                                                        title="Only letters and spaces are allowed"
                                                        placeholder="e.g. John, etc." required />
                                                    <label class="form-label" for="firstname">First Name <span
                                                            class="text-danger">*</span></label>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="form-outline">
                                                    <input type="text" id="middlename" name="middlename"
                                                        class="form-control form-control-lg"
                                                        value="{{ old('middlename') }}" pattern="[A-Za-z\s]*"
                                                        title="Only letters and spaces are allowed"
                                                        placeholder="e.g. Chacha, etc." required />
                                                    <label class="form-label" for="middlename">Middle Name <span
                                                            class="text-danger">*</span></label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="form-outline">
                                                    <input type="text" id="lastname" name="lastname"
                                                        class="form-control form-control-lg"
                                                        value="{{ old('lastname') }}" pattern="[A-Za-z\s]*"
                                                        title="Only letters and spaces are allowed"
                                                        placeholder="e.g. Deloslos, etc." required />
                                                    <label class="form-label" for="lastname">Last Name <span
                                                            class="text-danger">*</span></label>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="form-outline">
                                                    <input type="text" id="suffix" name="suffix"
                                                        class="form-control form-control-lg"
                                                        value="{{ old('suffix') }}" pattern="[A-Za-z\s]*"
                                                        title="Only letters and spaces are allowed"
                                                        placeholder="e.g. Jr, II, etc." required />
                                                    <label class="form-label" for="suffix">Name Suffix (NA if none) <span
                                                            class="text-danger">*</span></label>
                                                </div>
                                            </div>
                                        </div>

                                        <h5 class="mt-4">Please Enter Your Valid Email and Password</h5>

                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="form-outline">
                                                    <input type="email" id="email" name="email"
                                                        class="form-control form-control-lg"
                                                        value="{{ old('email') }}" required />
                                                    <label class="form-label" for="email">Email <span class="text-danger">*</span></label>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="form-outline">
                                                    <input type="password" id="password" name="password"
                                                        class="form-control form-control-lg" required />
                                                    <label class="form-label" for="password">Password <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="form-check mb-3">
                                                    <input type="checkbox" class="form-check-input" id="showPassword">
                                                    <label class="form-check-label" for="showPassword">Show Password</label>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-4">
                                                <div class="form-outline">
                                                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control form-control-lg" required />
                                                    <label class="form-label" for="password_confirmation">Confirm Password <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="form-check mb-3">
                                                    <input type="checkbox" class="form-check-input" id="showPasswordConfirm">
                                                    <label class="form-check-label" for="showPasswordConfirm">Show Password</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-end pt-3">
                                            <button type="button" class="btn btn-light btn-lg"
                                                onclick="resetForm()">Reset All</button>
                                            <button type="submit" name="submit"
                                                class="btn btn-primary btn-lg ms-2">Submit Form</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        function resetForm() {
            const inputs = document.querySelectorAll(
                '#registrationForm input[type="text"], #registrationForm input[type="email"], #registrationForm input[type="password"]'
            );
            inputs.forEach(input => {
                input.value = '';
            });
        }

        const passwordInput = document.getElementById('password');
        const passwordInputConfirm = document.getElementById('password_confirmation');

        const showPasswordCheckbox = document.getElementById('showPassword');
        const showPasswordCheckboxConfirm = document.getElementById('showPasswordConfirm');

        showPasswordCheckbox.addEventListener('change', () => {
            passwordInput.type = showPasswordCheckbox.checked ? 'text' : 'password';
        });

        showPasswordCheckboxConfirm.addEventListener('change', () => {
            passwordInputConfirm.type = showPasswordCheckboxConfirm.checked ? 'text' : 'password';
        });
    </script>
</body>

</html>