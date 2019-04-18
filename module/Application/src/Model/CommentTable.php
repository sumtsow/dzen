<?php

namespace Application\Model;

use RuntimeException;
use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\TableGatewayInterface;
use Application\Model\Comment;
use Application\Model\Image;
<<<<<<< HEAD
=======
use Application\Model\Text;
>>>>>>> 523f37ef6f78c8eb78f8fa5b409039b38b86ce9b

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
    
    // return array of children comments for comment with $id
    // so, if $id = 0 or not defined, return top level comments array
    public function fetchChildren($id = '0', $sort = 'created_at', $order = 'DESC')
    {
        $select = new Select();
        $select->from('comments')->where("parent = '$id'")->order($sort.' '.$order);
        $resultSet = $this->tableGateway->selectWith($select);
        $resultArr = false;
        
        if($resultSet) {
            foreach($resultSet as $result) {
                $resultArr[] = $result;
            }
        }
        
        return $resultArr;
    } 
    
    public function hasChildren($id = '0')
    {
        return (self::fetchChildren($id)) ? true : false;
    }
    
    //return comments as multidimentional array - parent[children][children]...
    public function getHierarchy($id = '0', $sort = 'created_at', $order = 'DESC')
    {
        $result = false;
        $comments = $this->fetchChildren($id, $sort, $order);
        
        if($comments) {
            foreach($comments as $comment) {
                if(self::hasChildren($comment->id)) {
                    $comment->children = self::getHierarchy($comment->id, $sort, $order);
                }
                $result[] = $comment;
            }
        }
        
        return $result;
    }
    
    public function getComment($id)
    {
        $rowset = $this->tableGateway->select(['id' => $id]);
        $row = $this->tableGateway->select(['id' => $id])->current();
        
        if (! $row) {
            throw new RuntimeException(sprintf(
                'Could not find row with identifier %d',
                $id
            ));
        }
        
        return $row;
    }

    public function saveComment(Comment $comment)
    {
        $data = [
            'id'        => (int) $comment->id,
            'user_name' => $comment->user_name,
            'user_ip'   => $comment->user_ip,
            'user_agent'=> $comment->user_agent,
            'email'     => $comment->email,
            'home_page' => $comment->home_page,
            'text'      => $comment->text,
            'parent'    => (int) $comment->parent,
            'created_at'=> $comment->created_at,
        ];
        $data['file_name'] = !empty($comment->file_name) ? $comment->file_name : null;
        $data['file_type'] = !empty($comment->file_type) ? $comment->file_type : null;

        $id = (int) $comment->id;

        if ($id === 0) {
            $data['text'] = htmlentities($data['text']);
            $this->tableGateway->insert($data);
            if(!empty($data['file_name'])) {
<<<<<<< HEAD
                if($data['file_type'] !== 'text/plain') {
                    Image::save($data['file_name']);
=======
                /*$request = new \Zend\Http\PhpEnvironment\Request();
                $path = $request->getServer('DOCUMENT_ROOT').'/files/';
                $dir = ($comment->file_type === 'text/plain') ? 'txt/' : 'img/';
                copy($path.$comment->file_name, $path.$dir.$comment->file_name);
                unlink($path.$comment->file_name);*/
                if($data['file_type'] === 'text/plain') {
                    Text::save($data['file_name']);
                    }
                else {
                    Image::save($data['file_name']);   
>>>>>>> 523f37ef6f78c8eb78f8fa5b409039b38b86ce9b
                }
            }
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