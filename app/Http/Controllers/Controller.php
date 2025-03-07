<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Pagination\Paginator;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public static function getBuildingId()
    {

        $guardsList = array_keys(config('auth.guards'));
        if (count($guardsList) > 0) {
            foreach ($guardsList as $guard) {
                if (auth()->guard($guard)->check()) {
                    $user = auth()->guard($guard)->user();
                    // dd($user);
                    if($user && $user != null){
                        $user_id = null;
                        if($user->building_id && $user->building_id != null){
                            $user_id = $user->building_id;

                        }else{
                            $user_id = $user->added_by;
                        }

                    }
                    if($user_id == null){
                        return false;
                    }
                    return  $user_id;
                }
            }
        }
        return true;
    }

    public function getPaginator()
{
    // Ensure the current page resolver is set
    Paginator::currentPageResolver(function () {
        return request()->input('page', 1); // Default to page 1 if not provided
    });

    // Resolve and return the current page
    return Paginator::resolveCurrentPage();
}
    public function index()
    {
        $data = Model::paginate(10); // Adjust the number of items per page
        return view('your-view', ['data' => $data]);
    }

}
