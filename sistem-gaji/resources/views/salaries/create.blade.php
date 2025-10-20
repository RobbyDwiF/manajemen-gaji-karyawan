<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Salary Record') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('salaries.store') }}" id="salaryForm">
                        @csrf

                        <!-- Employee -->
                        <div class="mb-4">
                            <x-input-label for="employee_id" :value="__('Employee')" />
                            <select id="employee_id" name="employee_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                <option value="">Select Employee</option>
                                @foreach($employees as $employee)
                                    <option value="{{ $employee->id }}" {{ old('employee_id') == $employee->id ? 'selected' : '' }}>
                                        {{ $employee->name }} ({{ $employee->nip }})
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('employee_id')" class="mt-2" />
                        </div>

                        <!-- Period -->
                        <div class="mb-4">
                            <x-input-label for="period" :value="__('Period')" />
                            <x-text-input id="period" class="block mt-1 w-full" type="text" name="period" :value="old('period')" placeholder="e.g., January 2024" required />
                            <x-input-error :messages="$errors->get('period')" class="mt-2" />
                        </div>

                        <!-- Base Salary -->
                        <div class="mb-4">
                            <x-input-label for="base_salary" :value="__('Base Salary')" />
                            <x-text-input id="base_salary" class="block mt-1 w-full" type="number" name="base_salary" :value="old('base_salary')" required />
                            <x-input-error :messages="$errors->get('base_salary')" class="mt-2" />
                        </div>

                        <!-- Allowance -->
                        <div class="mb-4">
                            <x-input-label for="allowance" :value="__('Allowance')" />
                            <x-text-input id="allowance" class="block mt-1 w-full" type="number" name="allowance" :value="old('allowance', 0)" />
                            <x-input-error :messages="$errors->get('allowance')" class="mt-2" />
                        </div>

                        <!-- Deduction -->
                        <div class="mb-4">
                            <x-input-label for="deduction" :value="__('Deduction')" />
                            <x-text-input id="deduction" class="block mt-1 w-full" type="number" name="deduction" :value="old('deduction', 0)" />
                            <x-input-error :messages="$errors->get('deduction')" class="mt-2" />
                        </div>

                        <!-- Total Salary (Auto-calculated) -->
                        <div class="mb-4">
                            <x-input-label for="total_salary" :value="__('Total Salary')" />
                            <x-text-input id="total_salary" class="block mt-1 w-full bg-gray-100" type="number" name="total_salary" :value="old('total_salary')" readonly />
                            <p class="text-sm text-gray-500 mt-1">Auto-calculated: Base Salary + Allowance - Deduction</p>
                            <x-input-error :messages="$errors->get('total_salary')" class="mt-2" />
                        </div>

                        <!-- Pay Date -->
                        <div class="mb-4">
                            <x-input-label for="pay_date" :value="__('Pay Date')" />
                            <x-text-input id="pay_date" class="block mt-1 w-full" type="date" name="pay_date" :value="old('pay_date')" required />
                            <x-input-error :messages="$errors->get('pay_date')" class="mt-2" />
                        </div>

                        <!-- Status -->
                        <div class="mb-4">
                            <x-input-label for="status" :value="__('Status')" />
                            <select id="status" name="status" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="paid" {{ old('status') == 'paid' ? 'selected' : '' }}>Paid</option>
                            </select>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>

                        <!-- Notes -->
                        <div class="mb-4">
                            <x-input-label for="notes" :value="__('Notes')" />
                            <textarea id="notes" name="notes" rows="3" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('notes') }}</textarea>
                            <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('salaries.index') }}" class="mr-4 text-gray-600 hover:text-gray-900">Cancel</a>
                            <x-primary-button>
                                {{ __('Create Salary Record') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const baseSalaryInput = document.getElementById('base_salary');
            const allowanceInput = document.getElementById('allowance');
            const deductionInput = document.getElementById('deduction');
            const totalSalaryInput = document.getElementById('total_salary');

            function calculateTotal() {
                const baseSalary = parseFloat(baseSalaryInput.value) || 0;
                const allowance = parseFloat(allowanceInput.value) || 0;
                const deduction = parseFloat(deductionInput.value) || 0;
                const total = baseSalary + allowance - deduction;
                totalSalaryInput.value = total;
            }

            baseSalaryInput.addEventListener('input', calculateTotal);
            allowanceInput.addEventListener('input', calculateTotal);
            deductionInput.addEventListener('input', calculateTotal);

            // Initial calculation
            calculateTotal();
        });
    </script>
</x-app-layout>
