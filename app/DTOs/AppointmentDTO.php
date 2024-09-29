<?php

namespace App\DTOs;

use Carbon\Carbon;


/** 
 * Main representation of an Appointment
 */
class AppointmentDTO
{
    public $id;
    public $author;
    public $content;
    public $score;
    public $created_at;
    public $updated_at;

    public function __construct(
        int $id,
        string $author,
        string $content,
        int $score,
        Carbon $created_at,
        ?Carbon $updated_at,
    ) {
        $this->id = $id;
        $this->author = $author;
        $this->content = $content;
        $this->score = $score;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

    /**
     * Used for serialization purposes
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'autor' => $this->author,
            'content' => $this->content,
            'score' => $this->score,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
