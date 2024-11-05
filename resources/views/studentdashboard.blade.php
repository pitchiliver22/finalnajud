    @include('templates.studentheader')

    <div id="main">
        <div class="w3-teal">
            <button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button>
            <div class="w3-container">
                <h1>STUDENT DASHBOARD</h1>
            </div>
        </div>

        <label>{{ auth()->user()->firstname }}</label>

    </div>
    @include('templates.studentfooter')
