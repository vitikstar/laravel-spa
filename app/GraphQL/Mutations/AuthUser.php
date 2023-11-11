<?php declare(strict_types=1);


namespace App\GraphQL\Mutations;

use App\Services\UserAuth;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class AuthUser
{
    protected $user_auth = null;
    public function __invoke($rootValue, array $args, GraphQLContext $context)
    {
        $this->user_auth = new UserAuth();

        $user = $this->user_auth->auth($args);
        $token = $user->createToken('app-token')->accessToken;

        return [
            'data' => $user,
            'token' => $token
        ];

    }
}
