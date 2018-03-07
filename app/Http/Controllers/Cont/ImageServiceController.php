<?php

namespace App\Http\Controllers\Cont;

use App\Http\Controllers\Controller;
use App\ImageService;
use Illuminate\Support\Facades\Cache;

class ImageServiceController extends Controller
{
    /**
     * 获取图片服务器
     * @return mixed|void
     */
    public function getCacheLink()
    {
        if (Cache::has('imagesLinks')) {
            return Cache::get('imagesLinks');
        }else{
            $links = $this->getLink();
            if (is_null($links)) {
                LogController::noteError('ErrorEmpty','图片服务为空',__FUNCTION__,$this);
                return;
            }
            Cache::put('imagesLinks',$links->images,3600);
            return $links->images;
        }
    }

    /**
     * 查询全部图片服务器
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    private function getLink()
    {
        $link = ImageService::find(3);
        return $link;
    }
}