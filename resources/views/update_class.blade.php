@include('templates.principalheader')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
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
    h1{
        margin-top:2%;
        font-size:20px;
    }
    .savech{
        background-color:rgba(8, 16, 66, 1); 
        color:white;
        padding:5px;
        margin-top:2%;
        margin-bottom:2%;
        border-radius:5px;
    }
    .savech:hover{
        background-color:#142882;
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


}
        
        </style>

<div class="header-container">
        <button id="openNav" class="navvers" onclick="w3_open()">&#9776;</button>
        <h1>Update Class load</h1>
    </div>

    <div id="main" onclick="w3_close()">


    <div class="container">
        <h1>Update Management</h1>

        <!-- Update Form -->
        <form action="/update_class/{{ $classes->id }}" method="POST" id="myForm">
            @csrf
            @if (isset($classes))
                @method('PUT') <!-- Use PUT for updates -->
            @endif

            <div class="col">
                <label for="grade">Grade</label>
                <select class="form-control" id="grade" name="grade" required>
                    <option value="">Select Grade</option>
                    <option value="K" {{ isset($classes) && $classes->grade == 'K' ? 'selected' : '' }}>
                        Kindergarten
                    </option>
                    @for ($i = 1; $i <= 10; $i++)
                        <option value="Grade {{ $i }}"
                            {{ isset($classes) && $classes->grade == "Grade $i" ? 'selected' : '' }}>
                            Grade {{ $i }}
                        </option>
                    @endfor
                </select>
            </div>

            <div class="row">
                <div class="col">
                    <label for="adviser">Adviser</label>
                    <input type="text" class="form-control uppercase" id="adviser" name="adviser"
                        value="{{ old('adviser', isset($classes) ? $classes->adviser : '') }}"
                        placeholder="e.g. JUANA DELAS ALAS" pattern="[A-Za-z\s]+" title="Please enter letters only"
                        required>
                </div>

                <div class="row">
                    <div class="col">
                        <label for="section">Section</label>
                        <input type="text" class="form-control uppercase" id="section" name="section"
                            value="{{ old('section', isset($classes) ? $classes->section : '') }}"
                            placeholder="e.g. DIAMOND, RUBY, JADE, ETC." pattern="[A-Za-z\s]+"
                            title="Please enter letters only" required>
                    </div>

                    <div class="col">
                        <label for="room">Room</label>
                        <input type="text" class="form-control" id="room" name="room"
                            value="{{ old('room', isset($classes) ? $classes->room : '') }}"
                            placeholder="208, ME 105, ETC." maxlength="5" required>
                    </div>

                    <div class="col">
                        <label for="subject">Subject</label>
                        <input type="text" class="form-control uppercase" id="subject" name="subject"
                            value="{{ old('subject', isset($classes) ? $classes->subject : '') }}"
                            placeholder="e.g. FILIPINO, ENGLISH, ETC." pattern="[A-Za-z\s]+"
                            title="Please enter letters only" required>
                    </div>
                </div>

                <div class="col">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" required placeholder="e.g. FILIPINO IS ALL ABOUT-"
                        rows="3">{{ old('description', isset($classes) ? $classes->description : '') }}</textarea>
                </div>

                <div class="row">
                    <div class="col">
                        <label for="edpcode">Edp Code</label>
                        <input type="text" class="form-control" id="edpcode" name="edpcode"
                            value="{{ old('edpcode', isset($classes) ? $classes->edpcode : '') }}" placeholder="41121"
                            maxlength="5" pattern="\d*" title="Please enter numbers only" required>
                    </div>

                    <div class="col">
                        <label for="type">Type</label>
                        <input type="text" class="form-control" id="type" name="type"
                            value="{{ old('type', isset($classes) ? $classes->type : '') }}" maxlength="1"
                            placeholder="Type L if it's LABORATORY and leave it blank if NOT" pattern="(L|)">
                    </div>

                    <div class="col">
                        <label for="unit">Unit</label>
                        <input type="text" class="form-control" id="unit" name="unit"
                            value="{{ old('unit', isset($classes) ? $classes->unit : '') }}"
                            placeholder="(Available units: 1/2/3)" required maxlength="1" pattern="\d{1,3}"
                            title="Please enter 1 to 3 numbers" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label for="time">Time</label>
                        <input type="text" class="form-control" id="time" name="time"
                            value="{{ old('time', isset($classes) ? $classes->time : '') }}"
                            placeholder="7:30 AM - 8:30 AM" required>
                    </div>

                    <div class="col">
                        <label for="days">Days</label>
                        <input type="text" class="form-control" id="days" name="days"
                            value="{{ old('days', isset($classes) ? $classes->days : '') }}"
                            placeholder="e.g. MWF/ TTH/ SAT" required>
                    </div>
                </div>
                <br>

                <div class="center">
                    <button type="submit"
                        class="savech">{{ isset($classes) ? 'Save Changes' : 'Add Class' }}</button>
                </div>
        </form>

        <hr>
    </div>
</div>

@include('templates.principalfooter')
