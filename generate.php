<?php
// Define the timetable structure
$years = [
    'First Year' => ['Division A1', 'Division B1', 'Division C1'],
    'Second Year' => ['Division A2', 'Division B2', 'Division C2'],
    'Third Year' => ['Division A3', 'Division B3', 'Division C3']
];

$days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
$time_slots = ['9:00 AM - 10:00 AM', '10:00 AM - 11:00 AM', '11:00 AM - 12:00 PM', '12:00 PM - 1:00 PM', '1:00 PM - 2:00 PM', '2:00 PM - 3:00 PM', '3:00 PM - 4:00 PM'];

// Subjects and faculty for each year
$subjects = [
    'First Year' => ['Math', 'Physics', 'Chemistry', 'Engineering Mechanics', 'Basic Electrical'],
    'Second Year' => ['Data Structures', 'Digital Electronics', 'Discrete Math', 'Signals and Systems', 'Computer Networks'],
    'Third Year' => ['Operating Systems', 'Microprocessors', 'Database Systems', 'Software Engineering', 'Artificial Intelligence']
];

$faculty = [
    'First Year' => ['Dr. Smith', 'Prof. Johnson', 'Dr. Lee', 'Prof. Brown', 'Dr. Patel'],
    'Second Year' => ['Prof. Clark', 'Dr. Martinez', 'Prof. Taylor', 'Dr. White', 'Prof. Hall'],
    'Third Year' => ['Dr. King', 'Prof. Adams', 'Dr. Wright', 'Prof. Scott', 'Dr. Harris']
];

// Helper function to get a random subject and ensure no overlap for the same division
function getAvailableSubject($assigned_subjects, $year_subjects) {
    $available_subjects = array_diff($year_subjects, $assigned_subjects);
    return !empty($available_subjects) ? $available_subjects[array_rand($available_subjects)] : $year_subjects[array_rand($year_subjects)];
}

// Helper function to get a random faculty and ensure no overlapping for the same time slot across divisions
function getAvailableFaculty($year, $division, $day, $time, $faculty, $timetable) {
    global $years;

    // Find the faculty who aren't assigned to any other division at the same time
    $available_faculty = $faculty[$year];
    foreach ($years[$year] as $div) {
        if (isset($timetable[$year][$div][$day][$time]) && $div !== $division) {
            $assigned_faculty = $timetable[$year][$div][$day][$time]['faculty'];
            $available_faculty = array_diff($available_faculty, [$assigned_faculty]);
        }
    }
    
    return !empty($available_faculty) ? $available_faculty[array_rand($available_faculty)] : $faculty[$year][array_rand($faculty[$year])];
}

// Generate timetable with no overlapping for faculty between divisions in the same time slot
function generateTimetable($years, $days, $time_slots, $subjects, $faculty) {
    $timetable = [];

    foreach ($years as $year => $divisions) {
        foreach ($divisions as $division) {
            foreach ($days as $day) {
                $assigned_subjects = [];

                foreach ($time_slots as $time) {
                    // Add Lunch Break from 12:00 PM to 1:00 PM
                    if ($time === '12:00 PM - 1:00 PM') {
                        $timetable[$year][$division][$day][$time] = [
                            'subject' => 'Lunch Break',
                            'faculty' => '-'
                        ];
                    } else {
                        // Get available subject and faculty
                        $subject = getAvailableSubject($assigned_subjects, $subjects[$year]);
                        $teacher = getAvailableFaculty($year, $division, $day, $time, $faculty, $timetable);

                        // Store assigned subjects to avoid overlaps within the same division
                        $assigned_subjects[] = $subject;

                        // Assign the timetable entry
                        $timetable[$year][$division][$day][$time] = [
                            'subject' => $subject,
                            'faculty' => $teacher
                        ];
                    }
                }
            }
        }
    }

    return $timetable;
}

// Display timetable for each division as a single table with all days included
function displayTimetable($timetable) {
    foreach ($timetable as $year => $divisions) {
        echo "<h1>Timetable for $year</h1>";
        foreach ($divisions as $division => $days) {
            echo "<h2>Timetable for $division</h2>";
            echo "<table border='1' cellpadding='10'>";
            echo "<tr><th>Time Slot</th>";
            foreach (array_keys($days) as $day) {
                echo "<th>$day</th>";
            }
            echo "</tr>";

            // Loop through each time slot and display subjects/faculty for each day
            foreach (array_keys(current($days)) as $time_slot) {
                echo "<tr>";
                echo "<td>$time_slot</td>";
                foreach ($days as $day => $times) {
                    $subject = $times[$time_slot]['subject'];
                    $faculty = $times[$time_slot]['faculty'];
                    echo "<td>$subject<br>($faculty)</td>";
                }
                echo "</tr>";
            }
            echo "</table><br>";
        }
    }
}

// Generate and display the timetable
$timetable = generateTimetable($years, $days, $time_slots, $subjects, $faculty);
displayTimetable($timetable);

?>
