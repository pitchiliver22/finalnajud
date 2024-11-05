@include('templates.cashierheader')

<style>
    .payment-proof-image {
        width: 185px;
        display: block;
        margin: 10px 0;
        border: 2px solid #ddd;
        border-radius: 4px;
        padding: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    /* Main content styles */
    #main {
        background-color: #f8f9fa;
        padding: 20px;
    }

    /* Teal header styles */


    .w3-teal h1 {
        font-size: 24px;
        font-weight: bold;
    }

    /* Form styles */
    .form-group {
        margin-bottom: 20px;
    }

    .form-control {
        border-color: #ddd;
        border-radius: 4px;
    }

    .btn-primary {
        background-color: #008080;
        border-color: #008080;
    }

    .btn-primary:hover {
        background-color: #006060;
        border-color: #006060;
    }
</style>


<div id="main">
    <div class="w3-teal">
        <button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button>
        <div class="w3-container">
            <h1>Proof of Payment</h1>
        </div>
    </div>

    <div class="container my-5">
        <h1 class="text-center mb-4">Proof Of Payment</h1>
        <form id="paymentForm" action="/proofofpayment/{{ $proof->id }}" method="POST">
            @csrf
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" value="{{ $student->firstname }}" readonly
                        required>
                </div>
                <div class="form-group col-md-4">
                    <label for="id-number">ID Number</label>
                    <input type="text" class="form-control" id="id-number" value="12321321" readonly required>
                </div>
                <div class="form-group col-md-4">
                    <label for="grade-level">Grade Level</label>
                    <input type="text" class="form-control" id="grade-level" value="{{ $proof->level }}" readonly
                        required>
                </div>
            </div>

            <div class="form-group">
                <label for="fee-type">Fee Type</label>
                <input type="text" class="form-control" id="fee-type" value="{{ $proof->fee_type }}" readonly
                    required>
            </div>
            <div class="form-group">
                <label for="amount">Amount</label>
                <input type="number" class="form-control" id="amount" value="{{ $proof->amount }}" readonly
                    required>
            </div>

            <div class="form-group">
                <label for="payment-proof">Payment Proof (Image)</label>
                <br>
                <img src="{{ asset('storage/' . $proof->payment_proof) }}" alt="Payment Proof" class="img-fluid"
                    style="max-width: 700px;" id="paymentProofImage" data-toggle="modal" data-target="#imageModal">
            </div>
            <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="imageModalLabel">Payment Proof</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <img src="{{ asset('storage/' . $proof->payment_proof) }}" alt="Payment Proof"
                                class="img-fluid" id="modalImage" style="width: 100%;">
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="payment-details">Payment Details</label>
                <textarea class="form-control" id="payment-details" rows="3" required readonly>{{ $proof->payment_details }}</textarea>
            </div>
            <br>

            <div class="row justify-content-center">
                @if ($proof->status === 'pending')
                    <div class="col-md-1">
                        <button type="button" class="btn btn-primary btn-block" id="approveButton">Approve</button>
                    </div>
                @endif
            </div>
        </form>
    </div>
</div>

<!-- Include SweetAlert library -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const approveButton = document.getElementById('approveButton');
        const paymentForm = document.getElementById('paymentForm');

        approveButton.addEventListener('click', function(event) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You are about to approve this payment.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, approve it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If confirmed, submit the form
                    paymentForm.submit();
                }
            });
        });
    });
</script>

@include('templates.cashierfooter')
