<?php

namespace App\Http\Controllers\Android\Api\Notice;

use App\Helper\CommonHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notice;
use Exception;

class NoticeController extends Controller
{
    public function getLatestNotice()
    {
        try {
            $noticeData = [
                'notice' => '',
            ];

            $notice = Notice::where('is_deleted', '=', 0)->orderBy('id', 'desc')->take(1);
            if ($notice->exists()) {
                $notice = $notice->first();
                $noticeData['notice'] = $notice->text;
            }

            return CommonHelper::Response(true, "Notice fetched successfully!", null, $noticeData);
        } catch (Exception $e) {
            return CommonHelper::Response(false, $e->getMessage(), 'UNKNOWN', null);
        }
    }
}
