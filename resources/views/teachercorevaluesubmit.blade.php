@include('templates.teacherheader')

<div id="main">
    <div class="w3-teal">
        <button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button>
        <div class="w3-container">
            <h1>TEACHER CORE VALUE SUBMISSION</h1>
        </div>
    </div>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeachd
        </ul>
    </div>
    @endif

    <div class="container" style="width: 80%; height: auto; border: 1px solid #ccc; padding: 20px;">
        <form action="{{ route('teachercorevaluesubmit') }}" method="POST">
            @csrf
            <input type="hidden" name="student_id" value="{{ old('payment_id', $paymentForm->payment_id ?? '') }}">
            <input type="hidden" name="fullname" value="{{ old('fullname', $fullName) }}">
            <input type="hidden" name="section" value="{{ old('section', $assign->section) }}">

            <!-- Core Values Table -->
            <div class="fee-list">
                <h4>STUDENT CORE VALUES</h4>
                <div class="table-responsive">
                    <table class="table table-striped" id="core-values-table">
                        <thead>
                            <tr>
                                <th>Core Value</th>
                                <th>Input</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (['respect', 'excellence', 'teamwork', 'innovation', 'sustainability'] as $coreValue)
                                <tr>
                                    <td>{{ strtoupper($coreValue) }}</td>
                                    <td>
                                        <input type="text" class="form-control" name="{{ $coreValue }}" value="{{ old($coreValue) }}" required>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="text-center">
                <button type="submit" name="submit" class="btn btn-danger btn-lg">Submit Core Values</button>
            </div>
        </form>
    </div>
</div>

@include('templates.teacherfooter')