<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\AuthController;
use Auth;
use LaravelAnalytics;
use Carbon\Carbon;
use Image;


class AdminController extends AuthController
{

    public function __construct()
    {
        $this->loginPath = route('admin.login.view');
        $this->redirectTo = route('admin.dashboard');
        $this->redirectPath = route('admin.dashboard');
        $this->redirectAfterLogout = route('admin.dashboard');

        $this->middleware('doNotCacheResponse');
    }

    public function loginView ()
    {
        return view("admin.login");
    }

    public function dashboard()
    {
        $view = [];

        $days = 30;
        $view['days'] = $days;

        if(env('ANALYTICS_SITE_ID') == ''){
            return view("admin.dashboard", $view);
        }

        $graph = [];
        $dataAnalytics =  LaravelAnalytics::getVisitorsAndPageViews($days);

        $graph['visitors'] = implode(',', (array_pluck($dataAnalytics, 'visitors')));
        $graph['pageViews'] = implode(',', (array_pluck($dataAnalytics, 'pageViews')));
        $carbonDate = (array_pluck($dataAnalytics, 'date'));
        $date = [];
        foreach($carbonDate as $carbon) {
            $date[] = $carbon->formatLocalized('%d/%m');
        }
        $graph['label'] = '"' . implode('","', $date) . '"';

        $view['graph'] = $graph;

        $view['direct'] = LaravelAnalytics::getTopReferrers($numberOfDays = $days, $maxResults = 10);
        $view['mostVisited'] = LaravelAnalytics::getMostVisitedPages($numberOfDays = $days, $maxResults = 10);
        $view['topBrowser'] = LaravelAnalytics::getTopBrowsers($numberOfDays = $days, $maxResults = 10);
        $view['topKeywords'] = LaravelAnalytics::getTopKeywords($numberOfDays = $days, $maxResults = 10);


        $dataAnalytics = LaravelAnalytics::performQuery(Carbon::now()->subDays($days), Carbon::now(), 'ga:pageviews');
        $box['pageViews'] = $dataAnalytics['rows'][0][0];
        $dataAnalytics = LaravelAnalytics::performQuery(Carbon::now()->subDays($days), Carbon::now(), 'ga:uniquePageviews');
        $box['uniquePageviews'] = $dataAnalytics['rows'][0][0];
        $dataAnalytics = LaravelAnalytics::performQuery(Carbon::now()->subDays($days), Carbon::now(), 'ga:avgTimeOnPage');
        $box['avgTimeOnPage'] = Carbon::createFromTimestamp($dataAnalytics['rows'][0][0])->format('i:s');
        $dataAnalytics = LaravelAnalytics::performQuery(Carbon::now()->subDays($days), Carbon::now(), 'ga:bounceRate');
        $box['bounceRate'] = $dataAnalytics['rows'][0][0];

        $view['box'] = $box;

        return view("admin.dashboard", $view);
    }

    public function notFound()
    {
        return view("admin.errors.404");
    }

    public function summernote()
    {
        $request = request();

        if ($request->hasFile('file')) {
            $file = $request->file('file');

            $extension = $file->getClientOriginalExtension();
            $fileName = date('Ymdhis') . '-' . rand(11111,99999) . '.' . $extension;

            $file->move(storage_path('cache'), $fileName);

            $fileInfo = array_values(getimagesize(storage_path('cache/') . $fileName));
            list($width, $height, $type, $attr) = $fileInfo;

            $width = ($width > 800) ? 800 : null;
            $height = ($height > 600) ? 600 : null;

            $targetPath = public_path('media/summernote/' . date('y/m/d/'));
            @mkdir($targetPath, 0775, true);
            Image::make(storage_path('cache/') . $fileName, [
                'width' => $width,
                'height' => $height
            ])->save($targetPath . $fileName);

            #Image::thumbnail(storage_path('cache/') . $fileName, 640, 480, true)->save($targetPath . $fileName);

            return '/media/summernote/' . $fileName;
        }
    }
}