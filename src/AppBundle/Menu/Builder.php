<?php
/**
 * Created by PhpStorm.
 * User: wilson.tang
 * Date: 30/10/2017
 * Time: 11:25 PM
 */

namespace AppBundle\Menu;


use Knp\Menu\MenuFactory;

class Builder
{
    public function mainMenu(MenuFactory $factory, array $options)
    {
        $menu = $factory->createItem('root');

        $menu->setChildrenAttribute('class', 'nav');
        $menu
            ->addChild('home', ['route' => 'homepage'])
            ->setAttribute('class', 'nav-item')
        ;

        $menu
            ->addChild('car', ['route' => 'carhome'])
            ->setAttribute('class', 'nav-item')
        ;

        return $menu;
    }
}