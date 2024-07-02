<?php

use TomLerendu\LaravelConvertCaseMiddleware\KeyCaseConverter;

it('throws an InvalidArgumentException when case is invalid', function () {
    expect(fn() => (new KeyCaseConverter())->convert('invalid', ['test' => 'data']))
        ->toThrow(InvalidArgumentException::class);
});

it('can convert to camel case', function ($input, $output, $case) {
    $array = (new KeyCaseConverter())->convert($case, $input);
    expect($array)->toEqual($output);
})->with([
    [
        ['one_key' => 'value'],
        ['oneKey' => 'value'],
        KeyCaseConverter::CASE_CAMEL,
    ],
    [
        ['test_1' => 1, 'test_2' => 2, 'inner' => ['inner_test' => 'inner_test']],
        ['test1' => 1, 'test2' => 2, 'inner' => ['innerTest' => 'inner_test']],
        KeyCaseConverter::CASE_CAMEL,
    ],
    [
        ['testOne' => 1, 'testTwo' => 2, 'inner' => ['innerTest' => 'inner_test']],
        ['test_one' => 1, 'test_two' => 2, 'inner' => ['inner_test' => 'inner_test']],
        KeyCaseConverter::CASE_SNAKE,
    ],
    [
        [],
        [],
        KeyCaseConverter::CASE_SNAKE,
    ],
    [
        ['no' => 'change'],
        ['no' => 'change'],
        KeyCaseConverter::CASE_SNAKE,
    ],
]);