<?php

namespace App\Http\Requests;

use App\Enums\GoogleRemoveSetting;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;

class SettingsUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'todoist_disable_reminders' => 'nullable|boolean',
            'google_reminders' => ['required', new EnumValue(GoogleRemoveSetting::class)],
        ];
    }
}
