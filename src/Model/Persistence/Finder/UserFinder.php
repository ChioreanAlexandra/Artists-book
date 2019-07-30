<?php


use Model\DomainObject\User;

class UserFinder extends AbstractFinder
{
    public function findById(int $id): User
    {
        // TODO: you can extract the table name in a constant, or a getter function, or config
        $sql = "select * from users where id=?";
        $statement = $this->getPdo()->prepare($sql);
        $statement->bindValue(0, $id, PDO::PARAM_INT);
        $row = $statement->fetch(PDO::FETCH_ASSOC);

        //TODO: we are assuming here the property names and column names are the same (adjust if not in your case)
        return $this->translateToUser($row);
    }

    private function translateToUser(array $row): User
    {
        $user = new User($row['name'], $row['email'], null, $row['id']);

        return $user;
    }
}