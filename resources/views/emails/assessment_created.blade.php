<!DOCTYPE html>
<html>
<head>
    <title>Accounting Submitted an Assessment</title>
</head>
<body>
    <h1>New Assessment Created</h1>
    <p>A new assessment has been created by the accounting:</p>
    <ul>
        <li>School Year: {{ $assessment->school_year }}</li>
        <li>Grade Level: {{ $assessment->grade_level }}</li>
        <li>Assessment Name: {{ $assessment->assessment_name }}</li>
        <li>Description: {{ $assessment->description }}</li>
        <li>Assessment Date: {{ $assessment->assessment_date }}</li>
        <li>Assessment Time: {{ $assessment->assessment_time }}</li>
        <li>Assessment Fee: {{ $assessment->assessment_fee }}</li>
    </ul>
    <p>We kindly ask for your review and approval of this assessment. Your guidance in publishing it would greatly support our students and staff. Thank you for your continued leadership and support.</p>
</body>
</html>