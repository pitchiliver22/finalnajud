@include('templates.teacherheader')

<div id="main">
    <div class="w3-teal">
        <button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button>
        <div class="w3-container">
            <h1>Teacher Profile</h1>
        </div>
    </div>

    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-12 col-xl-4">

                    <div class="card" style="border-radius: 15px;">
                        <div class="card-body text-center">
                            <div class="mt-3 mb-4">
                                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava2-bg.webp"
                                    class="rounded-circle img-fluid" style="width: 100px;" />
                            </div>
                            <h4 class="mb-2">Claire Mae. Hear</h4>
                            <p class="text-muted mb-4">Elementary Teacher <span class="mx-2">|</span> <a
                                    href="#!">Teacherclaire@gmail.com</a></p>
                            <button type="button" data-mdb-button-init data-mdb-ripple-init
                                class="btn btn-primary btn-rounded btn-lg">
                                Edit
                            </button>
                            <div class="d-flex justify-content-between text-center mt-5 mb-2">
                                <div>
                                    <p class="mb-2 h5">5</p>
                                    <p class="text-muted mb-0">Total Class</p>
                                </div>
                                <div class="px-3">
                                    <p class="mb-2 h5">168</p>
                                    <p class="text-muted mb-0">Total Student</p>
                                </div>
                                <div>
                                    <p class="mb-2 h5">092343424</p>
                                    <p class="text-muted mb-0">Contact Details</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>

@include('templates.teacherfooter')
