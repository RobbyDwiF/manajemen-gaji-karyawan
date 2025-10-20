<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Salary;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Get statistics
        $totalEmployees = Employee::count();
        $activeEmployees = Employee::where('status', 'active')->count();

        // Get total salary for current month
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $totalSalaryThisMonth = Salary::whereYear('pay_date', $currentYear)
            ->whereMonth('pay_date', $currentMonth)
            ->sum('total_salary');

        // Get last payroll date
        $lastPayrollDate = Salary::latest('pay_date')->first()?->pay_date;

        // Get recent salaries (last 5)
        $recentSalaries = Salary::with('employee')
            ->latest('pay_date')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalEmployees',
            'activeEmployees',
            'totalSalaryThisMonth',
            'lastPayrollDate',
            'recentSalaries'
        ));
    }
}
