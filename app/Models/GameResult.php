<?php

namespace App\Models;

use App\Enums\GameResultState;
use App\ValueObjects\Money;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameResult extends Model
{
    use HasFactory;

    protected $table = 'game_results';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'result',
        'result_state',
        'prize',
        'currency'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getPrizeInMoney(): Money
    {
        return new Money($this->prize, $this->currency);
    }

    public function getResultStateAttribute($value): GameResultState
    {
        return GameResultState::from($value);
    }

    public function setResultStateAttribute(GameResultState $state)
    {
        $this->attributes['result_state'] = $state->value;
    }
}
