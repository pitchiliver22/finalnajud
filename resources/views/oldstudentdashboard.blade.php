@include('templates.oldstudentheader')

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: white;
        margin: 0;
        padding: 0;
    }

    /* #main {
        max-width: 100%;
        margin: 0 auto;
        padding: 0px;
        background-color: white;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        position: relative; 
    } */

    .header-container {
        display: flex; 
        align-items: center; 
        background-color: rgba(8, 16, 66, 1); 
        color:white;
        padding: 10px; 
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5); 
            }
    .nav-button {
        margin-right: 15px; 
        margin-bottom: 4px;
    }


    h1 {
        margin: 0; 
        font-size: 15px;
        text-transform:uppercase;
        }
    h2 {
        font-weight: bold;
        margin: 20px 0 10px 0;
        color: black;
    }

    p {
        color: black;
        line-height: 1.6;
    }

    img {
            max-width: 100%; /* Make image responsive */
            height: auto; /* Maintain aspect ratio */
            margin-bottom: 20px;
        }

        ul, ol {
            text-align: center;
            margin: 0 auto;
            padding: 0;
            list-style-position: inside;
        }

        li {
            margin: 5px 0;
        }

        .navvers{
    background-color:rgba(8, 16, 66, 1); 
    border-width:0;
    color:white;
    padding:15px;

}
.navvers:hover{
    color:yellow;
}
      
        @media (max-width: 320px) {
       
        .header-container{
            font-size: 12px; /* Adjust font size for mobile */
            padding:20px;
            width:41rem;
         
        }
            .header-container h1{
        margin-left:-50%;
      }
        .navvers{
        position:absolute;
        left:10px;
        top:5px;
        }
        .headhead{
            font-size:15px;
        }
        .table{
            font-size:10px;
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

        @media (min-width: 320px) and (max-width:768px){
        
         
            .header-container{
            font-size: 12px; /* Adjust font size for mobile */
            padding:20px;
            width:41rem;
    
         
        }
            .header-container h1{
            margin-left:-50%;
        }
        .navvers{
        position:absolute;
        left:10px;
        top:5px;
        }
        }
</style>

<div class="header-container"> 
            <button id="openNav" class="navvers" onclick="w3_open(event)">&#9776;</button>
            <h1>Student Dashboard</h1> 
        </div>
        <div id="main" onclick="w3_close()">
    <div class="content" style="text-align: center; margin: 20px;">
        <img src="{{ asset('image/uclogo.png') }}" alt="University Logo" style="max-width: 200px; margin-bottom: 20px;">

        <h2>VISION</h2>
        <p>Democratize quality education.<br>
        Be the visionary and industry leader.<br>
        Give hope and transform lives.</p>

        <h2>MISSION</h2>
        <p>University of Cebu offers affordable and quality education responsive to the demands of local and<br> international communities. University of Cebu commits to:</p>
        <ul style="list-style-type: none; padding: 0; text-align: left; display: inline-block; margin-right:-12%;">
            <li>- Serve as an active catalyst in providing efficient and effective delivery of educational services;</li>
            <li>- Pursue excellence in instruction, research and community service towards social and economic development;</li>
            <li>- Acquire, disseminate and utilize appropriate technology to enhance the university's educational services;</li>
            <li>- Foster an organizational culture that nurtures employee productivity and innovation.</li>
        </ul>

        <h2>INSTITUTIONAL GOALS</h2>
        <ol style="text-align: justify; display: inline-block; margin-right:-8%;">
            <li>To offer programs that are relevant, holistic and compliant with the standards of higher education.</li>
            <li>To develop effective learning environments that will develop life-long learners.</li>
            <li>To develop social awareness, responsibility and accountability among students.</li>
            <li>To complement the academic programs with holistic and integrated student personnel services.</li>
            <li>To provide a pool of qualified, professional and motivated faculty in the areas of instruction, research <br>and community extension.</li>
        </ol>
    </div>
</div>

@include('templates.oldstudentfooter')
