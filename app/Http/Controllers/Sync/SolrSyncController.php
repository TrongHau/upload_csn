<?php

/**
 * Created by PhpStorm.
 * User: admin
 * Date: 8/17/2018
 * Time: 3:38 PM
 */

namespace App\Http\Controllers\Sync;
ini_set('memory_limit', '-1');

use App\Http\Controllers\Controller;
use Illuminate\Http\Request as Request;
use Illuminate\Support\Facades\Auth;
use App\Library\Helpers;
use App\Models\MusicModel;
use App\Models\UploadModel;
use App\Models\MusicSolrModel;
use App\Models\VideoModel;
use App\Models\CoverModel;
use App\Solr\Solarium;
use App\Models\ArtistModel;
use App\Repositories\Music\MusicEloquentRepository;
use DB;

class SolrSyncController extends Controller
{
    protected $Solr;

    public function __construct(Solarium $Solr)
    {
        $this->Solr = $Solr;
    }

    public function ping()
    {
        return $this->Solr->ping();
    }

    public function syncMusic($id = null, $musicItem = null, $time = null, $field = 'music_last_update_time', $offset = 0, $limit = 0)
    {
        $searchMusic = [];
        if ($id) {
                $searchMusic = MusicModel::select('music_id', 'music_composer', 'music_title', 'music_artist', 'music_downloads_this_week', 'music_search_result',
                    'cat_id', 'cat_level', 'cat_sublevel', 'cover_id', 'music_artist_id', 'music_album', 'music_listen', 'music_downloads', 'music_filename', 'music_bitrate', 'music_downloads_today', 'music_downloads_max_week', 'music_downloads_this_week', 'music_lyric', 'music_title_url', 'music_download_time')
                    ->where('cat_id', '!=', CAT_VIDEO)
                    ->where('music_deleted', '<', 1)
                    ->orderBy('music_id', 'asc')
                    ->where('music_id', $id)
                    ->get();
        } elseif ($musicItem) {
            if (isset($musicItem[0])) {
                $searchMusic = $musicItem;
            } else {
                $searchMusic[] = $musicItem;
            }
        } elseif ($time) {
            $searchMusic = MusicModel::select('music_id', 'music_composer', 'music_title', 'music_artist', 'music_downloads_this_week', 'music_search_result',
                'cat_id', 'cat_level', 'cat_sublevel', 'cover_id', 'music_artist_id', 'music_album', 'music_listen', 'music_downloads', 'music_filename', 'music_bitrate', 'music_downloads_today', 'music_downloads_max_week', 'music_downloads_this_week', 'music_lyric', 'music_title_url', 'music_download_time')
                ->where([['cat_id', '!=', CAT_VIDEO], ['music_deleted', '<', 1], [$field, '>', $time]])
                ->get();
        } elseif ( $limit > 0 ) {
                $searchMusic = MusicModel::select('music_id', 'music_composer', 'music_title', 'music_artist', 'music_downloads_this_week', 'music_search_result',
                    'cat_id', 'cat_level', 'cat_sublevel', 'cover_id', 'music_artist_id', 'music_album', 'music_listen', 'music_downloads', 'music_filename', 'music_bitrate', 'music_downloads_today', 'music_downloads_max_week', 'music_downloads_this_week', 'music_lyric', 'music_title_url', 'music_download_time')
                    ->where([['cat_id', '!=', CAT_VIDEO], ['music_deleted', '<', 1]])
                    ->offset($offset)
                    ->limit($limit)
                    ->orderBy('music_id', 'asc')
                    ->get();

//                if ( sizeof($searchMusic) == 0 && ($hour_now == 1 || $hour_now == 13) && $minute_now == 28 ) //
//                {
//                    $this->Solr->solrDeleteByQuery('(id:music_*)AND(solr_updated_time:[0 TO '. (time() - 3600) .'])');
//                    echo "Deleted!";
//                    exit;
//                }
        } elseif (isset($_GET['m_start'])) {
            if (Auth::check() && (Auth::user()->id == 3 || Auth::user()->id == 997917)) {
                $searchMusic = MusicModel::select('music_id', 'music_composer', 'music_title', 'music_artist', 'music_downloads_this_week', 'music_search_result',
                    'cat_id', 'cat_level', 'cat_sublevel', 'cover_id', 'music_artist_id', 'music_album', 'music_listen', 'music_downloads', 'music_filename', 'music_bitrate', 'music_downloads_today', 'music_downloads_max_week', 'music_downloads_this_week', 'music_lyric', 'music_title_url', 'music_download_time')
                    ->where([['cat_id', '!=', CAT_VIDEO], ['music_deleted', '<', 1], ['music_id', '>', intval($_GET['m_start'])]])
//                ->whereIn('music_id', [1980711])
                    ->where('music_id', '>', '200000')
                    ->offset(0)
                    ->limit(50000)
                    ->orderBy('music_id', 'asc')
                    ->get();
            }
//            else {
//                $minute_now = intval(date('i'));
//                $hour_now = intval(date('H'));
//                $limit = 50000;
//                $offset = $minute_now * $limit;
//                $searchMusic = MusicModel::select('music_id', 'music_composer', 'music_title', 'music_artist', 'music_downloads_this_week',
//                    'cat_id', 'cat_level', 'cat_sublevel', 'cover_id', 'music_artist_id', 'music_album', 'music_listen', 'music_downloads', 'music_filename', 'music_bitrate', 'music_downloads_today', 'music_downloads_max_week', 'music_downloads_this_week', 'music_lyric', 'music_title_url', 'music_download_time')
//                    ->where([['cat_id', '!=', CAT_VIDEO], ['music_deleted', '<', 1], ['music_id', '>', intval($_GET['m_start'])], ['music_id', '<', 1387001]])
//                    ->orwhere([['cat_id', '!=', CAT_VIDEO], ['music_deleted', '<', 1], ['music_id', '>', intval($_GET['m_start'])], ['music_id', '>', 1419000]])
//                    ->offset($offset)
//                    ->limit($limit)
//                    ->orderBy('music_id', 'asc')
//                    ->get();
//
//                if ( sizeof($searchMusic) == 0 && ($hour_now == 1 || $hour_now == 13) && $minute_now == 28 ) //
//                {
//                    $this->Solr->solrDeleteByQuery('(id:music_*)AND(solr_updated_time:[0 TO '. (time() - 3600) .'])');
//                    echo "Deleted!";
//                    exit;
//                }
//            }
        }
        DB::disconnect('mysql');

        $datas = [];
        foreach ($searchMusic as $key => $item) {
            if ($item->music_id > 200000) {
            if ($item->cat_id != CAT_VIDEO) {
                $titleSearch = Helpers::replaceKeySearch($item->music_title);
                $artistSearch = Helpers::replaceKeySearch($item->music_artist);
                $titleCharset = htmlspecialchars(Helpers::strReplaceSolr(Helpers::khongdau($titleSearch, ' ')), ENT_QUOTES);
                $artistCharset = htmlspecialchars(Helpers::strReplaceSolr(Helpers::khongdau($artistSearch, ' ')), ENT_QUOTES);
                $composerCharset = Helpers::replaceKeySearch($item->music_composer);
                $composerCharset = htmlspecialchars(Helpers::strReplaceSolr(Helpers::khongdau($composerCharset, ' ')), ENT_QUOTES);
//            $lyricSearch = Helpers::replaceKeySearch($item->music_lyric);
//            $lyricCharset = Helpers::khongdau(str_replace("\n", ' ', $lyricSearch), ' ');
                $data = [
                    'id' => 'music_' . $item->music_id,
                    'music_id' => $item->music_id,
                    'music_title' => $item->music_title,
                    'music_title_search' => htmlspecialchars($titleSearch, ENT_QUOTES),
                    'music_artist_search' => htmlspecialchars($artistSearch, ENT_QUOTES),
//                'music_title_artist_search' => $titleSearch .' '. $artistSearch,
                    'music_title_charset_nospace' => str_replace(' ', '', $titleCharset),
                    'music_artist_charset_nospace' => str_replace(' ', '', $artistCharset),
                    'music_title_artist_charset_nospace' => str_replace(' ', '', $titleCharset) . '' . str_replace(' ', '', $artistCharset),
                    'music_title_charset' => $titleCharset,
                    'music_artist_charset' => $artistCharset,
//                'music_title_artist_charset' => $titleCharset . ' '. $artistCharset,
//                'music_lyric' => $item->music_lyric,
//                'music_lyric_search' => $lyricSearch,
                    //'music_lyric_charset' => $lyricCharset,
                    'music_bitrate_html' => Helpers::bitrate2str($item->music_bitrate),
                    'music_cover' => Helpers::cover_url($item->cover_id),
                    'music_link' => Helpers::listen_url($item->toArray(), false),
                    'music_filename' => $item->music_filename,
                    'music_artist' => $item->music_artist, //str_replace(';', ',', $item->music_artist),
                    'music_artist_array' => explode(';', $item->music_artist),
                    'music_artist_id' => explode(';', htmlspecialchars_decode($item->music_artist_id, ENT_QUOTES)),
                    'music_artist_html' => Helpers::rawHtmlArtists($item->music_artist_id, $item->music_artist),
                    'music_listen' => $item->music_listen,
                    'music_title_url' => $item->music_title_url,
                    'music_cat_id' => $item->cat_id,
                    'cat_id' => $item->cat_id,
                    'music_composer_charset' => $composerCharset,
                    'music_composer_charset_nospace' => str_replace(' ', '', $composerCharset),
                    'music_composer' => $item->music_composer,
                    'music_cat_level' => $item->cat_level,
                    'cat_level' => $item->cat_level,
                    'music_cover_id' => $item->cover_id,
                    'cover_id' => $item->cover_id,
                    'music_bitrate' => $item->music_bitrate,
                    'music_width' => $item->music_width,
                    'music_height' => $item->music_height,
                    'music_length' => $item->music_length,
                    'music_downloads' => $item->music_downloads,
                    'music_download_time' => $item->music_download_time,
                    'music_downloads_today' => $item->music_downloads_today,
                    'music_downloads_this_week' => $item->music_downloads_this_week,
                    'music_downloads_max_week' => $item->music_downloads_max_week,
                    'music_search_result' => $item->music_search_result,
                    'solr_updated_time' => time(),
                ];
                $datas[] = $data;
                //$datas[] = $data['id'];
                //$this->Solr->addDocuments($data);
                //$this->Solr->solrDeleteById($data['id']);

//            if (Auth::check() && (Auth::user()->id == 3 || Auth::user()->id == 997917)) {
                if (isset($_GET['m_start'])) {
                    if (strpos($_SERVER['REQUEST_URI'], 'sync/solr_') !== false) {
                        echo ($key) . '/ ' . $item->music_id . "\n <br>";
                    }
                }
            }
            }
        }

        if($datas)
            $this->Solr->addMultiDocuments($datas);
        //$this->Solr->solrMultiDeleteById($datas);

//        if(Auth::check() && (Auth::user()->id == 3 || Auth::user()->id == 997917)) {
        if (isset($_GET['m_start'])) {
            if (strpos($_SERVER['REQUEST_URI'], 'sync/solr_') !== false) {
                if (sizeof($searchMusic) > 0) {
                    die('<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"><html><head><script type="text/javascript">window.location = "?m_start=' . $item->music_id . '"; </script></head><body></body></html>');
                } else {
                    die('Done! Full Data!');
                }
            }
        }

        return response(['Ok']);
    }

    public
    function syncDeleteMusic($id = null, $musicItem = null)
    {
//        <delete><query>_id:12345323211</query></delete>
//        <delete><query>music_id:[1387001 TO 1419000]</query></delete>
//        <delete><query>(id:music_*)AND(_version_:[0 TO 1627700530459443201])</query></delete>

        if ($id) {
            $searchMusic = MusicModel::select('music_id', 'music_composer', 'music_title', 'music_artist', 'music_downloads_this_week', 'music_search_result',
                'cat_id', 'cat_level', 'cat_sublevel', 'cover_id', 'music_artist_id', 'music_album', 'music_listen', 'music_downloads', 'music_filename', 'music_bitrate', 'music_downloads_today', 'music_downloads_max_week', 'music_downloads_this_week', 'music_lyric')
                ->where('cat_id', '!=', CAT_VIDEO)
                ->where('music_id', $id)
                ->get();
        } elseif ($musicItem) {
            if (isset($musicItem[0])) {
                $searchMusic = $musicItem;
            } else {
                $searchMusic[] = $musicItem;
            }
        } else {
            $searchMusic = UploadModel::select('music_id')
                ->where('cat_id', '!=', CAT_VIDEO)
                ->where('music_state', '=', -1)
                ->where('music_id', '>', intval($_GET['m_start']))
//                ->whereIn('music_id', [1603231,1602966,1603110])
                ->offset(0)
                ->limit(5000)
                ->orderBy('music_id', 'asc')
                ->get();

            $searchMusic = MusicModel::select('music_id')
                ->where('cat_id', '!=', CAT_VIDEO)
                ->where('music_deleted', '>', 1)
                ->where('music_id', '>', intval($_GET['m_start']))
//                ->whereIn('music_id', [1603231,1602966,1603110])
                ->offset(0)
                ->limit(5000)
                ->orderBy('music_id', 'asc')
                ->get();
        }
        DB::disconnect('mysql');

        //dd($searchMusic);
        $datas = [];
        foreach ($searchMusic as $key => $item) {
            $data = [
                'id' => 'music_' . $item->music_id,
            ];

            //$datas[] = $data;
            $datas[] = $data['id'];
            //$this->Solr->addDocuments($data);
            //$this->Solr->solrDeleteById($data['id']);
            if (Auth::check() && (Auth::user()->id == 3 || Auth::user()->id == 997917))
                echo ($key) . '/ ' . $item->music_id . "\n <br>";
        }
        //$this->Solr->addMultiDocuments($datas);
        if($datas)
            $this->Solr->solrMultiDeleteById($datas);
        if (Auth::check() && (Auth::user()->id == 3 || Auth::user()->id == 997917)) {
            if (strpos($_SERVER['REQUEST_URI'], 'sync/solr_') !== false) {
                if (sizeof($searchMusic) > 0) {
                    die('<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"><html><head><script type="text/javascript">window.location = "?m_start=' . $item->music_id . '"; </script></head><body></body></html>');
                } else {
                    die('Done! Full Data!');
                }
            }
        }
        return response(['Ok']);
    }

    public
    function syncVideo($id = null, $videoItem = null, $time = null, $field = 'music_last_update_time', $offset = 0, $limit = 0)
    {
        $searchVideo = [];
        if ($id) {
            if ($id < 1387001 or $id > 1419000) {
                $searchVideo = VideoModel::select('music_id', 'music_title_search', 'music_artist_search', 'music_composer', 'music_album_search', 'music_title', 'music_artist', 'music_downloads_this_week', 'music_search_result',
                    'cat_id', 'cat_level', 'cat_sublevel', 'cover_id', 'music_title_url', 'music_artist_id', 'music_album', 'music_listen', 'music_downloads', 'music_filename', 'music_bitrate', 'music_downloads_today', 'music_downloads_max_week', 'music_width', 'music_height', 'music_last_update_time', 'music_length', 'music_time', 'music_download_time')
                    ->where('cat_id', '=', CAT_VIDEO)
                    ->where('music_deleted', '<', 1)
                    ->where('music_id', $id)
                    ->orderBy('music_id', 'asc')
                    ->get();
            }
        } elseif ($videoItem) {
            if (isset($videoItem[0])) {
                $searchVideo = $videoItem;
            } else {
                $searchVideo[] = $videoItem;
            }
        } elseif ($time) {
            $searchVideo = VideoModel::select('music_id', 'music_title_search', 'music_artist_search', 'music_composer', 'music_album_search', 'music_title', 'music_artist', 'music_downloads_this_week', 'music_search_result',
                'cat_id', 'cat_level', 'cat_sublevel', 'cover_id', 'music_title_url', 'music_artist_id', 'music_album', 'music_listen', 'music_downloads', 'music_filename', 'music_bitrate', 'music_downloads_today', 'music_downloads_max_week', 'music_width', 'music_height', 'music_last_update_time', 'music_length', 'music_time', 'music_download_time')
                ->where([['cat_id', '=', CAT_VIDEO], ['music_deleted', '<', 1], ['music_id', '<', 1387001], [$field, '>', $time]])
                ->orwhere([['cat_id', '=', CAT_VIDEO], ['music_deleted', '<', 1], ['music_id', '>', 1419000], [$field, '>', $time]])
                ->orderBy('music_id', 'asc')
                ->get();
        } elseif ( $limit > 0 ) {
            $searchVideo = VideoModel::select('music_id', 'music_title_search', 'music_artist_search', 'music_composer', 'music_album_search', 'music_title', 'music_artist', 'music_downloads_this_week', 'music_search_result',
                'cat_id', 'cat_level', 'cat_sublevel', 'cover_id', 'music_title_url', 'music_artist_id', 'music_album', 'music_listen', 'music_downloads', 'music_filename', 'music_bitrate', 'music_downloads_today', 'music_downloads_max_week', 'music_width', 'music_height', 'music_last_update_time', 'music_length', 'music_time', 'music_download_time')
                ->where([['cat_id', '=', CAT_VIDEO], ['music_deleted', '<', 1], ['music_id', '<', 1387001]])
                ->orwhere([['cat_id', '=', CAT_VIDEO], ['music_deleted', '<', 1], ['music_id', '>', 1419000]])
                ->offset($offset)
                ->limit($limit)
                ->orderBy('music_id', 'asc')
                ->get();
        } else {
            $searchVideo = VideoModel::select('music_id', 'music_title_search', 'music_artist_search', 'music_composer', 'music_album_search', 'music_title', 'music_artist', 'music_downloads_this_week', 'music_search_result',
                'cat_id', 'cat_level', 'cat_sublevel', 'cover_id', 'music_title_url', 'music_artist_id', 'music_album', 'music_listen', 'music_downloads', 'music_filename', 'music_bitrate', 'music_downloads_today', 'music_downloads_max_week', 'music_width', 'music_height', 'music_last_update_time', 'music_length', 'music_time', 'music_download_time')
                ->where([['cat_id', '=', CAT_VIDEO], ['music_deleted', '<', 1], ['music_id', '>', intval($_GET['v_start'])], ['music_id', '<', 1387001]])
                ->orwhere([['cat_id', '=', CAT_VIDEO], ['music_deleted', '<', 1], ['music_id', '>', intval($_GET['v_start'])], ['music_id', '>', 1419000]])
//                ->whereIn('music_id', [1603231,1602966,1603110])
                ->offset(0)
                ->limit(10000)
                ->orderBy('music_id', 'asc')
                ->get();
        }
        DB::disconnect('mysql');
        $datas = [];
        foreach ($searchVideo as $key => $item) {
            if ($item->music_id > 900000) {
                if ($item->music_id < 1387001 or $item->music_id > 1419000) {
                    $titleSearch = Helpers::replaceKeySearch($item->music_title);
                    $artistSearch = Helpers::replaceKeySearch($item->music_artist);
                    $titleCharset = htmlspecialchars(Helpers::strReplaceSolr(Helpers::khongdau($titleSearch, ' ')), ENT_QUOTES);
                    $artistCharset = htmlspecialchars(Helpers::strReplaceSolr(Helpers::khongdau($artistSearch, ' ')), ENT_QUOTES);
                    $composerCharset = Helpers::replaceKeySearch($item->music_composer);
                    $composerCharset = htmlspecialchars(Helpers::strReplaceSolr(Helpers::khongdau($composerCharset, ' ')), ENT_QUOTES);
                    $data = [
                        'id' => 'video_' . $item->music_id,
                        'video_id' => $item->music_id,
                        'video_title' => $item->music_title,
                        'video_title_search' => $titleSearch,
                        'video_artist_search' => $artistSearch,
//                'video_title_artist_search' => $titleSearch .' '. $artistSearch,
                        'video_title_charset_nospace' => str_replace(' ', '', $titleCharset),
                        'video_artist_charset_nospace' => str_replace(' ', '', $artistCharset),
                        'video_title_artist_charset_nospace' => str_replace(' ', '', $titleCharset) . '' . str_replace(' ', '', $artistCharset),
                        'video_title_charset' => $titleCharset,
                        'video_artist_charset' => $artistCharset,
//                'video_title_artist_charset' => $titleCharset .' '. $artistCharset,
                        'video_bitrate_html' => Helpers::size2str($item->music_width, $item->music_height),//, false, true),
                        'video_width' => $item->music_width,
                        'video_height' => $item->music_height,
                        'video_cover' => Helpers::thumbnail_url($item->toArray()),
                        'preview_url' => Helpers::thumbnail_url($item->toArray(), 'preview'),
                        'video_link' => Helpers::listen_url($item->toArray(), false),
                        'video_filename' => $item->music_filename,
                        'video_artist' => $item->music_artist, //str_replace(';', ',', $item->music_artist),
                        'video_artist_id' => explode(';', htmlspecialchars_decode($item->music_artist_id, ENT_QUOTES)),//$item->music_artist_id, //str_replace(';', ',', $item->music_artist_id),
                        'video_artist_html' => Helpers::rawHtmlArtists($item->music_artist_id, $item->music_artist),
                        'video_listen' => $item->music_listen,
                        'video_title_url' => $item->music_title_url,
                        'video_cat_id' => $item->cat_id,
                        'video_cat_level' => $item->cat_level,
                        'cat_id' => $item->cat_id,
                        'cat_level' => $item->cat_level,
                        'video_composer_charset' => $composerCharset,
                        'video_composer_charset_nospace' => str_replace(' ', '', $composerCharset),
                        'video_composer' => $item->music_composer,
                        'video_cover_id' => $item->cover_id,
                        'cover_id' => $item->cover_id,
                        'video_bitrate' => $item->music_bitrate,
                        'video_length' => $item->music_length,
                        'video_download_time' => $item->music_download_time,
                        'video_length_html' => $item->music_length >= 3600 ? gmdate("H:i:s", $item->music_length) : gmdate("i:s", $item->music_length),
                        'video_downloads' => $item->music_downloads,
                        'video_downloads_today' => $item->music_downloads_today,
                        'video_downloads_this_week' => $item->music_downloads_this_week,
                        'video_downloads_max_week' => $item->music_downloads_max_week,
                        'video_search_result' => $item->music_search_result,
                        'solr_updated_time' => time(),
                    ];
                    $datas[] = $data;
//            $this->Solr->addDocuments($data);

                    if (Auth::check() && (Auth::user()->id == 3 || Auth::user()->id == 997917)) {
                        if (strpos($_SERVER['REQUEST_URI'], 'sync/solr_') !== false) {
                            echo ($key) . '/ ' . $item->music_id . "\n <br>";
                        }
                    }
                }
            }
        }
        if($datas)
            $this->Solr->addMultiDocuments($datas);

        if (Auth::check() && (Auth::user()->id == 3 || Auth::user()->id == 997917)) {
            if (strpos($_SERVER['REQUEST_URI'], 'sync/solr_') !== false) {
                if (sizeof($searchVideo) > 0) {
                    die('<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"><html><head><script type="text/javascript">window.location = "?v_start=' . $item->music_id . '"; </script></head><body></body></html>');
                } else {
                    die('Done! Full Data!');
                }
            }
        }

        return response(['Ok']);
    }

    public
    function syncDeleteVideo($id = null, $videoItem = null)
    {
        if ($id) {
            $searchVideo = VideoModel::select('music_id')
                ->where('cat_id', '=', CAT_VIDEO)
                ->where('music_id', $id)
                ->get();
        } elseif ($videoItem) {
            if (isset($videoItem[0])) {
                $searchVideo = $videoItem;
            } else {
                $searchVideo[] = $videoItem;
            }
        } else {
            $searchVideo = UploadModel::select('music_id')
                ->where('cat_id', '=', CAT_VIDEO)
                ->where('music_state', '=', -1)
                ->where('music_id', '>', intval($_GET['v_start']))
//                ->whereIn('music_id', [1603231,1602966,1603110])
                ->offset(0)
                ->limit(5000)
                ->orderBy('music_id', 'asc')
                ->get();

            $searchVideo = VideoModel::select('music_id')
                ->where('cat_id', '=', CAT_VIDEO)
                ->where('music_deleted', '>', 1)
                ->where('music_id', '>', intval($_GET['v_start']))
//                ->whereIn('music_id', [1603231,1602966,1603110])
                ->offset(0)
                ->limit(5000)
                ->orderBy('music_id', 'asc')
                ->get();
        }
        DB::disconnect('mysql');

        //dd($searchMusic);
        $datas = [];
        foreach ($searchVideo as $key => $item) {
            $data = [
                'id' => 'video_' . $item->music_id,
            ];

            //$datas[] = $data;
            $datas[] = $data['id'];
            //$this->Solr->addDocuments($data);
            //$this->Solr->solrDeleteById($data['id']);
            if (Auth::check() && (Auth::user()->id == 3 || Auth::user()->id == 997917)) {
                if (strpos($_SERVER['REQUEST_URI'], 'sync/solr_') !== false) {
                    echo ($key) . '/ ' . $item->music_id . "\n <br>";
                }
            }
        }
        //$this->Solr->addMultiDocuments($datas);
        if($datas)
            $this->Solr->solrMultiDeleteById($datas);
        if (Auth::check() && (Auth::user()->id == 3 || Auth::user()->id == 997917)) {
            if (strpos($_SERVER['REQUEST_URI'], 'sync/solr_') !== false) {
                if (sizeof($searchVideo) > 0) {
                    die('<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"><html><head><script type="text/javascript">window.location = "?v_start=' . $item->music_id . '"; </script></head><body></body></html>');
                } else {
                    die('Done! Full Data!');
                }
            }
        }
        return response(['Ok']);
    }

    public
    function syncArtist($id = null, $artistItem = null, $time = null)
    {
        if ($id) {
            $artist = ArtistModel::where('artist_id', $id)->get();
        } elseif ($artistItem) {
            if (isset($artistItem[0])) {
                $artist = $artistItem;
            } else {
                $artist[] = $artistItem;
            }
        } elseif ($time) {
            $artist = ArtistModel::where('music_last_update_time', '>', $time)->get();
        } else {
            $artist = ArtistModel::where('music_total', '>', 0)->orwhere('artist_avatar', '!=', '')->where('artist_cover', '!=', '')->offset(0)->limit(130000)->get();
        }
        DB::disconnect('mysql');
        $datas = [];
        foreach ($artist as $key => $item) {
            $artist_nickname_charset = Helpers::strReplaceSolr(Helpers::khongdau(mb_strtolower($item->artist_nickname, 'UTF-8'), ' '), true);
            $data = [
                'id' => 'artist_' . $item->artist_id,
                'artist_id' => $item->artist_id,
                'artist_nickname' => $item->artist_nickname,
                'artist_nickname_search' => Helpers::replaceKeySearch($item->artist_nickname),
                'artist_nickname_charset' => Helpers::replaceKeySearch($artist_nickname_charset),
                'artist_nickname_charset_nospace' => Helpers::replaceKeySearch(str_replace(' ', '', $artist_nickname_charset)),
                'music_total' => $item->music_total,
                'artist_link' => Helpers::artistUrl($item->artist_id, $item->artist_nickname),
                'artist_cover' => $item->artist_cover ? Helpers::file_path($item->artist_id, PUBLIC_COVER_ARTIST_PATH, true) . $item->artist_cover : '/imgs/no_cover_artist.jpg',
                'artist_avatar' => $item->artist_avatar ? Helpers::file_path($item->artist_id, PUBLIC_AVATAR_ARTIST_PATH, true) . $item->artist_avatar : '/imgs/no_cover.jpg',
                'solr_updated_time' => time(),
            ];
            $datas[] = $data;
//            $this->Solr->addDocuments($data);

            if (Auth::check() && (Auth::user()->id == 3 || Auth::user()->id == 997917)) {
                if (strpos($_SERVER['REQUEST_URI'], 'sync/solr_') !== false) {
                    echo ($key) . '/ ' . $item->artist_id . "\n <br>";
                }
            }
        }
        if($datas)
            $this->Solr->addMultiDocuments($datas);

        return response(['Ok']);
    }

    public
    function syncCover($id = null, $coverItem = null, $time = null)
    {
        if ($id) {
            $cover = CoverModel::where('cover_id', $id)->orderBy('cover_id', 'asc')->get();
        } elseif ($coverItem) {
            if (isset($coverItem[0])) {
                $cover = $coverItem;
            } else {
                $cover[] = $coverItem;
            }
        } elseif ($time) {
            $cover = CoverModel::where('album_music_total', '>', 0)
                ->where('album_last_updated', '>', $time)->orderBy('cover_id', 'asc')->get();
        } else {
            $cover = CoverModel::where('album_music_total', '>', 0)
                ->where('cover_id', '>', intval($_GET['c_start']))
                ->orderBy('cover_id', 'asc')->offset(0)->limit(5000)->get();
        }
        DB::disconnect('mysql');
        $datas = [];
        foreach ($cover as $key => $item) {
            $music_artist = $item->album_artist_1;
            $music_artist_id = $item->album_artist_id_1;
            if ($item->album_artist_2) {
                $music_artist = $music_artist . '; ' . $item->album_artist_2;
                $music_artist_id = $music_artist_id . ';' . $item->album_artist_id_2;
            }
            $album_cat = $item->album_cat_id_1;
            if ($album_cat) {
                $album_cat .= '_' . $item->album_cat_level_1;
                if ($item->album_cat_id_2)
                    $album_cat .= ';' . $item->album_cat_id_2 . '_' . $item->album_cat_level_1;
            }
            $titleSearch = Helpers::replaceKeySearch($item->music_album);
            $titleCharset = Helpers::strReplaceSolr(Helpers::khongdau($titleSearch, ' '));
            $artistSearch = Helpers::replaceKeySearch($music_artist);
            $artistCharset = Helpers::strReplaceSolr(Helpers::khongdau($artistSearch, ' '));

            $data = [
                'id' => 'cover_' . $item->cover_id,
                'cover_id' => $item->cover_id,
                'music_album' => $item->music_album,
                'music_album_search' => $titleSearch,
                'music_album_artist_search' => $titleSearch . ' ' . $artistSearch,
                'music_album_charset' => $titleCharset,
                'music_album_artist_charset' => $titleCharset . ' ' . $artistCharset,
                'music_album_charset_nospace' => Helpers::replaceKeySearch(str_replace(' ', '', $titleCharset)),
                'music_album_artist_charset_nospace' => str_replace(' ', '', $titleCharset) . '' . str_replace(' ', '', $artistCharset),
                'album_cover' => Helpers::cover_url($item->cover_id),
                'cover_filename' => $item->cover_filename,
                'album_cat' => !empty($album_cat) ? $album_cat : '',
                'album_link' => Helpers::album_url($item->toArray()),
                'album_bitrate' => $item->music_bitrate,
                'music_artist_html' => '',
                'album_bitrate_html' => $item->music_bitrate ? Helpers::bitrate2str($item->music_bitrate) : '',
                'album_user_id' => $item->user_id,
                'album_music_total' => $item->album_music_total,
                'album_music_artist' => '',
                'album_music_artist_id' => '',
                'album_music_artist_search' => '',
                'album_music_artist_charset' => '',
                'album_music_artist_nospace' => '',
                'album_music_artist_html' => '',
                'album_music_year' => $item->music_year,
                'album_search_result' => 0,
                'solr_updated_time' => time(),
            ];
            if ($music_artist) {
//                $artistSearch = Helpers::replaceKeySearch($music_artist);
//                $artistCharset = Helpers::rawTiengVietUrl($music_artist, ' ');

                $data['album_music_artist'] = $music_artist;
                $data['album_music_artist_id'] = explode(';', htmlspecialchars_decode($music_artist_id, ENT_QUOTES));
                $data['album_music_artist_search'] = $artistSearch;
                $data['album_music_artist_charset'] = $artistCharset;
                $data['album_music_artist_nospace'] = str_replace(' ', '', $artistCharset);
                $data['album_music_artist_html'] = Helpers::rawHtmlArtists($music_artist_id, $music_artist);

            }
            $datas[] = $data;
//            $this->Solr->addDocuments($data);
            if (Auth::check() && (Auth::user()->id == 3 || Auth::user()->id == 997917)) {
                if (strpos($_SERVER['REQUEST_URI'], 'sync/solr_') !== false) {
                    echo ($key) . '/ ' . $item->cover_id . "\n <br>";
                }
            }
        }
        if($datas)
            $this->Solr->addMultiDocuments($datas);

        if (Auth::check() && (Auth::user()->id == 3 || Auth::user()->id == 997917)) {
            if (strpos($_SERVER['REQUEST_URI'], 'sync/solr_') !== false) {
                if (sizeof($cover) > 0) {
                    die('<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"><html><head><script type="text/javascript">window.location = "?c_start=' . $item->cover_id . '"; </script></head><body></body></html>');
                } else {
                    die('Done! Full Data!');
                }
            }
        }
        $this->Solr->addMultiDocuments($datas);

        return response(['Ok']);
    }

    public
    function deleteCustom($id)
    {
        $this->Solr->solrDeleteById($id);
    }
}