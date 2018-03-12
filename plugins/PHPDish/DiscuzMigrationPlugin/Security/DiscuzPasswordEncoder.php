<?php

namespace PHPDish\DiscuzMigrationPlugin\Security;

use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;

class DiscuzPasswordEncoder implements PasswordEncoderInterface
{
    /**
     * {@inheritdoc}
     */
    public function encodePassword($raw, $salt)
    {
        return md5(md5($raw) . $salt);
    }

    /**
     * {@inheritdoc}
     */
    public function isPasswordValid($encoded, $raw, $salt)
    {
        return hash_equals($encoded, $this->encodePassword($raw, $salt));
    }
}