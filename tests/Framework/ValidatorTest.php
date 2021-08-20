<?php

namespace Tests\Framework;

use Framework\Validator;
use PHPUnit\Framework\TestCase;

final class ValidatorTest extends TestCase
{
    private function makeValidator(array $params): Validator
    {
        return new Validator($params);
    }

    public function testRequire(): void
    {
        $errors = $this->makeValidator(['name' => 'joe'])
            ->required('name', 'description')
            ->getErrors();
        $this->assertCount(1, $errors);
        $this->assertEquals('Le champs description est requis', (string)$errors['description']);
    }

    public function testNotEmpty(): void
    {
        $erros = $this->makeValidator([
            'name' => 'joe',
            'description' => ''
        ])
            ->notEmpty('description')
            ->getErrors();
        $this->assertCount(1, $erros);
    }

    public function testRequireIfSuccess(): void
    {
        $erros = $this->makeValidator([
            'name' => 'joe',
            'description' => 'description'
        ])
            ->required('name', 'description')
            ->getErrors();
        $this->assertCount(0, $erros);
    }

    public function testSlug(): void
    {
        $erros = $this->makeValidator([
            'slug' => 'azedd-eooed45'
        ])
            ->slug('slug')
            ->getErrors();
        $this->assertCount(0, $erros);
    }

    public function testSlugError(): void
    {
        $erros = $this->makeValidator([
            'slug' => 'aweer-assde-jieoRpdpY',
            'slug2' => 'bsnnso-sss_ss',
            'slug3' => 'assd--kdks-sosdo',
        ])
            ->slug('slug')
            ->slug('slug2')
            ->slug('slug3')
            ->slug('slug4')
            ->getErrors();
        $this->assertCount(3, $erros);
    }

    public function testLength(): void
    {
        $params = ['slug' => '123456789'];
        $this->assertCount(0, $this->makeValidator($params)->length('slug', 3)->getErrors());
        $errors = (new Validator($params))->length('slug', 12)->getErrors();
        $this->assertCount(1, $errors);
        $this->assertEquals('Le champs slug doit contenir plus de 12 caracteres', (string)$errors['slug']);
        $this->assertCount(1, $this->makeValidator($params)->length('slug', 3, 4)->getErrors());
        $this->assertCount(0, $this->makeValidator($params)->length('slug', 3, 20)->getErrors());
        $this->assertCount(0, $this->makeValidator($params)->length('slug', null, 20)->getErrors());
        $this->assertCount(1, $this->makeValidator($params)->length('slug', null, 8)->getErrors());
    }

    public function testeDateTime(): void
    {
        $this->assertCount(0, $this->makeValidator(['date' => '2020-08-9 11:11:03'])->dateTime('date')->getErrors());
        $this->assertCount(0, $this->makeValidator(['date' => '2020-08-9 00:00:00'])->dateTime('date')->getErrors());
        $this->assertCount(1, $this->makeValidator(['date' => '2020-22-9'])->dateTime('date')->getErrors());
        $this->assertCount(1, $this->makeValidator(['date' => '2020-13-29 11:12:13'])->dateTime('date')->getErrors());
    }
}