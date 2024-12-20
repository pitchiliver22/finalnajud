@include('templates.studentheader')
<!-- 
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->


<style>
    .header-container {
        display: flex; 
        align-items: center; 
        background-color: rgba(8, 16, 66, 1); 
        color:white;
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


.email-section {
    margin-bottom: 20px;
}

.text-muted {
    color: #a0a0a0 !important;
}

    .updateprof:hover{
        background-color:#0c0e54;
        color:white;
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
</style>

<div class="header-container"> 
            <button id="openNav" class="navvers" onclick="w3_open(event)">&#9776;</button>
            <h1>Student profile</h1> 
        </div>
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
                            <div class="grade-level text-center">
                    
                    @if($level)
                {{ $level->level }}
            @else
                No payment information available.
            @endif
                </div>
                        </div>
                        <div class="flex-grow-2" style="margin-top:-40px;">
                            <h5 class="mb-1 profile-name-line" id="firstnameDisplay">{{ $profile->firstname }} {{ $profile->middlename }} {{ $profile->lastname }} {{ $profile->suffix }}</h5>
                            <!-- <div class="d-flex justify-content-between bg-light rounded-3 p-2 mb-2"> -->
                                
                            <div class="email-section mb-4">
                    
                    <p class="text-black">{{ $profile->email }}</p>
                </div>
                <div class="button-section">
                    <button type="button" class="editbtn mb-2" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                        Edit Profile
                    </button> 
                                    <a href="/studentupdateprofile">
                                        <button type="button" class="updateprof">Upload Profile Picture</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Edit Profile Modal -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editProfileForm">
                    <div class="form-group">
                        <label for="firstname">First Name</label>
                        <input type="text" class="form-control" id="firstname" name="firstname" value="{{ $profile->firstname }}" required>
                    </div>
                    <div class="form-group">
                        <label for="middlename">Middle Name</label>
                        <input type="text" class="form-control" id="middlename" name="middlename" value="{{ $profile->middlename }}">
                    </div>
                    <div class="form-group">
                        <label for="lastname">Last Name</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" value="{{ $profile->lastname }}" required>
                    </div>
                    <div class="form-group">
                        <label for="suffix">Suffix</label>
                        <input type="text" class="form-control" id="suffix" name="suffix" value="{{ $profile->suffix }}">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $profile->email }}" readonly>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveChanges">Save changes</button>
            </div>
        </div>
    </div>
</div>

<script>
    function w3_open() {
        document.getElementById("mySidebar").style.display = "block";
    }

    document.getElementById('saveChanges').addEventListener('click', function() {
        const formData = {
            firstname: document.getElementById('firstname').value,
            middlename: document.getElementById('middlename').value,
            lastname: document.getElementById('lastname').value,
            suffix: document.getElementById('suffix').value,
        };

        $.ajax({
            url: '{{ route('update.profile') }}',
            method: 'POST',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function(response) {
                $('#editProfileModal').modal('hide');
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: response.success,
                    confirmButtonText: 'OK'
                }).then(() => {
                    location.reload();
                });
            },
            error: function(xhr) {
                const errorMessage = xhr.responseJSON && xhr.responseJSON.error ?
                    xhr.responseJSON.error :
                    'There was an error saving your changes. Please try again.';

                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: errorMessage,
                    confirmButtonText: 'OK'
                });
            }
        });
    });
</script>

@include('templates.studentfooter')