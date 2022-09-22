<?php 

namespace app\models;

use yii\db\ActiveRecord;

class Users extends ActiveRecord implements \yii\web\IdentityInterface
{
	public function setPassword($password)
	{
		$this->password=sha1($password);
	}
	public function validatePassword($password)
    {
        return $this->password === sha1($password);
    }
    //
    public static function findIdentity($id)
    {
        // return isset(self::findOne($id)) ? new static(self::findOne($id)) : null;
        return self::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::find() as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    public static function findByUsername($username)
    {
        foreach (self::find() as $user) {
            if (strcasecmp($user['login'], $username) === 0) {
                return new static($user);
            }
        }

        return null;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->authKey;
    }

    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }
    //
}