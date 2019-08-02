<?php

namespace MyApp\Model\Persistence\Finder;

use MyApp\Model\DomainObjects\User;
use MyApp\Model\Helper\Form\UserField;
use PDO;

class UserFinder extends AbstractFinder
{
    /**
     * @param array $row
     * @return User
     */
    private function translateToUser(array $row): User
    {
        $user = new User($row[UserField::getEmailField()], null, $row[UserField::getNameField()], $row[UserField::getId()]);
        return $user;
    }

    /**
     * Find user with given array and check password
     * @param string $email
     * @param string $password
     * @return User|null
     */
    public function findByCredentials(string $email, string $password): ?User
    {

        // TODO: you can extract the table name in a constant, or a getter function, or config
        $sql = "select * from user where email=?";
        $statement = $this->getPdo()->prepare($sql);
        $statement->bindValue(1, $email, PDO::PARAM_STR_CHAR);
        $statement->execute();
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        if (!$row || !password_verify($password,$row[UserField::getPasswordField()])) {
            return null;
        }
        return $this->translateToUser($row);
    }

    /**
     * @param int $id
     * @return User|null
     */
    public function findById(int $id): ?User
    {

        // TODO: you can extract the table name in a constant, or a getter function, or config
        $sql = "select * from user where id=?";
        $statement = $this->getPdo()->prepare($sql);
        $statement->bindValue(1, $id, PDO::PARAM_INT);
        $statement->execute();
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        if (!$row ) {
            return null;
        }
        return $this->translateToUser($row);
    }
}