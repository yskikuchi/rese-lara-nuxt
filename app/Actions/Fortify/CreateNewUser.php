<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:30'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'tel' => ['required', 'regex:/^0[0-9]{9,10}$/'],
            'password' => ['required','min:8','max:20']
        ])->validate();

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'tel' => $input['tel'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
