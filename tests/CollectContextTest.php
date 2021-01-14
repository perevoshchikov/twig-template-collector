<?php

namespace Anper\Twig\TemplateCollector\Tests;

use Anper\Twig\TemplateCollector\Context;
use Anper\Twig\TemplateCollector\Extension\CollectContextExtension;
use PHPStan\Testing\TestCase;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class CollectContextTest extends TestCase
{
    public function testContext()
    {
        $dir = __DIR__ . '/templates';
        $loader = new FilesystemLoader($dir);

        $twig = new Environment($loader, [
            'cache' => false,
        ]);

        /** @var Context[] $profiles */
        $profiles = [];

        $extension = new CollectContextExtension(function (Context $profile) use (&$profiles) {
            $profiles[] = $profile;
        });

        $twig->addExtension($extension);

        $context = ['name' => 'World'];
        $twig->render('index.twig', $context);

        self::assertCount(3, $profiles);
        self::assertSame([
            'path' => $dir . '/index.twig',
            'name' => 'index.twig',
            'context' => $context,
            'parent_id' => 0,
            'id' => 1,
        ], $profiles[0]->toArray());
        self::assertSame([
            'path' => $dir . '/blocks.twig',
            'name' => 'blocks.twig',
            'context' => \array_merge($context, ['invoke' => 1]),
            'parent_id' => 1,
            'id' => 2,
        ], $profiles[1]->toArray());
        self::assertSame([
            'path' => $dir . '/blocks.twig',
            'name' => 'blocks.twig',
            'context' => \array_merge($context, ['invoke' => 2]),
            'parent_id' => 1,
            'id' => 3,
        ], $profiles[2]->toArray());
    }
}
