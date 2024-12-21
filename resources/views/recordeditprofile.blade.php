@include('templates.recordheader')

<style>
    .header-container {
        display: flex; 
        align-items: center; 
        background-color: rgba(8, 16, 66, 1); 
        color: white;
        padding: 10px; 
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
    }

    .nav-button {
        margin-right: 15px; 
        background: transparent;
        border: none;
        color: white;
        font-size: 24px;
        cursor: pointer;
    }

    h1 {
        margin: 0; 
        font-size: 15px;
        text-transform: uppercase;
    }

    .editbtn, .updateprof {
        background-color: #118215;
        color: white;
        border: none;
        padding: 8px 20px;
        border-radius: 4px;
    }

    .editbtn:hover, .updateprof:hover {
        background-color: #22a327;
    }

    .classedit {
        padding: 25px;
    }
r
    .email-section {
        margin-bottom: 20px;
    }

    .text-muted {
        color: #a0a0a0 !important;
    }

    .card {
        padding: 40px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.7); 
        border-radius: 8px;
    }

    .profile-image {
        width: 250px;
        height: 250px;
        border-radius: 0;
        object-fit: cover;
        border: 6px solid white;
        margin-top: -20%;
        box-shadow: 0 2px 10px rgba(0,0,0,0.4);
    }

    .profile-header {
        background-color: rgba(8, 16, 66, 1); 
        color: white;
        padding: 10px 20px;
        font-weight: bold;
        border-radius: 5px 5px 0 0;
        margin-bottom: 0;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
    }

    .grade-level {
        color: black;
        margin-top: 10px;
    }

    .profile-name-line {
        border-bottom: 2px solid black;
        margin-bottom: 10px; 
        color: black;
        font-weight: bold;
        font-family: 'Tahoma', sans-serif;
        text-transform: uppercase;
    }
    .centercenter{

        margin-left:30%;
    }

    .navvers{
        background-color:rgba(8, 16, 66, 1); 
        border-width:0;
        color:white;
        padding:15px;

    }
    .navvers:hover{
        color:yellow;
    }
</style>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
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

<div class="header-container"> 
    <button id="openNav" class="navvers" onclick="w3_open(event)">&#9776;</button>
    <h1>Record</h1> 
</div>

<section class="container-fluid py-5 bg-custom">
    <div class="row justify-content-center">
        <div class="col-md-9 col-lg-7 col-xl-6">
            <div class="profile-header">
                Profile Details
            </div>
            <div class="card">
                <div class="card-body p-4">
                    <div class="d-flex">

                        <form action="{{ route('recordeditprofile') }}" method="POST" class="centercenter">
                                @csrf
                                <div class="mb-3">
                                    <label for="firstname" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="firstname" name="firstname" value="{{ old('firstname', $profile->firstname) }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="middlename" class="form-label">Middle Name</label>
                                    <input type="text" class="form-control" id="middlename" name="middlename" value="{{ old('middlename', $profile->middlename) }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="lastname" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="lastname" name="lastname" value="{{ old('lastname', $profile->lastname) }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="suffix" class="form-label">Suffix</label>
                                    <input type="text" class="form-control" id="suffix" name="suffix" value="{{ old('suffix', $profile->suffix) }}">
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" class="form-control" id="email" name="email" value="{{ old('email', $profile->email) }}" readonly>
                                </div>

                                <br>
                                <button type="submit" class="editbtn">
                                    Update Profile
                                </button>

                                <a href="recordprofile" class="btn btn-secondary">
                                    Back
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    function w3_open() {
        document.getElementById("mySidebar").style.display = "block";
    }
</script>

@include('templates.recordfooter')