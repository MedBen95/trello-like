<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 21/08/2018
 * Time: 01:08
 */

namespace App\Http\Repositories;


use App\Comment;

class CommentRepository
{
    protected $comment;

    /**
     * CommentRepository constructor.
     * @param $comment
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }


    public function createComment($array){

        $comment=$this->comment->create($array);
        return $comment;
    }
}