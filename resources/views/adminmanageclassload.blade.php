@include('templates.Adminheader')
<style>
    body {
        background-color: #f8f9fa;
    }

    #main {
        padding: 20px;
    }

    h1, h2 {
        color: #343a40;
        margin-bottom: 1rem;
    }

    .form-label {
        font-weight: bold;
    }

    .form-control {
        border-radius: 0.5rem;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
    }

    .table thead th {
        background-color: #343a40;
        color: #ffffff;
    }

    .table tbody tr:hover {
        background-color: #f1f1f1;
    }

    .center {
        text-align: center;
        margin-top: 1rem;
    }

    @media (max-width: 576px) {
        .col {
            margin-bottom: 1rem;
        }
    }
</style>

<div id="main">
    <div class="container">
        <h1>Class Management</h1>

        <form action="principalclassload" method="">
            @csrf
            <div class="mb-3">
                <label for="grade" class="form-label">Grade</label>
                <select class="form-control" id="grade" name="grade" required>
                    <option value="">Select Grade</option>
                    <option value="K">Kindergarten</option>
                    @for ($i = 1; $i <= 10; $i++)
                        <option value="{{ $i }}">Grade {{ $i }}</option>
                    @endfor
                </select>
            </div>

            <div class="row">
                <div class="col">
                    <label for="section" class="form-label">Section</label>
                    <input type="text" class="form-control" id="section" name="section" required>
                </div>

                <div class="col">
                    <label for="room" class="form-label">Room</label>
                    <input type="text" class="form-control" id="room" name="room" required>
                </div>

                <div class="col">
                    <label for="subject" class="form-label">Subject</label>
                    <input type="text" class="form-control" id="subject" name="subject" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
            </div>

            <div class="row">
                <div class="col">
                    <label for="edpcode" class="form-label">Edp Code</label>
                    <input type="text" class="form-control" id="edpcode" name="edpcode" required>
                </div>
                <div class="col">
                    <label for="type" class="form-label">Type</label>
                    <input type="text" class="form-control" id="type" name="type" required>
                </div>

                <div class="col">
                    <label for="unit" class="form-label">Unit</label>
                    <input type="text" class="form-control" id="unit" name="unit" required>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label for="time" class="form-label">Time</label>
                    <input type="text" class="form-control" id="time" name="time" required>
                </div>

                <div class="col">
                    <label for="days" class="form-label">Days</label>
                    <input type="text" class="form-control" id="days" name="days" required>
                </div>
            </div>

            <div class="center">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>

        <hr>

        <h2>Class List</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Grade</th>
                    <th>Section</th>
                    <th>Room</th>
                    <th>Edp Code</th>
                    <th>Subject</th>
                    <th>Description</th>
                    <th>Type</th>
                    <th>Unit</th>
                    <th>Time</th>
                    <th>Days</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        <a href="#" class="btn btn-primary btn-sm">Edit</a>
                        <form action="/principalclassload" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@include('templates.Adminfooter')