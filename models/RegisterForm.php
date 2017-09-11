<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;

class RegisterForm extends Model
{
	public $name;
	public $email;
    public $password;

    private $_user;

    public function rules()
    {
    	return [
            [['name', 'email', 'password'], 'required'],
            [['name'], 'string'],
            [['name'], 'unique', 'targetClass' => 'app\models\User', 'targetAttribute' => 'name'],
            [['email'], 'email'],
            [['email'], 'unique', 'targetClass' => 'app\models\User', 'targetAttribute' => 'email'],
            //['password', 'validatePassword'],
        ];
    }

    public function register()
    {
    	if($this->validate())
    	{
    		$user  = new User();
    		$user->attributes = $this->attributes;

    		return $user->create();
    	}
    }

    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }
}