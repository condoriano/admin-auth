<?php namespace Condoriano\AdminAuth;

use Illuminate\Auth\Guard;

class AdminGuard extends Guard {

    public function getName()
    {
        return 'admin_login_'.md5(get_class($this));
    }

    public function getRecallerName()
    {
        return 'admin_remember_'.md5(get_class($this));
    }

}
