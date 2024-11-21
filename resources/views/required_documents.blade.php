<!DOCTYPE html>
<html>

<head>
    <title>Required Documents Upload</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <style>
        .upload-container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .file-input {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .file-input label {
            display: inline-block;
            font-weight: bold;
            margin-right: 10px;
            width: 150px;
        }

        .file-input select {
            padding: 8px 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
            width: 200px;
            margin-right: 10px;
        }

        .file-input input[type="file"] {
            padding: 8px 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
            width: 300px;
        }

        .error-message {
            color: red;
            font-weight: bold;
            margin-left: 10px;
        }

        .submit-button {
            display: block;
            margin: 20px 0 0 0;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        #additional-uploads {
            margin-top: 20px;
        }

        #additional-uploads .file-input {
            margin-bottom: 10px;
        }

        .add-upload-button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 20px;
            display: inline-block;
        }

        .btn-upload {
            display: inline-block;
            margin-left: 10px;
        }

        .requirements {
            margin-top: 20px;
            padding: 10px;
            border: 1px solid #007bff;
            border-radius: 5px;
            background-color: #e9f7ff;
        }
    </style>
</head>

<body>
    <div class="upload-container">
        <h2>Required Documents Upload</h2>
        <p>Scanned copies must be clear and legible. Each file must not exceed 10MB.</p>
        <p>Accepted file formats for 2x2 ID Picture are jpg/png; all documents should be in pdf format.</p>
        <p>If your NSO / PSA Birth Certificate original copy is not clear/legible, you are required to upload a Local
            Civil Registrar (LCR).</p>
        <p>If you have an ESC Grantee Certificate, please include it in your uploads.</p>
        <p>Please upload at least one (1) document.</p>

        <form action="/required_documents" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="file-input">
                <label for="student-type">Select Student Type</label>
                <select id="student-type" name="student_type" onchange="showRequirements()" required>
                    <option value="" disabled selected>Select student type</option>
                    <option value="New Students">New Students</option>
                    <option value="Nursery">Nursery</option>
                    <option value="Old & Returnee Students">Old & Returnee Students</option>
                    <option value="Transferee Students">Transferee Students</option>
                </select>
            </div>

            <div class="requirements" id="requirements" style="display: none;"></div>

            <div class="file-input">
                <label for="document-upload">Select Document</label>
                <select name="type[]" required>
                    <option value="" disabled selected>Select document type</option>
                    <option value="F-138A or Report Card">F-138A or Report Card</option>
                    <option value="Certificate of Good Moral Character">Certificate of Good Moral Character</option>
                    <option value="Birth Certificate in Security Paper(NSO)">Birth Certificate in Security Paper(NSO)</option>
                    <option value="Medical Certificate">Medical Certificate</option>
                    <option value="2 pcs of latest and 2x2 colored picture">2 pcs of latest and 2x2 colored picture</option>
                    <option value="Other">Other</option>
                </select>
                <input type="file" name="documents[]" accept=".pdf,.jpg,.png" required>
                <div class="error-message" id="file-error"></div>
            </div>


            <input type="hidden" id="required_id" name="required_id" value="{{ $registerForm->id }}">
            <div id="additional-uploads"></div>
            <button type="button" class="add-upload-button" onclick="addAnotherUpload()">Add Another Upload</button>
            <button type="submit" name="submit" class="btn btn-success" id="submit-button">Upload</button>
        </form>
    </div>

    <script>
        function showRequirements() {
            const studentType = document.getElementById('student-type').value;
            const requirementsDiv = document.getElementById('requirements');
            let requirementsText = '';

            switch (studentType) {
                case 'New Students':
                    requirementsText = `
                        <strong>Requirements:</strong>
                        <ul>
                            <li>F-138A or Report Card</li>
                            <li>Certificate of Good Moral Character</li>
                            <li>Birth Certificate in Security Paper (NSO)</li>
                            <li>Medical Certificate</li>
                            <li>2 pcs of latest and colored picture</li>
                        </ul>`;
                    break;
                case 'Nursery':
                    requirementsText = `
                        <strong>Requirements:</strong>
                        <ul>
                            <li>Birth Certificate in Security Paper (NSO)</li>
                            <li>Medical Certificate</li>
                            <li>2 pcs of latest and colored picture</li>
                        </ul>`;
                    break;
                case 'Old & Returnee Students':
                    requirementsText = `
                        <strong>Requirements:</strong>
                        <ul>
                            <li>F-138A or Report Card</li>
                            <li>Clearance</li>
                        </ul>`;
                    break;
                case 'Transferee Students':
                    requirementsText = `
                        <strong>Requirements:</strong>
                        <ul>
                            <li>F-138A or Report Card</li>
                            <li>Certificate of Good Moral Character</li>
                            <li>Birth Certificate in Security Paper (NSO)</li>
                            <li>Medical Certificate</li>
                            <li>2 pcs of latest and colored picture</li>
                        </ul>`;
                    break;
                default:
                    requirementsText = '';
            }

            requirementsDiv.innerHTML = requirementsText;
            requirementsDiv.style.display = requirementsText ? 'block' : 'none';
        }

        function addAnotherUpload() {
    const additionalUploads = document.getElementById('additional-uploads');
    const newUpload = document.createElement('div');
    newUpload.className = 'file-input';

    const label = document.createElement('label');
    label.textContent = 'Select Document';
    newUpload.appendChild(label);

    const select = document.createElement('select');
    select.name = 'type[]';
    select.required = true; // Ensure each new upload has a type
    select.innerHTML = `
        <option value="" disabled selected>Select document type</option>
        <option value="F-138A or Report Card">F-138A or Report Card</option>
        <option value="Certificate of Good Moral Character">Certificate of Good Moral Character</option>
        <option value="Birth Certificate in Security Paper(NSO)">Birth Certificate in Security Paper(NSO)</option>
        <option value="Medical Certificate">Medical Certificate</option>
        <option value="2 pcs of latest and 2x2 colored picture">2 pcs of latest and 2x2 colored picture</option>
        <option value="Other">Other</option>
    `;
    newUpload.appendChild(select);

    const fileInput = document.createElement('input');
    fileInput.type = 'file';
    fileInput.name = 'documents[]'; // This allows multiple files to be uploaded
    fileInput.accept = '.pdf,.jpg,.png';
    fileInput.required = true; // Ensure each file input is required
    newUpload.appendChild(fileInput);

    const errorMessage = document.createElement('div');
    errorMessage.className = 'error-message';
    newUpload.appendChild(errorMessage);

    additionalUploads.appendChild(newUpload);
}
    </script>
</body>

</html>