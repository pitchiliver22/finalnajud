<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class GradesTemplateExport implements FromCollection, WithHeadings
{
    protected $students;
    protected $quarterSettings;

    // Constructor to accept the student data and quarter settings
    public function __construct(Collection $students, $quarterSettings)
    {
        $this->students = $students;
        $this->quarterSettings = $quarterSettings;
    }

    /**
     * Return the collection of students for export.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->students; // Return the students passed to the constructor
    }

    /**
     * Set the headings for the Excel sheet based on active quarters.
     *
     * @return array
     */
    public function headings(): array
    {
        $headings = [
            'EDP Code',
            'Full Name',
            'Section',
            'Subject',
            'Grade ID'
        ];

        // Add quarter headings based on settings
        if ($this->quarterSettings->first_quarter_enabled) {
            $headings[] = '1st Quarter';
        }
        if ($this->quarterSettings->second_quarter_enabled) {
            $headings[] = '2nd Quarter';
        }
        if ($this->quarterSettings->third_quarter_enabled) {
            $headings[] = '3rd Quarter';
        }
        if ($this->quarterSettings->fourth_quarter_enabled) {
            $headings[] = '4th Quarter';
        }

        return $headings;
    }
}
