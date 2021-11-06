<?php

namespace App\Http\Livewire;

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
    public $monthPayout;
    public $trending;
    public $withdrawableBalance;

    public function mount()
    {
        $this->user = User::find(Auth::user()->id);
        $this->wallet = $this->user->wallet;
        $this->withdrawableBalance = is_null($this->wallet) ? null : $this->wallet->withdrawableBalance;
        $this->partnerships = Partnership::where('user_id', Auth::user()->id)->where('isRedeemed', '0')->with('package')->orderBy('created_at', 'desc')->get()->filter(function ($item) {
            if(!empty($item->package) && $item->package->status != 'disabled'):
                return $item;
            endif;
        });
        $this->cummulativePayout = $this->partnerships->where('isRedeemed', '1')->sum('estimatedPayout');
        $this->cummulativePartnership = $this->partnerships->sum('amount');
        $this->monthtPayout = Partnership::where('user_id', Auth::user()->id)->where(DB::raw('MONTH(payoutDate) = MONTH(CURRENT_DATE())'))->sum('estimatedPayout');
        $this->trending =  $this->trendingPackages();
    }

    public function txs()
    {
        $query = DB::table('transactions')->select(DB::raw('DATE_FORMAT(time, "%b") AS x'), DB::raw('SUM(amount) as y'),)->where(['user_id' => $this->user->id])->groupByRaw(DB::raw('MONTH(time)'))->orderBy(DB::raw('MONTH(time)'))->get();
        return $query->toJson();
    }

    public function trendingPackages()
    {
        $query = Partnership::select(DB::raw('COUNT(*) as investors, package_id, package_name, amount * COUNT(*) as investment'))->where('isRedeemed', '0')->with('package')->groupBy('package_name')->orderByRaw(DB::raw('investment desc'))->limit(5)->get();
        return $query->filter(function ($item) {
            if(!empty($item->package) && $item->package->status != 'disabled'):
                return $item;
            endif;
        });
    }

    public function render()
    {
        return view('livewire.dashboard')->with(['txs' => $this->txs()]);
    }
}
