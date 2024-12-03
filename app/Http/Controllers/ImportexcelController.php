<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel; // Import the Excel facade
use App\Imports\UsersImport; // Import your UsersImport class
use App\Models\Grade; // Ensure your Grade model is included

class ImportexcelController extends Controller
{
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        // Import the Excel file using the UsersImport class
        Excel::import(new UsersImport, $request->file('file'));

        // After import, you can redirect to a route with a success message
        return redirect()->route('studentgrades')
                         ->with('success', 'Users imported successfully.');
    }

    // If you need to handle grades separately, you can add another method for that
    public function importGrades(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        $filePath = $request->file('file')->store('uploads');
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load(storage_path('app/' . $filePath));
        $data = $spreadsheet->getActiveSheet()->toArray();

        // Assuming the first row contains headers
        $header = array_shift($data);
        $importedGrades = [];

        foreach ($data as $row) {
            $fullname = $row[0]; // Adjust based on your Excel structure
            $section = $row[1];  // Adjust based on your Excel structure

            $grade = Grade::where('fullname', $fullname)
                          ->where('section', $section)
                          ->first();

            if ($grade) {
                // Update existing record
                $grade->update([
                    'edp_code' => $row[2], // Adjust based on your Excel structure
                    'subject' => $row[3],   // Adjust based on your Excel structure
                    '1st_quarter' => $row[4], // Adjust based on your Excel structure
                    '2nd_quarter' => $row[5], // Adjust based on your Excel structure
                    '3rd_quarter' => $row[6], // Adjust based on your Excel structure
                    '4th_quarter' => $row[7], // Adjust based on your Excel structure
                    'overall_grade' => $this->calculateOverallGrade($row), // Calculate overall grade
                    'status' => 'Updated',
                ]);
            } else {
                // Create a new record
                Grade::create([
                    'fullname' => $fullname,
                    'section' => $section,
                    'edp_code' => $row[2],
                    'subject' => $row[3],
                    '1st_quarter' => $row[4],
                    '2nd_quarter' => $row[5],
                    '3rd_quarter' => $row[6],
                    '4th_quarter' => $row[7],
                    'overall_grade' => $this->calculateOverallGrade($row),
                    'status' => 'New',
                    'grade_id' => isset($row[8]) ? $row[8] : null,
                ]);
            }

            // Collect imported grades for display
            $importedGrades[] = [
                'fullname' => $fullname,
                'section' => $section,
                '1st_quarter' => $row[4],
                '2nd_quarter' => $row[5],
                '3rd_quarter' => $row[6],
                '4th_quarter' => $row[7],
                'overall_grade' => $this->calculateOverallGrade($row),
            ];
        }

        // Pass the imported grades to the view
        return redirect()->route('your.view.route')
                         ->with('importedGrades', $importedGrades)
                         ->with('success', 'Grades imported successfully.');
    }

    private function calculateOverallGrade($row)
    {
        $quarters = array_slice($row, 4, 4); // Assuming quarters start at index 4

        $total = 0;
        $count = 0;

        foreach ($quarters as $grade) {
            if ($grade !== null && $grade !== '') {
                $total += $grade;
                $count++;
            }
        }

        return $count ? round($total / $count, 2) : 0;
    }
}