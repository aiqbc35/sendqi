<?php

namespace App\Http\Controllers\Cont;

use App\Http\Controllers\Controller;
use App\Video;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Request;

class VideoController extends Controller
{
    /**
     * 查询视频列表
     * @param $status 状态码 0：未激活 1：激活
     * @param $type 类别 0：免费 1：VIP
     * @param $orderStr 排序名称
     * @param string $orderType 排序类型
     * @param int $length 是否长片 0否  1是
     * @param int $offset 查询起始
     * @param int $limit 共查询多少
     * @return mixed
     */
    public function getList($status,$type,$orderStr,$orderType = 'desc',$length = 0,$offset = 0,$limit = 12)
    {
        $result = Video::where('status','=',$status)
            ->where('type','=',$type)
            ->where('length','=',$length)
            ->orderBy($orderStr,$orderType)
            ->offset($offset)
            ->limit($limit)
            ->get();
        return $result;
    }

    /**
     * 获取视频总数
     * @param int $status  状态
     * @param int $type    类型
     * @param int $length   是否长片 0 否 1 是
     * @return mixed
     */
    public function countVideo($status = 1,$type = 0,$length = 0)
    {
        $count = Video::where('status','=',$status)
            ->where('type','=',$type)
            ->where('length','=',$length)
            ->count();
        return $count;
    }

    /**
     * 视频数据批量转换
     * @param $video  视频源
     * @return array
     */
    static public function sqlToData($video)
    {
        $data = array();
        $url = (new ImageServiceController())->getCacheLink();

        foreach($video as $key=>$value)
        {
            if (empty($value->id)) {
                return false;
            }
            $data[$key]['id'] = $value->id;
            $data[$key]['title'] = $value->name;
            $data[$key]['thumb'] = $url . $value->image;
            $data[$key]['video'] = $value->link;
            $data[$key]['hit'] = $value->hit;
            $data[$key]['adddate'] = date('Y-m-d',$value->addtime);
        }
        return $data;
    }

    /**
     * 视频数据格式化
     * @param $video
     * @return array|bool
     */
    private static function dataForm($video,$videoService)
    {
        if (empty($video->id)) {
            return false;
        }
        $data = array();
        $url = (new ImageServiceController())->getCacheLink();

        $data['id'] = $video->id;
        $data['title'] = $video->name;
        $data['thumb'] = $url . $video->image;
        $data['video'] = $videoService . $video->link;
        $data['hit'] = $video->hit;
        $data['adddate'] = date('Y-m-d',$video->addtime);

        return $data;
    }

    /**
     * 查询点击前几位的视频
     * @param int $length 查询条数
     * @return mixed
     */
    public function getTopVideo( $length = 4 )
    {
        $result = Video::where('status','=',1)
            ->orderBy('hit','desc')
            ->offset(0)
            ->limit($length)
            ->get();
        return $result;
    }

    /**
     * 获取指定视频
     * @param Request $request
     * @return array
     */
    public function findVideo(Request $request)
    {

        $id = $request->get('id');
        if (empty($id)) {
            return self::ResponseJson(0,'请选择视频');
        }

        $video = Video::find($id);

        if (!$video) {
            return self::ResponseJson(0,'视频不存在');
        }

        if ($video->type == 1) {
            $isVip = UserController::getUserIfVip();
            if ($isVip == false) {
                return self::ResponseJson(0,'您还不是会员，请升级后观看');
            }
        }

        $serviceUrl = (new VideoServiceController())->getOne();

        $video = self::dataForm($video,$serviceUrl);

        return self::ResponseJson(1,'成功',$video);
    }

    /**
     * 获取随机视频API
     */
    public function randVideo()
    {
        $videoId = $this->getVideoId();

        $randId = array_rand($videoId,8);

        $id = [];
        foreach ($randId as $value){
            $id[] = $videoId[$value];
        }

        $video = Video::whereIn('id',$id)->get();
        $videoForm = self::sqlToData($video);

        return self::ResponseJson(1,'',$videoForm);
    }

    /**
     * 获取全部视频ID
     * @return array|\Illuminate\Database\Eloquent\Collection|static[]
     */
    private function getVideoId()
    {
        //Cache::forget('VIDEO_RAND_ID');
        if (Cache::has('VIDEO_RAND_ID')) {
            $video = Cache::get('VIDEO_RAND_ID');
        }else{
            $video = Video::where('status','=',1)
            ->get(['id']);
            $video = $video->toArray();
            $video = array_column($video,'id');
            Cache::put('VIDEO_RAND_ID',$video,3600);
        }
        return $video;
    }


}