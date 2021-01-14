<?php

namespace Anper\Twig\TemplateCollector\Tests;

use Anper\Twig\TemplateCollector\Extension\CollectTemplateExtension;
use Anper\Twig\TemplateCollector\Template;
use PHPStan\Testing\TestCase;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class CollectTemplateTest extends TestCase
{
    public function testTemplate()
    {
        $dir = __DIR__ . '/templates';
        $loader = new FilesystemLoader($dir);

        $twig = new Environment($loader, [
            'cache' => false,
        ]);

        /** @var Template[] $profiles */
        $profiles = [];

        $extension = new CollectTemplateExtension(function (Template $profile) use (&$profiles) {
            $profiles[] = $profile;
        });

        $twig->addExtension($extension);

        $content = $twig->render('index.twig');

        self::assertCount(3, $profiles);
        self::assertSame([
            'path' => $dir . '/index.twig',
            'name' => 'index.twig',
        ], $profiles[0]->toArray());
        self::assertSame([
            'path' => $dir . '/blocks.twig',
            'name' => 'blocks.twig',
        ], $profiles[1]->toArray());
        self::assertSame([
            'path' => $dir . '/macros.twig',
            'name' => 'macros.twig',
        ], $profiles[2]->toArray());
        self::assertSame("Hello!

in macro

in block #1

in macro

in block #2
", $content);
    }
}
