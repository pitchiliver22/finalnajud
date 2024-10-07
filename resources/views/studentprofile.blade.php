@include('templates.studentheader')

<div id="main">
    <div class="w3-teal">
        <button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button>
        <div class="w3-container">
            <h1>Student Profile</h1>
        </div>
    </div>


    <section class="container-fluid py-5" style="background-color: #9de2ff;">
        <div class="row justify-content-center">
            <div class="col-md-9 col-lg-7 col-xl-6">
                <div class="card rounded-3" style="border-radius: 15px;">
                    <div class="card-body p-4">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-profiles/avatar-1.webp"
                                    alt="Generic placeholder image" class="img-fluid rounded-circle"
                                    style="width: 180px;">
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5 class="mb-1">Oliver Pacatang</h5>
                                <p class="mb-2 pb-1">Student ID: 232023</p>
                                <div class="d-flex justify-content-between rounded-3 p-2 mb-2 bg-body-tertiary">
                                    <div>
                                        <p class="small text-muted mb-1">Grade Level</p>
                                        <p class="mb-0">grade 10</p>
                                    </div>
                                    <div>
                                        <p class="small text-muted mb-1">Email</p>
                                        <p class="mb-0">oliver@gmail.com</p>
                                    </div>
                                    <div>
                                        <p class="small text-muted mb-1">Phone Number</p>
                                        <p class="mb-0">09437653482</p>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end pt-1">
                                    <button type="button" class="btn btn-primary">Edit Profile</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


@include('templates.studentfooter')
