<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Ticket extends Model
{
    protected  $connection = 'mongodb';

    protected  $collection = 'tickets';
    protected $fillable = ['title', 'description', 'status'];

    const STATUSES = ['open', 'in_progress', 'closed'];

}
