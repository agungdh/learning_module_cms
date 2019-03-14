<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Route;

use App\Models\User;
use App\Models\Menu;
use App\Models\HakAkses;

use agungdh\Pustaka;

class ADHhelper extends Pustaka
{
    public static function getMenuTitle($route) {
        return Menu::find(self::getMenuIdByRouteSlug($route))->menu;
    }

    public static function getCurrentMenuTitle() {
        $menu = Menu::find(self::getMenuIdByRouteSlug(self::getCurrentRouteSlug()));

        if ($menu) {
            return $menu->menu;
        }

        return false;
    }

    public static function checkRouteForMenu($route) {
        try {
            $canIt = route($route);
            return true;
        } catch(\Exception $e) {
            return false;
        }
    }

    public static function getUserData() {
        return User::find(session('userID'));
    }

    public static function getMenuIdByRouteSlug($routeSlug)
    {
        $menu = Menu::where('route', 'like', "{$routeSlug}.%")->first();

        if ($menu) {
            return $menu->id;
        }

        return false;
    }

    public static function menuBoldParents($id)
    {
        $bolds = [];

        if ($id) {
            $menu = Menu::with('parent.parent.parent')->find($id);
            if ($menu->parent) {
                $bolds[] = $menu->parent->id;
                if ($menu->parent->parent) {
                    $bolds[] = $menu->parent->parent->id;
                    if ($menu->parent->parent->parent) {
                        $bolds[] = $menu->parent->parent->parent->id;
                    }
                }
            }            
        }

        return $bolds;
    }

    public static function templateMenu() {
        $menusTree = Menu::with('childs.childs.childs')->where('parent_id', null)->orderBy('posisi')->get();

        return $menusTree;
    }

    public static function getCurrentRoute()
    {
        return Route::currentRouteName();
    }

    public static function getCurrentRouteSlug()
    {
        return explode('.', Route::currentRouteName())[0];
    }

    public static function authCan($route)
    {
        if (explode('.', $route)[0] == 'main' || HakAkses::where(['id_user' => session('userID'), 'route' => $route])->first()) {
            return true;
        } else {
            return false;
        }
    }

    public static function getRouteList()
    {
        $routeCollection = Route::getRoutes();

        $routeList = [];
        foreach ($routeCollection as $value) {
            $name = $value->getName();
            if (!empty($name) && 
                substr($name, 0, 4) != 'api.' && 
                substr($name, 0, 5) != 'main.') {
                $routeList[] = $name;
            }
        }

        return $routeList;
    }

    public static function getGroupRouteList()
    {
        $rl = self::getRouteList();

        $grl = [];
        foreach ($rl as $item) {
            $t = explode('.', $item);
            if (!in_array($t[0], $grl)) {
                $grl[] = $t[0];
            }
        }

        return $grl;
    }

    public static function getDetailedGroupRouteList()
    {
        $grl = self::getGroupRouteList();

        $dgrl = new \stdClass();
        foreach ($grl as $item) {
            $dgrl->$item = self::getChildOfGroupRoute($item);
        }

        return $dgrl;
    }

    public static function getChildOfGroupRoute($parent)
    {
        $rl = self::getRouteList();

        $child = [];
        foreach ($rl as $item) {
            if (substr($item, 0, strlen($parent) + 1) == $parent . '.') {
                $child[] = $item;
            }            
        }

        return $child;
    }
}
