<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EvaluationMetric extends Model
{
    protected $fillable = [
        'evaluation_account_id',
        'profit', 'trades_count', 'drawDown',
        'rules_violated', 'max_drawdown',
    ];
}
