<?php


namespace MyApp\Model\Persistence\Mapper;


use MyApp\Model\DomainObjects\OrderItem;

class OrderItemMapper extends AbstractMapper
{
    public function save(OrderItem $orderItem)
    {
        $this->insert($orderItem);
    }

    private function translateToArray(OrderItem $orderItem): array
    {
        return [
            'created_at'=>$orderItem->getCreatedAt(),
            'user_id'=>$orderItem->getUserId(),
            'tier_id'=>$orderItem->getTierId()
        ];
    }
    private function insert(OrderItem $orderItem)
    {
        //TODO: transform user to array row then prepare an INSERT ($this->getPdo()) and execute
        $row = $this->translateToArray($orderItem);
        $sql = "insert into order_item(created_at,user_id,tier_id) values(:created_at, :user_id, :tier_id)";
        $statement = $this->getPdo()->prepare($sql);
        $statement->bindValue('created_at',$row['created_at']->format('Y-m-d H:i:s'));
        $statement->bindValue('user_id',$row['user_id']);
        $statement->bindValue('tier_id',$row['tier_id']);
        $statement->execute();
    }
}