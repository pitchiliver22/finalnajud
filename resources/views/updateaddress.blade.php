<!DOCTYPE html>
<html>

<head>
    <title>Address Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
    </style>
</head>

<body>
    <div class="container my-5">

        @if (session('success'))
            <div id="success-alert" class="custom-alert alert-success fade show" role="alert">
                <span>{{ session('success') }}</span>
                <button type="button" class="close" onclick="closeAlert()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <h1 class="mb-4">Address and Contact Details</h1>
        <p class="mb-4">Please fill in the required fields diligently. All required fields are marked with *
            (asterisk). Fill in at least one parent/guardian details.</p>

        @if ($errors->any())
            <div class="custom-alert alert-danger fade show" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="close" onclick="closeAlert(this)">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <form action="/updateaddress" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="zipcode" class="form-label">Zip Code *</label>
                    <input type="text" class="form-control" id="zipcode" name="zipcode" minlength="4"
                        maxlength="4" pattern="\d*" title="Please enter a valid zipcode."
                        onkeypress="return event.charCode >= 48 && event.charCode <= 57" placeholder="e.g. 1234"
                        value="{{ $address->zipcode }}">
                </div>
                <div class="col-md-6">
                    <label for="province" class="form-label">Province *</label>
                    <input type="text" class="form-control" id="province" name="province"
                        value="{{ $address->province }}" pattern="[A-Za-z\s]+" title="Please enter letters only"
                        onkeypress="return /^[A-Za-z\s]*$/.test(event.key)" required>
                </div>
                <div class="col-md-6">
                    <label for="city" class="form-label">City *</label>
                    <input type="text" class="form-control" id="city" name="city"
                        value="{{ $address->city }}" pattern="[A-Za-z\s]+" title="Please enter letters only"
                        onkeypress="return /^[A-Za-z\s]*$/.test(event.key)" required>
                </div>
                <div class="col-md-6">
                    <label for="barangay" class="form-label">Barangay *</label>
                    <input type="text" class="form-control" id="barangay" name="barangay"
                        value="{{ $address->barangay }}" pattern="[A-Za-z\s]+" title="Please enter letters only"
                        onkeypress="return /^[A-Za-z\s]*$/.test(event.key)" required>
                </div>
                <div class="col-md-6">
                    <label for="streetaddress" class="form-label">Street Address *</label>
                    <input type="text" class="form-control" id="streetaddress" name="streetaddress"
                        value="{{ $address->streetaddress }}" pattern="[A-Za-z\s]+" title="Please enter letters only"
                        onkeypress="return /^[A-Za-z\s]*$/.test(event.key)" required>
                </div>
                <input type="hidden" id="address_id" name="address_id" value="{{ $address->id }}">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Done</button>
                </div>
            </div>
        </form>
    </div>

    <script>
        function closeAlert(button) {
            const alert = button.parentElement;
            alert.style.display = 'none';
        }

        document.getElementById('sameAsCurrentAddress').addEventListener('change', function() {
            if (this.checked) {
                document.getElementById('zipcode2').value = document.getElementById('zipcode').value;
                document.getElementById('inputProvince2').value = document.getElementById('province').value;
                document.getElementById('inputCity2').value = document.getElementById('city').value;
                document.getElementById('inputBarangay2').value = document.getElementById('barangay').value;
                document.getElementById('inputStreetAddress2').value = document.getElementById('streetaddress')
                    .value;
            } else {
                document.getElementById('zipcode2').value = '';
                document.getElementById('inputProvince2').value = '';
                document.getElementById('inputCity2').value = '';
                document.getElementById('inputBarangay2').value = '';
                document.getElementById('inputStreetAddress2').value = '';
            }
        });

        function closeAlert() {
            document.getElementById('success-alert').style.display = 'none';
            window.location.href = '/enrollmentstep'; // Change to your actual enrollment steps path
        }
    </script>
</body>

</html>
