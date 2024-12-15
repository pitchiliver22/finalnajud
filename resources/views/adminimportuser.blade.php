@include('templates.Adminheader')


<style>
    body {
    overflow-x: hidden; 
}
    </style>

<div class="container py-2">
    <h2 class="text-center mb-4">Import Users</h2>
    
    {{-- Display success or error messagces --}}
    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger text-center">{{ session('error') }}</div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow">
                <div class="card-body">
                    <form action="adminimportuser" method="POST" enctype="multipart/form-data">                        
                        @csrf
                        <div class="mb-3">
                            <label for="excelFile" class="form-label">Choose Excel file</label>
                            <input type="file" class="form-control" id="excelFile" name="excel_file" accept=".xls,.xlsx" required>
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100">Import</button>
                    </form>
                    <br>
                    <a href="adminusers" class="btn btn-secondary">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>

@include('templates.Adminfooter')