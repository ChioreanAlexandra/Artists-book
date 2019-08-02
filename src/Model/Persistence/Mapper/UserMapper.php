<?php

namespace MyApp\Model\Persistence\Mapper;

use MyApp\Model\DomainObjects\User;
use MyApp\Model\Helper\Form\UserField;

class UserMapper extends AbstractMapper
{
    /**
     * @param User $user
     * @return int
     */
    public function save(User $user): int
    {
        if ($user->getId() === null) {
            return $this->insert($user);
        }
        return $this->update($user);
    }

    /**
     * @param User $user
     * @return int
     */
    private function insert(User $user): int
    {
        //TODO: transform user to array row then prepare an INSERT ($this->getPdo()) and execute
        $row = $this->translateToArray($user);
        $sql = "INSERT INTO user (name,email,password) VALUES (:name,:email,:password) ";
        $statement = $this->getPdo()->prepare($sql);
        $statement->bindValue('name', $row[UserField::getNameField()]);
        $statement->bindValue('email', $row[UserField::getEmailField()]);
        $statement->bindValue('password', $row[UserField::getPasswordField()]);
        $statement->execute();
        return $this->getPdo()->lastInsertId();
    }

    /**
     * @param User $user
     * @return array
     */
    private function translateToArray(User $user): array
    {
        $row = [
            UserField::getId() => $user->getId(),
            UserField::getNameField() => $user->getName(),
            UserField::getEmailField() => $user->getEmail(),
        ];

        // write password only when is set/user is a new entity (on load it is never read into the property)
        if ($user->getPassword() !== null) {
            $row[UserField::getPasswordField()] = password_hash($user->getPassword(), CRYPT_SHA512);
        }

        return $row;
    }

}