<!DOCTYPE html>
<html>
<head>
    <title>Principal Edited an Assessment</title>
</head>
<body>
    <h1>Assessment Edited</h1>
    <p>Your assessment submitted has been edited by the Principal:</p>
    <ul>
        <li>School Year: {{ $assessment->school_year }}</li>
        <li>Grade Level: {{ $assessment->grade_level }}</li>
        <li>Assessment Name: {{ $assessment->assessment_name }}</li>
        <li>Description: {{ $assessment->description }}</li>
        <li>Assessment Date: {{ $assessment->assessment_date }}</li>
        <li>Assessment Time: {{ $assessment->assessment_time }}</li>
        <li>Assessment Fee: {{ $assessment->assessment_fee }}</li>
    </ul>
    <p>We are pleased to inform you that the assessment has been successfully edited and published. We kindly ask for your review and approval of this updated assessment. Your support in finalizing this process will greatly benefit our students and staff.</p>
</body>
</html>