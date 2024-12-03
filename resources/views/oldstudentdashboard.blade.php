@include('templates.oldstudentheader')

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }

    #main {
        max-width: 100%;
        margin: 0 auto;
        padding: 0px;
        background-color: white;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        position: relative; 
    }

    .header-container {
        display: flex; 
        align-items: center; 
        background-color: #0c3b6d; 
        color: white;
        padding: 10px; 
    }

    .nav-button {
        margin-right: 15px; 
        margin-bottom: 4px;
    }

    h1 {
        margin: 0; 
        font-family: 'Arial', sans-serif;
        font-size: 20px;
    }

    h2 {
        font-weight: bold;
        margin: 20px 0 10px 0;
        color: #333;
    }

    p {
        color: #555;
        line-height: 1.6;
    }

    img {
        max-width: 200px;
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
</style>

<div id="main" onclick="w3_close()">
    <div class="header-container"> 
        <button id="openNav" class="w3-button w3-xlarge nav-button" onclick="w3_open(event)">&#9776;</button>
        <h1>Student Dashboard</h1> 
    </div>

    <div class="content" style="text-align: center; margin: 20px;">
        <img src="image/uclogo.png" alt="University Logo" style="max-width: 200px; margin-bottom: 20px;">

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

<script>
    function w3_open(event) {
        event.stopPropagation();
        document.getElementById("mySidebar").style.display = "block";
    }

    function w3_close() {
        document.getElementById("mySidebar").style.display = "none";
    }
</script>