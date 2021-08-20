<?php
namespace Framework\Middleware;

use App\Authentification\Actions\Authentification;
use App\Authentification\Exception\ForbiddenException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class RoleMiddleware implements MiddlewareInterface
{
    private Authentification $auth;
    private string $role;

    public function __construct(Authentification $auth, string $role)
    {
        $this->auth = $auth;
        $this->role = $role;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $user = $this->auth->getUser();
        if ($user === null || !in_array($this->role, $user->getRoles())){
            throw new ForbiddenException();
        }
        return $handler->handle($request);
    }
}