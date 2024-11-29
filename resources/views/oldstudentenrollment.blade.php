    @include('templates.oldstudentheader')

    <style>
        body {
            background-color: #f7f9fc;
            font-family: Arial, sans-serif;
        }

        #main {
            padding: 20px;
        }

        .w3-teal {
            background-color: #007bff;
        }

        h1 {
            font-size: 2.5rem;
            margin: 0;
            color: white;
        }

        h2 {
            margin-bottom: 20px;
            font-size: 1.75rem;
            color: #343a40;
        }

        .list-group {
            border-radius: 0.5rem;
            overflow: hidden;
            box-shadow: 0 0.25rem 0.5rem rgba(0, 0, 0, 0.1);
        }

        .list-group-item {
            padding: 1.5rem;
            background-color: #ffffff;
            border: none;
            border-bottom: 1px solid #e9ecef;
            transition: box-shadow 0.3s ease-in-out, background-color 0.3s ease-in-out;
        }

        .list-group-item:last-child {
            border-bottom: none; 
        }

        .list-group-item:hover {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            background-color: #f8f9fa;
        }

        .fw-bold {
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
            color: #343a40;
        }

        .list-group-item p {
            font-size: 0.95rem;
            color: #6c757d;
        }

        .badge {
            font-size: 0.9rem;
            padding: 0.5rem 1rem;
        }

        .btn-secondary {
            font-size: 0.9rem;
            padding: 0.4rem 1rem;
        }

        /* Button styling */
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        /* Responsive adjustments */
        @media (max-width: 576px) {
            h2 {
                font-size: 1.5rem;
            }

            .list-group-item {
                padding: 1rem;
            }

            .fw-bold {
                font-size: 1rem;
            }
        }
    </style>

    <div id="main">
        <div class="w3-teal ">
            <button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button>
            <h1 style="text-align: center; margin: 20px 0;">Student Enrollment</h1>
        </div>
        
        <section class="container my-5">
    
            <div class="row">
                <div class="col-12">
                    <h2>Enrollment Steps</h2>
                    <form action="/oldstudentenrollment" method="GET">
                        <ol class="list-group list-group-numbered">
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">Admission and Parent Consent Form</div>
                                    <p>Completed the admission and parent consent form.</p>
                                </div>
                                <span class="badge bg-success rounded-pill">Completed</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">Records Approval</div>
                                    <p>Approval of student records by the school Records.</p>
                                </div>
                                <span class="badge bg-success rounded-pill">Completed</span>
                            </li>

                            @if (auth()->check() && auth()->user()->role == 'OldStudent')
                            @php
                                $studentDetail = \App\Models\studentdetails::where('details_id', $registerForm->id)->first();
                            @endphp
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">Student Details</div>
                                    <p>Provided detailed student information.</p>
                                </div>
                                <div>
                                @if ($studentDetail)
                                    @if ($studentDetail->status === 'approved')
                                        <span class="badge bg-success rounded-pill">Completed</span>
                                    @else
                                        <a href="{{ route('oldstudentupdatedetails.id', ['id' => $studentDetail->details_id]) }}" 
                                        class="btn btn-primary mt-3 rounded-pill updateInfoBtn">
                                        Confirm Information
                                        </a>
                                    @endif
                                @else
                                    <span>No student details found.</span>
                                @endif
                                </div>
                            </li>

                            @php
                            $address = \App\Models\address::where('address_id', $registerForm->id)->first();
                        @endphp
                        
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Address and Contact Details</div>
                                <p>Provided student's address and contact information.</p>
                            </div>
                            <div>
                                @if ($address)  
                                    @if ($address->status === 'approved')  
                                        <span class="badge bg-success rounded-pill">Completed</span>
                                    @else
                                        <a href="{{ route('oldstudentupdateaddress.id', ['id' => $studentDetail->details_id]) }}" 
                                        class="btn btn-primary mt-3 rounded-pill updateInfoBtn">
                                        Confirm Information
                                        </a>
                                    @endif
                                @else
                                    <span>No address details found.</span>  
                                @endif
                            </div>
                        </li>

                            @php
                                $previousSchool = \App\Models\previous_school::where('school_id', $registerForm->id)->first();
                            @endphp

                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">Previous School Details</div>
                                    <p>Provided information about the student's previous school.</p>
                                </div>
                                <div>
                                    @if ($previousSchool && $previousSchool->status === 'approved')
                                        <span class="badge bg-success rounded-pill">Completed</span>
                                    @else
                                        <a href="{{ route('oldstudentupdateprevious.id', ['id' => $school_id]) }}" 
                                        class="btn btn-primary mt-3 rounded-pill updateInfoBtn">
                                            Confirm Information
                                        </a>
                                    @endif
                                </div>
                            </li>

                            @php
                            $existingDocs = \App\Models\required_docs::where('required_id', $registerForm->id)->first();
                            @endphp

                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">Required Documents Upload</div>
                                    <p>Upload all the required documents for enrollment.</p>
                                </div>
                                <div>
                                    @if ($existingDocs && $existingDocs->status === 'approved')
                                        <span class="badge bg-success rounded-pill">Completed</span>
                                    @else
                                    <a href="/oldstudentupdatedocuments"
                                        class="btn btn-primary mt-3 rounded-pill updateInfoBtn">
                                        Upload Required Documents
                                    </a>
                                    @endif
                                </div>
                            </li>

                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">Cashier</div>
                                    @if($paymentStatus === 'pending') 
                                        <p>Your payment is pending approval.</p>
                                    @elseif($paymentStatus === 'approved')
                                        <p>Your payment has been approved!</p>
                                    @else
                                        <p>Waiting for the Cashier approval. Refresh to check approval.</p>
                                    @endif
                                </div>
                                @if($paymentStatus === 'approved')
                                    <button class="badge bg-success rounded-pill" disabled>
                                        Completed
                                    </button>
                                @elseif($paymentStatus === 'pending')
                                    <button class="badge bg-warning rounded-pill" disabled>
                                        Pending
                                    </button>
                                @else
                                    <a href="{{ url('oldstudentpayment') }}"
                                    class="btn btn-primary mt-3 rounded-pill updateInfoBtn">
                                        Upload Payment Proof
                                    </a>
                                @endif
                            </li>

                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">Sectioning</div>
                                    <p>Assign the student to a specific section or class.</p>
                                </div>
                                <div>
                                @if ($assignStatus === 'assigned')
                                    <span class="badge bg-success rounded-pill">Completed</span>
                                @else
                                    <span class="badge bg-warning rounded-pill">Pending</span>
                                @endif
                                </div>
                            </li>
                            @endif

                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">Officially Enrolled</div>
                                    <p>Officially enrolled in the school.</p>
                                </div>
                                <div>
                                    @if ($allCompleted)
                                        <span class="badge bg-success rounded-pill">Completed</span>
                                        <script>
                                            launchConfetti();
                                        </script>
                                    @else
                                        <span class="badge bg-warning rounded-pill">Pending</span>
                                    @endif
                                </div>
                            </li>
                        </ol>
                    </form>
                </div>
            </div>
        </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti/dist/confetti.browser.min.js"></script>

    <script>

    let confettiLaunched = false;

    const allCompleted = @json($allCompleted);
            if (allCompleted && !confettiLaunched) {
                launchConfetti();
                confettiLaunched = true; 
            }

        function launchConfetti() {
            const duration = 1 * 1000; 
            const animationEnd = Date.now() + duration;

            (function frame() {
                if (Date.now() > animationEnd) return;

                confetti({
                    particleCount: 40,
                    angle: 90,
                    spread: 70,
                    origin: {
                        x: Math.random(),
                        y: Math.random() - 0.2
                    },
                    scalar: 1.2
                });

                requestAnimationFrame(frame);
            })();
        }
    </script>


    @include('templates.oldstudentfooter')