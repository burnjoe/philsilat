<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Validation\Rule;

class AccountsEdit extends Component
{
    public $user;

    public $last_name;
    public $first_name;
    public $sex;
    public $email;
    public $password;
    public $phone;
    public $role;
    public $status;


    /**
     * Renders the view
     */
    public function render()
    {
        return view('livewire.accounts.edit');
    }

    /**
     * Validation rules
     */
    public function rules()
    {
        if ($this->password) {
            return [
                'last_name' => ['required', 'string', 'min:2', 'max:50'],
                'first_name' => ['required', 'string', 'min:2', 'max:50'],
                'phone' => [
                    'required', 'regex:/^09\d{9}$/',
                    Rule::unique('admins', 'phone')->ignore($this->user->id),
                    Rule::unique('coaches', 'phone')->ignore($this->user->id),
                ],
                'sex' => ['required', 'in:Male,Female'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $this->user->id],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'role' => ['required', 'string', 'in:Admin,Coach'],
                'status' => ['required', 'string', 'in:ACTIVE,INACTIVE'],
            ];
        }

        return [
            'last_name' => ['required', 'string', 'min:2', 'max:50'],
            'first_name' => ['required', 'string', 'min:2', 'max:50'],
            'phone' => [
                'required', 'regex:/^09\d{9}$/',
                Rule::unique('admins', 'phone')->ignore($this->user->id),
                Rule::unique('coaches', 'phone')->ignore($this->user->id),
            ],
            'sex' => ['required', 'in:Male,Female'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $this->user->id],
            'role' => ['required', 'string', 'in:Admin,Coach'],
            'status' => ['required', 'string', 'in:ACTIVE,INACTIVE'],
        ];
    }

    /**
     * Validation messages
     */
    public function messages()
    {
        return [
            'phone.regex' => 'The :attribute field must be in a valid format. (e.g. 0921XXXXXXX)',
        ];
    }

    /**
     * Validation attributes
     */
    public function validationAttributes()
    {
        return [
            'email' => 'email address',
            'phone' => 'phone number',
        ];
    }

    /**
     * Initializes attributes upon load
     */
    public function mount()
    {
        try {
            $this->user = User::with('profileable')->find(session('id'));

            $this->last_name = $this->user->profileable->last_name;
            $this->first_name = $this->user->profileable->first_name;
            $this->sex = $this->user->profileable->sex;
            $this->email = $this->user->email;
            $this->phone = $this->user->profileable->phone;
            $this->role = ucwords($this->user->getRoleNames()->first());
            $this->status = $this->user->status;
        } catch (\Throwable $th) {
            redirect()->route('accounts');
        }
    }

    /**
     * Update the selected category
     */
    public function update()
    {
        // Add here checking if this user (admins & coaches) is associated with other records
        $validated = $this->validate();

        $this->user->update($validated);

        redirect()->route('accounts')
            ->with('success', 'The user account has been updated successfully.');
    }
}
