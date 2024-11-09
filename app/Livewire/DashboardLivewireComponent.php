<?php

namespace App\Livewire;

use Livewire\Component;

class DashboardLivewireComponent extends Component
{
    public function render()
    {
        $adultGraphCount = [];
        $childGraphCount = [];
        $bothGraphCount = [];
        $getTimeSlots = 0;
        $totalAdult = 0;
        $totalChild = 0;
        $totalIncome = 0;
        $lastSevenDaysIncome = 0;

        return view('livewire.dashboard-livewire-component', compact('childGraphCount', 'adultGraphCount', 'bothGraphCount', 'totalAdult', 'totalChild', 'totalIncome', 'lastSevenDaysIncome'));
    }
}
