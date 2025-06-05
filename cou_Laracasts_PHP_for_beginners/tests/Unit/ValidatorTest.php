<?php

namespace Core;
it('validates a string',function(){
    // $result = \Core\Validator::string('foobar');
    // expect($result)->toBeTrue();
    expect(\Core\Validator::string(false))->toBeFalse();
});


it('validates a string with a miimum length',function(){
    // $result = \Core\Validator::string('foobar');
    // expect($result)->toBeTrue();
    expect(\Core\Validator::string('foobar',20))->toBeTrue();
});

it('validates an email',function(){
    // $result = \Core\Validator::email('foobar');
    // expect($result)->toBeFalse();
    expect(Validator::email('foobar@bar.com'))->toBeTrue();
});

it('validates that a number is greater tha a given amount',function(){
    // $result = \Core\Validator::email('foobar');
    // expect($result)->toBeFalse();
    expect(Validator::greaterThan(10,1))->toBeTrue();
    expect(Validator::greaterThan(10, 100))->toBeFalse();
})->only();