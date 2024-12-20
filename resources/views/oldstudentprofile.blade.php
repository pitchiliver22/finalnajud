@include('templates.oldstudentheader')
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
    .editbtn{
        background-color:#118215;
        color:white;
        border-width:0;
        padding:5px;
        margin-bottom:2%;
    }
    .editbtn:hover{
        background-color:#22a327;
        color:white;
    }
    .classedit{
        padding:25px;
    }
    .updateprof{
        background-color:rgba(8, 16, 66, 1); 
        color:white;
        border-width:0;
        padding:5px;
        width:115%;
        
    }
    .updateprof:hover{
        background-color:#2231a3;
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
.profilename{
    font-family:'Arial',sans-serif;
  
}
.grade{
    margin-right:2%;
}
.card{
    padding:50px;
    background-color:#f0f1f7;
}
.profile-image.img-fluid
{
    margin-right:50%;
   
}
</style>


<div class="header-container"> 
            <button id="openNav" class="navvers" onclick="w3_open(event)">&#9776;</button>
            <h1>Student Dashboard</h1> 
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
                                <img src="{{ asset('storage/' . $picture->profile_picture) }}" 
                                     alt="Profile Image"  
                                     class="profile-image img-fluid" 
                                     onerror="this.onerror=null; this.src='{{ asset('path/to/default/image.png') }}';">
                            @else
                                <img src="{{ asset('path/to/default/image.png') }}" 
                                     alt="Default Profile Image" 
                                     class="profile-image img-fluid">
                            @endif
                        </div>
<<<<<<< HEAD
                        <div class="flex-grow-1 ms-3">
                            <h5 class="mb-1 uppercase" id="firstnameDisplay">{{ $profile->firstname }} {{ $profile->middlename }} {{ $profile->lastname }} {{ $profile->suffix }}</h5>
                          
=======
                        <div class="profilename">
                            <h5 class="mb-1 uppercase" id="firstnameDisplay" style="font-weight:bold">{{ $profile->firstname }} {{ $profile->middlename }} {{ $profile->lastname }} {{ $profile->suffix }}</h5>
                        
>>>>>>> 175100c22df9e552b6a1f082c1221e0f9eac2450
                            <div class="d-flex justify-content-between bg-light rounded-3 p-2 mb-2">
                                <div class="grade">
                                    <p class="small text-muted mb-1">Grade Level</p>
                                    <p>{{ $level->level }}</p>
                                </div>
                                <div class="email">
                                    <p class="small text-muted mb-1">Email Address</p>
                                    <p >{{ $profile->email }}</p>
                                </div>
                                
                                <div class="classedit" id="editbtnn">
                                    <button type="button" class="editbtn" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                                        Edit Profile
                                    </button> 
                                    
                                    <a href="/oldstudentupdateprofile"><button type="submit" class="updateprof">
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


 <!-- Edit Profile Modal -->
 <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editProfileForm">
                    <div class="mb-3">
                        <label for="firstname" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="firstname" name="firstname" required>
                    </div>
                    <div class="mb-3">
                        <label for="middlename" class="form-label">Middle Name</label>
                        <input type="text" class="form-control" id="middlename" name="middlename">
                    </div>
                    <div class="mb-3">
                        <label for="lastname" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" required>
                    </div>
                    <div class="mb-3">
                        <label for="suffix" class="form-label">Suffix</label>
                        <input type="text" class="form-control" id="suffix" name="suffix">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" readonly>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveChanges">Save changes</button>
            </div>
        </div>
    </div>
</div>



<script>
    function w3_open() {
        document.getElementById("mySidebar").style.display = "block";
    }

    const modal = new bootstrap.Modal(document.getElementById('editProfileModal'));

        document.querySelector('[data-bs-toggle="modal"]').addEventListener('click', () => {
            // Populate the modal with the existing profile data
            document.getElementById('firstname').value = "{{ $profile->firstname }}";
            document.getElementById('middlename').value = "{{ $profile->middlename }}";
            document.getElementById('lastname').value = "{{ $profile->lastname }}";
            document.getElementById('suffix').value = "{{ $profile->suffix }}";
            document.getElementById('email').value = "{{ $profile->email }}"; // Read-only
            modal.show();
        });

        document.getElementById('saveChanges').addEventListener('click', function() {
            const formData = {
                firstname: document.getElementById('firstname').value,
                middlename: document.getElementById('middlename').value,
                lastname: document.getElementById('lastname').value,
                suffix: document.getElementById('suffix').value,
            };

            // AJAX request to save changes
            $.ajax({
                url: '{{ route('update.profile') }}',
                method: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    modal.hide();
                    Swal.fire({
                        icon: 'success',
                        title: 'Profile Updated',
                        text: response.success,
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
                    });
                }
            });
        });

</script>

@include('templates.oldstudentfooter')