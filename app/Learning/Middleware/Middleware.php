<?php

class VerifyToken
{
    public function handle($request, Closure $next)
    {
        $request['token'] = \Illuminate\Support\Str::random(12);
        return $next($request);
    }
}

class VerfiyIp
{
    public function handle($request, Closure $next)
    {
        $request['ip'] = '';
        return $next($request);
    }
}

class LoginLog
{
    public function handle($request, Closure $next)
    {
        logger()->info('User logged in');
        return $next($request);
    }
}

$middleware = ['VerifyToken', 'VerifyIp', 'LoginLog'];

$request = [];

$destination = function ($request) {
    print_r($request);
    return 'destination';
};

$handle = function ($passable) use ($destination){
    return $destination($passable);
};

$pipeline = array_reduce(array_reverse($middleware), function ($stack, $pipe) {
    return function ($passable) use ($stack, $pipe) {
        return (new $pipe)->handle($passable, $stack);
    };
}, $handle);

print_r($pipeline);
var_dump($pipeline($request));
