<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'deadline', 'task_status_id'];

    public function taskStatus(){
        return $this->belongsTo(TaskStatus::class);
    }}
