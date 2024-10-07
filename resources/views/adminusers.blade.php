@include('templates.Adminheader')
<div class="col py-3">
    <form action="/adminusers" method="POST">
        @csrf

        <div class="row g-3">
            <div class="col">
                <label for="firstname" class="form-label">First Name<span class="required">*</span></label>
                <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name"
                    required>
            </div>

            <div class="col">
                <label for="lastname" class="form-label">Last Name<span class="required">*</span></label>
                <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name"
                    required>
            </div>
            <div class="col">
                <label for="middlename" class="form-label">Middle Name<span class="required">*</span></label>
                <input type="text" class="form-control" id="middlename" name="middlename" placeholder="Middle Name"
                    required>
            </div>

            <div class="col">
                <label for="suffix" class="form-label">Suffix<span class="required">*</span></label>
                <input type="text" class="form-control" id="suffix" name="suffix" placeholder="Suffix" required>
            </div>


        </div>

        <div class="row g-3">
            <div class="col">
                <label for="password" class="form-label">Password<span class="required">*</span></label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password"
                    required>
            </div>
            <div class="col">
                <label for="email" class="form-label">Email<span class="required">*</span></label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
            </div>



            <div class="col">
                <label for="role" class="form-label">Role<span class="required">*</span></label>
                <select name="role" id="role" class="form-control" required>
                    <option value="Newstudent">New Student</option>
                    <option value="Oldstudent">Old Student</option>
                    <option value="Teacher">Teacher</option>
                    <option value="Cashier">Cashier</option>
                    <option value="Record">Record</option>
                    <option value="Accounting">Accounting</option>
                    <option value="Principal">Principal</option>
                </select>
            </div>

        </div>
        <br>
        <div class="row g-4">

            <div class="col">
                <button type="submit" name="submit" class="btn btn-primary">Create Account</button>
            </div>
        </div>

    </form>

    <div class="users-list">
        <form action="/adminusers" method="GET">
            <br>
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="query" placeholder="Search student entries..."
                    aria-label="Search student entries" aria-describedby="button-addon2">
                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-search" viewBox="0 0 16 16">
                        <path
                            d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                    </svg>
                    Search
                </button>
            </div>

            <div class="input-group mb-3">
                <a href="/users" class="btn btn-outline-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z" />
                        <path
                            d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z" />
                    </svg>
                    Refresh
                </a>
            </div>

            <div class="users-list">
                <h4>Users List</h4>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Middle Name</th>
                            <th>Suffix</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($account as $account)
                            <tr>
                                <td>{{ $account->id }}</td>
                                <td>{{ $account->firstname }}</td>
                                <td>{{ $account->lastname }}</td>
                                <td>{{ $account->middlename }}</td>
                                <td>{{ $account->suffix }}</td>
                                <td>{{ $account->email }}</td>
                                <td>{{ $account->password }}</td>
                                <td>{{ $account->role }}</td>

                                <td>
                                    <a href="/update_users/{{ $account->id }}"
                                        class="btn btn-primary btn-sm update-users"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                            <path
                                                d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001m-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708z" />
                                        </svg></a>
                                    <a href="/delete_users/{{ $account->id }}"
                                        class="btn btn-danger btn-sm delete-users"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-recycle" viewBox="0 0 16 16">
                                            <path
                                                d="M9.302 1.256a1.5 1.5 0 0 0-2.604 0l-1.704 2.98a.5.5 0 0 0 .869.497l1.703-2.981a.5.5 0 0 1 .868 0l2.54 4.444-1.256-.337a.5.5 0 1 0-.26.966l2.415.647a.5.5 0 0 0 .613-.353l.647-2.415a.5.5 0 1 0-.966-.259l-.333 1.242zM2.973 7.773l-1.255.337a.5.5 0 1 1-.26-.966l2.416-.647a.5.5 0 0 1 .612.353l.647 2.415a.5.5 0 0 1-.966.259l-.333-1.242-2.545 4.454a.5.5 0 0 0 .434.748H5a.5.5 0 0 1 0 1H1.723A1.5 1.5 0 0 1 .421 12.24zm10.89 1.463a.5.5 0 1 0-.868.496l1.716 3.004a.5.5 0 0 1-.434.748h-5.57l.647-.646a.5.5 0 1 0-.708-.707l-1.5 1.5a.5.5 0 0 0 0 .707l1.5 1.5a.5.5 0 1 0 .708-.707l-.647-.647h5.57a1.5 1.5 0 0 0 1.302-2.244z" />
                                        </svg></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </form>
    </div>
</div>



@include('templates.Adminfooter')
