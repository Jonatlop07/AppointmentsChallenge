<?php

namespace App\Http\Requests;

use App\DTOs\CreateAppointmentDTO;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Used to map payload data required to create an appointment at
 * the http level. Also allows for validation of the input data.
 * Could also be extended with OpenAPI documentation.
 */
class CreateAppointmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'author' => 'required|string|max:255',
            'content' => 'required|string',
            'score' => 'required|integer|between:0,5',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'score.between' => 'The score must be between 0 and 5.',
        ];
    }

    /**
     * Map the request to a CreateAppointmentDTO
     */
    public function toCreateAppointmentDTO(): CreateAppointmentDTO
    {
        return new CreateAppointmentDTO(
            $this->input('author'),
            $this->input('content'),
            $this->input('score')
        );
    }
}
