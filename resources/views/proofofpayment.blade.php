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
        <form>
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="fee-type">Name</label>
                    <input type="text" class="form-control" id="fee-type" value="oliver Lambo Batan" readonly
                        required>
                </div>
                <div class="form-group col-md-4">
                    <label for="fee-type">ID Number</label>
                    <input type="text" class="form-control" id="fee-type" value="2343243 " readonly required>
                </div>
                <div class="form-group col-md-4">
                    <label for="fee-type">Grade Level</label>
                    <input type="text" class="form-control" id="fee-type" value="Grade 1 " readonly required>
                </div>
            </div>

            <div class="form-group">
                <label for="fee-type">Fee Type</label>
                <input type="text" class="form-control" id="fee-type" value="Enrollment Fee" readonly required>
            </div>
            <div class="form-group">
                <label for="amount">Amount</label>
                <input type="number" class="form-control" id="amount" placeholder="500" readonly required>
            </div>
            <div class="form-group">
                <label for="payment-proof">Payment Proof (Image)</label>

                <img src="https://erepublic.brightspotcdn.com/dims4/default/…a2071cf7a016cadf%2Fshutterstock-cash-payments.jpg"
                    class="payment-proof-image" alt="proof" style="width: 185px;">
            </div>

            <div class="form-group">
                <label for="payment-details">Payment Details</label>
                <textarea class="form-control" id="payment-details" rows="3" required readonly></textarea>
            </div>
            <br>

            <div class="row justify-content-center">
                <div class="col-md-1">
                    <button type="submit" name="submit" class="btn btn-primary btn-block">Approve</button>
                </div>
            </div>
        </form>
    </div>
</div>

@include('templates.cashierfooter')
