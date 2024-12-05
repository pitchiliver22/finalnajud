@include('templates.Adminheader')

<div class="container py-5">
    <div class="text-center mb-4">
        <h2 class="font-weight-bold">Admin Dashboard</h2>
        <p class="lead">Manage your application effortlessly</p>
    </div>

    <div class="row">
        <div class="col-lg-6 col-md-12 mb-4">
            <div class="card shadow border-0 h-100">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">User Management</h5>
                    <p class="card-text">Manage user accounts, roles, and permissions efficiently.</p>
                    <a href="/adminusers" class="btn btn-primary mt-auto">Go to Users</a>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-12 mb-4">
            <div class="card shadow border-0 h-100">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">Reports</h5>
                    <p class="card-text">Generate and view reports for users and classes.</p>
                    <a href="/adminreport" class="btn btn-primary mt-auto">View Reports</a>
                </div>
            </div>
        </div>
    </div>
</div>

@include('templates.Adminfooter')

<style>
    body {
        background-color: #f8f9fa;
        font-family: Arial, sans-serif;
    }

    .container {
        max-width: 1200px;
    }

    .card {
        transition: transform 0.3s, box-shadow 0.3s;
        border-radius: 15px;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    .card-title {
        font-size: 1.5rem;
        font-weight: bold;
        color: #343a40;
    }

    .card-text {
        color: #6c757d;
        margin-bottom: 15px;
    }

    .btn-primary {
        background-color: #007bff;
        border: none;
        border-radius: 5px;
        padding: 10px 15px;
        transition: background-color 0.3s;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    @media (max-width: 768px) {
        .container {
            padding: 0 15px;
        }
    }
</style>