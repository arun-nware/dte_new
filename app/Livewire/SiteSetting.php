<?php

namespace App\Livewire;

use App\Traits\TimeZoneTrait;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Models\SiteSetting as SiteSettingModel;

#[Title('Site Setting')]
#[Layout('layouts.app')]
class SiteSetting extends Component
{
    use TimeZoneTrait, WithFileUploads, LivewireAlert;

    #[Validate('required|string|max:200')]
    public $app_name = '';

    #[Validate('required|string|max:200')]
    public $copyright = '';

    #[Validate('required|string|max:200')]
    public $currency = '';

    #[Validate('required|string|max:200')]
    public $time_zone = '';

    #[Validate('image|mimes:jpg,jpeg,png|max:1024')]
    public $favicon = '';

    #[Validate('image|mimes:jpg,jpeg,png|max:1024')]
    public $logo = '';

    #[Validate('required|string|max:200')]
    public $financial_year = '';
    public $siteSetting;
    public function render()
    {
        $this->siteSetting = SiteSettingModel::all()->first();
        $siteSetting = $this->siteSetting;
        $this->setSiteSetting($siteSetting);
        $allTimeZone = $this->getTimeZoneList();
        return view('livewire.site-setting', compact('siteSetting', 'allTimeZone'));
    }

    public function setSiteSetting($siteSetting)
    {
        $this->app_name = $siteSetting->app_name;
        $this->copyright = $siteSetting->copyright;
        $this->currency = $siteSetting->currency;
//        $this->time_zone = $siteSetting->time_zone;
        //$this->favicon = $siteSetting->favicon;
        //$this->logo = $siteSetting->logo;
        $this->financial_year = $siteSetting->financial_year;
    }

    public function update($id)
    {
        $data = array('app_name' => $this->app_name, 'copyright' => $this->copyright,  'currency' => $this->currency, 'financial_year' => $this->financial_year);

        if ($this->favicon != '' && $faviconName = $this->favicon->store(path: 'images/settings')) {
            $data = array_merge($data, ['favicon' => $faviconName]);
        }
        if ($this->logo != '' && $logoName = $this->logo->store(path: 'images/settings')) {
            $data = array_merge($data, ['logo' => $logoName]);
        }
        $setting = SiteSettingModel::find($id);
        $setting->update($data);

        $this->alert('success', 'Site Setting updated Successfully');
    }

}
