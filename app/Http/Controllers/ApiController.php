<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Cont\LinkController;
use App\Http\Controllers\Cont\LogController;
use App\Http\Controllers\Cont\VideoController;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Request;

class ApiController extends Controller
{

    /**
     * 首页缓存
     * @return array
     */
    public function getHome()
    {

        //Cache::forget('homeAll');
        if (Cache::has('homeAll')) {
            $homeAll = Cache::get('homeAll');
        }else{
            $homeAll = $this->homeGetData();
            Cache::put('homeAll',$homeAll,3600);
        }
        if (empty($homeAll)) {
            return self::ResponseJson(0,'数据我空','');
        }
        return self::ResponseJson(1,'',$homeAll);
    }

    /**
     * 获取最新的首页内容
     * @return array
     */
    private function homeGetData()
    {
        $videoModel = (new VideoController());

        $freeVideo = $videoModel->getList(1,0,'addtime');
        $freeVideo = VideoController::sqlToData($freeVideo);
        $vipVideo = $videoModel->getList(1,1,'addtime');
        $vipVideo = VideoController::sqlToData($vipVideo);
        $lengthVideo = $videoModel->getList(1,1,'addtime','desc',1);
        $lengthVideo = VideoController::sqlToData($lengthVideo);
        //友情链接
        $links = (new LinkController())->getList();

        if (empty($freeVideo)) {
            LogController::noteError('ErrorEmpty','首页免费视频数据为空',__FUNCTION__,$this);
        }
        if (empty($vipVideo)) {
            LogController::noteError('ErrorEmpty','首页VIP视频数据为空',__FUNCTION__,$this);
        }

        if (empty($lengthVideo)) {
            LogController::noteError('ErrorEmpty','首页长片视频数据为空',__FUNCTION__,$this);
        }

        if (empty($links->toArray())) {
            LogController::noteError('ErrorEmpty','首页友情链接数据为空',__FUNCTION__,$this);
        }

        return [
            'freeVideo' => $freeVideo,
            'vipVideo'  => $vipVideo,
            'lengthVideo' => $lengthVideo,
            'links' => $links,
        ];

    }


    /**
     * 分页获取视频API
     * @param Request $request
     * @return array
     */
    public function getVideoList(Request $request)
    {
        $type = $request->get('type') ? $request->get('type') : 0;
        $page = $request->get('page') ? $request->get('page') : 0;
        $length = $request->get('length') ? $request->get('length') : 0;

        $limit = 32;
        $offset = $page * $limit;

        $videoModel = (new VideoController());
        //视频总数
        $count = $videoModel->countVideo(1,$type,$length);

        $list = $videoModel->getList(1,$type,'addtime','desc',$length,$offset,$limit);

        $list = VideoController::sqlToData($list);

        $data = [
            'count' => $count,
            'list' => $list,
            'limit' => $limit,
        ];

        return self::ResponseJson(1,'',$data);

    }

}