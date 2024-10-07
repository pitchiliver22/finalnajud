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

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/previous_school" method="POST" class="row g-3">
            @csrf

            <!-- Secondary School -->
            <h3 class="mb-3">Secondary School</h3>
            <div class="col-md-6">
                <label for="secondary-school-name" class="form-label">School Name <span
                        class="text-danger">*</span></label>
                <input type="text" class="form-control" id="secondary-school-name" name="second_school_name"
                    placeholder="Enter School Name" required>
            </div>
            <div class="col-md-6">
                <label for="secondary-last-strand" class="form-label">Last Strand <span
                        class="text-danger">*</span></label>
                <input type="text" class="form-control" id="secondary-last-strand" name="second_last_strand"
                    placeholder="Enter Last Strand" required>
            </div>
            <div class="col-md-6">
                <label for="secondary-last-year-level" class="form-label">Last Year Level <span
                        class="text-danger">*</span></label>
                <select id="secondary-last-year-level" name="second_last_year_level" class="form-select" required>
                    <option value="" selected>Select Year Level</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="secondary-school-year-from" class="form-label">School Year From <span
                        class="text-danger">*</span></label>
                <input type="text" class="form-control" id="secondary-school-year-from"
                    name="second_school_year_from" placeholder="From" required pattern="\d{4}"
                    title="Please enter a valid 4-digit year.">
            </div>
            <div class="col-md-3">
                <label for="secondary-school-year-to" class="form-label">School Year To <span
                        class="text-danger">*</span></label>
                <input type="text" class="form-control" id="secondary-school-year-to" name="second_school_year_to"
                    placeholder="To" required pattern="\d{4}" title="Please enter a valid 4-digit year.">
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
                    placeholder="Enter School Name" required>
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
                    name="primary_school_year_from" placeholder="From" required pattern="\d{4}"
                    title="Please enter a valid 4-digit year.">
            </div>
            <div class="col-md-3">
                <label for="primary-school-year-to" class="form-label">School Year To <span
                        class="text-danger">*</span></label>
                <input type="text" class="form-control" id="primary-school-year-to" name="primary_school_year_to"
                    placeholder="To" required pattern="\d{4}" title="Please enter a valid 4-digit year.">
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

            <!-- Hidden field for school ID -->
            <input type="hidden" name="school_id" id="school_id" value="{{ auth()->user()->id }}">

            <!-- Form actions -->
            <div class="col-12 text-end">
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</body>

</html>
