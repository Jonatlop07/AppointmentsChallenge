<?php

namespace App\DTOs;

/**
 * Payload data that is required in order
 * to create an appointment
 */
class CreateAppointmentDTO
{
    public $author;
    public $content;
    public $score;

    public function __construct(string $author, string $content, int $score)
    {
        $this->author = $author;
        $this->content = $content;
        $this->score = $score;
    }

    /**
     * Used for serialization purposes
     */
    public function toArray(): array
    {
        return [
            'author' => $this->author,
            'content' => $this->content,
            'score' => $this->score,
        ];
    }
}
