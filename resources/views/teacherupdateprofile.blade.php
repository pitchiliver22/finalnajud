@include('templates.teacherheader')
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

    .navvers{
    background-color:rgba(8, 16, 66, 1); 
    border-width:0;
    color:white;
    padding:15px;

}
.navvers:hover{
    color:yellow;
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
    .card{
 
 padding:50px;
 /* background:linear-gradient(to bottom,rgba(8, 16, 66, 1),#1d2a78); */
 box-shadow: 0 2px 10px rgba(0, 0, 0, 0.7); 
}
.updatee{
    background-color:rgba(8, 16, 66, 1); 
    color: white;
    padding: 10px 20px;
    font-weight: bold;
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
    margin-bottom: 0px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5); 
}
.upload{
    background-color: #2b398f;
    color: white;
    border-width: 0;
    padding: 8px 20px;
    border-radius: 4px;
    width: auto;
}
.upload:hover{
    background-color:#0c0e54;
    color:white;
}
</style>


<div class="header-container"> 
            <button id="openNav" class="navvers" onclick="w3_open(event)">&#9776;</button>
            <h1>Update Profile</h1> 
        </div>
        <div id="main" onclick="w3_close()">

<section class="container-fluid py-5 bg-custom">
    <div class="row justify-content-center">
        <div class="col-md-9 col-lg-7 col-xl-6">
        <h5 class="updatee">Update Profile Picture</h5>
            <div class="card">
                <div class="card-body p-4">
                 

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
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

                    <form action="/teacherupdateprofile" method="POST" enctype="multipart/form-data">
                        @csrf
                    
                        <!-- Hidden input for profile_id -->
                        <input type="hidden" id="user_id" name="user_id" value="{{ Auth::user()->id }}">
                        <div class="mb-3">
                            <label for="profile_picture" class="form-label">Profile Picture</label>
                            <input type="file" class="form-control" id="profile_picture" name="profile_picture" required>
                        </div>
                    
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="upload">Upload</button>
                        </div>
                    </form>
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

@include('templates.teacherfooter')