<?php

// Routes

$app->group('/book', function () {
    $this->get('', 'BookController:index');
    $this->get('/{id:[0-9]+}', 'BookController:show');
});

$app->group('/book', function () {
    $this->get('/create', 'BookController:create');
    $this->post('', 'BookController:store');
    $this->get('/{id:[0-9]+}/edit', 'BookController:edit');
    $this->put('/{id:[0-9]+}', 'BookController:update');
    $this->delete('/{id:[0-9]+}', 'BookController:destroy');
});
