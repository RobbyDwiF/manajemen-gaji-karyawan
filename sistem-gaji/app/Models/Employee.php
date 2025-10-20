<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'nip',
        'name',
        'position',
        'department',
        'join_date',
        'status',
        'address',
        'phone',
        'email',
        'birth_date',
    ];

    protected $casts = [
        'join_date' => 'date',
        'birth_date' => 'date',
    ];

    public function salaries()
    {
        return $this->hasMany(Salary::class);
    }

    public function getTotalSalaryAttribute()
    {
        return $this->salaries()->where('status', 'paid')->sum('total_salary');
    }

    public function getLatestSalaryAttribute()
    {
        return $this->salaries()->latest()->first();
    }
}
