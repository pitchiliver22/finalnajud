@include('templates.Adminheader')

<div class="container py-5">
    <div class="text-center mb-4">
        <h2 class="font-weight-bold">Admin Dashboard</h2>
        <p class="lead">Manage your application effortlessly</p>
    </div>

    <div class="row">
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card shadow border-0">
                <div class="card-body">
                    <h5 class="card-title">User Management</h5>
                    <p class="card-text">Manage user accounts, roles, and permissions efficiently.</p>
                    <a href="/adminusers" class="btn btn-primary">Go to Users</a>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card shadow border-0">
                <div class="card-body">
                    <h5 class="card-title">Class Management</h5>
                    <p class="card-text">Create and oversee classes and subjects seamlessly.</p>
                    <a href="/adminclasses" class="btn btn-primary">Go to Classes</a>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card shadow border-0">
                <div class="card-body">
                    <h5 class="card-title">Reports</h5>
                    <p class="card-text">Generate and view reports for users and classes.</p>
                    <a href="/adminreports" class="btn btn-primary">View Reports</a>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card shadow border-0">
                <div class="card-body">
                    <h5 class="card-title">Settings</h5>
                    <p class="card-text">Adjust application settings and preferences.</p>
                    <a href="/adminsettings" class="btn btn-primary">Go to Settings</a>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card shadow border-0">
                <div class="card-body">
                    <h5 class="card-title">Notifications</h5>
                    <p class="card-text">Stay updated with system notifications and alerts.</p>
                    <a href="/adminnotifications" class="btn btn-primary">View Notifications</a>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card shadow border-0">
                <div class="card-body">
                    <h5 class="card-title">Analytics</h5>
                    <p class="card-text">Analyze performance metrics and insights.</p>
                    <a href="/adminanalytics" class="btn btn-primary">View Analytics</a>
                </div>
            </div>
        </div>
    </div>
</div>

@include('templates.Adminfooter')

<style>
    body {
        background-color: #f8f9fa;
    }

    .card {
        transition: transform 0.3s, box-shadow 0.3s;
        border-radius: 15px;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    .container {
        max-width: 1200px;
    }

    .card-title {
        font-size: 1.25rem;
        font-weight: bold;
        color: #343a40;
    }

    .card-text {
        color: #6c757d;
    }

    .btn-primary {
        background-color: #007bff;
        border: none;
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