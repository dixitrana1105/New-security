<?php

if (! function_exists('pr')) {
    function pr($data)
    {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
        exit;
    }
}

if (! function_exists('fileToBytes')) {
    function fileToBytes($file)
    {
        $image = fopen($file->getPathName(), 'r');

        return fread($image, $file->getSize());
    }
}


if (!function_exists('getAuthenticatedUserDetails')) {
    function getAuthenticatedUserDetails() {
        $guards = ['superadmin', 'buildingadmin', 'schoolsecurity', 'buildingSecutityadmin', 'buildingtenant'];

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::guard($guard)->user();
                // dd($user);
                return [
                    'email' => $user->email,
                    'name' => $user->name,
                    'logo' => $user->logo,
                ];
            }
        }

        return null; // Return null if no user is authenticated
    }
}
