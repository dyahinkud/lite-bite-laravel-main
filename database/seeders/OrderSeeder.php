<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil harga menu berdasarkan ID
        $menuItems = DB::table('menu_items')
            ->pluck('price', 'id');

        // Ambil user dengan role user
        $userIds = DB::table('users')
            ->where('role', 'user')
            ->pluck('id')
            ->toArray();

        // Ambil admin sebagai fallback
        $adminId = DB::table('users')
            ->where('role', 'admin')
            ->value('id');

        $user1 = $userIds[0] ?? $adminId;
        $user2 = $userIds[1] ?? $adminId;

        $orders = [
            [
                'id' => 1,
                'user_id' => $user1,
                'customer_name' => 'Angga',
                'phone' => '123456789',
                'total_price' => $menuItems[3] ?? 0,
                'payment_status' => 'paid',
                'payment_method' => 'qris',
                'created_at' => '2025-06-15 06:20:33',
                'updated_at' => '2025-06-15 06:20:33',
            ],
            [
                'id' => 2,
                'user_id' => $user2,
                'customer_name' => 'Budi',
                'phone' => '081234567890',
                'total_price' => ($menuItems[6] ?? 0) * 2,
                'payment_status' => 'paid',
                'payment_method' => 'bank_transfer',
                'created_at' => '2025-06-16 10:15:00',
                'updated_at' => '2025-06-16 10:15:00',
            ],
            [
                'id' => 3,
                'user_id' => $user1,
                'customer_name' => 'Citra',
                'phone' => '085678901234',
                'total_price' => $menuItems[8] ?? 0,
                'payment_status' => 'pending',
                'payment_method' => null,
                'created_at' => '2025-06-17 14:30:22',
                'updated_at' => '2025-06-17 14:30:22',
            ],
            [
                'id' => 4,
                'user_id' => $user2,
                'customer_name' => 'Dewi',
                'phone' => '089876543210',
                'total_price' => ($menuItems[9] ?? 0) * 3,
                'payment_status' => 'paid',
                'payment_method' => 'ewallet',
                'created_at' => '2025-06-18 12:45:10',
                'updated_at' => '2025-06-18 12:45:10',
            ],
            [
                'id' => 5,
                'user_id' => $user1,
                'customer_name' => 'Eko',
                'phone' => '087654321098',
                'total_price' => ($menuItems[11] ?? 0) * 2,
                'payment_status' => 'failed',
                'payment_method' => 'bank_transfer',
                'created_at' => '2025-06-19 08:20:05',
                'updated_at' => '2025-06-19 08:20:05',
            ],
            [
                'id' => 6,
                'user_id' => $user2,
                'customer_name' => 'Fajar',
                'phone' => '081112223334',
                'total_price' => $menuItems[13] ?? 0,
                'payment_status' => 'paid',
                'payment_method' => 'qris',
                'created_at' => '2025-06-20 16:55:40',
                'updated_at' => '2025-06-20 16:55:40',
            ],
            [
                'id' => 7,
                'user_id' => $user1,
                'customer_name' => 'Gita',
                'phone' => '082233445566',
                'total_price' => ($menuItems[14] ?? 0) * 4,
                'payment_status' => 'paid',
                'payment_method' => 'ewallet',
                'created_at' => '2025-06-21 11:10:15',
                'updated_at' => '2025-06-21 11:10:15',
            ],
        ];

        // Insert data ke orders
        DB::table('orders')->insert($orders);

        // Data detail masing-masing order
        $orderItems = [
            [
                'order_id' => 1,
                'product_id' => 3,
                'quantity' => 1,
                'price' => $menuItems[3] ?? 0,
                'notes' => null,
            ],
            [
                'order_id' => 2,
                'product_id' => 6,
                'quantity' => 2,
                'price' => $menuItems[6] ?? 0,
                'notes' => 'Extra spicy please',
            ],
            [
                'order_id' => 3,
                'product_id' => 8,
                'quantity' => 1,
                'price' => $menuItems[8] ?? 0,
                'notes' => 'Less sugar',
            ],
            [
                'order_id' => 4,
                'product_id' => 9,
                'quantity' => 3,
                'price' => $menuItems[9] ?? 0,
                'notes' => null,
            ],
            [
                'order_id' => 5,
                'product_id' => 11,
                'quantity' => 2,
                'price' => $menuItems[11] ?? 0,
                'notes' => 'Ice separate',
            ],
            [
                'order_id' => 6,
                'product_id' => 13,
                'quantity' => 1,
                'price' => $menuItems[13] ?? 0,
                'notes' => 'Allergy to nuts',
            ],
            [
                'order_id' => 7,
                'product_id' => 14,
                'quantity' => 4,
                'price' => $menuItems[14] ?? 0,
                'notes' => 'Cut in half',
            ],
        ];

        // Tambahkan timestamps
        foreach ($orderItems as &$item) {
            $item['created_at'] = now();
            $item['updated_at'] = now();
        }

        // Insert detail order
        DB::table('order_items')->insert($orderItems);
    }
}