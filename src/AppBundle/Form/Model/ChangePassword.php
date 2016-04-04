<?php

namespace AppBundle\Form\Model;

use Symfony\Component\Security\Core\Validator\Constraints as SecurityAssert;
use Symfony\Component\Validator\Constraints as Assert;

class ChangePassword
{

    /**
     * @SecurityAssert\UserPassword(
     *     message = "Uw huidig wachtwoord is niet correct"
     * )
     */
    protected $oldPassword;

    /**
     * @Assert\Length(
     *     min = 6,
     *     minMessage = "Wachtwoord moet minstens 6 karakters lang zijn"
     * )
     */
    protected $newPassword;

    public function setOldPassword($oldPassword) {
        $this->oldPassword = $oldPassword;
    }

    public function getOldPassword() {
        return $this->oldPassword;
    }

    public function setNewPassword($newPassword) {
        $this->newPassword = $newPassword;
    }

    public function getNewPassword() {
        return $this->newPassword;
    }

}
