<?php

namespace Database\Seeders;

use App\Models\Navigation;
use Illuminate\Database\Seeder;

class NavigationSeeder extends Seeder
{
    /**
     * Run the database seeding_files.
     */
    public function run(): void
    {
        $navigtions = collect([
            /* Dashboard Start*/
            [
                'nav_name' => 'Home',
                'nav_route' => 'dashboard',
                'nav_permission' => 'dashboard',
                'nav_type' => 'main',
                'nav_icon' => '<i class="bx bx-home-alt" aria-hidden="true"></i>',
                'nav_order' => 1,
                'sub_navigations' => []
            ],
            /* Dashboard End*/
            /* College Start*/
            [
                'nav_name' => 'College',
                'nav_route' => 'colleges',
                'nav_permission' => 'colleges',
                'nav_type' => 'main',
                'nav_icon' => '<i class="fa-solid fa-building-columns"></i>',
                'nav_order' => 1,
                'sub_navigations' => []
            ],
            /* College End*/
            /* Student Start*/
            [
                'nav_name' => 'Student',
                'nav_route' => 'students',
                'nav_permission' => 'students',
                'nav_type' => 'main',
                'nav_icon' => '<i class="fa-solid fa-people-group"></i>',
                'nav_order' => 1,
                'sub_navigations' => []
            ],
            /* Student End*/
            /* Transaction Start*/
            [
                'nav_name' => 'Transaction',
                'nav_route' => 'transactions',
                'nav_permission' => 'transactions',
                'nav_type' => 'main',
                'nav_icon' => '<i class="fa-regular fa-money-bill-1"></i>',
                'nav_order' => 1,
                'sub_navigations' => []
            ],
            /* Transaction End*/

            /* Reports Start*/
            [
                'nav_name' => 'Reports',
                'nav_route' => '',
                'nav_permission' => 'reports',
                'nav_icon' => '<i class="fa-solid fa-chart-line"></i>',
                'nav_type' => 'main',
                'nav_order' => 8,
                'sub_navigations' => [
                    [
                        'nav_name' => 'Payment Report',
                        'nav_route' => 'report.payment_report',
                        'nav_permission' => 'payment_report',
                        'nav_type' => 'nav',
                        'nav_icon' => '',
                        'nav_order' => 1
                    ],

                ]
            ],
            /* Reports End*/
            /* User Start*/
            [
                'nav_name' => 'Users & Permissions',
                'nav_route' => 'users',
                'nav_permission' => 'users_permissions',
                'nav_type' => 'main',
                'nav_icon' => '<i class="fa-solid fa-users"></i>',
                'nav_order' => 1,
                'sub_navigations' => []
            ],
            /* User End*/
            /* User Permission Start*/
            [
                'nav_name' => 'Access Management',
                'nav_route' => 'access_managements',
                'nav_permission' => 'access_management',
                'nav_type' => 'main',
                'nav_icon' => '<i class="fa-solid fa-users"></i>',
                'nav_order' => 1,
                'sub_navigations' => []
            ],
            /* User Permission End*/
            /* Site Setting Start*/
            [
                'nav_name' => 'Site Setting',
                'nav_route' => 'site-setting',
                'nav_permission' => 'site_setting',
                'nav_type' => 'main',
                'nav_icon' => '<i class="icons icon-settings" aria-hidden="true"></i>',
                'nav_order' => 10,
                'sub_navigations' => []
            ],
            [
                'nav_name' => 'Navigations',
                'nav_route' => 'navigations',
                'nav_permission' => 'navigation',
                'nav_type' => 'main',
                'nav_icon' => '<i class="fa-solid fa-route"></i>',
                'nav_order' => 11,
                'sub_navigations' => []
            ],
        ]);

        $navigtions->each(function ($nav) {
            $nav1 = $this->makeArray($nav);

            $navID = Navigation::create($this->makeArray($nav1));

            if (!empty($nav['sub_navigations'])) {
                foreach ($nav['sub_navigations'] as $navigation) {

                    $navigation1 = array_merge(['nav_id' => $navID->id], $this->makeArray($navigation));

                    $subNavID = Navigation::create($navigation1);

                    if (!empty($navigation['sub'])) {
                        foreach ($navigation['sub'] as $sub) {
                            $sub1 = array_merge(['nav_id' => $subNavID->id], $this->makeArray($sub));
                            $subID = Navigation::create($sub1);
                        }
                    }
                }
            }
        });
    }

    private function makeArray($row)
    {
        $data = [
            'nav_name' => $row['nav_name'],
            'nav_route' => $row['nav_route'],
            'nav_permission' => $row['nav_permission'],
            'nav_type' => $row['nav_type'],
            'nav_icon' => $row['nav_icon'],
            'nav_order' => $row['nav_order']
        ];
        return $data;
    }
}
