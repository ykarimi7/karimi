<?php

/**
 * Created by NiNaCoder.
 * Date: 2019-06-18
 * Time: 24:20
 */

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Session;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use App\Models\Song;
use App\Models\Slide;
use App\Models\Channel;
use Route;
use View;
use Cache;
use App\Models\Manauser;
use App\Models\User;
use PDF;
use Illuminate\Support\Facades\Log;

class TrendingController extends Controller
{
    private $request;

    private $range;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->range = Route::currentRouteName();
        switch ($this->range == 'frontend.trending') {
            case 'frontend.trending.week':
                $this->range = 7;
                break;
            case 'frontend.trending.month':
                $this->range = 30;
                break;
            default:
                $this->range = 0;
        }
    }

    public function index()
    {
        $trending = (object) array();

        switch (Route::currentRouteName()) {
            case 'frontend.trending.week':
                $start_date = Carbon::now()->subWeeks(2);
                $end_date = Carbon::now()->subWeek();
                $cache_key = 'trending_week';
                break;
            case 'frontend.trending.month':
                $start_date = Carbon::now()->subMonths(2);
                $end_date = Carbon::now()->subMonth();
                $cache_key = 'trending_month';
                break;
            default:
                $start_date = Carbon::now()->subDays(2);
                $end_date = Carbon::now()->subDay();
                $cache_key = 'trending_day';
        }

        if (Cache::has($cache_key)) {
            $trending->songs = Cache::get($cache_key);
        } else {
            $lastTimeToCompare = $this->songs($start_date, $end_date)->toArray();
            $lastTimeToCompare = $lastTimeToCompare['data'];

            $present = $this->songs($start_date, Carbon::now());

            $trending->songs = $present->map(function ($row) use ($lastTimeToCompare) {
                if (isset($row->id)) {
                    $song = new \stdClass();
                    $song = $row;
                    $song->last_postion = array_search($row->id, array_column($lastTimeToCompare, 'id'));
                    return $song;
                }
            });

            Cache::put($cache_key, $trending->songs, now()->addDay());
        }

        $trending->channels = Channel::where('allow_trending', 1)->orderBy('priority', 'asc')->get();
        $trending->slides = Slide::where('allow_trending', 1)->orderBy('priority', 'asc')->get();

        $trending = json_decode(json_encode($trending));

        if ($this->request->is('api*')) {
            return response()->json($trending);
        }

        if ($this->request->ajax()) {
            $view = View::make('trending.index')->with('trending', $trending);
            $sections = $view->renderSections();
            return $sections['content'];
        }

        getMetatags();

        return view('trending.index')->with('trending', $trending);
    }

    public function songs($start_date, $end_date, $limit = 50)
    {
        return Song::leftJoin('popular', 'popular.song_id', '=', 'songs.id')
            ->select('songs.*', DB::raw('sum(popular.plays) AS total_plays'))
            ->where('popular.created_at', '<=',  $end_date)
            ->where('popular.created_at', '>=',  $start_date)
            ->groupBy('popular.song_id')
            ->orderBy('total_plays', 'desc')
            ->paginate($limit);
    }

    public function customer()
    {
       $user=Auth()->user();
       $status=$user->status;
       if($status==0)
            $status='Offline';
       if($status==1)
           $status='Online';
       $lastvizit=$user->last_activity;
       $count=Manauser::where('manager_id','=',$user->id)->count();
       $var=Manauser::where('manager_id','=',$user->id)->get();



        $view = View::make('customer',['var'=>$var,'status'=>$status,'lastvizit'=>$lastvizit,'count'=>$count,'usercount'=>$user->usercount]);
        if ($this->request->ajax()) {

            $sections = $view->renderSections();
            if ($this->request->input('page') && intval($this->request->input('page')) > 1) {
                return $sections['pagination'];
            } else {
                return $sections['content'];
            }
        }
        return $view;
    }

    public function newaddnewuser()
    {
        $view = View::make('newaddnewuser');

        if ($this->request->ajax()) {

            $sections = $view->renderSections();
            if ($this->request->input('page') && intval($this->request->input('page')) > 1) {
                return $sections['pagination'];
            } else {
                return $sections['content'];
            }
        }
        return $view;
    }

    public function newaddnewuser1($id)
    {

        $var=User::where('id','=',$id)->first();

        $view = View::make('newaddnewuser1',['var'=>$var]);

        if ($this->request->ajax()) {

            $sections = $view->renderSections();
            if ($this->request->input('page') && intval($this->request->input('page')) > 1) {
                return $sections['pagination'];
            } else {
                return $sections['content'];
            }
        }
        return $view;
    }


    public function newsearch(Request $request)
    {
        $this->validate($request,['date1'=>'required','date2'=>'required']);

        $date1=$request->date1;
        $date2=$request->date2;
        \Session::put('date1',$date1);
        \Session::put('date2',$date2);
         $d1=\Session::get('date1');
         $d2=\Session::get('date2');


        $user=Auth()->user();
        $status=$user->status;
        if($status==0)
            $status='Offline';
        if($status==1)
            $status='Online';
        $lastvizit=$user->last_activity;
        $count=Manauser::where('manager_id','=',$user->id)->whereBetween('created_at', [$request->date1, $request->date2])->count();
        $var=Manauser::
        where('manager_id','=',$user->id)
        ->whereBetween('created_at', [$request->date1, $request->date2])
        ->get();



        $view = View::make('customer1',['var'=>$var,'status'=>$status,'lastvizit'=>$lastvizit,'count'=>$count,
            'usercount'=>$user->usercount,'date1'=>$date1,'date2'=>$date2,'d1'=>$d1,'d2'=>$d2]);
        if ($this->request->ajax()) {

            $sections = $view->renderSections();
            if ($this->request->input('page') && intval($this->request->input('page')) > 1) {
                return $sections['pagination'];
            } else {
                return $sections['content'];
            }
        }
        return $view;
    }

    public function exportPdf(Request $request)
    {
        try {
            $this->validate($request, ['date1' => 'required', 'date2' => 'required']);
    
            $date1 = $request->date1;
            $date2 = $request->date2;
            \Session::put('date1', $date1);
            \Session::put('date2', $date2);
            $d1 = \Session::get('date1');
            $d2 = \Session::get('date2');
    
            $user = Auth()->user();
            $status = $user->status;
            $status = $status == 0 ? 'Offline' : 'Online';
    
            $lastvizit = $user->last_activity;
            $count = Manauser::where('manager_id', '=', $user->id)
                ->whereBetween('created_at', [$request->date1, $request->date2])
                ->count();
    
            $var = Manauser::where('manager_id', '=', $user->id)
                ->whereBetween('created_at', [$request->date1, $request->date2])
                ->get();
    
            $data = [
                'items' => $var,
                'status' => $status,
                'lastvizit' => $lastvizit,
                'count' => $count,
                'usercount' => $user->usercount,
                'date1' => $date1,
                'date2' => $date2,
                'd1' => $d1,
                'd2' => $d2,
            ];
    
            $pdf = PDF::loadView('frontend.default.exports.pdf.customerFiltered', $data);
            $pdf->setPaper('A4');
    
            info('Export PDF method called successfully.');
            info('PDF generated successfully.');
    
            return $pdf->stream('customerFiltered.pdf');
        } catch (\Exception $e) {
            // error('Error generating PDF: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }



}