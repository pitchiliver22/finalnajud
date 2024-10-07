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
    </style>
</head>

<body>

    <div class="container">
        <h1>Personal Details</h1>
        <h4>Please fill in the required fields diligently. All required fields are marked with an asterisk (*).</h4>
        <form action="/studentdetails" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="firstname" class="form-label">First Name *</label>
                    <input type="text" class="form-control" id="firstname" name="firstname" required
                        value="{{ auth()->user()->firstname }}">
                </div>
                <div class="col-md-6">
                    <label for="middlename" class="form-label">Middle Name *</label>
                    <input type="text" class="form-control" id="middlename" name="middlename" required
                        value="{{ auth()->user()->middlename }}">
                </div>
                <div class="col-md-6">
                    <label for="lastname" class="form-label">Last Name *</label>
                    <input type="text" class="form-control" id="lastname" name="lastname" required
                        value="{{ auth()->user()->lastname }}">
                </div>
                <div class="col-md-6">
                    <label for="suffix" class="form-label">Suffix Name</label>
                    <input type="text" class="form-control" id="suffix" name="suffix"
                        placeholder="e.g. Jr, Sr, III" value="{{ auth()->user()->suffix }}">
                </div>
                <div class="col-md-6">
                    <label for="nationality" class="form-label">Nationality *</label>
                    <input type="text" class="form-control" id="nationality" name="nationality" required>
                </div>
                <div class="col-md-6">
                    <label for="gender" class="form-label">Gender *</label>
                    <select id="gender" name="gender" class="form-select" required>
                        <option value="" disabled selected>Select Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="civilstatus" class="form-label">Civil Status *</label>
                    <select id="civilstatus" name="civilstatus" class="form-select" required>
                        <option value="" disabled selected>Select Civil Status</option>
                        <option value="single">Single</option>
                        <option value="married">Married</option>
                        <option value="divorced">Divorced</option>
                        <option value="widowed">Widowed</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="birthdate" class="form-label">Birth Date *</label>
                    <input type="date" class="form-control" id="birthdate" name="birthdate" required>
                </div>
                <div class="col-md-6">
                    <label for="birthplace" class="form-label">Birth Place *</label>
                    <input type="text" class="form-control" id="birthplace" name="birthplace"
                        placeholder="City, Province/State, Country" required>
                </div>
                <div class="col-md-6">
                    <label for="religion" class="form-label">Religion</label>
                    <input type="text" class="form-control" id="religion" name="religion">
                </div>
                <div class="col-md-6">
                    <label for="mother_name" class="form-label">Mother's Full Name *</label>
                    <input type="text" class="form-control" id="mother_name" name="mother_name" required>
                </div>
                <div class="col-md-6">
                    <label for="mother_occupation" class="form-label">Mother's Occupation</label>
                    <input type="text" class="form-control" id="mother_occupation" name="mother_occupation">
                </div>
                <div class="col-md-6">
                    <label for="mother_contact" class="form-label">Mother's Contact Number *</label>
                    <input type="text" class="form-control" id="mother_contact" name="mother_contact" required>
                </div>
                <div class="col-md-6">
                    <label for="father_name" class="form-label">Father's Full Name *</label>
                    <input type="text" class="form-control" id="father_name" name="father_name" required>
                </div>
                <div class="col-md-6">
                    <label for="father_occupation" class="form-label">Father's Occupation</label>
                    <input type="text" class="form-control" id="father_occupation" name="father_occupation">
                </div>
                <div class="col-md-6">
                    <label for="father_contact" class="form-label">Father's Contact Number *</label>
                    <input type="text" class="form-control" id="father_contact" name="father_contact" required>
                </div>
                <div class="col-md-6">
                    <label for="guardian_name" class="form-label">Guardian's Full Name</label>
                    <input type="text" class="form-control" id="guardian_name" name="guardian_name">
                </div>
                <div class="col-md-6">
                    <label for="guardian_occupation" class="form-label">Guardian's Occupation</label>
                    <input type="text" class="form-control" id="guardian_occupation" name="guardian_occupation">
                </div>
                <div class="col-md-6">
                    <label for="guardian_contact" class="form-label">Guardian's Contact Number</label>
                    <input type="text" class="form-control" id="guardian_contact" name="guardian_contact">
                </div>
                <input type="hidden" id="details_id" name="details_id" value="{{ auth()->user()->id }}">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Next</button>
                </div>
            </div>
        </form>
    </div>


</body>

</html>
