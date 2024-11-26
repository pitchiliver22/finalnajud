<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Student Details</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 30px;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        h4 {
            text-align: center;
            margin-bottom: 30px;
            font-weight: 300;
            color: #6c757d;
        }

        .personal-details {
            background-color: #f4f4f4;
            padding: 20px;
            border-radius: 8px;
        }
    </style>
</head>

<body>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

   <div class="container">
        <h1>Personal Details</h1>
        <h4>Please fill in the required fields diligently. All required fields are marked with an asterisk (*).</h4>
        <div class="personal-details">
            <form action="/newstudent" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="firstname" class="form-label">First Name *</label>
                        <input type="text" class="form-control" id="firstname" name="firstname" placeholder="e.g Juan">
                    </div>
                    <div class="col-md-6">
                        <label for="middlename" class="form-label">Middle Name *</label>
                        <input type="text" class="form-control" id="middlename" name="middlename" placeholder="e.g Tamad">
                    </div>
                    <div class="col-md-6">
                        <label for="lastname" class="form-label">Last Name *</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" placeholder="e.g Lazy">
                    </div>
                    <div class="col-md-6">
                        <label for="suffix" class="form-label">Suffix Name</label>
                        <input type="text" class="form-control" id="suffix" name="suffix"
                            placeholder="e.g. Jr, Sr, III">
                    </div>

                    <div class="col-md-6">
                        <label for="email" class="form-label">Email<span class="required">*</span></label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                    </div>

                    <div class="col-md-6">
                        <label for="password" class="form-label">Password<span class="required">*</span></label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>

                        <div class="col-mb-6">
                            <input type="checkbox" class="form-check-input" id="showPassword">
                            <label class="form-check-label" for="showPassword">Show Password</label>
                        </div>
                    </div>



                    <div class="col-md-6">
                        <label for="nationality" class="form-label">Nationality *</label>
                        <input type="text" class="form-control" id="nationality"
                            placeholder="e.g. Filipino, American, etc." name="nationality" pattern="[A-Za-z\s]+"
                            title="Please enter letters only" onkeypress="return /^[A-Za-z\s]*$/.test(event.key)" required>
                    </div>
                    <div class="col-md-6">
                        <label for="gender" class="form-label">Gender *</label>
                        <select id="gender" name="gender" class="form-select" required>
                            <option value="" disabled selected>Select Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="civilstatus" class="form-label">Civil Status *</label>
                        <select id="civilstatus" name="civilstatus" class="form-select" required>
                            <option value="" disabled selected>Select Civil Status</option>
                            <option value="single">Single</option>
                            <option value="married">Married</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="birthdate" class="form-label">Birth Date *</label>
                        <input type="date" class="form-control" id="birthdate" name="birthdate" required>
                        <div class="error" id="error" style="color: red; display: none;"></div>
                    </div>

                    <div class="col-md-6">
                        <label for="birthplace" class="form-label">Birth Place *</label>
                        <input type="text" class="form-control" id="birthplace" name="birthplace"
                            placeholder="City, Province/State, Country" pattern="[A-Za-z\s]+"
                            title="Please enter letters only" onkeypress="return /^[A-Za-z\s]*$/.test(event.key)" required>
                    </div>
                    <div class="col-md-6">
                        <label for="religion" class="form-label">Religion</label>
                        <input type="text" class="form-control" id="religion" placeholder="e.g. Catholic, Muslim, etc."
                            name="religion" pattern="[A-Za-z\s]+" title="Please enter letters only"
                            onkeypress="return /^[A-Za-z\s]*$/.test(event.key)" required>
                    </div>
                    <div class="col-md-6">
                        <label for="mother_name" class="form-label">Mother's Full Name *</label>
                        <input type="text" class="form-control" id="mother_name" name="mother_name"
                            pattern="[A-Za-z\s]+" title="Please enter letters only"
                            onkeypress="return /^[A-Za-z\s]*$/.test(event.key)" placeholder="e.g. Juanita De Los Angeles"
                            required>
                    </div>
                    <div class="col-md-6">
                        <label for="mother_occupation" class="form-label">Mother's Occupation</label>
                        <input type="text" class="form-control" id="mother_occupation" name="mother_occupation"
                            pattern="[A-Za-z\s]+" title="Please enter letters only"
                            onkeypress="return /^[A-Za-z\s]*$/.test(event.key)" placeholder="e.g. Teacher, CEO, etc."
                            required>
                    </div>
                    <div class="col-md-6">
                        <label for="mother_contact" class="form-label">Mother's Contact Number *</label>
                        <input type="text" class="form-control" id="mother_contact" name="mother_contact"
                            pattern="\d*" title="Please enter numbers only"
                            onkeypress="return event.charCode >= 48 && event.charCode <= 57" minlength="11"
                            maxlength="11" placeholder="0995#######" required>
                        <small class="form-text text-muted">Only numbers are allowed.</small>
                    </div>
                    <div class="col-md-6">
                        <label for="father_name" class="form-label">Father's Full Name *</label>
                        <input type="text" class="form-control" id="father_name" name="father_name"
                            pattern="[A-Za-z\s]+" title="Please enter letters only"
                            onkeypress="return /^[A-Za-z\s]*$/.test(event.key)" placeholder="e.g. Juanito De Los Anegeles"
                            required>
                    </div>
                    <div class="col-md-6">
                        <label for="father_occupation" class="form-label">Father's Occupation</label>
                        <input type="text" class="form-control" id="father_occupation" name="father_occupation"
                            pattern="[A-Za-z\s]+" title="Please enter letters only"
                            onkeypress="return /^[A-Za-z\s]*$/.test(event.key)" placeholder="e.g.IT, Engineer, etc"
                            required>
                    </div>
                    <div class="col-md-6">
                        <label for="father_contact" class="form-label">Father's Contact Number *</label>
                        <input type="text" class="form-control" id="father_contact" name="father_contact"
                            pattern="\d*" title="Please enter numbers only"
                            onkeypress="return event.charCode >= 48 && event.charCode <= 57" minlength="11"
                            maxlength="11" placeholder="0995#######" required>
                        <small class="form-text text-muted">Only numbers are allowed.</small>
                    </div>
                    <div class="col-md-6">
                        <label for="guardian_name" class="form-label">Guardian's Full Name</label>
                        <input type="text" class="form-control" id="guardian_name" name="guardian_name"
                            pattern="[A-Za-z\s]+" title="Please enter letters only"
                            onkeypress="return /^[A-Za-z\s]*$/.test(event.key)" placeholder="e.g. Kandingaka Waley Bayoza"
                            required>
                    </div>
                    <div class="col-md-6">
                        <label for="guardian_occupation" class="form-label">Guardian's Occupation</label>
                        <input type="text" class="form-control" id="guardian_occupation" name="guardian_occupation"
                            pattern="[A-Za-z\s]+" title="Please enter letters only"
                            onkeypress="return /^[A-Za-z\s]*$/.test(event.key)" placeholder="e.g. Astronaut, Networking"
                            required>
                    </div>
                    <div class="col-md-6">
                        <label for="guardian_contact" class="form-label">Guardian's Contact Number</label>
                        <input type="text" class="form-control" id="guardian_contact" name="guardian_contact"
                            pattern="\d*" title="Please enter numbers only"
                            onkeypress="return event.charCode >= 48 && event.charCode <= 57" minlength="11"
                            maxlength="11" placeholder="e.g. 0995#######" required>
                        <small class="form-text text-muted">Only numbers are allowed.</small>
                    </div>
                    {{-- <input type="hidden" id="details_id" name="details_id" value="{{ $registerForm->id }}"> --}}
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Next</button>
                    </div>
                </div>
            </form>
        </div>
    </div>



    <script>
        document.getElementById('birthdate').addEventListener('change', function() {
            const birthdateInput = this.value;
            const birthdateYear = new Date(birthdateInput).getFullYear();
            const errorDiv = document.getElementById('error');

            if (birthdateYear >= 2023 && birthdateYear <= 2999) {
                errorDiv.textContent = 'Error: Birthdate cannot be above 2023.';
                errorDiv.style.display = 'block';
            } else {
                errorDiv.style.display = 'none';
            }
        });

        const passwordInput = document.getElementById('password');
        const showPasswordCheckbox = document.getElementById('showPassword');

        showPasswordCheckbox.addEventListener('change', () => {
            if (showPasswordCheckbox.checked) {
                passwordInput.type = 'text';
            } else {
                passwordInput.type = 'password';
            }
        });
    </script>


</body>

</html>