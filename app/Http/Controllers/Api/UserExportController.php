<?php

namespace App\Http\Controllers\Api;

use App\Models\UserRegister;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Barryvdh\DomPDF\Facade\Pdf;

use function PHPUnit\Framework\isEmpty;

class UserExportController extends Controller
{
    //
    public function UserexportToExcel()
    {
        $users = UserRegister::all();

        // Check if there are any users
        if ($users->isEmpty()) {
            return redirect('/UserManagement')->with('failedToExport', 'No users found to export');
        }

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set headers
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'First Name');
        $sheet->setCellValue('C1', 'Last Name');
        $sheet->setCellValue('D1', 'Birth Year');
        $sheet->setCellValue('E1', 'Birth Month');
        $sheet->setCellValue('F1', 'Birth Day');
        $sheet->setCellValue('G1', 'Gender');
        $sheet->setCellValue('H1', 'Email');
        $sheet->setCellValue('I1', 'Password');
        $sheet->setCellValue('J1', 'Created At');

        // Add data
        $row = 2;
        foreach ($users as $Ecommerce_users) {
            $sheet->setCellValue('A' . $row, $Ecommerce_users->id);
            $sheet->setCellValue('B' . $row, $Ecommerce_users->firstName);
            $sheet->setCellValue('C' . $row, $Ecommerce_users->lastName);
            $sheet->setCellValue('D' . $row, $Ecommerce_users->birthYear);
            $sheet->setCellValue('E' . $row, $Ecommerce_users->birthMonth);
            $sheet->setCellValue('F' . $row, $Ecommerce_users->birthDay);
            $sheet->setCellValue('G' . $row, $Ecommerce_users->gender);
            $sheet->setCellValue('H' . $row, $Ecommerce_users->email);
            $sheet->setCellValue('I' . $row, $Ecommerce_users->password);
            $sheet->setCellValue('J' . $row, $Ecommerce_users->created_at);
            $row++;
        }

        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="users.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }


    public function exportPDF()
    {
        try {
            $users = UserRegister::all();

            if ($users->isEmpty()) {
                return redirect('/UserManagement')->with('failedToExport', 'No users found to Download to PDF');
            }

            $pdf = PDF::loadView('components/superAdmin/pages/users-pdf', ['users' => $users]);
            return $pdf->download('users.pdf');
        } catch (\Exception $e) {
            return redirect()->back()->with('failedToExport', 'Failed to export PDF: ' . $e->getMessage());
        }
    }
}
