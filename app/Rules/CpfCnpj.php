<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Pessoa;

class CpfCnpj implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(
        protected $id = null,
    )
    {

    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $value = preg_replace('/[^0-9]/', '', $value);

        return Pessoa::where('cpf_cnpj', $value)->where('id', '!=', $this->id)->doesntExist();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute already exist.';
    }
}
