@include('templates.teacherheader')

<div id="main">
    <div id="main">
        <div class="w3-teal">
            <button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button>
            <div class="w3-container">
                <h1>Teacher Notification</h1>
            </div>
        </div>
        <div class="notification-container">
            <div class="notification">
                <div class="notification-header">
                    <img src="https://via.placeholder.com/40" alt="Profile Picture" class="profile-picture">
                    <div class="header-text">
                        <h4>Grade Submission Approved</h4>
                        <p>by Principal</p>
                    </div>
                </div>
                <div class="notification-body">
                    <p>Your grade submission has been approved by the principal.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .notification-container {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }

    .notification {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        width: 400px;
        overflow: hidden;
    }

    .notification-header {
        display: flex;
        align-items: center;
        padding: 12px;
        background-color: #f0f2f5;
    }

    .profile-picture {
        border-radius: 50%;
        margin-right: 12px;
    }

    .header-text h4 {
        margin: 0;
        font-size: 16px;
        font-weight: bold;
    }

    .header-text p {
        margin: 0;
        font-size: 14px;
        color: #65676b;
    }

    .notification-body {
        padding: 12px;
    }
</style>
@include('templates.teacherfooter')
