    @include('templates.recordheader')
    <style>
 body {
        font-family: Arial, sans-serif;
        background-color: white;
        margin: 0;
        padding: 0;
    }

    .header-container {
        display: flex; 
        align-items: center; 
        background-color: rgba(8, 16, 66, 1); 
        color: white;
        padding: 10px; 
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);  
    }
    
    h1 {
        margin: 0; 
        font-size: 15px;
        text-transform:uppercase;

        
    }
        </style>
<div class="header-container">
        <button id="openNav" class="w3-button w3-xlarge" onclick="w3_open()">&#9776;</button>
        <h1>Account Approval</h1>
    </div>

    <div id="main" onclick="w3_close()">




        <div class="account-details">
            <br>

            <form action="/recordapproval" method="POST">
                @csrf
                <div class="container">
                    <input type="hidden" name="id" id="id" value="{{ $account->id }}">
                    <div class="row mb-3">
                        <div class="col">
                            <label for="firstname" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="firstname" name="firstname"
                                value="{{ $account->firstname }}" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="lastname" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="lastname" name="lastname"
                                value="{{ $account->lastname }}" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="middlename" class="form-label">Middle Name</label>
                            <input type="text" class="form-control" id="middlename" name="middlename"
                                value="{{ $account->middlename }}" readonly>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="suffix" class="form-label">Suffix</label>
                            <input type="text" class="form-control" id="suffix" name="suffix"
                                value="{{ $account->suffix }}" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ $account->email }}" readonly>
                        </div>
                        <div class="col">
                            <label for="password" class="form-label">Password</label>
                            <input type="text" class="form-control" id="password" name="password"
                                value="{{ $account->password }}" readonly>
                        </div>
                    </div>

                    <div class="row md-3">
                        <input type="hidden" id="role" name="role" value="Newstudent">
                    </div>
                    <br>
                    <button type="submit" name="submit" class="btn btn-primary">Approve</button>
                </div>

            </form>
        </div>
    </div>

    @include('templates.recordfooter')
