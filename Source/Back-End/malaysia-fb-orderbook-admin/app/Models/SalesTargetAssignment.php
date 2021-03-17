<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesTargetAssignment extends Model
{
    use HasFactory;
    protected $table = 'sales_target_assignments';
    protected $primaryKey = 'id';
    public $incrementing = false;

    protected $fillable = ['user_id', 'target_month', 'target_year', 'amount'];
}
