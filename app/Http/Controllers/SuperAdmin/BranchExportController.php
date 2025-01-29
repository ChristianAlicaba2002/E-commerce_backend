<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Domain\Branches\Branch;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Barryvdh\DomPDF\Facade\Pdf;


use App\Infrastructure\Persistence\Eloquent\Admin\BranchesModel;

class BranchExportController extends Controller
{
    //
    public function BranchexportToExcel()
    {
        $users = BranchesModel::all();

        // Check if there are any users
        if ($users->isEmpty()) {
            return redirect('/LoginSuperAdmin')->with('failedToExport', 'No users found to export');
        }

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set headers
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'branch_id');
        $sheet->setCellValue('C1', 'branch_name');
        $sheet->setCellValue('D1', 'first_name');
        $sheet->setCellValue('E1', 'last_name');
        $sheet->setCellValue('F1', 'address');
        $sheet->setCellValue('G1', 'phone_number');
        $sheet->setCellValue('H1', 'email');
        $sheet->setCellValue('I1', 'password');
        $sheet->setCellValue('J1', 'status');
        $sheet->setCellValue('K1', 'created_at');

        // Add data
        $row = 2;
        foreach ($users as $BranchOccupied) {
            $sheet->setCellValue('A' . $row, $BranchOccupied->id);
            $sheet->setCellValue('B' . $row, $BranchOccupied->branch_id);
            $sheet->setCellValue('C' . $row, $BranchOccupied->branch_name);
            $sheet->setCellValue('D' . $row, $BranchOccupied->first_name);
            $sheet->setCellValue('E' . $row, $BranchOccupied->last_name);
            $sheet->setCellValue('F' . $row, $BranchOccupied->address);
            $sheet->setCellValue('G' . $row, $BranchOccupied->phone_number);
            $sheet->setCellValue('H' . $row, $BranchOccupied->email);
            $sheet->setCellValue('I' . $row, $BranchOccupied->password);
            $sheet->setCellValue('J' . $row, $BranchOccupied->status);
            $sheet->setCellValue('K' . $row, $BranchOccupied->created_at);
            $row++;
        }

        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="users.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }

    public function exportBranchPDF()
    {
        try {
            $users = BranchesModel::all();

            if ($users->isEmpty()) {
                return redirect('/UserManagement')->with('failedToExport', 'No users found to Download to PDF');
            }

            $pdf = PDF::loadView('components/branchAdmin/atoms/branch-pdf', ['users' => $users]);
            return $pdf->download('users.pdf');
        } catch (\Exception $e) {
            return redirect()->back()->with('failedToExport', 'Failed to export PDF: ' . $e->getMessage());
        }
    }
}
