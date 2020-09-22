<?php

use Illuminate\Database\Seeder;

class AdminTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // base tables
        Encore\Admin\Auth\Database\Menu::truncate();
        Encore\Admin\Auth\Database\Menu::insert(
            [
                [
                    "parent_id" => 0,
                    "order" => 1,
                    "title" => "后台首页",
                    "icon" => "fa-bar-chart",
                    "uri" => "/",
                    "permission" => NULL
                ],
                [
                    "parent_id" => 0,
                    "order" => 2,
                    "title" => "系统管理",
                    "icon" => "fa-tasks",
                    "uri" => NULL,
                    "permission" => NULL
                ],
                [
                    "parent_id" => 2,
                    "order" => 3,
                    "title" => "管理员",
                    "icon" => "fa-users",
                    "uri" => "auth/users",
                    "permission" => NULL
                ],
                [
                    "parent_id" => 2,
                    "order" => 4,
                    "title" => "角色",
                    "icon" => "fa-user",
                    "uri" => "auth/roles",
                    "permission" => NULL
                ],
                [
                    "parent_id" => 2,
                    "order" => 5,
                    "title" => "权限",
                    "icon" => "fa-ban",
                    "uri" => "auth/permissions",
                    "permission" => NULL
                ],
                [
                    "parent_id" => 2,
                    "order" => 6,
                    "title" => "菜单",
                    "icon" => "fa-bars",
                    "uri" => "auth/menu",
                    "permission" => NULL
                ],
                [
                    "parent_id" => 2,
                    "order" => 7,
                    "title" => "日志",
                    "icon" => "fa-history",
                    "uri" => "auth/logs",
                    "permission" => NULL
                ],
                [
                    "parent_id" => 0,
                    "order" => 0,
                    "title" => "用户管理",
                    "icon" => "fa-users",
                    "uri" => "/users",
                    "permission" => NULL
                ],
                [
                    "parent_id" => 0,
                    "order" => 0,
                    "title" => "商品管理",
                    "icon" => "fa-cubes",
                    "uri" => NULL,
                    "permission" => NULL
                ],
                [
                    "parent_id" => 0,
                    "order" => 0,
                    "title" => "订单管理",
                    "icon" => "fa-cny",
                    "uri" => "/orders",
                    "permission" => NULL
                ],
                [
                    "parent_id" => 0,
                    "order" => 0,
                    "title" => "优惠卷管理",
                    "icon" => "fa-tags",
                    "uri" => "/coupon_codes",
                    "permission" => NULL
                ],
                [
                    "parent_id" => 0,
                    "order" => 0,
                    "title" => "商品类目",
                    "icon" => "fa-list-ul",
                    "uri" => "/categories",
                    "permission" => NULL
                ],
                [
                    "parent_id" => 0,
                    "order" => 0,
                    "title" => "幻灯片",
                    "icon" => "fa-bars",
                    "uri" => "/soliders",
                    "permission" => NULL
                ],
                [
                    "parent_id" => 9,
                    "order" => 0,
                    "title" => "普通商品",
                    "icon" => "fa-cubes",
                    "uri" => "/products",
                    "permission" => NULL
                ],
                [
                    "parent_id" => 9,
                    "order" => 0,
                    "title" => "秒杀商品",
                    "icon" => "fa-flash",
                    "uri" => "/seckill_products",
                    "permission" => NULL
                ],
                [
                    "parent_id" => 0,
                    "order" => 0,
                    "title" => "秒杀时间",
                    "icon" => "fa-balance-scale",
                    "uri" => "/seckill_times",
                    "permission" => NULL
                ]
            ]
        );

        Encore\Admin\Auth\Database\Permission::truncate();
        Encore\Admin\Auth\Database\Permission::insert(
            [
                [
                    "name" => "所有权限",
                    "slug" => "*",
                    "http_method" => "",
                    "http_path" => "*"
                ],
                [
                    "name" => "后台首页",
                    "slug" => "dashboard",
                    "http_method" => "GET",
                    "http_path" => "/"
                ],
                [
                    "name" => "登录登出",
                    "slug" => "auth.login",
                    "http_method" => "",
                    "http_path" => "/auth/login\r\n/auth/logout"
                ],
                [
                    "name" => "超管设置",
                    "slug" => "auth.setting",
                    "http_method" => "GET,PUT",
                    "http_path" => "/auth/setting"
                ],
                [
                    "name" => "系统管理",
                    "slug" => "auth.management",
                    "http_method" => "",
                    "http_path" => "/auth/roles\r\n/auth/permissions\r\n/auth/menu\r\n/auth/logs"
                ],
                [
                    "name" => "用户管理",
                    "slug" => "users",
                    "http_method" => "",
                    "http_path" => "/users*"
                ],
                [
                    "name" => "商品管理",
                    "slug" => "Products",
                    "http_method" => "",
                    "http_path" => "/products*"
                ],
                [
                    "name" => "订单管理",
                    "slug" => "Orders",
                    "http_method" => "",
                    "http_path" => "/orders*"
                ],
                [
                    "name" => "优惠卷管理",
                    "slug" => "CouponCodes",
                    "http_method" => "",
                    "http_path" => "/coupon_codes*"
                ]
            ]
        );

        Encore\Admin\Auth\Database\Role::truncate();
        Encore\Admin\Auth\Database\Role::insert(
            [
                [
                    "name" => "Administrator",
                    "slug" => "administrator"
                ],
                [
                    "name" => "运营",
                    "slug" => "operation"
                ]
            ]
        );

        // pivot tables
        DB::table('admin_role_menu')->truncate();
        DB::table('admin_role_menu')->insert(
            [
                [
                    "role_id" => 1,
                    "menu_id" => 2
                ]
            ]
        );

        DB::table('admin_role_permissions')->truncate();
        DB::table('admin_role_permissions')->insert(
            [
                [
                    "role_id" => 1,
                    "permission_id" => 1
                ],
                [
                    "role_id" => 2,
                    "permission_id" => 2
                ],
                [
                    "role_id" => 2,
                    "permission_id" => 3
                ],
                [
                    "role_id" => 2,
                    "permission_id" => 4
                ],
                [
                    "role_id" => 2,
                    "permission_id" => 6
                ],
                [
                    "role_id" => 2,
                    "permission_id" => 7
                ],
                [
                    "role_id" => 2,
                    "permission_id" => 8
                ],
                [
                    "role_id" => 2,
                    "permission_id" => 9
                ]
            ]
        );

        // finish
    }
}
