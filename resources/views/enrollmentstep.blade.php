@include('templates.studentheader')

<style>
    .list-group-item {
        padding: 1.5rem;
        border-radius: 0.5rem;
        box-shadow: 0 0.25rem 0.5rem rgba(0, 0, 0, 0.1);
        transition: box-shadow 0.3s ease-in-out, background-color 0.3s ease-in-out;
    }

    .list-group-item:hover {
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        background-color: #f8f9fa;
        /* Light background on hover */
    }

    .list-group-item .fw-bold {
        font-size: 1.2rem;
        margin-bottom: 0.5rem;
    }

    .list-group-item p {
        font-size: 0.95rem;
        color: #6c757d;
    }

    .list-group-item .badge {
        font-size: 0.9rem;
        padding: 0.5rem 1rem;
    }

    .list-group-item .btn-secondary {
        font-size: 0.9rem;
        padding: 0.4rem 1rem;
    }

    /* Responsive adjustments */
    @media (max-width: 576px) {
        .list-group-item {
            padding: 1rem;
        }

        .list-group-item .fw-bold {
            font-size: 1rem;
        }
    }
</style>

<div id="main">
    <div class="w3-teal">
        <button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button>
        <div class="w3-container">
            <h1 class="text-center text-light">STUDENT ENROLLMENT</h1>
        </div>
    </div>

    <section class="container my-5">
        <div class="row">
            <div class="col-12">
                <h2 class="mb-4">Enrollment Steps</h2>
                <form action="/enrollmentsteps" method="GET">
                    <ol class="list-group list-group-numbered">
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Admission and Parent Consent Form</div>
                                <p class="mb-0">Completed the admission and parent consent form.</p>
                            </div>
                            <div>
                                <span class="badge bg-success rounded-pill">Completed</span>
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Records Approval</div>
                                <p class="mb-0">Approval of student records by the school Records.</p>
                            </div>
                            <div>
                                <span class="badge bg-success rounded-pill">Completed</span>
                            </div>
                        </li>

                        @if (auth()->check() && auth()->user()->role == 'Oldstudent')
                            @php
                                // Fetch the student details directly
                                $studentDetail = \App\Models\StudentDetails::where(
                                    'details_id',
                                    auth()->user()->id,
                                )->first();
                            @endphp

                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">Student Details</div>
                                    <p class="mb-0">Provided detailed student information.</p>
                                </div>
                                <div>
                                    @if ($studentDetail && $studentDetail->status === 'approved')
                                        <span class="badge bg-success rounded-pill"
                                            aria-label="Status: Completed">Completed</span>
                                    @else
                                        <a href="/updatedetails/{{ auth()->user()->id }}"
                                            class="btn btn-primary mt-3 rounded-pill updateInfoBtn"
                                            data-url="updatedetails"
                                            aria-label="Confirm Information for Student ID {{ auth()->user()->id }}">
                                            Confirm Information
                                        </a>
                                    @endif
                                </div>
                            </li>


                            @php
                                // Fetch the student details directly
                                $address = \App\Models\address::where('address_id', auth()->user()->id)->first();
                            @endphp
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">Address and Contact Details</div>
                                    <p class="mb-0">Provided student's address and contact information.</p>
                                </div>
                                <div>
                                    @if ($address && $address->status === 'approved')
                                        <span class="badge bg-success rounded-pill"
                                            aria-label="Status: Completed">Completed</span>
                                    @else
                                        <a href="/updateaddress/{{ auth()->user()->id }}"
                                            class="btn btn-primary mt-3 rounded-pill updateInfoBtn"
                                            data-url="updateaddress"
                                            aria-label="Confirm Information for Student ID {{ auth()->user()->id }}">
                                            Confirm Information
                                        </a>
                                    @endif
                                </div>
                            </li>


                            @php
                                // Fetch the student details directly
                                $previousSchool = \App\Models\previous_school::where(
                                    'school_id',
                                    auth()->user()->id,
                                )->first();
                            @endphp
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">Previous School Details</div>
                                    <p class="mb-0">Provided information about the student's previous school.</p>
                                </div>
                                <div>
                                    @if ($previousSchool && $previousSchool->status === 'approved')
                                        <span class="badge bg-success rounded-pill"
                                            aria-label="Status: Completed">Completed</span>
                                    @else
                                        <a href="/updateschool/{{ auth()->user()->id }}"
                                            class="btn btn-primary mt-3 rounded-pill updateInfoBtn"
                                            data-url="updateschool"
                                            aria-label="Confirm Information for Student ID {{ auth()->user()->id }}">
                                            Confirm Information
                                        </a>
                                    @endif
                                </div>
                            </li>

                            @php
                                // Fetch the required documents for the authenticated user
                                $existingDocs = \App\Models\required_docs::where(
                                    'required_id',
                                    auth()->user()->required_id,
                                )->first();
                            @endphp

                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">Required Documents Upload</div>
                                    <p class="mb-0">Uploaded all the required documents for enrollment.</p>
                                </div>
                                <div>
                                    @if ($existingDocs && $existingDocs->status === 'approved')
                                        <span class="badge bg-success rounded-pill"
                                            aria-label="Status: Completed">Completed</span>
                                    @else
                                        <a href="{{ route('updatedocuments', ['id' => auth()->user()->id]) }}"
                                            class="btn btn-primary mt-3 rounded-pill updateInfoBtn"
                                            data-url="updatedocuments"
                                            aria-label="Confirm Information for Student ID {{ auth()->user()->id }}">
                                            Confirm Information
                                        </a>
                                    @endif
                                </div>
                            </li>
                        @endif

                        @php
                            // Fetch the payment form associated with the user
                            $paymentForm = App\Models\payment_form::where('payment_id', auth()->user()->id)->first();
                            $paymentStatus = $paymentForm ? $paymentForm->status : null; // Handle case where payment form is not found
                        @endphp

                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Cashier</div>
                                <p class="mb-0">Waiting for the Cashier approval. Refresh to check approval.</p>
                                @if ($paymentStatus === 'pending')
                                    <small class="text-muted">You will be notified once the payment is approved.</small>
                                @endif
                            </div>
                            <div>
                                @if ($paymentStatus === 'approved')
                                    <span class="badge bg-success rounded-pill">Completed</span>
                                @elseif ($paymentStatus === 'pending')
                                    <span class="badge bg-warning rounded-pill">Pending</span>
                                @else
                                    <span class="badge bg-danger rounded-pill">Not Found</span>
                                    <!-- Handle unexpected status -->
                                @endif
                            </div>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Sectioning</div>
                                <p class="mb-0">Assign the student to a specific section or class.</p>
                            </div>
                            <div>
                                @if (session('assigningStatus') === 'assigned')
                                    <span class="badge bg-success rounded-pill">Completed</span>
                                @else
                                    <span class="badge bg-warning rounded-pill">Pending</span>
                                @endif
                            </div>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Officially Enrolled</div>
                                <p class="mb-0">Officially enrolled in the school.</p>
                            </div>
                            <div>
                                @php
                                    // Check if all required steps are completed
                                    $allCompleted = true;

                                    // Check each step's status
if ($paymentStatus !== 'approved') {
    $allCompleted = false;
}
if (session('assigningStatus') !== 'assigned') {
    $allCompleted = false;
}
// Add checks for other sections as needed
if (
    session('DetailsUpdateStatus') !== 'student_details' ||
    session('AddressUpdateStatus') !== 'address' ||
    session('SchoolUpdateStatus') !== 'school' ||
    session('docsUpdateStatus') !== 'docs'
                                    ) {
                                        $allCompleted = false;
                                    }
                                @endphp

                                @if ($allCompleted)
                                    <span class="badge bg-success rounded-pill">Completed</span>
                                @else
                                    <span class="badge bg-warning rounded-pill">Pending</span>
                                @endif
                            </div>
                        </li>
                    </ol>
                    <a href="#" class="btn btn-primary mt-3">Review Submitted Details</a>
                </form>
            </div>
        </div>
    </section>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/canvas-confetti/dist/confetti.browser.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.updateInfoBtn').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();

                const url = this.getAttribute('href');
                const dataUrl = this.getAttribute('data-url');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You will be redirected to update your information. PS: You can't update your information again once submitted.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'OK',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        setTimeout(() => {
                            window.location.href = '/' + dataUrl + '/' +
                                {{ auth()->user()->id }};
                        }, 1000);
                    }
                });
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        // Check for session variables
        const paymentStatus = @json(session('paymentStatus')); // Convert PHP variable to JavaScript
        const assigningStatus = @json(session('assigningStatus')); // Convert PHP variable to JavaScript

        // Show payment approved alert if payment status is approved
        if (paymentStatus === 'approved') {
            Swal.fire({
                title: 'Payment Approved!',
                text: "The payment has been successfully approved.",
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(() => {
                // After the first alert is closed, check for sectioning approval
                if (assigningStatus === 'assigned') {
                    Swal.fire({
                        title: 'Sectioning Approved!',
                        text: "The sectioning has been successfully approved.",
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                }
            });
        } else if (assigningStatus === 'assigned') {
            // If payment is not approved but sectioning is
            Swal.fire({
                title: 'Sectioning Approved!',
                text: "The sectioning has been successfully approved.",
                icon: 'success',
                confirmButtonText: 'OK'
            });
        }

        // Check if all steps are completed to show confetti
        const allCompleted = @json($allCompleted); // Ensure this variable is set in your blade file
        if (allCompleted) {
            launchConfetti();
        }
    });

    // Function to launch confetti
    function launchConfetti() {
        const duration = 1 * 1000; // Duration of the confetti effect in milliseconds
        const animationEnd = Date.now() + duration;

        (function frame() {
            // Check if the animation duration has ended
            if (Date.now() > animationEnd) return;

            // Launch confetti from random positions
            confetti({
                particleCount: 40,
                angle: 90,
                spread: 70,
                origin: {
                    x: Math.random(),
                    y: Math.random() - 0.2
                }, // Randomize origin
                scalar: 1.2 // Size of confetti pieces
            });

            // Request another frame
            requestAnimationFrame(frame);
        })();
    }
</script>

@include('templates.studentfooter')
