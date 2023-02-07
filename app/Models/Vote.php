<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vote extends Model {

    use HasUlids;

    protected $guarded = [];

    public function suggestion(): BelongsTo
    {
        return $this->belongsTo(Suggestion::class);
    }

}
