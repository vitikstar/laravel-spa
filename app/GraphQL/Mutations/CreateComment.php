<?php declare(strict_types=1);


namespace App\GraphQL\Mutations;

use App\Events\CommentCreated;
use App\Services\UserRegistration;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class CreateComment
{

    protected $create_comment;

    public function __invoke($rootValue, array $args, GraphQLContext $context)
    {
        $this->create_comment = new \App\Services\CreateComment();

        $comment = $this->create_comment->add($args);

        if ($comment) {
            event(new CommentCreated($comment));
            return ['data' => $comment];
        }
    }
}
