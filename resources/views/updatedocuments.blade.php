<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Required Documents Upload</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <style>
        .image-container {
            display: inline-block;
            position: relative;
            margin: 15px;
        }

        .image-container img {
            width: 2in;
            height: 2in;
            object-fit: cover;
            border: 1px solid #ccc;
            border-radius: 5px;
            cursor: pointer;
        }

        #image-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        #modal-image {
            max-width: 90%;
            max-height: 90%;
            width: auto;
            height: auto;
        }

        .document-card {
            cursor: pointer;
        }
    </style>
</head>

<body>
    <form action="/updatedocuments" method="POST" enctype="multipart/form-data" class="container mt-4">
        @csrf
        <div class="upload-container mb-4 p-4 border rounded bg-light shadow-sm">
            <h2 class="mb-3">Required Documents Upload</h2>
            <p class="text-muted">Scanned copies must be clear and legible. Each file must not exceed 10MB.</p>
            <div class="file-input mb-3">
                <label for="document-upload" class="form-label">Select Document</label>
                <select name="type[]" class="form-select">
                    <option value="" disabled selected>Select document type</option>
                    <option value="F-138A or Report Card">F-138A or Report Card</option>
                    <option value="Certificate of Good Moral Character">Certificate of Good Moral Character</option>
                    <option value="Birth Certificate in Security Paper(NSO)">Birth Certificate in Security Paper(NSO)</option>
                    <option value="Medical Certificate">Medical Certificate</option>
                    <option value="2 pcs of latest and 2x2 colored picture">2 pcs of latest and 2x2 colored picture</option>
                    <option value="Other">Other</option>
                </select>
                <input type="file" name="documents[]" accept=".pdf,.jpg,.png" class="form-control mt-2">
                <div class="error-message text-danger" id="file-error"></div>
            </div>
            <input type="hidden" id="required_id" name="required_id" value="{{ $registerForm->id }}">
            <div id="additional-uploads"></div>
            <button type="button" class="btn btn-secondary mb-2" onclick="addAnotherUpload()">Add Another Upload</button>
            <button type="submit" name="submit" class="btn btn-success" id="submit-button">Upload</button>
        </div>

        <div class="upload-container mb-4 p-4 border rounded bg-light shadow-sm">
            <h2 class="mb-3">Uploaded Documents</h2>
            @if ($docs && count($docs) > 0)
                <div class="row">
                    @foreach ($docs as $doc)
                        <div class="col-md-4 mb-3">
                            <div class="card text-center document-card" onclick="openModal('{{ asset('storage/' . $doc->documents) }}')">
                                <div class="card-body">
                                    <p><strong>Type:</strong> {{ $doc->type }}</p>
                                    <img src="{{ asset('storage/' . $doc->documents) }}"
                                        alt="{{ $doc->documents }}" class="img-fluid document-img">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p>No required documents available.</p>
            @endif
        </div>

        <!-- Modal for enlarged image -->
        <div id="image-modal" class="modal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Enlarged Document</h5>
                        <button type="button" class="btn-close" onclick="closeModal()"></button>
                    </div>
                    <div class="modal-body text-center">
                        <img id="modal-image" src="" alt="Enlarged Document" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" name="done" class="btn btn-success" id="done-button">Done</button>
    </form>

    <script>
        function openModal(imageSrc) {
            const modal = document.getElementById('image-modal');
            const modalImage = document.getElementById('modal-image');
            modalImage.src = imageSrc;
            modal.style.display = 'flex'; // Use flex to open modal
        }

        function closeModal() {
            const modal = document.getElementById('image-modal');
            modal.style.display = 'none'; // Hide modal
        }

        function addAnotherUpload() {
            const additionalUploads = document.getElementById('additional-uploads');
            const newUpload = document.createElement('div');
            newUpload.className = 'file-input mb-3';

            const label = document.createElement('label');
            label.textContent = 'Select Document';
            label.className = 'form-label';
            newUpload.appendChild(label);

            const select = document.createElement('select');
            select.name = 'type[]';
            select.className = 'form-select';
            select.required = true;
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
            fileInput.name = 'documents[]';
            fileInput.accept = '.pdf,.jpg,.png';
            fileInput.className = 'form-control mt-2';
            fileInput.required = true;
            newUpload.appendChild(fileInput);

            additionalUploads.appendChild(newUpload);
        }
    </script>
</body>

</html>