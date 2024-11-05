<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Previous School school</title>
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

        .custom-alert {
            position: relative;
            padding: 15px;
            margin: 20px 0;
            border: 1px solid #d4edda;
            border-radius: 5px;
            background-color: #d4edda;
            /* Light green background */
            color: #155724;
            /* Dark green text */
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: opacity 0.5s ease;
        }

        .custom-alert .close {
            background: none;
            border: none;
            font-size: 1.5rem;
            color: #155724;
            /* Dark green */
            cursor: pointer;
            margin-left: 10px;
        }

        .custom-alert .close:hover {
            color: #0c5e0c;
            /* Darker green on hover */
        }

        /* Responsive Design */
        @media (max-width: 576px) {
            .custom-alert {
                flex-direction: column;
                align-items: flex-start;
            }

            .custom-alert .close {
                align-self: flex-end;
                margin-top: 10px;
            }
        }
    </style>
</head>

<body>
    <div class="container my-5">
        <h1 class="mb-4">Previous School school</h1>
        <p class="lead mb-4">Please fill in the required fields diligently. All required fields are marked with <span
                class="text-danger">*</span>. Fill in at least one parent/guardian school.</p>

        @if (session('success'))
            <div id="success-alert" class="custom-alert alert-success fade show" role="alert">
                <span>{{ session('success') }}</span>
                <button type="button" class="close" onclick="closeAlert()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/updateschool" method="POST" class="row g-3">
            @csrf

            <!-- Secondary School -->
            <h3 class="mb-3">Secondary School</h3>
            <div class="col-md-6">
                <label for="secondary-school-name" class="form-label">School Name <span
                        class="text-danger">*</span></label>
                <input type="text" class="form-control" id="secondary-school-name" name="second_school_name"
                    placeholder="Enter School Name" value="{{ $school->second_school_name }}" pattern="[A-Za-z\s]+"
                    title="Please enter letters only" onkeypress="return /^[A-Za-z\s]*$/.test(event.key)" required>
            </div>
            <div class="col-md-6">
                <label for="secondary-last-year-level" class="form-label">Last Year Level <span
                        class="text-danger">*</span></label>
                <input type="text" class="form-control" name="second_last_year_level" id="second_last_year_level"
                    value="{{ $school->second_last_year_level }}" readonly>
            </div>
            <div class="col-md-3">
                <label for="secondary-school-year-from" class="form-label">School Year From <span
                        class="text-danger">*</span></label>
                <input type="text" class="form-control" id="secondary-school-year-from"
                    name="second_school_year_from" placeholder="From" required pattern="\d{4}"
                    title="Please enter a valid 4-digit year." value="{{ $school->second_school_year_from }}"
                    maxlength="4" pattern="\d*" title="Please enter numbers only"
                    onkeypress="return event.charCode >= 48 && event.charCode <= 57">
            </div>
            <div class="col-md-3">
                <label for="secondary-school-year-to" class="form-label">School Year To <span
                        class="text-danger">*</span></label>
                <input type="text" class="form-control" id="secondary-school-year-to" name="second_school_year_to"
                    placeholder="To" required pattern="\d{4}" title="Please enter a valid 4-digit year."
                    value="{{ $school->second_school_year_to }}" maxlength="4" pattern="\d*"
                    title="Please enter numbers only" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
            </div>
            <div class="col-md-6">
                <label for="secondary-school-type" class="form-label">School Type <span
                        class="text-danger">*</span></label>
                <input type="text" class="form-control" id="second_school_type" name="second_school_type"
                    value="{{ $school->second_school_type }}" pattern="[A-Za-z\s]+" title="Please enter letters only"
                    onkeypress="return /^[A-Za-z\s]*$/.test(event.key)">

            </div>

            <!-- Primary School -->
            <h3 class="mb-3">Primary School</h3>
            <div class="col-md-6">
                <label for="primary-school-name" class="form-label">School Name <span
                        class="text-danger">*</span></label>
                <input type="text" class="form-control" id="primary-school-name" name="primary_school_name"
                    placeholder="Enter School Name" value="{{ $school->primary_school_name }}" pattern="[A-Za-z\s]+"
                    title="Please enter letters only" onkeypress="return /^[A-Za-z\s]*$/.test(event.key)" required>
            </div>
            <div class="col-md-6">
                <label for="primary-last-year-level" class="form-label">Last Year Level <span
                        class="text-danger">*</span></label>

                <input type="text" class="form-control" id="primary_last_year_level"
                    name="primary_last_year_level" value="{{ $school->primary_last_year_level }}" readonly>
            </div>
            <div class="col-md-3">
                <label for="primary-school-year-from" class="form-label">School Year From <span
                        class="text-danger">*</span></label>
                <input type="text" class="form-control" id="primary-school-year-from"
                    name="primary_school_year_from" placeholder="From" required pattern="\d{4}"
                    title="Please enter a valid 4-digit year." value="{{ $school->primary_school_year_from }}"
                    maxlength="4" pattern="\d*" title="Please enter numbers only"
                    onkeypress="return event.charCode >= 48 && event.charCode <= 57">
            </div>
            <div class="col-md-3">
                <label for="primary-school-year-to" class="form-label">School Year To <span
                        class="text-danger">*</span></label>
                <input type="text" class="form-control" id="primary-school-year-to" name="primary_school_year_to"
                    placeholder="To" required pattern="\d{4}" title="Please enter a valid 4-digit year."
                    value="{{ $school->primary_school_year_to }}" maxlength="4" pattern="\d*"
                    title="Please enter numbers only"
                    onkeypress="return event.charCode >= 48 && event.charCode <= 57">
            </div>
            <div class="col-md-6">
                <label for="primary-school-type" class="form-label">School Type <span
                        class="text-danger">*</span></label>
                <input type="text" class="form-control" id="primary_school_type" name="primary_school_type"
                    value="{{ $school->primary_school_type }}" pattern="[A-Za-z\s]+"
                    title="Please enter letters only" onkeypress="return /^[A-Za-z\s]*$/.test(event.key)">
            </div>

            <!-- Hidden field for school ID -->
            <input type="hidden" name="school_id" id="school_id" value="{{ auth()->user()->id }}">

            <!-- Form actions -->
            <div class="col-12 text-end">
                <button type="submit" name="submit" class="btn btn-primary">Done</button>
            </div>
        </form>
    </div>
    <script>
        function closeAlert() {
            document.getElementById('success-alert').style.display = 'none';
            window.location.href = '/enrollmentstep'; // Change to your actual enrollment steps path
        }
    </script>
</body>

</html>
