<?php
namespace App\Library;

use DateTime;
use Config;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use App\Models\ArtistModel;

class Helpers
{
    public static function coverImg($coverId)
    {
        $coverImg = '';
        if (isset($coverId) && $coverId > 0) {
            $coverImg = self::filePath($coverId, MUSIC_COVER_PATH, env('DATA_URL')) . $coverId . '.jpg';
        }
        return $coverImg;
    }

    public static function bitrate2str($bitrate, $color = true, $showAll = false)
    {
        if ($color) {
            if ($bitrate == 0 || $bitrate > 500)
                $bitrate2str = '<span class="card-text" style="color: red">' . LOSSLESS . '</span>';
            else if ($bitrate > 320)
                $bitrate2str = '<span class="card-text" style="color: orange">' . $bitrate . KBPS . '</span>';
            else if ($bitrate > 192)
                $bitrate2str = '<span class="card-text" style="color: darkblue">' . $bitrate . KBPS . '</span>';
            else if ($bitrate >= 128)
                $bitrate2str = '<span class="card-text" style="color: darkgreen">' . $bitrate . KBPS . '</span>';
            else if ($bitrate >= 64)
                $bitrate2str = '<span class="card-text" style="color: darkgreen">' . $bitrate . KBPS . '</span>';
            else
                $bitrate2str = $bitrate . KBPS;
        } else {
            if ($showAll) {
                if ($showAll == -1) {
                    $bitrate2str = '32' . KBPS;
                    $bitrate2str .= ', 128' . KBPS;
                    if ($bitrate > 128)
                        $bitrate2str .= ', 320' . KBPS;
                    if ($bitrate > 320)
                        $bitrate2str .= ', 500' . KBPS;
                } else {
                    $bitrate2str = '32' . KBPS;
                    $bitrate2str = '128' . KBPS . ', ' . $bitrate2str;
                    if ($bitrate > 128)
                        $bitrate2str = '320' . KBPS;// . ', ' . $bitrate2str;
                    if ($bitrate > 320)
                        $bitrate2str = '500' . KBPS . ', ' . $bitrate2str;
                    if ($bitrate > 500)
                        $bitrate2str = LOSSLESS . ', ' . $bitrate2str;
                }
            } else
                $bitrate2str = ($bitrate == 0 || $bitrate > 500) ? LOSSLESS : $bitrate . KBPS;
        }

        return $bitrate2str;
    }

    public static function timeElapsedString($datetime, $full = false)
    {
        $now = new DateTime;
        $ago = new DateTime(date('Y-m-d H:i:s', $datetime));
        $diff = $now->diff($ago);
        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'năm',
            'm' => 'tháng',
            'w' => 'tuần',
            'd' => 'ngày',
            'h' => 'giờ',
            'i' => 'phút',
            's' => 'giây',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                if ($v == 'giây') {
                    $v = $diff->$k . ' ' . $v . ' trước';
                }elseif ($v == 'phút') {
                    $v = $diff->$k . ' ' . $v . ' trước';
                }elseif ($v == 'giờ') {
                    $v = $diff->$k . ' ' . $v . ' trước';
                } elseif ($v == 'ngày') {
                    if($diff->$k == 1) {
                        $v = 'Hôm qua, ' . date('H:i', $datetime);
                    }else{
                        $v = $diff->$k . ' ' . $v . ' trước';
                    }
                } else {
                    $v = $diff->$k . ' ' . $v;
                }
            } else {
                unset($string[$k]);
            }
        }
        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) : 'Bây giờ';
    }

    public static function getRandLimitArr($arr = array(), $length = 1)
    {
        if (count($arr) <= $length) {
            return $arr;
        }
        $randArr = array_rand($arr, $length);
        $result = array();
        foreach ($randArr as $val) {
            $result[] = $arr[$val];
        }
        return $result;
    }
    public static function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public static function convertToReadableSize($size)
    {
        $base = log($size) / log(1024);
        $suffix = array("", "KB", "MB", "GB", "TB");
        $f_base = floor($base);
        return round(pow(1024, $base - floor($base)), 1) . ' ' . $suffix[$f_base];
    }


    public static function encodeID($id, $type = 'music')
    {
        $id_encode = dechex(MAX_ID_CONST - $id);
        $id_encode2 = str_replace(array(1,2,4,8,9,'a','e','f'), array('z','v','s','m','w','r','q','t'), $id_encode);
        $id_encode3 = str_replace(array(0,3,5,6,7,'b','c','d'), array('n','w','h','k','t','q','v','m'), $id_encode);
        return (($type=='video') ? 'v' : 't') . $id_encode2 . 'q' . substr($id_encode3, 2, 5);
    }

    public static function decodeID($hexID)
    {
        $id_decode2 = str_replace(array('z','v','s','m','w','r','q','t'), array(1,2,4,8,9,'a','e','f'), substr($hexID, 1, -6));
        $id_decode = hexdec($id_decode2);
        $id_encode3 = str_replace(array(0,3,5,6,7,'b','c','d'), array('n','w','h','k','t','q','v','m'), $id_decode2);

        // check ID fake
        $type = substr($hexID, 0, 1);
        if ( $type !== 't' && $type !== 'v' ) return intval($hexID);
        if ( substr($hexID, -6, 1) !== 'q' ) return intval($hexID);
        if ( substr($hexID, -5) != substr($id_encode3, 2, 5) ) return intval($hexID);

        return (MAX_ID_CONST - $id_decode);
    }

    public static function music_url($music_info, $mode = '')
    {
        $id = ($music_info['cat_id'] == CAT_VIDEO) ? self::encodeID($music_info['music_id'], 'video') : self::encodeID($music_info['music_id']);
        return isset($music_info['music_title_url']) ? $music_info['music_title_url'] . "~" . $id . $mode . ".".HTMLEX : $id . $mode . "." . HTMLEX;
    }
    public static function music_id($music_info, $mode = '')
    {
        return self::encodeID($music_info['music_id']);
    }
    public static function artistUrl($artistId, $artistNickName, $mode = '')
    {
        if(!$artistId || $artistId == -1){
            return env('SEARCH_TEMPLATE_URL').'/tim-kiem?q='.trim($artistNickName).'&mode=ca-si';
        }
        return '/ca-si/'.self::rawTiengVietUrl($artistNickName) . "~" . base64_encode(KEY_ID_ARTIST_ENCODE_URL . $artistId) . $mode . ".".HTMLEX;
    }
    public static function rawHtmlArtists($artistId, $artistNickName) {
        $artistId = explode(';', htmlspecialchars_decode($artistId, ENT_QUOTES));
        $artistNickName = explode(';', htmlspecialchars_decode($artistNickName, ENT_QUOTES));
        if($artistNickName && $artistId) {
            $html = '';
            foreach ($artistNickName as $key => $val) {
//                $html = $html.', <a href="'.self::artistUrl(isset($artistId[$key]) ? $artistId[$key] : -1, $val).'">'.$val.'</a>';
                $val = htmlspecialchars(trim($val), ENT_QUOTES);
                $html = $html.'; <a href="'.self::artistUrl(isset($artistId[$key]) ? $artistId[$key] : -1, $val).'">'.$val.'</a>';
            }
            return substr($html, 2);
        }
        return '';
    }
    public static function category_url($c_info = array(), $c_id = 0, $c_level = 0)
    {
        global $cat_id2info;
        $url = '';
        if (!$c_id && !$c_level) {
            $c_id = intval($c_info['cat_id']);
            $c_level = intval($c_info['cat_level']);

            if (!$c_id && !$c_level && !isset($c_info['cat_url'])) {
                return $url;
            }
        }

        $url = ($c_id == CAT_VIDEO) ? VIEW_VIDEO_URL . '/' : VIEW_MUSIC_URL . '/';
        if (isset($cat_id2info[$c_id][0]['cat_url'])) {
            $url .= $cat_id2info[$c_id][0]['cat_url'] . "/";
        }

        if ($c_level > 0) {
            if (isset($c_info['cat_url'])) {
                $url .= $c_info['cat_url'] . "/";
            } else if (isset($cat_id2info[$c_id][$c_level]['cat_url'])) {
                $url .= $cat_id2info[$c_id][$c_level]['cat_url'] . "/";
            }
        }

        return $url;
    }

//    public static function nav_links($c_info = array(), $c_id = 0, $c_level = 0)
//    {
//        global $root_path, $theme, $cat_id2info;
//        $lang = Config::get('constants.lang');
//
//        $url = ENV('URL');//$root_path;
//        if (!$c_id && !$c_level) {
//            $c_id = $c_info['cat_id'];
//            $c_level = $c_info['cat_level'];
//
//            if (!$c_id && !$c_level) {
//                $nav_links = '<a href="' . $url . '">' . ENV('SITENAME') . '</a>';
//                return $nav_links;
//            }
//        }
//
//        $url .= ($c_id == CAT_VIDEO) ? VIEW_VIDEO_URL . '/' : VIEW_MUSIC_URL . '/';
//        $ct_id = 1;
//        $nav_links = ($theme['themes_id'] == 4) ? '<li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem"><a href="' . $url . '" itemprop="item"><span itemprop="name">' . $lang['MUSIC'] . '</span></a><meta itemprop="position" content="' . $ct_id . '"></li>' : '';
//        if (isset($cat_id2info[$c_id][0]['cat_short_title'])) {
//            $url .= $cat_id2info[$c_id][0]['cat_url'] . "/";
//            $nav_links .= ($theme['themes_id'] == 4) ? '<li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem"><a href="' . $url . '" itemprop="item"><span itemprop="name">' . $cat_id2info[$c_id][0]['cat_short_title'] . '</span></a><meta itemprop="position" content="' . (++$ct_id) . '"></li>' : '<a href="' . $url . '">' . $cat_id2info[$c_id][0]['cat_short_title'] . '</a>';
//        }
//
//        if ($c_level > 0) {
//            if (isset($c_info['cat_short_title'])) {
//                $url .= $c_info['cat_url'] . "/";
//                $nav_links .= ($theme['themes_id'] == 4) ? '<li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem"><a href="' . $url . '" itemprop="item"><span itemprop="name">' . $cat_id2info[$c_id][$c_level]['cat_short_title'] . '</span></a><meta itemprop="position" content="' . (++$ct_id) . '"></li>' : ' -&gt; <a href="' . $url . '">' . $cat_id2info[$c_id][$c_level]['cat_short_title'] . '</a>';
//            } else if (isset($cat_id2info[$c_id][$c_level]['cat_short_title'])) {
//                $url .= $cat_id2info[$c_id][$c_level]['cat_url'] . "/";
//                $nav_links .= ($theme['themes_id'] == 4) ? '<li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem"><a href="' . $url . '" itemprop="item"><span itemprop="name">' . $cat_id2info[$c_id][$c_level]['cat_short_title'] . '</span></a><meta itemprop="position" content="' . (++$ct_id) . '"></li>' : ' -&gt; <a href="' . $url . '">' . $cat_id2info[$c_id][$c_level]['cat_short_title'] . '</a>';
//            }
//
//            $c_sublevel = $c_info['cat_sublevel'];
//            if ($c_sublevel > 0) {
//                if ($c_id == 2) {
//                    $nav_links .= ($lang['CAT_SUBLEVEL_PLAYBACK'][$c_sublevel]['cat_title']) ? (($theme['themes_id'] == 4) ? '<li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem"><span itemprop="name">' . $lang['CAT_SUBLEVEL_PLAYBACK'][$c_sublevel]['cat_title'] . '</span><meta itemprop="position" content="' . (++$ct_id) . '"></li>' : ' -&gt; ' . $lang['CAT_SUBLEVEL_PLAYBACK'][$c_sublevel]['cat_title']) : "";
//                } else if ($c_id == 3) {
//                    $nav_links .= ($lang['CAT_SUBLEVEL_VN'][$c_level][$c_sublevel]['cat_title']) ? (($theme['themes_id'] == 4) ? '<li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem"><span itemprop="name">' . $lang['CAT_SUBLEVEL_VN'][$c_level][$c_sublevel]['cat_title'] . '</span><meta itemprop="position" content="' . (++$ct_id) . '"></li>' : ' -&gt; ' . $lang['CAT_SUBLEVEL_VN'][$c_level][$c_sublevel]['cat_title']) : "";
//                } else if ($c_id > 3) {
//                    $nav_links .= ($lang['CAT_SUBLEVEL'][$c_level][$c_sublevel]['cat_title']) ? (($theme['themes_id'] == 4) ? '<li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem"><span itemprop="name">' . $lang['CAT_SUBLEVEL'][$c_level][$c_sublevel]['cat_title'] . '</span><meta itemprop="position" content="' . (++$ct_id) . '"></li>' : ' -&gt; ' . $lang['CAT_SUBLEVEL'][$c_level][$c_sublevel]['cat_title']) : "";
//                }
//            }
//        }
//
//        return $nav_links;
//    }

    public static function listen_url($music_info, $domain = true)
    {
        global $cat_id2info;
        include_once(__DIR__.'/../../resources/views/cache/def_main_cat.blade.php');
        if(isset($cat_id2info[$music_info['cat_id']][$music_info['cat_level']])) {
            if ( ENV('APP_ENV') == 'beta' ) {
                $seo_domain = '';
                switch ($music_info['cat_id']) {
                    case 1:
                        $seo_domain = 'https://mv.chiasenhac.vn/';
                        break;
                    case 2:
                        $seo_domain = 'https://pb.chiasenhac.vn/';
                        break;
                    case 3:
                        $seo_domain = 'https://vn.chiasenhac.vn/';
                        break;
                    case 4:
                        $seo_domain = 'https://us.chiasenhac.vn/';
                        break;
                    case 5:
                        $seo_domain = 'https://cn.chiasenhac.vn/';
                        break;
                    case 6:
                        $seo_domain = 'https://kr.chiasenhac.vn/';
                        break;
                    case 7:
                        $seo_domain = 'https://jp.chiasenhac.vn/';
                        break;
                    case 8:
                        $seo_domain = 'https://fr.chiasenhac.vn/';
                        break;
                    case 9:
                        $seo_domain = 'https://ot.chiasenhac.vn/';
                        break;
                    default:
                        $seo_domain = '';
                }

                return $seo_domain . self::category_url($cat_id2info[$music_info['cat_id']][$music_info['cat_level']]) . self::music_url($music_info);
            }

            return ($domain ? ENV('LISTEN_URL') : '') . self::category_url($cat_id2info[$music_info['cat_id']][$music_info['cat_level']]) . self::music_url($music_info);
        }
        return '';
    }

//    public static function download_url($music_info)
//    {
//        global $cat_id2info, $phpEx;
//
//        return ENV('DOWNLOAD_URL') . self::category_url($cat_id2info[$music_info[cat_id]][$music_info[cat_level]]) . self::music_url($music_info, DOWNLOAD_URL);
//    }


    public static function thumbnail_url($video_info, $mode = '')
    {
        $music_id = $video_info['music_id'];
        if ($video_info['cat_id'] != CAT_VIDEO) {
            return '';
        } else if ($mode == 'preview') {
            $url = env('DATA_URL');
            return $url . MUSIC_THUMBNAIL_PATH . ceil($music_id / 1000) . '/' . $music_id . '_prv.jpg';
        } else {
            $url = env('DATA_URL');
            return $url . MUSIC_THUMBNAIL_PATH . ceil($music_id / 1000) . '/' . $music_id . '.jpg';
        }
    }
    public static function saveBase64Image($data, $path, $fileName = null, $type = 'png')
    {
        $data = str_replace('data:image/png;base64,', '', $data);
        $data = str_replace('data:image/jpeg;base64,', '', $data);
        $data = str_replace(' ', '+', $data);
        $data = base64_decode($data);
        $fileName = ($fileName ?? rand() . '_' . time()) . '.' .$type;
        Storage::put('public' . $path . $fileName, $data);
        return $fileName;
    }
    public static function saveBase64ImageJpg($data, $path, $fileName = null)
    {
        $data = str_replace('data:image/png;base64,', '', $data);
        $data = str_replace('data:image/jpeg;base64,', '', $data);
        $data = str_replace(' ', '+', $data);
        $data = base64_decode($data);
        $source = imagecreatefromstring($data);
        $fileName = ($fileName ?? rand() . '_' . time()) . '.jpg';
        $dir = Storage::disk('public')->getAdapter()->getPathPrefix().$path;
        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
        }
        $imageSave = imagejpeg($source, $dir . $fileName,88);
        imagedestroy($source);
        return $fileName;
    }

    public static function copySourceImage($data, $path, $fileName = null, $type = 'png')
    {
        $data->storeAs(
            'public' . $path, $fileName . ($type ? '.'.$type : '')
        );
        return $fileName . ($type ? '.'.$type : '');
    }
    public static function moveFile($source, $path, $fileName, $overWrite = false){
        if (file_exists($path . '/' . $fileName) && !$overWrite) {
            $fileName = '(' . time() . ')' . $fileName;
            $source->move($path, $fileName);
        } else {
            $source->move($path, $fileName);
        }
        return $fileName;
    }
    public  static function splitMusicUrl($url) {
        $arrSplit = explode('~', $url);
        $id_encode = last(str_replace('.html', '', $arrSplit));
        return [
            'id' => self::decodeID($id_encode),
            'type' => substr($id_encode, 0, 1) == 'v' ? 'video' : 'music',
            'url' => str_replace(last($arrSplit), "", $arrSplit)
        ];
    }

    public  static function splitPlaylistUrl($url, $floatType = '') {
        $arrSplit = explode('~', $url);
        $id_encode = last(str_replace('.html', '', $arrSplit));
        $type = $floatType ? $floatType : explode('/', url()->current())[3];
        return [
            'id' => str_replace(($type == 'playlist' || $type == 'playlist_publisher') ? KEY_ID_PLAYLIST_ENCODE_URL : KEY_ID_ALBUM_ENCODE_URL, "", base64_decode($id_encode)),
            'type' => $type,
            'url' => str_replace(last($arrSplit), "", $arrSplit)
        ];
    }
    public  static function splitArtistUrl($url) {
        $arrSplit = explode('~', $url);
        $id_encode = last(str_replace('.html', '', $arrSplit));
        return [
            'id' => str_replace(KEY_ID_ARTIST_ENCODE_URL, "", base64_decode($id_encode)),
            'type' => explode('/', url()->current())[3],
            'url' => str_replace(last($arrSplit), "", $arrSplit)
        ];
    }

    public static function fbShareLink($url, $domain = false)
    {
        return 'https://www.facebook.com/dialog/share?app_id=' . env('FACEBOOK_APP_ID') . '&display=popup&href=' . ($domain ? ENV('LISTEN_URL') : '') . $url . '&redirect_uri=' . ($domain ? ENV('LISTEN_URL') : '') . $url;
    }
    public static function ajaxResult($is_success = true,
                         $message = '',
                         $data = array(),
                         $terminer = true)
    {
        echo json_encode(array(
                'success' => $is_success,
                'message' => $message,
                'data' => $data)
        );
        if ($terminer) {
            exit();
        }
    }
    public static function sessionCountTimesMusic($idMusic, $type = 'listen') {
        /// set view with cookie
        $musicRecent = $_COOKIE['music_history'] ?? '';
        $musicHistory = unserialize($musicRecent);
        if(!is_array($musicHistory) || !in_array($idMusic, $musicHistory)) {
            return true;
        }
        return false;
        /// set view with session
        session_start();
        if(!isset($_SESSION[$type])) {
            $newSession[$idMusic] = [
                'time_expiry' => strtotime('+1 hour')
            ];
            $_SESSION[$type] = $newSession;
            return true;
        }else{
            $listen = $_SESSION[$type];
            if(isset($listen[$idMusic])) {
                if($listen[$idMusic]['time_expiry'] <= time()) {
                    $listen[$idMusic] = [
                        'time_expiry' => strtotime(TIME_EXPIRY_ADD_LISTEN_MUSIC)
                    ];
                    $_SESSION[$type] = $listen;
                    return true;
                }
                return false;
            }else{
                $listen[$idMusic] = [
                    'time_expiry' => strtotime('+1 hour')
                ];
                $_SESSION[$type] = $listen;
                return true;
            }
        }
    }

    public static function file_path($id, $dir = '', $url = '')
    {
        $url = ($url == '') ? env('DATA_URL') : '';
        return $url . $dir . ceil($id/1000) . '/';
    }
    public static function filePath($musicId, $dir = MUSIC_DATA_PATH, $url = '')
    {
        global $root_path;
        return ($url) ? $url . $dir . ceil($musicId / 1000) . '/' : $root_path . $dir . ceil($musicId / 1000) . '/';
    }

    public static function cover_path($cover_id = 0)
    {
        return self::file_path($cover_id, MUSIC_COVER_PATH);
    }

    public static function cover_url($cover_id = 0, $artist_id = 0)
    {
        if($cover_id > 0) {
             return self::cover_path($cover_id) . $cover_id . '.jpg';
        }else{
            if($artist_id > 0) {
                $artist = ArtistModel::find($artist_id);
                return $artist && $artist->artist_avatar ? env('APP_URL') . self::file_path($artist->artist_id, PUBLIC_AVATAR_ARTIST_PATH, true) . $artist->artist_avatar : env('APP_URL') . '/imgs/no_cover.jpg';
            }else{
                return env('APP_URL') . '/imgs/no_cover.jpg';
            }
        }
    }
    public static function artist_cover($artist_id)
    {
        return self::cover_path($artist_id) . $artist_id . '.jpg';
    }

    public static function khongdau2($str)
    {
        static $unicode_trans = array(
            // Unicode dựng sẵn
            "á" => "a", "à" => "a", "ả" => "a", "ã" => "a", "ạ" => "a", "ă" => "a", "ắ" => "a", "ằ" => "a", "ẳ" => "a", "ẵ" => "a", "ặ" => "a", "â" => "a", "ấ" => "a", "ầ" => "a", "ẩ" => "a", "ẫ" => "a", "ậ" => "a",
            "Á" => "A", "À" => "A", "Ả" => "A", "Ã" => "A", "Ạ" => "A", "Ă" => "A", "Ắ" => "A", "Ằ" => "A", "Ẳ" => "A", "Ẵ" => "A", "Ặ" => "A", "Â" => "A", "Ấ" => "A", "Ầ" => "A", "Ẩ" => "A", "Ẫ" => "A", "Ậ" => "A",
            "é" => "e", "è" => "e", "ẻ" => "e", "ẽ" => "e", "ẹ" => "e", "ê" => "e", "ế" => "e", "ề" => "e", "ể" => "e", "ễ" => "e", "ệ" => "e",
            "É" => "E", "È" => "E", "Ẻ" => "E", "Ẽ" => "E", "Ẹ" => "E", "Ê" => "E", "Ế" => "E", "Ề" => "E", "Ể" => "E", "Ễ" => "E", "Ệ" => "E",
            "í" => "i", "ì" => "i", "ỉ" => "i", "ĩ" => "i", "ị" => "i",
            "Í" => "I", "Ì" => "I", "Ỉ" => "I", "Ĩ" => "I", "Ị" => "I",
            "ó" => "o", "ò" => "o", "ỏ" => "o", "õ" => "o", "ọ" => "o", "ô" => "o", "ố" => "o", "ồ" => "o", "ổ" => "o", "ỗ" => "o", "ộ" => "o", "ơ" => "o", "ớ" => "o", "ờ" => "o", "ở" => "o", "ỡ" => "o", "ợ" => "o",
            "Ó" => "O", "Ò" => "O", "Ỏ" => "O", "Õ" => "O", "Ọ" => "O", "Ô" => "O", "Ố" => "O", "Ồ" => "O", "Ổ" => "O", "Ỗ" => "O", "Ộ" => "O", "Ơ" => "O", "Ớ" => "O", "Ờ" => "O", "Ở" => "O", "Ỡ" => "O", "Ợ" => "O",
            "ú" => "u", "ù" => "u", "ủ" => "u", "ũ" => "u", "ụ" => "u", "ư" => "u", "ứ" => "u", "ừ" => "u", "ử" => "u", "ữ" => "u", "ự" => "u",
            "Ú" => "U", "Ù" => "U", "Ủ" => "U", "Ũ" => "U", "Ụ" => "U", "Ư" => "U", "Ứ" => "U", "Ừ" => "U", "Ử" => "U", "Ữ" => "U", "Ự" => "U",
            "ý" => "y", "ỳ" => "y", "ỷ" => "y", "ỹ" => "y", "ỵ" => "y",
            "Ý" => "Y", "Ỳ" => "Y", "Ỷ" => "Y", "Ỹ" => "Y", "Ỵ" => "Y",
            "đ" => "d",
            "Đ" => "D",
            "ñ" => "n",

            // Unicode tổ hợp
            "á" => "a", "à" => "a", "ả" => "a", "ã" => "a", "ạ" => "a", "ắ" => "a", "ằ" => "a", "ẳ" => "a", "ẵ" => "a", "ặ" => "a", "ấ" => "a", "ầ" => "a", "ẩ" => "a", "ẫ" => "a", "ậ" => "a",
            "Á" => "A", "À" => "A", "Ả" => "A", "Ã" => "A", "Ạ" => "A", "Ắ" => "A", "Ằ" => "A", "Ẳ" => "A", "Ẵ" => "A", "Ặ" => "A", "Ấ" => "A", "Ầ" => "A", "Ẩ" => "A", "Ẫ" => "A", "Ậ" => "A",
            "é" => "e", "è" => "e", "ẻ" => "e", "ẽ" => "e", "ẹ" => "e", "ế" => "e", "ề" => "e", "ể" => "e", "ễ" => "e", "ệ" => "e",
            "É" => "E", "È" => "E", "Ẻ" => "E", "Ẽ" => "E", "Ẹ" => "E", "Ế" => "E", "Ề" => "E", "Ể" => "E", "Ễ" => "E", "Ệ" => "E",
            "í" => "i", "ì" => "i", "ỉ" => "i", "ĩ" => "i", "ị" => "i",
            "Í" => "I", "Ì" => "I", "Ỉ" => "I", "Ĩ" => "I", "Ị" => "I",
            "ó" => "o", "ò" => "o", "ỏ" => "o", "õ" => "o", "ọ" => "o", "ố" => "o", "ồ" => "o", "ổ" => "o", "ỗ" => "o", "ộ" => "o", "ớ" => "o", "ờ" => "o", "ở" => "o", "ỡ" => "o", "ợ" => "o",
            "Ó" => "O", "Ò" => "O", "Ỏ" => "O", "Õ" => "O", "Ọ" => "O", "Ố" => "O", "Ồ" => "O", "Ổ" => "O", "Ỗ" => "O", "Ộ" => "O", "Ớ" => "O", "Ờ" => "O", "Ở" => "O", "Ỡ" => "O", "Ợ" => "O",
            "ú" => "u", "ù" => "u", "ủ" => "u", "ũ" => "u", "ụ" => "u", "ứ" => "u", "ừ" => "u", "ử" => "u", "ữ" => "u", "ự" => "u",
            "Ú" => "U", "Ù" => "U", "Ủ" => "U", "Ũ" => "U", "Ụ" => "U", "Ứ" => "U", "Ừ" => "U", "Ử" => "U", "Ữ" => "U", "Ự" => "U",
            "ý" => "y", "ỳ" => "y", "ỷ" => "y", "ỹ" => "y", "ỵ" => "y",
            "Ý" => "Y", "Ỳ" => "Y", "Ỷ" => "Y", "Ỹ" => "Y", "Ỵ" => "Y",
            "Ñ" => "n",
            //"̌" => "", "́" => "", "̀" => "", "̉" => "", "̃" => "", "̣" => "",
        );

        return strtr($str, $unicode_trans);
    }

    public static function khongdau($value)
    {
        foreach (Helpers::charsArray() as $key => $val) {
            $value = str_replace($val, $key, $value);
        }

        return $value;//Helpers::khongdau2($value);//preg_replace('/[^\x20-\x7E]/u', '', $value);
    }
    public static function charsArray()
    {
        static $charsArray;

        if (isset($charsArray)) {
            return $charsArray;
        }

        return $charsArray = [
            '0'    => ['°', '₀', '۰'],
            '1'    => ['¹', '₁', '۱'],
            '2'    => ['²', '₂', '۲'],
            '3'    => ['з', 'З', '³', '₃', '۳'],
            '4'    => ['⁴', '₄', '۴', '٤'],
            '5'    => ['⁵', '₅', '۵', '٥'],
            '6'    => ['⁶', '₆', '۶', '٦'],
            '7'    => ['⁷', '₇', '۷'],
            '8'    => ['⁸', '₈', '۸'],
            '9'    => ['⁹', '₉', '۹'],
            'a'    => ['@', 'ä', 'à', 'á', 'ả', 'ã', 'ạ', 'ă', 'ắ', 'ằ', 'ẳ', 'ẵ', 'ặ', 'â', 'ấ', 'ầ', 'ẩ', 'ẫ', 'ậ', 'ā', 'ą', 'å', 'α', 'ά', 'ἀ', 'ἁ', 'ἂ', 'ἃ', 'ἄ', 'ἅ', 'ἆ', 'ἇ', 'ᾀ', 'ᾁ', 'ᾂ', 'ᾃ', 'ᾄ', 'ᾅ', 'ᾆ', 'ᾇ', 'ὰ', 'ά', 'ᾰ', 'ᾱ', 'ᾲ', 'ᾳ', 'ᾴ', 'ᾶ', 'ᾷ', 'а', 'أ', 'အ', 'ာ', 'ါ', 'ǻ', 'ǎ', 'ª', 'ა', 'अ', 'ا'],
            'b'    => ['б', 'ხ', 'β', 'Ъ', 'Ь', 'ب', 'ဗ', 'ბ'],
            'c'    => ['©', 'ç', 'ć', 'č', 'ĉ', 'ċ'],
            'd'    => ['შ', 'đ', 'ძ', 'ď', 'ð', 'đ', 'ƌ', 'ȡ', 'ɖ', 'ɗ', 'ᵭ', 'ᶁ', 'ᶑ', 'д', 'δ', 'د', 'ض', 'ဍ', 'ဒ', 'დ'],
            'e'    => ['ع', 'é', 'è', 'ẻ', 'ẽ', 'ẹ', 'ê', 'ế', 'ề', 'ể', 'ễ', 'ệ', 'ë', 'ē', 'ę', 'ě', 'ĕ', 'ė', 'ε', 'έ', 'ἐ', 'ἑ', 'ἒ', 'ἓ', 'ἔ', 'ἕ', 'ὲ', 'έ', 'е', 'ё', 'э', 'є', 'ə', 'ဧ', 'ေ', 'ဲ', 'ე', 'ए', 'إ', 'ئ'],
            'f'    => ['ф', 'φ', 'ف', 'ƒ', 'ფ'],
            'g'    => ['ĝ', 'ğ', 'ġ', 'ģ', 'г', 'ґ', 'γ', 'ဂ', 'გ', 'گ'],
            'h'    => ['ђ', 'ĥ', 'ħ', 'η', 'ή', 'ح', 'ه', 'ဟ', 'ှ', 'ჰ'],
            'i'    => ['آ', 'í', 'ì', 'ỉ', 'ĩ', 'ị', 'î', 'ï', 'ī', 'ĭ', 'į', 'ı', 'ι', 'ί', 'ϊ', 'ΐ', 'ἰ', 'ἱ', 'ἲ', 'ἳ', 'ἴ', 'ἵ', 'ἶ', 'ἷ', 'ὶ', 'ί', 'ῐ', 'ῑ', 'ῒ', 'ΐ', 'ῖ', 'ῗ', 'і', 'ї', 'и', 'ဣ', 'ိ', 'ီ', 'ည်', 'ǐ', 'ი', 'इ'],
            'j'    => ['ĵ', 'ј', 'Ј', 'ჯ', 'ج'],
            'k'    => ['ķ', 'ĸ', 'к', 'κ', 'Ķ', 'ق', 'ك', 'က', 'კ', 'ქ', 'ک'],
            'l'    => ['ł', 'ľ', 'ĺ', 'ļ', 'ŀ', 'л', 'λ', 'ل', 'လ', 'ლ'],
            'm'    => ['м', 'μ', 'م', 'မ', 'მ'],
            'n'    => ['й', 'ñ', 'ń', 'ň', 'ņ', 'ŉ', 'ŋ', 'ν', 'н', 'ن', 'န', 'ნ'],
            'o'    => ['ö', 'ó', 'ò', 'ỏ', 'õ', 'ọ', 'ô', 'ố', 'ồ', 'ổ', 'ỗ', 'ộ', 'ơ', 'ớ', 'ờ', 'ở', 'ỡ', 'ợ', 'ø', 'ō', 'ő', 'ŏ', 'ο', 'ὀ', 'ὁ', 'ὂ', 'ὃ', 'ὄ', 'ὅ', 'ὸ', 'ό', 'о', 'و', 'θ', 'ို', 'ǒ', 'ǿ', 'º', 'ო', 'ओ'],
            'p'    => ['п', 'π', 'ပ', 'პ', 'پ'],
            'q'    => ['ყ'],
            'r'    => ['я', 'ŕ', 'ř', 'ŗ', 'р', 'ρ', 'ر', 'რ'],
            's'    => ['ŝ', 'ś', 'š', 'ş', 'с', 'σ', 'ș', 'ς', 'س', 'ص', 'စ', 'ſ', 'ს'],
            't'    => ['ť', 'ţ', 'т', 'τ', 'ț', 'ت', 'ط', 'ဋ', 'တ', 'ŧ', 'თ', 'ტ'],
            'u'    => ['υ', 'ϋ', 'ύ', 'ΰ', 'ي', 'џ', 'ц', 'ü', 'ú', 'ù', 'ủ', 'ũ', 'ụ', 'ư', 'ứ', 'ừ', 'ử', 'ữ', 'ự', 'û', 'ū', 'ů', 'ű', 'ŭ', 'ų', 'µ', 'у', 'ဉ', 'ု', 'ူ', 'ǔ', 'ǖ', 'ǘ', 'ǚ', 'ǜ', 'უ', 'उ'],
            'v'    => ['в', 'ვ', 'ϐ'],
            'w'    => ['ŵ', 'ω', 'ώ', 'ဝ', 'ွ', 'ယ'],
            'x'    => ['х', 'χ', 'ξ'],
            'y'    => ['ч', 'ý', 'ỳ', 'ỷ', 'ỹ', 'ỵ', 'ÿ', 'ŷ', 'ы'],
            'z'    => ['ź', 'ž', 'ż', 'ζ', 'ز', 'ဇ', 'ზ'],
            'aa'   => ['आ'],
            'ae'   => ['æ', 'ǽ'],
            'ai'   => ['ऐ'],
            //'at'   => ['@'],
            'ch'   => ['ჩ', 'ჭ', 'چ'],
            //'dj'   => ['ђ'],
            //'dz'   => ['џ'],
            'ei'   => ['ऍ'],
            'gh'   => ['غ', 'ღ'],
            'ii'   => ['ई'],
            'ij'   => ['ĳ'],
            'kh'   => ['خ'],
            'lj'   => ['љ'],
            'nj'   => ['њ'],
            'oe'   => ['œ', 'ؤ'],
            'oi'   => ['ऑ'],
            'oii'  => ['ऒ'],
            'ps'   => ['ψ'],
            'sh'   => ['ш', 'ش'],
            'shch' => ['щ'],
            'ss'   => ['ß'],
            //'sx'   => ['ŝ'],
            'th'   => ['þ', 'ϑ', 'ث', 'ذ', 'ظ'],
            'ts'   => ['ც', 'წ'],
            //'ue'   => ['ü'],
            'uu'   => ['ऊ'],
            //'ya'   => ['я'],
            'yu'   => ['ю'],
            'zh'   => ['ж', 'ჟ', 'ژ'],
            //'(c)'  => ['©'],
            'A'    => ['Ä', 'Á', 'À', 'Ả', 'Ã', 'Ạ', 'Ă', 'Ắ', 'Ằ', 'Ẳ', 'Ẵ', 'Ặ', 'Â', 'Ấ', 'Ầ', 'Ẩ', 'Ẫ', 'Ậ', 'Å', 'Ā', 'Ą', 'Α', 'Ά', 'Ἀ', 'Ἁ', 'Ἂ', 'Ἃ', 'Ἄ', 'Ἅ', 'Ἆ', 'Ἇ', 'ᾈ', 'ᾉ', 'ᾊ', 'ᾋ', 'ᾌ', 'ᾍ', 'ᾎ', 'ᾏ', 'Ᾰ', 'Ᾱ', 'Ὰ', 'Ά', 'ᾼ', 'А', 'Ǻ', 'Ǎ'],
            'B'    => ['Ђ', 'ẞ', 'Б', 'Β', 'ब'],
            'C'    => ['Ç', 'Ć', 'Č', 'Ĉ', 'Ċ'],
            'D'    => ['Ď', 'Ð', 'Đ', 'Ɖ', 'Ɗ', 'Ƌ', 'ᴅ', 'ᴆ', 'Д', 'Δ'],
            'E'    => ['É', 'È', 'Ẻ', 'Ẽ', 'Ẹ', 'Ê', 'Ế', 'Ề', 'Ể', 'Ễ', 'Ệ', 'Ë', 'Ē', 'Ę', 'Ě', 'Ĕ', 'Ė', 'Ε', 'Έ', 'Ἐ', 'Ἑ', 'Ἒ', 'Ἓ', 'Ἔ', 'Ἕ', 'Έ', 'Ὲ', 'Е', 'Ё', 'Э', 'Є', 'Ə'],
            'F'    => ['Ф', 'Φ'],
            'G'    => ['Ĝ', 'Ğ', 'Ġ', 'Ģ', 'Г', 'Ґ', 'Γ'],
            'H'    => ['Ĥ', 'Η', 'Ή', 'Ħ'],
            'I'    => ['Í', 'Ì', 'Ỉ', 'Ĩ', 'Ị', 'Î', 'Ï', 'Ī', 'Ĭ', 'Į', 'İ', 'Ι', 'Ί', 'Ϊ', 'Ἰ', 'Ἱ', 'Ἳ', 'Ἴ', 'Ἵ', 'Ἶ', 'Ἷ', 'Ῐ', 'Ῑ', 'Ὶ', 'Ί', 'И', 'І', 'Ї', 'Ǐ', 'ϒ'],
            'J'    => ['Ĵ'],
            'K'    => ['К', 'Κ'],
            'L'    => ['Ĺ', 'Ł', 'Л', 'Λ', 'Ļ', 'Ľ', 'Ŀ', 'ल'],
            'M'    => ['М', 'Μ'],
            'N'    => ['Й', 'Ń', 'Ñ', 'Ň', 'Ņ', 'Ŋ', 'Н', 'Ν'],
            'O'    => ['Ö', 'Ó', 'Ò', 'Ỏ', 'Õ', 'Ọ', 'Ô', 'Ố', 'Ồ', 'Ổ', 'Ỗ', 'Ộ', 'Ơ', 'Ớ', 'Ờ', 'Ở', 'Ỡ', 'Ợ', 'Ø', 'Ō', 'Ő', 'Ŏ', 'Ο', 'Ό', 'Ὀ', 'Ὁ', 'Ὂ', 'Ὃ', 'Ὄ', 'Ὅ', 'Ὸ', 'Ό', 'О', 'Θ', 'Ө', 'Ǒ', 'Ǿ'],
            'P'    => ['П', 'Π'],
            'Q'    => ['Ω', 'Ώ'],
            'R'    => ['Я', 'Ř', 'Ŕ', 'Р', 'Ρ', 'Ŗ'],
            'S'    => ['Ş', 'Ŝ', 'Ș', 'Š', 'Ś', 'С', 'Σ'],
            'T'    => ['Ť', 'Ţ', 'Ŧ', 'Ț', 'Т', 'Τ'],
            'U'    => ['Ц', 'Џ', 'Ü', 'Ú', 'Ù', 'Ủ', 'Ũ', 'Ụ', 'Ư', 'Ứ', 'Ừ', 'Ử', 'Ữ', 'Ự', 'Û', 'Ū', 'Ů', 'Ű', 'Ŭ', 'Ų', 'У', 'Ǔ', 'Ǖ', 'Ǘ', 'Ǚ', 'Ǜ'],
            'V'    => ['В'],
            'W'    => ['Ĳ', 'Ŵ'],
            'X'    => ['Ж', 'Х', 'Χ', 'Ξ'],
            'Y'    => ['Ч', 'Ψ', 'Ý', 'Ỳ', 'Ỷ', 'Ỹ', 'Ỵ', 'Ÿ', 'Ῠ', 'Ῡ', 'Ὺ', 'Ύ', 'Ы', 'Υ', 'Ϋ', 'Ŷ'],
            'Z'    => ['Ź', 'Ž', 'Ż', 'Ζ'],
            'AE'   => ['Æ', 'Ǽ'],
            //'CH'   => [],
            //'DJ'   => [],
            //'DZ'   => ['Џ'],
            //'GX'   => ['Ĝ'],
            //'HX'   => ['Ĥ'],
            //'IJ'   => ['Ĳ'],
            //'JX'   => ['Ĵ'],
            //'KH'   => ['Х'],
            'LJ'   => ['Љ'],
            'NJ'   => ['Њ'],
            'OE'   => ['Œ'],
            //'PS'   => ['Ψ'],
            'SH'   => ['Ш'],
            'SHCH' => ['Щ'],
            //'SS'   => ['ẞ'],
            'TH'   => ['Þ'],
            //'TS'   => ['Ц'],
            //'UE'   => ['Ü'],
            //'YA'   => ['Я'],
            'YU'   => ['Ю'],
            //'ZH'   => ['Ж'],
            ' '    => ["\xC2\xA0", "\xE2\x80\x80", "\xE2\x80\x81", "\xE2\x80\x82", "\xE2\x80\x83", "\xE2\x80\x84", "\xE2\x80\x85", "\xE2\x80\x86", "\xE2\x80\x87", "\xE2\x80\x88", "\xE2\x80\x89", "\xE2\x80\x8A", "\xE2\x80\xAF", "\xE2\x81\x9F", "\xE3\x80\x80"],
            ''     => ["ˇ", "ˆ", "̌", "˰", "̈", "̇ ", "̆", "˜",  "́", "̀", "̉", "̃", "̣"], // for unicode to hop http://www.doc.ic.ac.uk/~svb/chars.html
        ];
    }

    public static function rawTiengVietUrl($str, $spaceReplace = '-')
    {
        return preg_replace(array('/[^a-zA-Z0-9 -]/', '/[ -]+/', '/^-|-$/'), array('', $spaceReplace, ''), self::khongdau($str));
    }

    public static function replaceKeySearch($str) {
        return self::strReplaceSolr(preg_replace(['/y/', '/ý/', '/ỳ/', '/ỷ/', '/ỵ/', '/ỹ/', '/s/'], ['i', 'í', 'ì', 'ỉ', 'ị', 'ĩ', 'x'], mb_strtolower($str, 'UTF-8')));
    }

    public static function album_url($album_info, $id = 0)
    {
        $album_title_url = self::rawTiengVietUrl(htmlspecialchars_decode($album_info['music_album'], ENT_QUOTES));
        $album_url = $album_title_url . '~' . base64_encode(KEY_ID_ALBUM_ENCODE_URL . $album_info['cover_id']) . "." . HTMLEX;;

        return ($id == 0) ? SUB_ALLBUM . $album_url : SUB_ALLBUM . $album_url . '?id='. $id;
    }
    public static function playlist_url($playlist_info, $id = 0)
    {
        $playlist_title_url = self::rawTiengVietUrl(htmlspecialchars_decode($playlist_info['playlist_title'],ENT_QUOTES));
        $playlist_url = $playlist_title_url . '~' . base64_encode(KEY_ID_PLAYLIST_ENCODE_URL . $playlist_info['playlist_id']) . "." . HTMLEX;;

        return ($id == 0) ? SUB_PLAYLIST . $playlist_url : SUB_PLAYLIST . $playlist_url . '?id='. $id;
    }
    public static function playlist_publisher_url($playlist_info, $id = 0)
    {
        $playlist_title_url = self::rawTiengVietUrl(htmlspecialchars_decode($playlist_info['playlist_title'], ENT_QUOTES));
        $playlist_url = $playlist_title_url . '~' . base64_encode(KEY_ID_PLAYLIST_ENCODE_URL . $playlist_info['playlist_id']) . "." . HTMLEX;;

        return ($id == 0) ? SUB_PLAYLIST_PUBLISHER . $playlist_url : SUB_PLAYLIST . $playlist_url . '?id='. $id;
    }

    public static function pagingCustom($page, $rows, $total, $url, $key = 'q') {
        echo '<ul class="pagination">';
        echo PaginationLinksCustom::create($page, ceil($total / $rows), 1, '<li>'.$url.'</li>', '<li class="active"><a>%d</a></li>', '<li><a>&hellip;</a></li>', $key);
        echo '</ul>';
    }


    public static function music_filename($music_info)
    {
        $name = htmlspecialchars_decode(self::khongdau($music_info['music_title'] . ' - ' . $music_info['music_artist']), ENT_QUOTES);
        $temp = '';
        $last_char = ' ';
        for ($i = 0; $i < strlen($name); $i++) {
            $char = $name[$i];
            if (('a' <= $char && $char <= 'z') || ('A' <= $char && $char <= 'Z') || ('0' <= $char && $char <= '9') || $char == '-') {
                $last_char = $char;
                $temp .= $last_char;
            } else if ($last_char != ' ') {
                $last_char = ($char == ' ') ? ' ' : '_';
                $temp .= $last_char;
            }
        }

        return trim(substr($temp, 0, 40));
    }

    public static function filesize2str($bytes, $precision = 2)
    {
        $units = array('Bytes', 'KB', 'MB', 'GB', 'TB');

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        // Uncomment one of the following alternatives
        $bytes /= pow(1024, $pow);
        // $bytes /= (1 << (10 * $pow));

        return round($bytes, $precision) . ' ' . $units[$pow];
    }
    public static function getIp(){
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']) == true){
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        }else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']) == true){
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }else if(isset($_SERVER['HTTP_X_FORWARDED']) == true){
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        }else if(isset($_SERVER['HTTP_FORWARDED_FOR']) == true){
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        }else if(isset($_SERVER['$_SERVER[\'REMOTE_ADDR\']']) == true){
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        }else if(isset($_SERVER['REMOTE_ADDR']) == true){
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        }else{
            $ipaddress = 'UNKNOWN';
        }
        return $ipaddress;
    }
    public static function domain_hosted($music_info)
    {
        $music_id = $music_info['music_id'];

        // Large Data2's Server
        if ($music_id < 1000000)
            $url = 'https://data50.chiasenhac.com/'; //'https://data3.chiasenhac.com/';
        else if ($music_id <= 1029000)
            $url = 'https://data51.chiasenhac.com/';
        else if ($music_id <= 1059000)
            $url = 'https://data52.chiasenhac.com/';
        else if ($music_id <= 1089000)
            $url = 'https://data53.chiasenhac.com/';
        else if ($music_id <= 1119000)
            $url = 'https://data54.chiasenhac.com/';
        else if ($music_id <= 1149000)
            $url = 'https://data55.chiasenhac.com/';
        else if ($music_id <= 1179000)
            $url = 'https://data56.chiasenhac.com/';
        else if ($music_id <= 1209000)
            $url = 'https://data57.chiasenhac.com/';
        else if ($music_id <= 1239000)
            $url = 'https://data58.chiasenhac.com/';
        else if ($music_id <= 1269000)
            $url = 'https://data59.chiasenhac.com/';
        else if ($music_id <= 1299000)
            $url = 'https://data60.chiasenhac.com/';
        else if ($music_id <= 1329000)
            $url = 'https://data61.chiasenhac.com/';
        else if ($music_id <= 1349000)
            $url = 'https://data62.chiasenhac.com/';

        // DDLQD's Server
        else if ($music_id <= 1379000)
            $url = 'https://data01.chiasenhac.com/';
        // Large Server
        else if ($music_id <= 1419000)
            $url = 'https://data.chiasenhac.com/';
        else if ($music_id <= 1449000)
            $url = 'https://data26.chiasenhac.com/';
        // Large Server
        else if ($music_id <= 1469000)
            $url = 'https://data16.chiasenhac.com/';
        else if ($music_id <= 1489000)
            $url = 'https://data17.chiasenhac.com/';
//        else if ($music_id <= 1489000)
//            $url = 'https://data.chiasenhac.com/dataxx/27/'; //'http://data27.chiasenhac.com/';
        // YCH's Server
        else if ($music_id <= 1529000)
            $url = 'https://data04.chiasenhac.com/';
        else if ($music_id <= 1569000)
            $url = 'https://data03.chiasenhac.com/';
        // Large Server
        else if ($music_id <= 1649000)
            $url = 'https://data2.chiasenhac.com/';
        // YCH's Server
        else if ($music_id <= 1689000)
            $url = 'https://data05.chiasenhac.com/';
        // Large Server
        else if ($music_id <= 1729000)
            $url = 'https://data2.chiasenhac.com/';
        else if ($music_id <= 1739000)
            $url = 'https://data01.chiasenhac.com/';
        else if ($music_id <= 1809000)
            $url = 'https://data3.chiasenhac.com/';
        // DDLQD's Server
        else if ($music_id <= 1859000)
            $url = 'https://data00.chiasenhac.com/';
        // CSN's Server OLD
        else if ($music_id <= 1919000)
            $url = (rand(1,2) == 1) ? 'https://data38.chiasenhac.com/' : 'https://data37.chiasenhac.com/';
        else if ($music_id <= 1934000)
            $url = 'https://data32.chiasenhac.com/';
        else if ($music_id <= 1949000)
            $url = 'https://data34.chiasenhac.com/';
        else if ($music_id <= 1962000)
            $url = 'https://data35.chiasenhac.com/';
        else if ($music_id <= 1969000)
            $url = 'https://data36.chiasenhac.com/';
        else if ($music_id <= 1979000)
            $url = 'https://data31.chiasenhac.com/';
        else if ($music_id <= 1993000)
            $url = 'https://data33.chiasenhac.com/';
        else if ($music_id <= 2019000)
            $url = 'https://data18.chiasenhac.com/';
        else if ($music_id <= 2029000)
            $url = 'https://data19.chiasenhac.com/';
        else if ($music_id <= 2046000)
            $url = 'https://data25.chiasenhac.com/';
        else
            $url = 'https://data.chiasenhac.com/';

        ///// demo url hidden link
//        if($url == 'https://data4.chiasenhac.com/') {
//            $exp = strtotime("+" . TIME_EXPIRED_LINK . "  minutes");
//            return $url . md5(self::getIp() . env('DATA_KEY')) . '@' . $exp . '/';
//        }
        return $url;
    }

    public static function file_url(&$music_info)
    {
        if (!isset($music_info['music_id'])) {
            return '';
        }

        $music_id = $music_info['music_id'];
        if (!$music_info['music_file_cache']) {
            $music_info['music_file_cache'] = self::music_filename($music_info);
        }
        $url = self::domain_hosted($music_info);

        $pathinfo = pathinfo($music_info['music_filename']);
        $music_info['music_extension'] = $pathinfo['extension'];
        $music_info['music_filename_noext'] = $pathinfo['filename'];

        $music_info['url1'] = $url . 'downloads/' . ceil($music_id / 1000) . '/' . date('w') . '/';
        $music_info['url2'] = rawurlencode($music_info['music_filename_noext']);
        $music_info['url3'] = "/128/" . rawurlencode($music_info['music_file_cache']) . "." . $music_info['music_extension'];

        if ($music_info['music_extension'] == 'mp4') {
            $file_url = array();

            if ($music_info['music_32_filesize'] > 0) {
                $file_url[] = array(
                    'url' => $url . 'downloads/' . ceil($music_id / 1000) . '/' . date('w') . '/' . rawurlencode($music_info['music_filename_noext']) . "/32/" . rawurlencode($music_info['music_file_cache']) . "." . $music_info['music_extension'],
                    'label' => '180p',
                    'size' => self::filesize2str($music_info['music_32_filesize']),
                    'type' => 'mp4'
                );
            }
            if ($music_info['music_filesize'] > 0) {
                $file_url[] = array(
                    'url' => $url . 'downloads/' . ceil($music_id / 1000) . '/' . date('w') . '/' . rawurlencode($music_info['music_filename_noext']) . "/128/" . rawurlencode($music_info['music_file_cache']) . "." . $music_info['music_extension'],
                    'label' => '360p',
                    'size' => self::filesize2str($music_info['music_filesize']),
                    'type' => 'mp4'
                );
            }
            if ($music_info['music_320_filesize'] > 0) {
                $file_url[] = array(
                    'url' => $url . 'downloads/' . ceil($music_id / 1000) . '/' . date('w') . '/' . rawurlencode($music_info['music_filename_noext']) . "/320/" . rawurlencode($music_info['music_file_cache']) . "." . $music_info['music_extension'],
                    'label' => '480p',
                    'size' => self::filesize2str($music_info['music_320_filesize']),
                    'type' => 'mp4'
                );
            }
            if ($music_info['music_m4a_filesize'] > 0) {
                $file_url[] = array(
                    'url' => $url . 'downloads/' . ceil($music_id / 1000) . '/' . date('w') . '/' . rawurlencode($music_info['music_filename_noext']) . "/m4a/" . rawurlencode($music_info['music_file_cache']) . "." . $music_info['music_extension'],
                    'label' => '720p',
                    'size' => self::filesize2str($music_info['music_m4a_filesize']),
                    'type' => 'mp4'
                );
            }
            if ($music_info['music_lossless_filesize'] > 0) {
                $file_url[] = array(
                    'url' => $url . 'downloads/' . ceil($music_id / 1000) . '/' . date('w') . '/' . rawurlencode($music_info['music_filename_noext']) . "/flac/" . rawurlencode($music_info['music_file_cache']) . "." . $music_info['music_extension'],
                    'label' => '1080p',
                    'size' => self::filesize2str($music_info['music_lossless_filesize']),
                    'type' => 'mp4'
                );
            }
        } else {
            $file_url = array();
            if ($music_info['music_32_filesize'] > 0) {
                $file_url[] = array(
                    'url' => $url . 'downloads/' . ceil($music_id / 1000) . '/' . date('w') . '/' . rawurlencode($music_info['music_filename_noext']) . "/32/" . rawurlencode($music_info['music_file_cache']) . ".m4a",
                    'label' => '32kbps',
                    'size' => self::filesize2str($music_info['music_32_filesize']),
                    'type' => 'm4a'
                );
            }
            if ($music_info['music_filesize'] > 0) {
                $file_url[] = array(
                    'url' => $url . 'downloads/' . ceil($music_id / 1000) . '/' . date('w') . '/' . rawurlencode($music_info['music_filename_noext']) . "/128/" . rawurlencode($music_info['music_file_cache']) . "." . $music_info['music_extension'],
                    'label' => '128kbps',
                    'size' => self::filesize2str($music_info['music_filesize']),
                    'type' => 'mp3'
                );
            }
            if ($music_info['music_320_filesize'] > 0) {
                $file_url[] = array(
                    'url' => $url . 'downloads/' . ceil($music_id / 1000) . '/' . date('w') . '/' . rawurlencode($music_info['music_filename_noext']) . "/320/" . rawurlencode($music_info['music_file_cache']) . "." . $music_info['music_extension'],
                    'label' => '320kbps',
                    'size' => self::filesize2str($music_info['music_320_filesize']),
                    'type' => 'mp3'
                );
            }
            if ($music_info['music_m4a_filesize'] > 0) {
                $file_url[] = array(
                    'url' => $url . 'downloads/' . ceil($music_id / 1000) . '/' . date('w') . '/' . rawurlencode($music_info['music_filename_noext']) . "/m4a/" . rawurlencode($music_info['music_file_cache']) . ".m4a",
                    'label' => '500kbps',
                    'size' => self::filesize2str($music_info['music_m4a_filesize']),
                    'type' => 'm4a'
                );
            }
            if ($music_info['music_lossless_filesize'] > 0) {
                $file_url[] = array(
                    'url' => $url . 'downloads/' . ceil($music_id / 1000) . '/' . date('w') . '/' . rawurlencode($music_info['music_filename_noext']) . "/flac/" . rawurlencode($music_info['music_file_cache']) . ".flac",
                    'label' => 'Lossless',
                    'size' => self::filesize2str($music_info['music_lossless_filesize']),
                    'type' => 'flac'
                );
            }
        }

        return $file_url;
    }
    public static function rawLyrics($lyrics) {
//        $lyrics = str_replace("]\r\n", ']', $lyrics);
//        $lyrics = str_replace("][", "]\r\n[", $lyrics);
//
//        $lyrics = explode("\r\n", $lyrics);
//        foreach ($lyrics as &$item) {
//            preg_match_all("[(.*)]", $item, $matches);
//            dd($matches);
//        }
//
//        dd($lyrics);
        return $lyrics;
    }

    public static function lyric_to_web($lyric)
    {
        if (strlen($lyric) < 100)
        {
            return $lyric;
        }

        $lyrics = array();
        $lyric_line = explode("\n", $lyric);
        $nosub = true;

        foreach($lyric_line as $line) {
            $preline = substr($line, 0, 4);
            if ($preline == '[t1]')
            {
                // SUB
                $line .= '[/t1]';
                $nosub = false;
            }
            else if ($preline == '[t2]')
            {
                // SUB
                $line .= '[/t2]';
                $nosub = false;
            }
            else if (!$nosub && $preline == 'Ngư')
            {
                if (substr($line, 0, 16) == 'Người dịch:') {
                    // SUB
                    $line = '[t2]' . $line . '[/t2]';
                    $nosub = false;
                }
            }
            $lyrics[] = $line;
        }

        $web_lyric = implode("\n", $lyrics);

        if (!$nosub) {
            $web_lyric = str_replace("[t1]", '<div class="vietsub1 sub_line">', $web_lyric);
            $web_lyric = str_replace("[t2]", '<div class="vietsub2 sub_line">', $web_lyric);
            $web_lyric = str_replace(array("[/t1]\n", "[/t2]\n", "[/t1]", "[/t2]"), '</div>', $web_lyric);
        }

        return array(
            'lyric' => nl2br($web_lyric),
            'sub' => $nosub ? false : true
        );
    }
    public static function size2str($width, $height, $color = true, $show_all = false)
    {
        if ($width == 1920 && $height <= 1080)
            $size2str = 'HD 1080p';
        else if ($width == 1280 && $height <= 720)
            $size2str = 'HD 720p';
        else if ($width == 854 && $height <= 480)
            $size2str = 'MV 480p';
        else if ($width == 640 && $height <= 360)
            $size2str = 'MV 360p';
        else if ($width == 320 && $height <= 180)
            $size2str = 'MV 180p';
        else
            $size2str = $width .'x'. $height;

        if ($color)
        {
            if ($width >= 1920)// && $height >= 1080)
                $size2str = '<span style="color: red">'. $size2str .'</span>';
            else if ($width >= 1280)// && $height >= 720)
                $size2str = '<span style="color: orange">'. $size2str .'</span>';
            else if ($width >= 854)// && $height >= 480)
                $size2str = '<span style="color: darkblue">'. $size2str .'</span>';
            else if ($width >= 640)// && $height >= 360)
                $size2str = '<span style="color: darkgreen">'. $size2str .'</span>';
        }
        else
        {
            if ($show_all)
            {
                if ( $show_all == -1 )
                {
                    $size2str = 'MV 360p';
                    if ($width >= 854)
                        $size2str .= ', MV 480p';
                    if ($width >= 1280)
                        $size2str .= ', HD 720p';
                    if ($width >= 1920)
                        $size2str .= ', HD 1080p';
                }
                else
                {
                    $size2str = 'MV 360p';
                    if ($width >= 854)
                        $size2str = 'MV 480p, ' . $size2str;
                    if ($width >= 1280)
                        $size2str = 'HD 720p, ' . $size2str;
                    if ($width >= 1920)
                        $size2str = 'HD 1080p, ' . $size2str;
                }
            }
        }

        return $size2str;
    }
    public static function MusicCookie($request, $music) {
        $musicRecent = $_COOKIE['music_history'] ?? '';
        if(Auth::check()) {
            $musicRecent = Auth::user()->user_music_recent;
        }
        if(isset($musicRecent)) {
            $musicHistory = unserialize($musicRecent);
            $musicHistory = array_diff(array_reverse($musicHistory ? $musicHistory : []), [$music->music_id]);
            array_push($musicHistory, $music->music_id);
            $musicHistory = array_slice(array_reverse($musicHistory),0, LIMIT_HISTORY_MUSIC);
        }else{
            $musicHistory[] = $music->music_id;
        }
        $musicHistorySer = serialize($musicHistory);
        setcookie('music_history', $musicHistorySer, time() + 31536000,'/');
        if(Auth::check()) {
            $user = Auth::user();
            $user->user_music_recent = $musicHistorySer;
            $user->save();
        }
        return [
            'cookie' => $musicHistorySer,
            'value' => $musicHistory
        ];

    }
    public static function numberShorten($number) {
        $numberFormat = number_format($number);
        if($number < 999) {
            return $numberFormat;
        }elseif($number < 999999) {
            return substr($numberFormat, 0, strlen($numberFormat) - 2) . 'k';
        }elseif($number < 999999999) {
            return substr($numberFormat, 0, strlen($numberFormat) - 5) . 'm';
        }elseif($number < 999999999999) {
            return substr($numberFormat, 0, strlen($numberFormat) - 8) . 't';
        }else{
            return $numberFormat;
        }
    }
    public static function formatBytes($size) {
        $base = log($size) / log(1024);
        $suffix = array("", "KB", "MB", "GB", "TB");
        $f_base = floor($base);
        return round(pow(1024, $base - floor($base)), 1) . $suffix[$f_base];
    }
    public static function pathAvatar($userAvatar, $userId, $domain = '') {
        if(!$userAvatar)
            return $domain.'/imgs/no_avatar.png';
        return (strpos($userAvatar, 'http') !== false) ? $userAvatar : $domain.Helpers::file_path($userId, PUBLIC_AVATAR_PATH, true) . $userAvatar . '?time='.time();
    }
    public static function getImgQuality($musicId) {
        return 'https://data5.chiasenhac.com/data/spectrum'.Helpers::file_path($musicId, '/', true).$musicId.'.jpg';
//        return 'http://data5.chiasenhac.com/data/spectrum'.Helpers::file_path($musicId, '/', true).$musicId.'.jpg';
    }
    public static function strReplaceSolr($str, $keyRelease = false) {
//        $firstPart = preg_replace(array('/[^a-zA-Z0-9]/'), array(''), substr($str, 0, 1));
//        $str = $firstPart . substr($str, 1);
//        $str = str_replace('\\', '', $str);
        $str = str_replace(array('\\', '+', '-', '~', '!', '%', '/', ';', '?', '#', '`', '@', '$', '&', '_', '=', '{', '}', ',', '<', '>', '"', '[', ']', '|', '*', '^', ':', '(', ')'), ' ', $str);
        if(!$keyRelease)
            return $str;
        return trim(preg_replace(['/y/', '/ý/', '/ỳ/', '/ỷ/', '/ỵ/', '/ỹ/', '/s/'], ['i', 'í', 'ì', 'ỉ', 'ị', 'ĩ', 'x'], mb_strtolower($str, 'UTF-8')));
    }
    public static function checkExitsExcepArtist($artist, $arrExep)
    {
        foreach (explode(';', $artist) as $item) {
            if(in_array($item, $arrExep))
                return true;
        }
        return false;
    }
    public static function removeMultiSpace($input) {
        return preg_replace('!\s+!', ' ', $input);
    }
    public static function convertArrSolr(&$dataSolr) {
        $data = [];
        if($dataSolr['data']) {
            foreach ($dataSolr['data'] as $item) {
                $term = [];
                foreach ($item as $key => $val) {
                    $term[$key] = htmlspecialchars_decode((is_array($val) ? $val[0] : $val), ENT_QUOTES);
                }
                $data[] = $term;
            }
        }
        return $dataSolr['data'] = $data;
    }
    public static function convertArrHtmlCharsDecode($data) {
        foreach ($data as $key => $val) {
            if(is_array($val)) {
                $data[$key] = self::convertArrHtmlCharsDecode($val);
            }else{
                $data[$key] = $val ? htmlspecialchars_decode($val, ENT_QUOTES) : null;
            }
        }
        return $data;
    }
    public static function checkMemberVip() {
//        if(Auth::check()) {
//            $level = Auth::user()->level();
//            if($level && $level->level_expried >= time() && $level->level_status == 1) {
//                return true;
//            }
//            return false;
//        }
        return false;
    }
    public static function news_image($image, $size = null) {
        if(strpos($image, 'http') !== false){
            if($size == 'full') {
                return str_replace(
                    ["-360x180", "-360x185", "-300x240", "-300x214"],
                    [""],
                    $image);
            }else {
                return $image;
            }
        }else {
            if($size == 'full') {
                return '/'.$image;
            }else {
                $arrFile = explode('/', $image);
                $removed = array_pop($arrFile);
                $name = '/uploads/.tmb/' . $removed;
//                return '/'.$image;
                return $name;
            }

        }
    }
}
