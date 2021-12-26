<?php

namespace App\Menu;

use App\Entity\Category;
use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

final class Builder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function mainMenu(FactoryInterface $factory, array $options): ItemInterface
    {
        $menu = $factory->createItem('root');

        $menu->addChild('Home', ['route' => 'homepage']);

        $em = $this->container->get('doctrine')->getManager();
        $blog = $em->getRepository(Category::class)->findMostRecent();

        $menu->addChild('Latest Blog Post', [
            'route' => 'blog_show',
            'routeParameters' => ['id' => $blog->getId()]
        ]);

        $menu->addChild('About Me', ['route' => 'about']);
        $menu['About Me']->addChild('Edit profile', ['route' => 'edit_profile']);

        return $menu;
    }
}