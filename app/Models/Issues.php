<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issues extends Model
{
    use HasFactory;

    protected $fillable = [
        'module',
        'issue_type',
        'description',
        'img',
        'priority', 
        'status',
        'assigned_user_id', // Add assigned user ID to fillable fields
    ];

    public function user() // Add relationship to User model
    {
        return $this->belongsTo(User::class, 'assigned_user_id');
    }

    protected function setDueDateBasedOnPriority()
    {
        if ($this->priority === 'low') {
            $this->due_date = now()->addDay(); // Set due date to one day from now
        } elseif ($this->priority === 'medium') {
            $this->due_date = now()->addHours(6); // Set due date to six hours from now
        } elseif ($this->priority === 'high') {
            $this->due_date = now()->addHour(); // Set due date to one hour from now
        }
    }

    public function save(array $options = [])
    {
        $this->setDueDateBasedOnPriority(); // Set due date before saving
        return parent::save($options);
    }
}
