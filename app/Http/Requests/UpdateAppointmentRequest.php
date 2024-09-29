<?php

namespace App\Http\Requests;

use App\DTOs\UpdateAppointmentDTO;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Used to map payload data used to update an appointment at
 * the http level. Also allows for validation of the input data.
 * Could also be extended with OpenAPI documentation.
 */
class UpdateAppointmentRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'author' => 'sometimes|string|max:255',
            'content' => 'sometimes|string',
            'score' => 'sometimes|integer|between:0,5',
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
     * Map the request to an UpdateAppointmentDTO.
     */
    public function toUpdateAppointmentDTO(): UpdateAppointmentDTO
    {
        return new UpdateAppointmentDTO(
            $this->input('author'),
            $this->input('content'),
            $this->input('score')
        );
    }
}
