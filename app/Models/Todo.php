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
        'completed_at' =>  TodoHelper::DB_TIMESTAMP_CAST,
        'created_at' =>  TodoHelper::DB_TIMESTAMP_CAST,
        'updated_at' =>  TodoHelper::DB_TIMESTAMP_CAST,
    ];

    public function updateWith(array $attrs)
    {
        foreach ($attrs as $attr => $value) {
            $this[$attr] = $value;
        }

        $this->save();
        return $this;
    }

    public function stringAttr(string $attrName)
    {
        $attr = $this[$attrName];

        if ($attr instanceof \DateTimeInterface) {
            return TodoHelper::formatDbTimestamp($attr);
        }

        return $attr;
    }
}
