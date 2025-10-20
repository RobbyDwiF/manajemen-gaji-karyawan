<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Salary;
use Illuminate\Http\Request;
use PDF;

class ReportController extends Controller
{
    public function index()
    {
        return view('reports.index');
    }

    public function monthly(Request $request)
    {
        $month = $request->get('month', date('Y-m'));
        $salaries = Salary::with('employee')
            ->where('period', $month)
            ->where('status', 'paid')
            ->get();

        $totalSalary = $salaries->sum('total_salary');
        $totalEmployees = $salaries->count();

        return view('reports.monthly', compact('salaries', 'month', 'totalSalary', 'totalEmployees'));
    }

    public function employee(Request $request)
    {
        $employeeId = $request->get('employee_id');
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');

        $query = Salary::with('employee');

        if ($employeeId) {
            $query->where('employee_id', $employeeId);
        }

        if ($startDate && $endDate) {
            $query->whereBetween('pay_date', [$startDate, $endDate]);
        }

        $salaries = $query->where('status', 'paid')->get();
        $employees = Employee::all();

        return view('reports.employee', compact('salaries', 'employees', 'employeeId', 'startDate', 'endDate'));
    }

    public function exportMonthly(Request $request)
    {
        $month = $request->get('month', date('Y-m'));
        $salaries = Salary::with('employee')
            ->where('period', $month)
            ->where('status', 'paid')
            ->get();

        $pdf = PDF::loadView('reports.pdf.monthly', compact('salaries', 'month'));

        return $pdf->download('monthly-salary-report-' . $month . '.pdf');
    }

    public function exportEmployee(Request $request)
    {
        $employeeId = $request->get('employee_id');
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');

        $query = Salary::with('employee');

        if ($employeeId) {
            $query->where('employee_id', $employeeId);
        }

        if ($startDate && $endDate) {
            $query->whereBetween('pay_date', [$startDate, $endDate]);
        }

        $salaries = $query->where('status', 'paid')->get();

        $pdf = PDF::loadView('reports.pdf.employee', compact('salaries', 'startDate', 'endDate'));

        return $pdf->download('employee-salary-report.pdf');
    }
}
