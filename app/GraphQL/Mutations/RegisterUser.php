<?php declare(strict_types=1);


namespace App\GraphQL\Mutations;

use App\Services\UserRegistration;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class RegisterUser
{
    protected $user_registration = "";

    public function __invoke($rootValue, array $args, GraphQLContext $context)
    {
        $this->user_registration = new UserRegistration();

        $user = $this->user_registration->register($args);

        return [
            'data' => $user
        ];
    }
}
