<?php

namespace App\Imports;

use App\Models\Grade;
use App\Models\Assign;
use App\Models\payment_form;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TeacherGrades implements ToCollection, WithHeadingRow
{
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            try {
                Log::info('Processing row data: ', $row->toArray());

                // Check for required fields
                $missingFields = [];
                if (empty($row['full_name'])) {
                    $missingFields[] = 'full_name';
                }
                if (empty($row['edp_code'])) {
                    $missingFields[] = 'EDP Code';
                }
                if (empty($row['section'])) {
                    $missingFields[] = 'section';
                }
                if (empty($row['subject'])) {
                    $missingFields[] = 'subject';
                }
                if (empty($row['grade_id'])) {
                    $missingFields[] = 'grade_id';
                }

                if (!empty($missingFields)) {
                    Log::warning('Missing required fields for row: ' . implode(', ', $missingFields), $row->toArray());
                    continue; 
                }

                // Find the assignment record based on edp_code, section, subject
                $assignRecord = Assign::where('edpcode', $row['edp_code'])
                                      ->where('section', $row['section'])
                                      ->where('subject', $row['subject'])
                                      ->first();

                if (!$assignRecord) {
                    Log::warning('No assignment found for EDP code: ' . $row['edp_code']);
                    continue; 
                }

                // Get the class_id for this assignment
                $classId = $assignRecord->class_id;

                // Retrieve the payment form using the student_id (from class_id)
                $paymentForm = payment_form::where('payment_id', $classId)->first();

                if (!$paymentForm) {
                    Log::warning('No payment form found for student ID: ' . $classId);
                    continue; 
                }

                // Use the grade_id from the row directly
                $gradeId = $row['grade_id'];

                // Get quarterly grades from the row
                $firstQuarter = $row['1st_quarter'] ?? 0;
                $secondQuarter = $row['2nd_quarter'] ?? 0;
                $thirdQuarter = $row['3rd_quarter'] ?? 0;
                $fourthQuarter = $row['4th_quarter'] ?? 0;

                // Calculate overall grade
                $overallGrade = ($firstQuarter + $secondQuarter + $thirdQuarter + $fourthQuarter) / 4;

                // Import the grade using updateOrCreate with unique criteria
                $grade = Grade::updateOrCreate(
                    [
                        'edp_code' => $row['edp_code'],
                        'subject' => $row['subject'],
                        'section' => $row['section'],
                        'grade_id' => $gradeId, // Use the grade_id directly from the row
                    ],
                    [
                        'fullname' => $row['full_name'],
                        '1st_quarter' => $firstQuarter,
                        '2nd_quarter' => $secondQuarter,
                        '3rd_quarter' => $thirdQuarter,
                        '4th_quarter' => $fourthQuarter,
                        'overall_grade' => $overallGrade,
                        'status' => Grade::STATUS_PENDING,
                    ]
                );

                Log::info('Grade imported: ', $grade->toArray());
            } catch (\Exception $e) {
                Log::error('Error importing grade: ' . $e->getMessage());
            }
        }
    }
}