@include('templates.accountingheader')
<!-- 
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->

<style>
    .header-container {
        display: flex; 
        align-items: center; 
        background-color: rgba(8, 16, 66, 1); 
        color: white;
        padding: 10px; 
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);  
    }

    .profile-image {
        width: 180px;
        height: 180px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid #007bff;
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
        text-transform:uppercase;
    }
</style>

<div class="header-container"> 
        <button id="openNav" class="w3-button w3-xlarge nav-button" onclick="w3_open()">&#9776;</button>
        <h1 class="text-light">Accounting Profile</h1>
    </div>
    <div id="main" onclick="w3_close()">

<section class="container-fluid py-5 bg-custom">
    <div class="row justify-content-center">
        <div class="col-md-9 col-lg-7 col-xl-6">
            <div class="card">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            @if ($picture)
                                <img src="{{ asset('storage/' . $picture->profile_picture) }}" alt="Profile Image" class="profile-image img-fluid" onerror="this.onerror=null; this.src='{{ asset('path/to/default/image.png') }}';">
                            @else
                                <img src="{{ asset('path/to/default/image.png') }}" alt="Default Profile Image" class="profile-image img-fluid">
                            @endif
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="mb-1 uppercase" id="firstnameDisplay">{{ $user->firstname }} {{ $user->middlename }} {{ $user->lastname }} {{ $user->suffix }}</h5>
                            <div class="d-flex justify-content-between bg-light rounded-3 p-2 mb-2">
                                <div>
                                    <p class="small text-muted mb-1">Email</p>
                                    <p class="mb-0">{{ $user->email }}</p>
                                </div>
                                <div class="d-flex justify-content-end pt-1">
                                    <a href="{{ url('accountingeditprofile') }}">
                                        <button type="button" class="btn-primary">
                                            Edit Profile Details
                                        </button>
                                    </a>
                                 </div>

                                 <a href="/accountingupdateprofile">
                                    <button type="button" class="btn btn-primary">upload Profile Picture</button>
                                </a>
                            </div>
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





</div>
@include('templates.accountingfooter')
