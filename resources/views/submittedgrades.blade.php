@include('templates.principalheader')

<div id="main">
    <div class="w3-teal">
        <button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button>
        <div class="w3-container">
            <h1>Evaluate Grades</h1>
        </div>
    </div>

    <div class="container" style="width: 80%; height: auto; border: 1px solid #ccc; padding: 20px;">
        <!-- Form to Enable/Disable Quarters -->
        <form action="{{ route('update.quarters') }}" method="POST">
            @csrf
            <h4>Enable/Disable Quarters</h4>
        
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
        
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        
            <div class="form-group">
                <label>
                    <input type="checkbox" name="1st_quarter_enabled" value="1" {{ $quartersEnabled['1st_quarter'] ? 'checked' : '' }}>
                    1st Quarter Enabled
                </label>
            </div>
        
            <div class="form-group">
                <label>
                    <input type="checkbox" name="2nd_quarter_enabled" value="1" {{ $quartersEnabled['2nd_quarter'] ? 'checked' : '' }}>
                    2nd Quarter Enabled
                </label>
            </div>
        
            <div class="form-group">
                <label>
                    <input type="checkbox" name="3rd_quarter_enabled" value="1" {{ $quartersEnabled['3rd_quarter'] ? 'checked' : '' }}>
                    3rd Quarter Enabled
                </label>
            </div>
        
            <div class="form-group">
                <label>
                    <input type="checkbox" name="4th_quarter_enabled" value="1" {{ $quartersEnabled['4th_quarter'] ? 'checked' : '' }}>
                    4th Quarter Enabled
                </label>
            </div>
        
            <div class="form-group">
                <label for="quarter_status">Quarter Status</label>
                <select name="quarter_status" class="form-control" required>
                    <option value="" disabled selected>Select Status</option>
                    <option value="active" {{ $quarterSettings->quarter_status === 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ $quarterSettings->quarter_status === 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
        
            <button type="submit" class="btn btn-primary">Update Quarters</button>
        </form>

        <!-- Form for Evaluating Grade Submission -->
        <h4 class="mt-5">Evaluate Grade Submission</h4>
        <form action="#" method="GET">
            @csrf
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="input-group mr-3">
                    <input type="text" class="form-control" placeholder="Search..." aria-label="Search" name="search">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">Refresh Search</button>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Status</th>
                            <th>Adviser</th>
                            <th>Subject</th>
                            <th>Section</th>
                            <th>Grade Level</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($assigns as $assign)
                            @php
                                $grade = $grades->firstWhere('id', $assign->id);
                            @endphp

                            <tr>
                                <td>{{ $grade ? $grade->status : 'pending' }}</td>
                                <td>{{ $assign->adviser }}</td>
                                <td>{{ $assign->subject }}</td>
                                <td>{{ $assign->section }}</td>
                                <td>{{ $assign->grade }}</td>
                                <td>
                                    <a href="/publishgrade/{{ $assign->id }}" class="btn btn-info btn-sm" title="View">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                            <path d="M7.998 2c-2.757 0-5.287 1.417-6.758 3.75a.748.748 0 0 0 0 .5c1.471 2.333 4.001 3.75 6.758 3.75s5.287-1.417 6.758-3.75a.748.748 0 0 0 0-.5c-1.471-2.333-4.001-3.75-6.758-3.75zm0 1.5a3.75 3.75 0 1 1 0 7.5 3.75 3.75 0 0 1 0-7.5zm0 2a1.75 1.75 0 1 0 0 3.5 1.75 1.75 0 0 0 0-3.5z"/>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</div>

@include('templates.principalfooter')