<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Auth\Authenticatable; // Add this line to import the interface
use Illuminate\Auth\Authenticatable as AuthenticatableTrait; // Add this line for the Authenticatable trait

class Employee extends Model implements Authenticatable
{
    use HasFactory, AuthenticatableTrait; // Add the trait to your model
    protected $primaryKey = 'unique_id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'unique_id',
        'EmpName',
        'MobileNumber',
        'position',
        'email',
        'password',
        'joining_date',
        'image',
    ];
    // Automatically generate the unique ID when creating a new employee
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($employee) {
            $companyInitial = 'IN'; // First 2 letters of "Infanion"
            $roleInitial = substr($employee->position, 0, 2); // First 2 letters of position
            $date = now()->format('dmY'); // Current date in ddmmyyyy format

            // Get the last increment from the unique_id
            $lastEmployee = Employee::latest('unique_id')->first();
            $lastIncrement = $lastEmployee ? (int)substr($lastEmployee->unique_id, -2) : 0;

            $nextIncrement = str_pad($lastIncrement + 1, 2, '0', STR_PAD_LEFT);
            $employee->unique_id = $companyInitial . $roleInitial . $date . $nextIncrement;
        });
    }
}
