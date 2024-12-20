@include('templates.recordheader')

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: white;
        margin: 0;
        padding: 0;
    }

    .header-container {
        display: flex; 
        align-items: center; 
        background-color: rgba(8, 16, 66, 1); 
        color: white;
        padding: 10px; 
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);  
    }

    h1 {
        margin: 0; 
        font-size: 14px;
        text-transform: uppercase;
    }

    .container {
        margin: 100px; /* Add margin to container */
        display: flex;
        flex-direction: column;
        align-items: center; /* Center contents */
    }

    .card {
        border-radius: 8px;
        transition: transform 0.2s, box-shadow 0.2s;
        width: 100%; /* Full width for smaller screens */
        max-width: 600px; /* Limit max width */
        margin: 10px 0; /* Add margin for spacing */
    }

    .card:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
    }

    .text-center {
        text-align: center;
    }

    .back {
        background-color: rgba(26, 161, 21);
        color: white;
        margin-left: 80%;
        text-decoration: none;
        padding: 10px;
        border-radius: 10px;
    }

    .back:hover {
        background-color: #2ebf28;
        color: white;
    }
</style>

<div class="header-container">
    <button id="openNav" class="w3-button w3-xlarge" onclick="w3_open()">&#9776;</button>
    <h1>Student Information</h1>
</div>

<div id="main" onclick="w3_close()">
    <div class="text-center mt-4">
        <a href="/studententries" class="back">Back to Student List</a>
    </div>

    <div class="container mt-4 mb-5">
        <div class="row">
            <!-- Student Information Card -->
            <div class="col-md-12 mb-4">
                <div class="card student-info-card">
                    <div class="card-body">
                        <h5 class="card-subtitle" style="color:rgba(8, 16, 66, 1); font-weight:bold;">Personal Details</h5>
                        @if ($student)
                            <p><strong>Name:</strong> {{ $student->firstname }} {{ $student->middlename }} {{ $student->lastname }} {{ $student->suffix }}</p>
                            <p><strong>Nationality:</strong> {{ $student->nationality }}</p>
                            <p><strong>Gender:</strong> {{ $student->gender }}</p>
                            <p><strong>Civil Status:</strong> {{ $student->civilstatus }}</p>
                            <p><strong>Birthdate:</strong> {{ $student->birthdate }}</p>
                            <p><strong>Birthplace:</strong> {{ $student->birthplace }}</p>
                            <p><strong>Religion:</strong> {{ $student->religion }}</p>
                            
                            <br>
                            <h5 class="card-subtitle mb-2" style="color:rgba(8, 16, 66, 1); font-weight:bold;">Contact Information</h5>
                            <p><strong>Mother's Name:</strong> {{ $student->mother_name }}</p>
                            <p><strong>Mother's Occupation:</strong> {{ $student->mother_occupation }}</p>
                            <p><strong>Mother's Contact:</strong> {{ $student->mother_contact }}</p>
                            <p><strong>Father's Name:</strong> {{ $student->father_name }}</p>
                            <p><strong>Father's Occupation:</strong> {{ $student->father_occupation }}</p>
                            <p><strong>Father's Contact:</strong> {{ $student->father_contact }}</p>
                            <p><strong>Guardian's Name:</strong> {{ $student->guardian_name }}</p>
                            <p><strong>Guardian's Occupation:</strong> {{ $student->guardian_occupation }}</p>
                            <p><strong>Guardian's Contact:</strong> {{ $student->guardian_contact }}</p>
                        @else
                            <p>No student information available.</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Previous School Card -->
            <div class="col-md-6 mb-4">
                <div class="card school-info-card">
                    <div class="card-body">
                        <h5 class="card-title" style="color:rgba(8, 16, 66, 1); font-weight:bold;">Previous School</h5>
                        @if ($previous)
                            <p><strong>Secondary School Name:</strong> {{ $previous->second_school_name }}</p>
                            <p><strong>Last Year Level:</strong> {{ $previous->second_last_year_level }}</p>
                            <p><strong>Year From:</strong> {{ $previous->second_school_year_from }}</p>
                            <p><strong>Year To:</strong> {{ $previous->second_school_year_to }}</p>
                            <p><strong>School Type:</strong> {{ $previous->second_school_type }}</p>

                            <p><strong>Primary School Name:</strong> {{ $previous->primary_school_name }}</p>
                            <p><strong>Last Year Level:</strong> {{ $previous->primary_last_year_level }}</p>
                            <p><strong>Year From:</strong> {{ $previous->primary_school_year_from }}</p>
                            <p><strong>Year To:</strong> {{ $previous->primary_school_year_to }}</p>
                            <p><strong>School Type:</strong> {{ $previous->primary_school_type }}</p>
                        @else
                            <p>No previous school information available.</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Address Card -->
            <div class="col-md-6 mb-4">
                <div class="card address-card">
                    <div class="card-body">
                        <h5 class="card-title" style="color:rgba(8, 16, 66, 1); font-weight:bold;">Address</h5>
                        @if ($address)
                            <p><strong>Street Address:</strong> {{ $address->streetaddress }}</p>
                            <p><strong>Barangay:</strong> {{ $address->barangay }}</p>
                            <p><strong>City:</strong> {{ $address->city }}</p>
                            <p><strong>Province:</strong> {{ $address->province }}</p>
                            <p><strong>Zipcode:</strong> {{ $address->zipcode }}</p>
                        @else
                            <p>No address information available.</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Required Documents Card -->
            <div class="col-md-12 mb-4">
                <div class="card documents-card">
                    <div class="card-body">
                        <h5 class="card-title" style="color:rgba(8, 16, 66, 1); font-weight:bold;">Required Documents</h5>
                        @if ($require && count($require) > 0)
                            <div class="row">
                                @foreach ($require as $doc)
                                    <div class="col-md-4 mb-3">
                                        <div class="card text-center document-card">
                                            <div class="card-body">
                                                <p><strong>Type:</strong> {{ $doc->type }}</p>
                                                <img src="{{ asset('storage/' . $doc->documents) }}"
                                                    alt="{{ $doc->documents }}" class="img-fluid document-img"
                                                    data-img-src="{{ asset('storage/' . $doc->documents) }}">
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p>No required documents available.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Image Zoom-In Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Document Preview</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <img src="" id="modalImage" class="img-fluid full-image" alt="Document Preview">
            </div>
        </div>
    </div>
</div>

<script>
    // Script to handle image modal preview
    document.querySelectorAll('.document-img').forEach(image => {
        image.addEventListener('click', function() {
            const imgSrc = this.getAttribute('data-img-src');
            const modalImage = document.getElementById('modalImage');
            modalImage.src = imgSrc;

            // Show the modal
            $('#imageModal').modal('show');
        });
    });

    // Ensure the modal closes when the close button or backdrop is clicked
    ('#imageModal').on('hidden.bs.modal', function() {
        const modalImage = document.getElementById('modalImage');
        modalImage.src = ''; // Clear the image source to stop loading
    });
</script>

<style>
    .student-info-card,
    .school-info-card,
    .address-card,
    .documents-card {
        border: 1px solid #ccc;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s;
    }

    .student-info-card:hover,
    .school-info-card:hover,
    .address-card:hover,
    .documents-card:hover {
        transform: translateY(-5px);
    }

    .card-title {
        color: #343a40;
    }

    .card-subtitle {
        color: #6c757d;
    }

    .document-img {
        cursor: pointer;
        transition: transform 0.2s;
        border-radius: 4px;
    }

    .document-img:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .full-image {
        width: 100%;
        height: auto;
        max-height: 80vh;
        object-fit: contain;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }
</style>

@include('templates.recordfooter')