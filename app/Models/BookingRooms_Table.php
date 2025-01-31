<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingRooms_Table extends Model
{
    use HasFactory;

    // Define the table associated with the model
    protected $table = 'BookingRooms_Table';

    // Set the primary key (in case it differs from the default 'id')
    protected $primaryKey = 'id';

    // Disable auto-incrementing if it's not necessary
    public $incrementing = true;

    // Define the fillable fields (you should specify which attributes are mass-assignable)
    protected $fillable = [
        'unique_id',
        'room_id',
        'capacity',
        'booking_date',
        'booking_status',
        'start_time',
        'end_time',
    ];

    // Define the type casting for timestamps (start_time and end_time)
    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'booking_date' => 'date',
    ];

    // Optionally, add relationships if there are foreign key constraints
    public function user()
    {
        // Assuming there's a 'User' model, change the relationship as needed
        return $this->belongsTo(Employee::class, 'unique_id');
    }

    public function room()
    {
        // Assuming there's a 'Room' model, change the relationship as needed
        return $this->belongsTo(Room::class, 'room_id');
    }
}
