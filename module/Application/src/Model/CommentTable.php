<?php

namespace Application\Model;

use RuntimeException;
use Zend\Db\TableGateway\TableGatewayInterface;

class CommentTable
{
    private $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }
    
    public function fetchAll()
    {
        return $this->tableGateway->select();
    }
    
    public function getComment($id)
    {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(['id' => $id]);
        $row = $rowset->current();
        if (! $row) {
            throw new RuntimeException(sprintf(
                'Could not find row with identifier %d',
                $id
            ));
        }
    }

    public function saveComment(Comment $comment)
    {
        $data = [
            'id' => $comment->id,
            'user_name'  => $comment->user_name,
            'user_ip' => $comment->user_ip,
            'email'  => $comment->email,
            'home_page' => $comment->home_page,
            'text'  => $comment->text,
            'created_at' => $comment->created_at,
            'updated_at'  => $comment->updated_at,            
        ];

        $id = (int) $comment->id;

        if ($id === 0) {
            $this->tableGateway->insert($data);
            return;
        }

        try {
            $this->getComment($id);
        } catch (RuntimeException $e) {
            throw new RuntimeException(sprintf(
                'Cannot update comment with identifier %d; does not exist',
                $id
            ));
        }

        $this->tableGateway->update($data, ['id' => $id]);
    }

    public function deleteComment($id)
    {
        $this->tableGateway->delete(['id' => (int) $id]);
    }
}