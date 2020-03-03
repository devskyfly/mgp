<?php
namespace devskyfly\mgp\managers;

use devskyfly\mgp\types\Comment;
use devskyfly\mgp\types\AbstractType;
use devskyfly\mgp\response\CommentResponse;


class CommentManager extends AbstractManager
{
    public function create(AbstractType $entity, Comment $comment): CommentResponse
    {
        $comment->subject = $entity;

        $client = $this->client;
        $serializer = $this->serializer;
        $result = [];

        $data = $serializer->serialize($comment, 'json');
        $url = "/api/v3/todo/{$entity->id}/comments";
        //$url = "/api/v3/comment/";

        $result = $client->makePost($url, $data);

        return $this->serializer->deserialize($result, CommentResponse::class, 'json');
    }

}