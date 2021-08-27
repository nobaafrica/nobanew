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
    public $expectedPayout;
    public $monthPayout;
    public $trending;

    public function mount()
    {
        $this->user = User::find(Auth::user()->id);
        $this->partnerships = Partnership::where('user_id', Auth::user()->id)->with('package')->orderBy('created_at', 'desc')->get();
        $this->cummulativePayout = $this->partnerships->sum('estimatedPayout');
        $this->expectedPayout = $this->partnerships->where('payoutDate', '>=', now())->sum('estimatedPayout');
        $this->monthtPayout = Partnership::where('user_id', Auth::user()->id)->where(DB::raw('MONTH(payoutDate) = MONTH(CURRENT_DATE())'))->sum('estimatedPayout');
        $this->trending =  Partnership::where('user_id', Auth::user()->id)->with('package')->groupBy('package_id')->orderBy('created_at', 'desc')->get();
    }

    public function txs()
    {
        $query = DB::table('transactions')->select(DB::raw('DATE_FORMAT(time, "%b") AS x'), DB::raw('SUM(amount) as y'),)->where(['user_id' => $this->user->id])->groupByRaw(DB::raw('MONTH(time)'))->orderBy(DB::raw('MONTH(time)'))->get();
        return $query->toJson();
    }

    public function render()
    {
        return view('livewire.dashboard')->with(['txs' => $this->txs()]);
    }
}
