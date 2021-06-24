<?php

namespace App\Models;

use App\Helpers\TodoHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Rorecek\Ulid\HasUlid;

class Todo extends Model
{
    use HasFactory;
    use HasUlid;

    protected $fillable = [
        'title',
        'completed_at'
    ];

    protected $casts = [
        'completed_at' => 'datetime:' . TodoHelper::DB_TIMESTAMP_FORMAT,
        'created_at' => 'datetime:' . TodoHelper::DB_TIMESTAMP_FORMAT,
        'updated_at' => 'datetime:' . TodoHelper::DB_TIMESTAMP_FORMAT,
    ];

    public function updateWith(array $attrs)
    {
        if (array_key_exists('completed_at', $attrs)) {
            $this->completed_at = $attrs['completed_at'];
            unset($attrs['completed_at']);
        }

        foreach ($attrs as $attr => $value) {
            $this[$attr] = $value;
        }

        $this->save();
        return $this;
    }
}
