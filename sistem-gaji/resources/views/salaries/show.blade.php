<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Salary Details') }}
            </h2>
            <div>
                <a href="{{ route('salaries.edit', $salary) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">
                    Edit Salary
                </a>
                <a href="{{ route('salaries.slip', $salary) }}" target="_blank" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mr-2">
                    Print Slip
                </a>
                <a href="{{ route('salaries.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Back to List
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Employee Information -->
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Employee Information</h3>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Name</p>
                                    <p class="text-sm text-gray-900">{{ $salary->employee->name }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">NIP</p>
                                    <p class="text-sm text-gray-900">{{ $salary->employee->nip }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Position</p>
                                    <p class="text-sm text-gray-900">{{ $salary->employee->position }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Department</p>
                                    <p class="text-sm text-gray-900">{{ $salary->employee->department }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Salary Breakdown -->
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Salary Breakdown</h3>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center py-2 border-b border-gray-200">
                                <span class="text-sm font-medium text-gray-500">Period</span>
                                <span class="text-sm text-gray-900">{{ $salary->period }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-200">
                                <span class="text-sm font-medium text-gray-500">Base Salary</span>
                                <span class="text-sm text-gray-900">Rp {{ number_format($salary->base_salary, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-200">
                                <span class="text-sm font-medium text-gray-500">Allowance</span>
                                <span class="text-sm text-green-600">+ Rp {{ number_format($salary->allowance, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-200">
                                <span class="text-sm font-medium text-gray-500">Deduction</span>
                                <span class="text-sm text-red-600">- Rp {{ number_format($salary->deduction, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-t-2 border-gray-300 pt-4">
                                <span class="text-lg font-bold text-gray-900">Total Salary</span>
                                <span class="text-lg font-bold text-gray-900">Rp {{ number_format($salary->total_salary, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Information -->
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Payment Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Pay Date</p>
                                <p class="text-sm text-gray-900">{{ $salary->pay_date->format('d M Y') }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Status</p>
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $salary->status === 'paid' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ ucfirst($salary->status) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Notes -->
                    @if($salary->notes)
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Notes</h3>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <p class="text-sm text-gray-900">{{ $salary->notes }}</p>
                            </div>
                        </div>
                    @endif

                    <!-- Actions -->
                    <div class="flex justify-end space-x-4">
                        <form method="POST" action="{{ route('salaries.destroy', $salary) }}" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Are you sure you want to delete this salary record?')">
                                Delete Record
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
