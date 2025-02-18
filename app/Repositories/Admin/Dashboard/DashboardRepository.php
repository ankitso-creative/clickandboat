<?php
namespace App\Repositories\Admin\Dashboard;

use App\Models\Admin\Listing;
use App\Models\User;

class DashboardRepository
{
    public function boatOwnerCount()
    {
        return User::where('role', 'boatowner')->count();
    }
    public function customerCount()
    {
        return User::where('role', 'customer')->count();
    }
    public function listingCount()
    {
        return Listing::count();
    }
}