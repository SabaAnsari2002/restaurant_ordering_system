<?php

namespace app\models;

use yii\base\Model;

class RegisterForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $confirmPassword;
    public $role;

    public function rules()
    {
        return [
            [['username', 'email', 'password', 'confirmPassword', 'role'], 'required'],
            ['email', 'email'],
            ['username', 'string', 'min' => 4, 'max' => 255],
            ['password', 'string', 'min' => 6],
            ['confirmPassword', 'compare', 'compareAttribute' => 'password', 'message' => 'Passwords must match.'],
            ['role', 'in', 'range' => ['customer', 'restaurant']],
        ];
    }

    public function register()
    {
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            $user->role = $this->role;
            if ($user->save()) {
                return $user;
            }
        }
        return null;
    }
}
