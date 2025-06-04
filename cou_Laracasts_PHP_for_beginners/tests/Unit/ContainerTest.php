/**
 * Unit test for the Core\Container class.
 *
 * This test verifies that the container can resolve a binding.
 *
 * - Binds the key 'foo' to a closure that returns 'bar'.
 * - Resolves 'foo' from the container.
 * - Asserts that the resolved value is 'bar'.
 */
<?php

use Core\Container;

test('it can resolve something out of the container', function () {
    $container = new Container();

    $container->bind('foo', function () {
        return 'bar';
    });

    $result = $container->resolve('foo');

    expect($result)->toBe('bar');
});
