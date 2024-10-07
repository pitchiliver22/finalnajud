@include('templates.Adminheader')
<style>
    .center {
        text-align: center;
        margin-top: 1rem;
    }
</style>
<div id="main">

    <div class="container">
        <h1>Class Management</h1>

        <form action="principalclassload" method="">
            @csrf
            <div class="col">
                <label for="grade">Grade</label>
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
                    <label for="section">Section</label>
                    <input type="text" class="form-control" id="section" name="section" required>
                </div>


                <div class="col">
                    <label for="room">Room</label>
                    <input type="text" class="form-control" id="room" name="room" required>
                </div>

                <div class="col">
                    <label for="subject">Subject</label>
                    <input type="text" class="form-control" id="subject" name="subject" required>
                </div>
            </div>

            <div class="col">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
            </div>
            <div class="row">
                <div class="col">
                    <label for="edpcode">Edp Code</label>
                    <input type="text" class="form-control" id="edpcode" name="edpcode" required>
                </div>
                <div class="col">
                    <label for="type">Type</label>
                    <input type="text" class="form-control" id="type" name="type" required>
                </div>

                <div class="col">
                    <label for="unit">Unit</label>
                    <input type="text" class="form-control" id="unit" name="unit" required>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="time">Time</label>
                    <input type="text" class="form-control" id="time" name="time" required>
                </div>

                <div class="col">
                    <label for="days">Days</label>
                    <input type="text" class="form-control" id="days" name="days" required>
                </div>
            </div>
            <br>

            <div class="center">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>

        <hr>

        <h2>Class List</h2>
        <table class="table">
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
                        <a href="" class="btn btn-primary btn-sm">Edit</a>
                        <form action="/principalclassload">
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
