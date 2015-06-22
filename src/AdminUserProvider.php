<?php namespace Condoriano\AdminAuth;

use Illuminate\Contracts\Auth\Authenticatable as UserContract;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Hashing\Hasher as HasherContract;

class AdminUserProvider implements UserProvider {

    protected $model;
    /**
     * @var HasherContract
     */
    private $hasher;

    public function __construct(HasherContract $hasher, UserContract $model)
    {
        $this->model = $model;
        $this->hasher = $hasher;
    }

    public function retrieveById($identifier)
    {
        return $this->model->newQuery()->find($identifier);
    }

    public function retrieveByToken($identifier, $token)
    {
        return $this->model->newQuery()
                           ->where($this->model->getKeyName(), $identifier)
                           ->where($this->model->getRememberTokenName(), $token)
                           ->first();
    }

    public function updateRememberToken(UserContract $user, $token)
    {
        $user->setRememberToken($token);

        $user->save();
    }

    public function retrieveByCredentials(array $credentials)
    {
        $query = $this->model->newQuery();

        foreach ($credentials as $key => $value)
        {
            if ( ! str_contains($key, 'password')) $query->where($key, $value);
        }

        return $query->first();
    }

    public function validateCredentials(UserContract $user, array $credentials)
    {
        $plain = $credentials['password'];

        return $this->hasher->check($plain, $user->getAuthPassword());
    }

}