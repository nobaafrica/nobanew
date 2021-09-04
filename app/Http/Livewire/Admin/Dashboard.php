<?php

namespace App\Http\Livewire\Admin;

use App\Models\Partnership;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dashboard extends Component
{
    public $user;
    public $partnerships;
    public $cummulativePayout;
    public $cummulativePartnership;
    public $trending;
    public $users;
    public $partnered;
    public $activePartnerships;
    public $conversion;

    public function mount()
    {
        $this->user = User::find(Auth::user()->id);
        $this->users = User::where('isAdmin', 0)->with('partnerships')->get();
        $this->partnered = Partnership::where('isRedeemed', 0)->groupBy('user_id')->get();
        $this->partnerships = Partnership::orderBy('created_at', 'desc')->get();
        $this->activePartnerships = $this->partnerships->where('isRedeemed', '0');
        $this->cummulativePayout = $this->partnerships->where('isRedeemed', '1')->sum('estimatedPayout');
        $this->cummulativePartnership = $this->partnerships->sum('amount');
        $this->trending =  $this->trendingPackages();
        $this->conversion = $this->partnered->count()/$this->users->count();
    }

    public function investments()
    {
        $query = DB::table('partnerships')->select(DB::raw('DATE_FORMAT(created_at, "%b") AS x'), DB::raw('SUM(amount) as y'))->groupByRaw(DB::raw('MONTH(created_at)'))->orderBy(DB::raw('MONTH(created_at)'))->get();
        return $query->toJson();
    }

    public function payouts()
    {
        $query = DB::table('partnerships')->select(DB::raw('DATE_FORMAT(payoutDate, "%b") AS x'), DB::raw('SUM(estimatedPayout) as y'))->where('isRedeemed', '1')->groupByRaw(DB::raw('MONTH(payoutDate)'))->orderBy(DB::raw('MONTH(payoutDate)'))->get();
        return $query->toJson();
    }

    public function trendingPackages()
    {
        $query = Partnership::select(DB::raw('COUNT(DISTINCT user_id) as investors, user_id, package_id, package_name, amount * COUNT(*) as investment'))->where('isRedeemed', '0')->with('user', 'package')->groupBy('user_id')->orderByRaw(DB::raw('investment desc'))->limit(10)->get();
        return $query;
    }

    public function render()
    {
        return view('livewire.admin.dashboard')->with([
            'investments' => $this->investments(),
            'payouts' => $this->payouts()
        ]);
    }
}
