<?php

test('the applications returns a successful response', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});
