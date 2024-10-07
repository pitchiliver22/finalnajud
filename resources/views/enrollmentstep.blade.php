@include('templates.studentheader')

<style>
    .list-group-item {
        padding: 1.5rem;
        border-radius: 0.5rem;
        box-shadow: 0 0.25rem 0.5rem rgba(0, 0, 0, 0.1);
        transition: box-shadow 0.3s ease-in-out;
    }

    .list-group-item:hover {
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }

    .list-group-item .fw-bold {
        font-size: 1.1rem;
        margin-bottom: 0.5rem;
    }

    .list-group-item p {
        font-size: 0.95rem;
        color: #6c757d;
    }

    .list-group-item .badge {
        font-size: 0.8rem;
        padding: 0.5rem 0.8rem;
    }

    .list-group-item .btn-secondary {
        font-size: 0.8rem;
        padding: 0.3rem 0.8rem;
    }
</style>
<div id="main">
    <div class="w3-teal">
        <button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button>
        <div class="w3-container">
            <h1>STUDENT ENROLLMENT</h1>
        </div>
    </div>

    <section class="container my-5">
        <div class="row">
            <div class="col-12">
                <h2>Enrollment Steps</h2>
                <form action="/enrollmentsteps" method="GET">
                    <ol class="list-group list-group-numbered">
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold"> Admission and Parent Consent Form</div>
                                <p class="mb-0">Completed the admission and parent consent form.</p>
                            </div>
                            <div>
                                <span class="badge bg-success rounded-pill">Completed</span>

                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold"> Records Approval</div>
                                <p class="mb-0">Approval of student records by the school Records.</p>
                            </div>
                            <div>
                                <span class="badge bg-success rounded-pill">Completed</span>

                            </div>
                        </li>

                        @if (auth()->check())
                            @if (auth()->user()->role == 'Oldstudent')
                                @csrf
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold"> Student Details</div>
                                        <p class="mb-0">Provided detailed student information.</p>
                                    </div>
                                    <div>
                                        <a href="/updatedetails/{{ auth()->user()->id }}"
                                            class="btn btn-primary mt-3 rounded-pill">Update Information</a>
                                    </div>
                                </li>


                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold"> Address and Contact Details</div>
                                        <p class="mb-0">provided student's address and contact information.</p>
                                    </div>
                                    <div>
                                        <a href="/updateaddress/{{ auth()->user()->id }}"
                                            class="btn btn-primary mt-3 rounded-pill">Update Information</a>
                                    </div>
            </div>
            </li>

            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div class="fw-bold"> Previous School Details</div>
                    <p class="mb-0">Provided information about the student's previous school.</p>
                </div>
                <div>
                    <a href="/updateschool/{{ auth()->user()->id }}" class="btn btn-primary mt-3 rounded-pill">Update
                        Information</a>
                </div>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div class="fw-bold"> Required Documents Upload</div>
                    <p class="mb-0">Uploaded all the required documents for enrollment.</p>
                </div>
                <div>
                    <a href="/updatedocuments/{{ auth()->user()->id }}" class="btn btn-primary mt-3 rounded-pill">Update
                        Information</a>


                </div>
            </li>
            @endif
            @endif



            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div class="fw-bold"> Cashier (Pending)</div>
                    <p class="mb-0">waiting for the Cashier approval.</p>
                </div>
                <div>
                    <span class="badge bg-warning rounded-pill">Pending</span>

                </div>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div class="fw-bold"> Sectioning (Pending)</div>
                    <p class="mb-0">Assign the student to a specific section or class.</p>
                </div>
                <div>
                    <span class="badge bg-warning rounded-pill">Pending</span>

                </div>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div class="fw-bold"> Officially Enrolled</div>
                    <p class="mb-0">officially enrolled in the school.</p>
                </div>
                <div>
                    <span class="badge bg-warning rounded-pill">pending</span>

                </div>
            </li>
            </ol>
            <a href="#" class="btn btn-primary mt-3">Review Submitted Details</a>
            </form>
        </div>
</div>
</section>
</div>
@include('templates.studentfooter')
