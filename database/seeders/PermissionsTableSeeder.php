<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'product_create',
            ],
            [
                'id'    => 18,
                'title' => 'product_edit',
            ],
            [
                'id'    => 19,
                'title' => 'product_show',
            ],
            [
                'id'    => 20,
                'title' => 'product_delete',
            ],
            [
                'id'    => 21,
                'title' => 'product_access',
            ],
            [
                'id'    => 22,
                'title' => 'report_create',
            ],
            [
                'id'    => 23,
                'title' => 'report_edit',
            ],
            [
                'id'    => 24,
                'title' => 'report_show',
            ],
            [
                'id'    => 25,
                'title' => 'report_delete',
            ],
            [
                'id'    => 26,
                'title' => 'report_access',
            ],
            [
                'id'    => 27,
                'title' => 'category_create',
            ],
            [
                'id'    => 28,
                'title' => 'category_edit',
            ],
            [
                'id'    => 29,
                'title' => 'category_show',
            ],
            [
                'id'    => 30,
                'title' => 'category_delete',
            ],
            [
                'id'    => 31,
                'title' => 'category_access',
            ],
            [
                'id'    => 32,
                'title' => 'in_stock_create',
            ],
            [
                'id'    => 33,
                'title' => 'in_stock_edit',
            ],
            [
                'id'    => 34,
                'title' => 'in_stock_show',
            ],
            [
                'id'    => 35,
                'title' => 'in_stock_delete',
            ],
            [
                'id'    => 36,
                'title' => 'in_stock_access',
            ],
            [
                'id'    => 37,
                'title' => 'out_stock_create',
            ],
            [
                'id'    => 38,
                'title' => 'out_stock_edit',
            ],
            [
                'id'    => 39,
                'title' => 'out_stock_show',
            ],
            [
                'id'    => 40,
                'title' => 'out_stock_delete',
            ],
            [
                'id'    => 41,
                'title' => 'out_stock_access',
            ],
            [
                'id'    => 42,
                'title' => 'customer_create',
            ],
            [
                'id'    => 43,
                'title' => 'customer_edit',
            ],
            [
                'id'    => 44,
                'title' => 'customer_show',
            ],
            [
                'id'    => 45,
                'title' => 'customer_delete',
            ],
            [
                'id'    => 46,
                'title' => 'customer_access',
            ],
            [
                'id'    => 47,
                'title' => 'supplier_create',
            ],
            [
                'id'    => 48,
                'title' => 'supplier_edit',
            ],
            [
                'id'    => 49,
                'title' => 'supplier_show',
            ],
            [
                'id'    => 50,
                'title' => 'supplier_delete',
            ],
            [
                'id'    => 51,
                'title' => 'supplier_access',
            ],
            [
                'id'    => 52,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 53,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 54,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
