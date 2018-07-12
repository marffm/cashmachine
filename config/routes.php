<?php

use Api\CashMachine\Application\Controller\WithdrawController;
use Api\CashMachine\Application\Presenter\OutputFormatter;
use Slim\Http\Response;
use Slim\Http\Request;

$app->get('/withdraw/[{value}]', function (Request $request, Response $response, $args) use ($container) {
    $result = (new WithdrawController($container))->getWithdraw($args);
    return $response->withJson(OutputFormatter::formatReturnJson($result));
});