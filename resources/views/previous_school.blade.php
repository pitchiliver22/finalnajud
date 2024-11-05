<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Previous School Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
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
    <div class="container my-5">
        <h1 class="mb-4">Previous School Details</h1>
        <p class="lead mb-4">Please fill in the required fields diligently. All required fields are marked with <span
                class="text-danger">*</span>. Fill in at least one parent/guardian details.</p>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


        <script>
            $(document).ready(function() {
                @if (session('success'))
                    toastr.success('{{ session('success') }}');
                @endif

                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        toastr.error('{{ $error }}');
                    @endforeach
                @endif
            });
        </script>




        <form action="/previous_school" method="POST" class="row g-3">
            @csrf

            <!-- Secondary School -->
            <h3 class="mb-3">Secondary School</h3>
            <div class="col-md-6">
                <label for="secondary-school-name" class="form-label">School Name <span
                        class="text-danger">*</span></label>
                <input type="text" class="form-control" id="secondary-school-name" name="second_school_name"
                    placeholder="Enter School Name/ If you are in still in Primary level, please put NA"
                    pattern="[A-Za-z\s]+" title="Please enter letters only"
                    onkeypress="return /^[A-Za-z\s]*$/.test(event.key)" required>
            </div>
            <div class="col-md-6">
                <label for="secondary-last-year-level" class="form-label">Last Year Level <span
                        class="text-danger">*</span></label>
                <select id="secondary-last-year-level" name="second_last_year_level" class="form-select" required>
                    <option value="" selected>Select Year Level</option>
                    <option value="NA">N/A</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="secondary-school-year-from" class="form-label">School Year From <span
                        class="text-danger">*</span></label>
                <input type="text" class="form-control" id="secondary-school-year-from"
                    name="second_school_year_from" placeholder="From" pattern="\d*" title="Please enter numbers only"
                    onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="4">
            </div>
            <div class="col-md-3">
                <label for="secondary-school-year-to" class="form-label">School Year To <span
                        class="text-danger">*</span></label>
                <input type="text" class="form-control" id="secondary-school-year-to" name="second_school_year_to"
                    placeholder="To" pattern="\d*" title="Please enter numbers only"
                    onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="4">
            </div>
            <div class="col-md-6">
                <label for="secondary-school-type" class="form-label">School Type <span
                        class="text-danger">*</span></label>
                <select id="secondary-school-type" name="second_school_type" class="form-select" required>
                    <option value="" selected>Select School Type</option>
                    <option value="public">Public</option>
                    <option value="private">Private</option>
                </select>
            </div>

            <!-- Primary School -->
            <h3 class="mb-3">Primary School</h3>
            <div class="col-md-6">
                <label for="primary-school-name" class="form-label">School Name <span
                        class="text-danger">*</span></label>
                <input type="text" class="form-control" id="primary-school-name" name="primary_school_name"
                    placeholder="Enter School Name" pattern="[A-Za-z\s]+" title="Please enter letters only"
                    onkeypress="return /^[A-Za-z\s]*$/.test(event.key)" required>
            </div>
            <div class="col-md-6">
                <label for="primary-last-year-level" class="form-label">Last Year Level <span
                        class="text-danger">*</span></label>
                <select id="primary-last-year-level" name="primary_last_year_level" class="form-select" required>
                    <option value="" selected>Select Year Level</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="primary-school-year-from" class="form-label">School Year From <span
                        class="text-danger">*</span></label>
                <input type="text" class="form-control" id="primary-school-year-from"
                    name="primary_school_year_from" placeholder="From" pattern="\d*"
                    title="Please enter numbers only" onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                    maxlength="4">
            </div>
            <div class="col-md-3">
                <label for="primary-school-year-to" class="form-label">School Year To <span
                        class="text-danger">*</span></label>
                <input type="text" class="form-control" id="primary-school-year-to" name="primary_school_year_to"
                    placeholder="To" pattern="\d*" title="Please enter numbers only"
                    onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="4">
            </div>
            <div class="col-md-6">
                <label for="primary-school-type" class="form-label">School Type <span
                        class="text-danger">*</span></label>
                <select id="primary-school-type" name="primary_school_type" class="form-select" required>
                    <option value="" selected>Select School Type</option>
                    <option value="public">Public</option>
                    <option value="private">Private</option>
                </select>
            </div>


            <input type="hidden" name="school_id" id="school_id" value="{{ auth()->user()->id }}">


            <div class="col-12 text-end">
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>

</body>

</html>
