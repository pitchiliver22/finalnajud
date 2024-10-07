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
    </style>
</head>

<body>
    <div class="container my-5">
        <h1 class="mb-4">Address and Contact Details</h1>
        <p class="mb-4">Please fill in the required fields diligently. All required fields are marked with *
            (asterisk).
            Fill in at least one parent/guardian details.</p>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/updateaddress" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="zipcode" class="form-label">Zip Code *</label>
                    <input type="text" class="form-control" id="zipcode" name="zipcode" required pattern="\d{5}"
                        title="Please enter a valid 5-digit zip code." placeholder="e.g. 12345"
                        value="{{ $address->zipcode }}">
                </div>
                <div class="col-md-6">
                    <label for="province" class="form-label">Province *</label>
                    <input type="text" class="form-control" id="province" name="province"
                        value="{{ $address->province }}" required>
                </div>
                <div class="col-md-6">
                    <label for="city" class="form-label">City *</label>
                    <input type="text" class="form-control" id="city" name="city"
                        value="{{ $address->city }}" required>
                </div>
                <div class="col-md-6">
                    <label for="barangay" class="form-label">Barangay *</label>
                    <input type="text" class="form-control" id="barangay" name="barangay"
                        value="{{ $address->barangay }}" required>
                </div>
                <div class="col-md-6">
                    <label for="streetaddress" class="form-label">Street Address *</label>
                    <input type="text" class="form-control" id="streetaddress" name="streetaddress"
                        value="{{ $address->streetaddress }}" required>
                </div>
                <input type="hidden" id="address_id" name="address_id" value="{{ $address->id }}">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Done</button>
                </div>
            </div>
        </form>
    </div>

    <script>
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
    </script>
</body>

</html>
