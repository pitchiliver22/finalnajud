@include('templates.principalheader')
    <style>
 body {
        font-family: Arial, sans-serif;
        background-color: white;
        margin: 0;
        padding: 0;
    }

    .header-container {
        display: flex; 
        align-items: center; 
        background-color: rgba(8, 16, 66, 1); 
        color: white;
        padding: 10px; 
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);  
    }
    
    .header-container h1 {
        margin: 0; 
        font-size: 15px;
        text-transform:uppercase;
    }
    .headdr{
        text-transform:uppercase;
        font-size:17px;
        background-color:rgba(8, 16, 66, 1); 
        color:white;
        padding:12px;
        width:22%;
       
    }
    .updatee{
        background-color:#148718;
        padding:8px;
        color:white;
        border-width:0;
        border-radius:10px;
        margin-left:85%;
    }
    .updatee:hover{
        background-color:#24ab28;
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
        margin-left:-60%;
        font-size:15px;
      }
        .navvers{
        position:absolute;
        left:10px;
        top:5px;
        padding:15px;
        }
        .headdr{
            font-size:14px;
            width:45%;
        }

      
    }
  @media (min-width:320px) and (max-width:768px){
    .header-container{
            font-size: 12px; /* Adjust font size for mobile */
            padding:20px;
            width:41rem;
         
        }
      .header-container h1{
        margin-left:-60%;
        font-size:15px;
      }
        .navvers{
        position:absolute;
        left:10px;
        top:5px;
        padding:15px;
        }
        .headdr{
            font-size:14px;
            width:45%;
        }
        .updatee{
            width:50%;
            margin-left:50%;
        }
        }
        </style>
<div class="header-container">
        <button id="openNav" class="navvers" onclick="w3_open()">&#9776;</button>
        <h1>Assessment Details</h1>
    </div>

    <div id="main" onclick="w3_close()">
    <div class="container my-5">
        <h1 class="headdr">Assessment Information</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('assessment.edit', $assessment->id) }}" method="POST" class="shadow p-4 rounded bg-light">
            @csrf 
            @method('PUT')
            <input type="hidden" name="id" id="id" value="{{ $assessment->id }}">

            <div class="mb-3">
                <label for="school-year" class="form-label fw-bold">School Year:</label>
                <input type="text" id="school-year" name="school_year" class="form-control" 
                    value="{{ $assessment->school_year }}" placeholder="Enter the school year">
            </div>

            <div class="mb-3">
                <label for="grade-level" class="form-label fw-bold">Grade Level:</label>
                <input type="text" id="grade-level" name="grade_level" class="form-control" 
                    value="{{ $assessment->grade_level }}" placeholder="Enter the grade level">
            </div>

            <div class="mb-3">
                <label for="assessment-name" class="form-label fw-bold">Assessment Name:</label>
                <input type="text" id="assessment-name" name="assessment_name" class="form-control" 
                    value="{{ $assessment->assessment_name }}" placeholder="Enter assessment name">
            </div>

            <div class="mb-3">
                <label for="assessment-description" class="form-label fw-bold">Assessment Description:</label>
                <textarea id="assessment-description" name="description" class="form-control" rows="3" placeholder="Enter a brief description">{{ $assessment->description }}</textarea>
            </div>

            <div class="mb-3">
                <label for="assessment-date" class="form-label fw-bold">Assessment Date:</label>
                <input type="date" id="assessment-date" name="assessment_date" class="form-control" 
                    value="{{ $assessment->assessment_date }}">
            </div>

            <div class="mb-3">
                <label for="assessment-time" class="form-label fw-bold">Assessment Time:</label>
                <input type="time" id="assessment-time" name="assessment_time" class="form-control" 
                    value="{{ $assessment->assessment_time }}">
            </div>

            <div class="mb-3">
                <label for="assessment-fee" class="form-label fw-bold">Assessment Fee:</label>
                <input type="number" id="assessment-fee" name="assessment_fee" class="form-control" 
                    value="{{ $assessment->assessment_fee }}" min="0" step="0.01" placeholder="Enter the assessment fee">
            </div>

            <button type="submit" class="updatee">Update Assessment</button>
        </form>
    </div>
</div>

@include('templates.principalfooter')
