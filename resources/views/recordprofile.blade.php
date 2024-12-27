@include('templates.recordheader')

<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->

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
    .navvers{
    background-color:rgba(8, 16, 66, 1); 
    border-width:0;
    color:white;
    padding:15px;

}
.navvers:hover{
    color:yellow;
}
.grade{
    margin-right:2%;
}
.card{
 
    padding:40px;
    /* background:linear-gradient(to bottom,rgba(8, 16, 66, 1),#1d2a78); */
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.7); 
    height:55vh;
}
.profile-image {
    width: 200px;
    height: 200px;
    border-radius: 0;
    object-fit: cover;
    border: 6px solid white;
    margin-top:-20%;
    box-shadow: 0 2px 10px rgba(0,0,0,0.4);
}

.profile-header {
    background-color:rgba(8, 16, 66, 1); 
    color: white;
    padding: 10px 20px;
    font-weight: bold;
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
    margin-bottom: 0px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5); 
}
.grade-level {
    color: black;
    margin-top: 10px;
}
.profile-name-line {
    border-bottom: 2px solid black;
    margin-bottom: 10px; 
    color:black;
    font-weight:bold;
    font-family:'Tahoma',sans-serif;
   
    text-transform:uppercase;
}
.editbtn {
    background-color: #118215;
    color: white;
    border-width: 0;
    padding: 8px 20px;
    margin-bottom: 10px;
    border-radius: 4px;
}
    .editbtn:hover{
        background-color:#22a327;
        color:white;
    }
    .classedit{
        padding:25px;
    }
    .updateprof {
    background-color: #2b398f;
    color: white;
    border-width: 0;
    padding: 8px 20px;
    border-radius: 4px;
    width: auto;
}
.updateprof:hover{
        background-color:#0c0e54;
        color:white;
    }

.email-section {
    margin-bottom: 20px;
}

.text-muted {
    color: #a0a0a0 !important;
}
</style>
<div class="header-container"> 
            <button id="openNav" class="navvers" onclick="w3_open(event)">&#9776;</button>
            <h1>Record profile</h1> 
        </div>
        <div id="main" onclick="w3_close()">

    <div id="main" onclick="w3_close()">
<section class="container-fluid py-5 bg-custom">
    <div class="row justify-content-center">
        <div class="col-md-9 col-lg-7 col-xl-6">
        <div class="profile-header">
                Profile Details
            </div>
            <div class="card">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                    <div class="text-center me-4">
                            @if ($picture)
                                <img src="{{ asset('storage/' . $picture->profile_picture) }}" alt="Profile Image" class="profile-image img-fluid" onerror="this.onerror=null; this.src='{{ asset('path/to/default/image.png') }}';">
                            @else
                                <img src="{{ asset('path/to/default/image.png') }}" alt="Default Profile Image" class="profile-image img-fluid">
                            @endif
                        </div>
                        <div class="flex-grow-2" style="margin-top:-40px;">
                        <h5 class="mb-1 uppercase" id="firstnameDisplay">{{ $user->firstname }} {{ $user->middlename }} {{ $user->lastname }} {{ $user->suffix }}</h5>
                            <!-- <div class="d-flex justify-content-between bg-light rounded-3 p-2 mb-2"> -->
                            <div class="email-section mb-4">
                        <p class="mb-0">{{ $user->email }}</p>
                            </div>
                            <div class="button-section">
                                <a href="recordeditprofile">
                                    <button type="button" class="editbtn mb-2">
                                        Edit Profile Details
                                    </button>
                                </a>
                                <br>
                                    <a href="/recordupdateprofile"><button type="submit" class="updateprof">
                                    Update Profile Picture 
                                </button></a>
                                </div>
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

@include('templates.recordfooter')