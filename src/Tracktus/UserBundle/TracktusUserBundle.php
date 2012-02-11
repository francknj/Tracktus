<?php

namespace Tracktus\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class TracktusUserBundle extends Bundle
{
    public function getParent() {
        return 'FOSUserBundle';
    }
}
