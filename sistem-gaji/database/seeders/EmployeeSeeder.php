<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Employee;
use App\Models\Salary;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employees = [
            [
                'name' => 'Ahmad Surya',
                'nip' => 'EMP001',
                'position' => 'Software Developer',
                'department' => 'IT',
                'join_date' => '2023-01-15',
                'status' => 'active',
            ],
            [
                'name' => 'Siti Nurhaliza',
                'nip' => 'EMP002',
                'position' => 'HR Manager',
                'department' => 'Human Resources',
                'join_date' => '2022-06-10',
                'status' => 'active',
            ],
            [
                'name' => 'Budi Santoso',
                'nip' => 'EMP003',
                'position' => 'Finance Analyst',
                'department' => 'Finance',
                'join_date' => '2023-03-20',
                'status' => 'active',
            ],
            [
                'name' => 'Maya Sari',
                'nip' => 'EMP004',
                'position' => 'Marketing Specialist',
                'department' => 'Marketing',
                'join_date' => '2022-11-05',
                'status' => 'active',
            ],
            [
                'name' => 'Rudi Hartono',
                'nip' => 'EMP005',
                'position' => 'Operations Manager',
                'department' => 'Operations',
                'join_date' => '2021-08-12',
                'status' => 'active',
            ],
        ];

        foreach ($employees as $employeeData) {
            $employee = Employee::create($employeeData);

            // Create salary for each employee
            $baseSalary = rand(4000000, 8000000);
            $allowance = rand(500000, 1500000);
            $deduction = rand(0, 200000);
            $totalSalary = $baseSalary + $allowance - $deduction;

            Salary::create([
                'employee_id' => $employee->id,
                'base_salary' => $baseSalary,
                'allowance' => $allowance,
                'deduction' => $deduction,
                'total_salary' => $totalSalary,
                'pay_date' => now()->startOfMonth(),
                'period' => now()->format('Y-m'),
                'status' => 'paid',
            ]);
        }
    }
}
