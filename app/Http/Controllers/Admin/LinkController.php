<?php

namespace App\Http\Controllers\Admin;

use App\Links;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Request;

class LinkController
{
    public function index ()
    {
        $list = Links::all();
        return view('Admin.link',[
            'name' => 'Links',
            'list' => $list
        ]);
    }

    public function add (Request $request)
    {
        $info = '';
        if ($request->id) {
            $info = Links::find($request->id);
        }
        return view('Admin.linkadd',[
            'name' => 'ADD LINK',
            'info' => $info
        ]);
    }

    public function delete (Request $request)
    {
        if ($request->id) {
            $result = Links::find($request->id);
            if (empty($result)) {
                return array(
                    'status' => 2,
                    'msg' => 'Link is empty'
                );
            }

            $ret = $result->delete();
            if ($ret) {
                Cache::forget('homeList');
                $info['status'] = 1;
                $info['msg'] = 'OK';
            }else{
                $info['status'] = 3;
                $info['msg'] = 'error';
            }
            return $info;
        }
    }

    public function addHalt (Request $request)
    {
        if ($request->isMethod('post')) {
            $data['title'] = $request->input('title');
            $data['link'] = $request->input('link');
            $data['sort'] = $request->input('sort');

            if ($request->input('id')) {
                $id = $request->input('id');
                $ret = Links::where('id','=',$id)->update($data);
            }else{
                $ret = Links::create($data);
            }

            if ($ret) {
                Cache::forget('homeList');
                return redirect('admin/links');
            }else{
                return redirect()->back()->with('error','操作失败！')->withInput();
            }
        }
    }
}