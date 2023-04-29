<?php

namespace App\Rules;

use Illuminate\Validation\Rule;
use App\Models\Student;

class UniqueEmail extends Rule
{
    public function passes($attribute, $value)
    {
        return Student::where('email', $value)->count() === 0;
    }

    public function message()
    {
        return 'L\'adresse e-mail est déjà utilisée.';
    }
}