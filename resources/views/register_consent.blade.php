<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <style>
        body {
            background-image: url('../image/people.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            background-color: rgba(1, 0, 66, 0.7);
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }

        h2 {
            margin-bottom: 20px;
            font-family: 'Arial', sans-serif;
            font-size: 2.5rem;
            font-weight: bold;
            color: white;
        }

        .btn-admission {
            background-color: rgba(1, 0, 34, 0.8);
            color: white; /* White text color */
            border: none; /* Remove default border */
        }

        .btn-admission:hover {
            background-color: rgba(11, 116, 11, 0.8);
            color: white;
        }

        .modal-content {
            border-radius: 15px;
        }
       
    </style>
</head>

<body>
    <div class="container">
        <div class="text-center">
            <h2>Welcome to Basic Education</h2>
            <button type="button" class="btn btn-admission" id="admissionBtn">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                    class="bi bi-bank me-2" viewBox="0 0 16 16">
                    <path
                        d="m8 0 6.61 3h.89a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5H15v7a.5.5 0 0 1 .485.38l.5 2a.498.498 0 0 1-.485.62H.5a.498.498 0 0 1-.485-.62l.5-2A.5.5 0 0 1 1 13V6H.5a.5.5 0 0 1-.5-.5v-2A.5.5 0 0 1 .5 3h.89zM3.777 3h8.447L8 1zM2 6v7h1V6zm2 0v7h2.5V6zm3.5 0v7h1V6zm2 0v7H12V6zM13 6v7h1V6zm2-1V4H1v1zm-.39 9H1.39l-.25 1h13.72z" />
                </svg>
                Click for Admission
            </button>
        </div>
    </div>

    <!-- Parent Consent Form Modal -->
    <div class="modal fade" id="consentModal" tabindex="-1" aria-labelledby="consentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="consentModalLabel">PARENT CONSENT FORM</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>I, <span id="displayParentName">[Parent/Guardian's Name]</span>, hereby give my consent for my
                        child, <span id="displaystudentname">[student's name]</span>, to
                        participate
                        in the University of Cebu Lapu-Lapu and Mandaue.</p>

                    <p>I understand the details of the activity, including any potential risks involved, and I am
                        satisfied with the safety precautions put in place by the organizers.</p>

                    <p>I agree that my child will follow all instructions and guidelines provided during the activity. I
                        also grant permission for my child's photograph or video to be taken and used for promotional or
                        educational purposes by the organizers.</p>

                    <p>In case of an emergency, I authorize the organizers to take necessary actions, including seeking
                        medical treatment for my child, if required.</p>

                    <p>I hereby release the organizers from any liability for any injuries or accidents that may occur
                        during the activity, unless caused by their negligence or intentional misconduct.</p>

                    <div class="mb-3">
                        <label for="parentName" class="form-label">Parent/Guardian's Name:</label>
                        <input type="text" class="form-control" id="parentName"
                            placeholder="Enter parent/guardian's name" required>
                    </div>

                    <div class="mb-3">
                        <label for="studentname" class="form-label">Student Name:</label>
                        <input type="text" class="form-control" id="studentname" placeholder="Enter Student name"
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="emergencyContact" class="form-label">Emergency Contact Information:</label>
                        <input type="text" class="form-control" id="emergencyContact"
                            placeholder="Enter emergency contact details" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a href="/partialaccount"><button type="button" class="btn btn-primary" id="submit"
                            name="submit">Submit</button></a>
                </div>
            </div>
        </div>
    </div>

    <script>
        const admissionBtn = document.getElementById('admissionBtn');
        const consentModal = new bootstrap.Modal(document.getElementById('consentModal'), {
            keyboard: false
        });

        admissionBtn.addEventListener('click', () => {
            consentModal.show();
        });

        const parentNameInput = document.getElementById('parentName');
        const displayParentName = document.getElementById('displayParentName');

        const studentnameInput = document.getElementById('studentname');
        const displaystudentname = document.getElementById('displaystudentname');

        parentNameInput.addEventListener('input', () => {
            const parentName = parentNameInput.value;
            displayParentName.textContent = parentName;


        });

        studentnameInput.addEventListener('input', () => {
            const studentname = studentnameInput.value;
            displaystudentname.textContent = studentname;


        });

        const submitBtn = document.getElementById('submitBtn');
        submitBtn.addEventListener('click', () => {
            const parentName = document.getElementById('parentName').value;
            const studentname = document.getElementById('studentname').value;
            const emergencyContact = document.getElementById('emergencyContact').value;

            // You can add your logic to handle the form submission here
            console.log('Parent Name:', parentName);
            console.log('Student Name:', studentname);
            console.log('Emergency Contact:', emergencyContact);

            consentModal.hide();
        });
    </script>
</body>

</html>
