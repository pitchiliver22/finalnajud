<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <title>BESIS | Record</title>
    <link rel="icon" type="image/png" sizes="32x32" href="image/uclogo.png" class="titlelogo">
    <style>
        .w3-sidebar {
            background-image: url('image/ucbuild.png');
            background-size: cover;
            background-position: center;
            position: relative;
            color: white;
            width: 180%;
          
            overflow-y: hidden;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.5);
        }

        .w3-sidebar::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(8, 16, 66, 0.9);
            z-index: 1;
        }

        .profile-section,
        .w3-bar-item {
            position: relative;
            z-index: 2;
        }

        .profile-section {
            display: flex;
            flex-direction: column; /* Change to column layout */
            align-items: center; /* Center align items */
            padding: 6px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .profile-picture {
            width: 50px;
            height: 58px;
            border-radius: 80%;
            margin-bottom: 5px; /* Space below profile picture */
        }

        .w3-bar-item {
            display: flex;
            align-items: center;
            padding: 10px; /* Add padding for better spacing */
            text-decoration: none;
            transition: color 0.3s; /* Only transition color */
            border-radius: 5px;
            margin-right:10px;
            margin-top:15px;
            font-size: 14px; /* Adjusted font size */
        }

        .w3-bar-item svg {
            width: 15px;
            height: 15px;
            margin-right: 20px; /* Increased space between icon and text */
            transition: fill 0.5s;
        }

        .w3-bar-item:hover svg {
            fill: red;
        }

        .w3-bar-item{
            color: rgb(255, 255, 255);
            border: none;
            border-radius: 5px;
            margin-bottom: 2px;
        }

        .w3-bar-item:hover {
            color:black;
            background-color:white;
            
        }
        .w3-bar-item.active {
        background-color: rgba(240, 252, 126); /* Background color for active link */
        color: rgba(3, 5, 74); /* Text color for active link */
      
        }

        .uc-logo-container {
            position: relative;
            z-index: 2;
            text-align: center;
            margin: 0px 0px;
            background-color: rgba(255, 244, 231, 1);
            margin-top: 42%;
            padding: 14px;
        }

        .uc-logo {
            width: 120px;
            height: auto;
            margin-top: 5%;
            margin-bottom: 10px; /* Added margin below the logo */
        }

        .profile-section a {
            text-decoration: none; /* No underline */
            color: rgba(203, 209, 208); /* Match text color */
            margin-top: 5px; /* Space above the link */
            font-size: 12px;
        }

        .profile-section a:hover {
            color: white; /* Change color on hover */
        }

        .profile-name {
            font-size: 13px;
            text-transform: uppercase;
        }
        .w3-bar-item.w3-button.w3-large{
            top:-5px;
            position:fixed;
            left:200px;
            width: 30px; /* Adjust width as needed */
            border-radius:0;
            height: 40px; /* Adjust height as needed */
            display: flex; /* Center the content */
            align-items: center; /* Center vertically */
            justify-content: center; /* Center horizontally */
       
        }
        .signout{
            margin-top:150px;
        }
      
        @media (max-width: 768px) {
            .header-container {
                flex-direction: column; /* Stack items on smaller screens */
                align-items: flex-start; /* Align items to the start */
            }

            h1 {
                font-size: 18px; /* Adjust heading size */
            }

            .nav-button {
                margin-bottom: 10px; /* Adjust button margin */
            }

            .content {
                margin: 10px; /* Reduce margin on smaller screens */
            }

            ul, ol {
                text-align: left; /* Align lists to the left on mobile */
            }
        }

        @media (max-width: 480px) {
            h1 {
                font-size: 16px; /* Further reduce heading size */
            }

            h2 {
                font-size: 18px; /* Adjust h2 size */
            }

            p {
                font-size: 14px; /* Adjust paragraph size */
            }
        }
    </style>



<div class="w3-sidebar w3-bar-block w3-card w3-animate-left" style="display:none" id="mySidebar">
        <div class="profile-section">
            <img src="{{ $picture && $picture->profile_picture ? asset('storage/' . $picture->profile_picture) : asset('path/to/default-image.jpg') }}" alt="Profile Picture" class="profile-picture">  <span class="profile-name">{{ auth()->user()->firstname }} {{ auth()->user()->lastname }}</span>
           <span class="profile-name">{{ auth()->user()->firstname }} {{ auth()->user()->lastname }}</span>
            <a href="/recordprofile">View Profile</a>
        </div>

        <h5>
            <a href="/record" class="w3-bar-item">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-check-fill" viewBox="0 0 16 16">
                    <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293z" />
                    <path d="m8 3.293 4.712 4.712A4.5 4.5 0 0 0 8.758 15H3.5A1.5 1.5 0 0 1 2 13.5V9.293z" />
                </svg> Home
            </a>
            <a href="/studententries" class="w3-bar-item">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                    <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5m.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1z" />
                </svg> Students Applicant
            </a>
            <a href="/studentapplicant" class="w3-bar-item">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                    <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5m.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1z" />
                </svg> Pending Partial Account
            </a>
            <a href="/approvedaccount" class="w3-bar-item">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                    <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5m.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1z" />
                </svg> Approved Students
            </a>
            <div class="signout">
        <a href="/logout" class="w3-bar-item">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0z" />
                <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708z" />
            </svg> Sign Out
        </a>
        <div class="closebtn">
        <button class="w3-bar-item w3-button w3-large" onclick="w3_close()"> &times;</button>
        </div>
    </h5>
    </div>
    <script>
document.addEventListener('DOMContentLoaded', function() {
    // Get all sidebar links, excluding the close button
    const sidebarLinks = document.querySelectorAll('.w3-bar-item:not(.closebtn button)');
    
    // Function to set active link based on current URL
    function setActiveLink() {
        const currentPath = window.location.pathname;
        
        // Remove active class from all links
        sidebarLinks.forEach(link => {
            link.classList.remove('active');
        });
        
        // Add active class to the matching link
        sidebarLinks.forEach(link => {
            if (link.getAttribute('href') === currentPath) {
                link.classList.add('active');
            }
        });
    }
    
    // Set active link on page load
    setActiveLink();
    
    // Add click event listeners to all sidebar links, excluding the close button
    sidebarLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            // Remove active class from all links
            sidebarLinks.forEach(link => {
                link.classList.remove('active');
            });
            
            // Add active class to clicked link
            this.classList.add('active');
        });
    });
});

function w3_open(event) {
    event.stopPropagation();
    document.getElementById("mySidebar").style.display = "block";
    document.getElementById("main").style.marginLeft = "220px";
}

function w3_close() {
    document.getElementById("mySidebar").style.display = "none";
    document.getElementById("main").style.marginLeft = "0";
}
</script>
