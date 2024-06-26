<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'appointments';

   protected $casts =[

    'parking' => 'array',

   ];

    protected $dates = [
        'start_time',
        'created_at',
        'updated_at',
        'deleted_at',
        'finish_time',
        'pstart_time',
        'pfinish_time',
    ];

    protected $fillable = [
        'name',
        'comments',
        'client_id',
        'employee_name',
        'start_time',
        'capacity',
        'alcohol_sales',
        'ems_approval',
        'evac_points',
        'noise',
        'parking',
        'created_at',
        'updated_at',
        'deleted_at',
        'employee_id',
        'finish_time',
        'pstart_time',
        'pfinish_time',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function services()
    {
        return $this->belongsToMany(Service::class);
    }
}
