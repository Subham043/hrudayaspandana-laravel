<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Enquiry;
use App\Models\Literature;
use App\Models\Subscription;
use App\Models\Volunteer;
use App\Models\Donation;
use App\Http\Resources\GraphCollection;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    
    public function dashboard(){
        $enquiry_count = count(Enquiry::all());
        $volunteer_count = count(Volunteer::all());
        $subscription_count = count(Subscription::all());
        $literature_count = count(Literature::all());
        $user_count = count(User::where('userType', 2)->where('status', 1)->get());
        $donation_count = Donation::select(DB::raw('sum(amount) as donation'))->where('status', 1)->first();
        $graph = Donation::select(DB::raw('year(created_at) as year, month(created_at) as month, sum(amount) as total_amount'))->where('status', 1)->groupBy(DB::raw('month(created_at)'))->groupBy(DB::raw('year(created_at)'))->orderBy(DB::raw('year(created_at)'))->get();
        $months = $graph->pluck('month');
        $years = $graph->pluck('year');
        $amounts = $graph->pluck('total_amount');
        $month_arr = [];

        foreach($months as $months){
            array_push($month_arr, $this->getMonthName($months));
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Data received successfully',
            'data' => array(
                'enquiry' => $enquiry_count,
                'volunteer' => $volunteer_count,
                'subscription' => $subscription_count,
                'literature' => $literature_count,
                'user' => $user_count,
                'donation' => $donation_count->donation,
            ),
            'graph' => array(
                'main' => GraphCollection::collection($graph),
                'months' => $month_arr,
                'years' => $years,
                'amounts' => $amounts,
            ),
        ], 200);
    }

    private function getMonthName($v) {
        $months = [
            1 => 'Jan',
            2 => 'Feb',
            3 => 'Mar',
            4 => 'Apr',
            5 => 'May',
            6 => 'Jun',
            7 => 'Jul',
            8 => 'Aug',
            9 => 'Sep',
            10 => 'Oct',
            11 => 'Nov',
            12 => 'Dec',
        ];
        
        return $months[$v];
    }
}
