<?php
// Include PhpSpreadsheet classes
require 'PhpSpreadsheet/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize reservation data from the form
    $date = htmlspecialchars($_POST["date"]);
    $time = htmlspecialchars($_POST["time"]);
    $partySize = htmlspecialchars($_POST["party-size"]);

    // Validate form data (add more validation as needed)
    if (empty($date) || empty($time) || empty($partySize)) {
        echo "Please fill in all required fields.";
        // You might redirect the user back to the reservation form or handle this differently
    } else {
        // Create a PhpSpreadsheet spreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Add headers to the spreadsheet
        $sheet->setCellValue('A1', 'Date');
        $sheet->setCellValue('B1', 'Time');
        $sheet->setCellValue('C1', 'Party Size');

        // Add reservation details to the spreadsheet
        $row = $sheet->getHighestRow() + 1;
        $sheet->setCellValue('A' . $row, $date);
        $sheet->setCellValue('B' . $row, $time);
        $sheet->setCellValue('C' . $row, $partySize);

        // Save the spreadsheet to a file (replace 'reservations.xlsx' with your desired file name)
        $writer = new Xlsx($spreadsheet);
        $writer->save('reservations.xlsx');

        // Send a confirmation email to the user
        $to = $_POST["user-email"];
        $subject = "Reservation Confirmation";
        $message = "Thank you for your reservation. Your reservation details:\nDate: $date\nTime: $time\nParty Size: $partySize";
        $headers = "From: your-email@example.com";

        mail($to, $subject, $message, $headers);

        echo "Reservation successful! Confirmation email sent. Reservation details saved to reservations.xlsx";
    }
}
?>
