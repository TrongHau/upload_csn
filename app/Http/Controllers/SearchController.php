<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 8/17/2018
 * Time: 3:38 PM
 */
namespace App\Http\Controllers;
use Illuminate\Http\Request as Request;
use Illuminate\Support\Facades\Auth;
use App\Library\Helpers;
use App\Solr\Solarium;

class SearchController extends Controller
{
    protected $Solr;

    public function __construct(Solarium $Solr) {
        $this->Solr = $Solr;
    }
    public function index(Request $request) {
        $request->q = mb_substr($request->q,0,50, "utf-8");
        if(!$request->q)
            return redirect()->route('home');
        $search = mb_strtolower($request->q, 'UTF-8');
        $request->view_music = true;
        $request->view_album = true;
        $request->view_video = true;
        $request->view_artist= true;
        $request->playback = true;
        $result = $this->ajaxSearch($request, false);
        $titleSearch = $search.' | ';
        $result = $result[0];
        if(!$search)
            return redirect('/');
        $search = htmlspecialchars($search, ENT_QUOTES);
        return view('search.index', compact('result', 'titleSearch', 'search', 'result'));
    }
    public function ajaxSearch(Request $request, $quickSearch = true) {
//        abort(403, 'Đang bảo trì hệ thống tìm kiếm, vui lòng quay lại sau ít phút.');
        $request->q = mb_substr($request->q,0,50, "utf-8");
        $search = Helpers::strReplaceSolr(htmlspecialchars($request->q, ENT_QUOTES), true);
//        $search = trim(mb_strtolower($request->q, 'UTF-8'));
        $searchExp = explode(' ', $search);
        foreach ($searchExp as $key => $item) {
            if(mb_detect_encoding($item) != 'UTF-8')
                unset($searchExp[$key]);
        }
        $searchNotUtf8 = implode('+', $searchExp);
        $result[0] = [
            'q' =>  $request->q,
            'music' => [
                'data' => [], 'rows' => 10, 'page' => 1, 'row_total' => 0,
            ],
            'top_music' => [
                'data' => [], 'rows' => 10, 'page' => 1, 'row_total' => 0,
            ],
            'music_playback' => [
                'data' => [], 'rows' => 10, 'page' => 1, 'row_total' => 0,
            ],
            'video' => [
                'data' => [], 'rows' => 10, 'page' => 1, 'row_total' => 0,
            ],
            'artist' => [
                'data' => [], 'rows' => 10, 'page' => 1, 'row_total' => 0,
            ],
            'album' => [
                'data' => [], 'rows' => 10, 'page' => 1, 'row_total' => 0,
            ],
        ];
        if($search) {
            $rawTiengViet = htmlspecialchars(Helpers::khongdau($search, ' '), ENT_QUOTES);
            $charsetNoSpace = str_replace(' ', '', $rawTiengViet);
            $titleCharset = str_replace(' ', '+', $rawTiengViet);
            $titleSearch = str_replace(' ', '+', htmlspecialchars($search, ENT_QUOTES));//Helpers::replaceKeySearch($searchNotUtf8);
            // search key
            if(isset($request->view_all) || isset($request->view_music)) {
                $searchSolarium = [];
                //$searchSolarium['music_title_charset_nospace'] = $charsetNoSpace .'^1000';
//                if ($quickSearch) {
                    $searchSolarium['music_title_charset_nospace'] = $charsetNoSpace . '^500';
                    $searchSolarium['music_title_artist_charset_nospace'] = $charsetNoSpace . '^100 | music_title_artist_charset_nospace:' . $charsetNoSpace . '*^50';
//                }
    //            $searchSolarium['music_title_artist_charset'] = $titleCharset;
//                if(isset($request->playback) || 1 == 1) {
//                    foreach ($searchSolarium as $key => $item) {
//                        $searchSolarium[$key] = $item . ' AND music_cat_id: ' . CAT_BEAT;
//                    }
//                }
                if($titleSearch) {
                    //$searchSolarium['music_title_artist_search'] = $titleSearch;
                    $searchSolarium['music_title_charset'] = $titleCharset . '^1000' . (isset($request->playback) ? ' AND -music_cat_id: '.CAT_BEAT : '');
                    $searchSolarium['music_artist_charset'] = $titleCharset . '^200 | music_artist_charset:' . $charsetNoSpace . '*^100';

                    if ($titleSearch != $titleCharset) {
                        $searchSolarium['music_title_search'] = $titleSearch . '^2000' . (isset($request->playback) ? ' AND -music_cat_id: '.CAT_BEAT : '');
                        $searchSolarium['music_artist_search'] = $titleSearch . '^400 | music_artist_charset:' . $charsetNoSpace . '*^200';
                    }
                }
                $search_level_playback = 1;
                $search_top_music = 1;
                $keyResult = 'top_music';
                $search_level = 1;
                search_music_2:
                if ($search_level == 2)
                {
                    $searchSolarium['music_artist_charset'] = '';
                    if ($titleSearch != $titleCharset) {
                        $searchSolarium['music_artist_search'] = '';
                    }
                }
                // filter
                if($request->filter == 'sang-tac' && !isset($searchSolarium['music_composer_charset'])) {
                    $searchSolarium['music_composer_charset'] = $searchSolarium['music_title_charset_nospace'];
                    $searchSolarium['music_composer_charset_nospace'] = str_replace('music_title_artist_charset_nospace:', 'music_composer_charset_nospace:', $searchSolarium['music_title_artist_charset_nospace']);
                    unset($searchSolarium['music_title_charset_nospace']);
                    unset($searchSolarium['music_title_artist_charset_nospace']);
                    unset($searchSolarium['music_title_charset']);
                    unset($searchSolarium['music_artist_charset']);
                    unset($searchSolarium['music_title_search']);
                    unset($searchSolarium['music_artist_search']);
                }
                if($request->filter == 'ten-bai-hat') {
                    unset($searchSolarium['music_title_artist_charset_nospace']);
                    unset($searchSolarium['music_artist_charset']);
                    unset($searchSolarium['music_artist_search']);
                }
                if($request->filter == 'ca-si') {
                    unset($searchSolarium['music_title_charset_nospace']);
                    unset($searchSolarium['music_title_artist_charset_nospace']);
                    unset($searchSolarium['music_title_charset']);
                    unset($searchSolarium['music_title_search']);
                }

                // click từ đường dẫn ca sĩ
                if($request->mode == 'ca-si') {
                    $searchSolarium = [];
                    $searchSolarium['music_artist_charset_nospace'] = $charsetNoSpace;
                }
                if($search_level_playback == 2) {
                    $keyResult = 'music_playback';
                    $resultMusic = $this->Solr->search($searchSolarium, ($request->page_playback ?? 1), $request->rows ?? ROWS_MUSIC_SEARCH_PAGING, array('score' => 'desc', 'music_downloads' => 'desc', 'music_listen' => 'desc'));
                }elseif(isset($request->top_music) && $search_top_music == 1) {
                    $keyResult = 'top_music';
                    $searchSolarium['-id'] = '0 AND music_search_result:['.LIMIT_SEARCH_TOP_RESULT.' TO 999999]';
                    $resultMusic = $this->Solr->search($searchSolarium, ($request->page_music ?? 1), 2, array('score' => 'desc', 'music_search_result' => 'desc', 'music_listen' => 'desc'));
                    if($resultMusic['data']){
                        foreach ($resultMusic['data'] as $key => $item) {
                            if(strpos($item['music_title_artist_charset_nospace'][0], $charsetNoSpace) === false) {
                                unset($resultMusic['data'][$key]);
                            }
                        }
                    }
                    unset($searchSolarium['-id']);
                }else{
                    $keyResult = 'music';
                    $resultMusic = $this->Solr->search($searchSolarium, ($request->page_music ?? 1), $request->rows ?? ROWS_MUSIC_SEARCH_PAGING, array('score' => 'desc', 'music_downloads' => 'desc', 'music_listen' => 'desc'));
                }
                if($resultMusic['data']) {
                    foreach ($resultMusic['data'] as $item) {
                        $result[0][$keyResult]['data'][] = [
                            'music_id' => $item['music_id'][0],
                            'music_title' => htmlspecialchars_decode($item['music_title'][0], ENT_QUOTES),// . ' | ' . $titleCharset . $item['score'] . ' { ' . $item['music_downloads_this_week'][0] . ' }' . $search_level,
                            'music_artist' => htmlspecialchars_decode($item['music_artist'][0], ENT_QUOTES),
                            'music_bitrate' => $item['music_bitrate'][0],
                            'music_bitrate_html' => $item['music_bitrate_html'][0],
                            'music_link' => $item['music_link'][0],
                            'cat_id' => $item['cat_id'][0],
                            'music_listen' => $item['music_listen'][0],
                            'music_filename' => '', //$item['music_file_name'][0]
                            'music_cover' => $item['music_cover'][0],
                            'music_title_url' => $item['music_title_url'][0],
                            'music_downloads' => $item['music_downloads'][0],
                        ];

                        if ($search_level == 1)
                        {
                            if ($item['music_title_charset_nospace'][0] == $charsetNoSpace)
                            {
                                $search_level = 2;
                                $result[0][$keyResult]['data'] = [];
                                goto search_music_2;
                            }
                        }
                    }
                }
                $result[0][$keyResult]['rows'] = $resultMusic['rows'];
                $result[0][$keyResult]['page'] = $resultMusic['page'];
                $result[0][$keyResult]['row_total'] = $resultMusic['row_total'];
                if(isset($request->playback) && $search_level_playback == 1) {
                    $search_level_playback = 2;
                    foreach ($searchSolarium as $key => $item) {
                        $searchSolarium[$key] = str_replace('-music_cat_id', 'music_cat_id', $item);
                    }
                    goto search_music_2;
                }
                if(isset($request->top_music) && $search_top_music == 1) {
                    $search_top_music = 2;
                    $arrIds = [];
                    if($result[0]['top_music']['data']) {
                        foreach ($result[0]['top_music']['data'] as $item) {
                            $arrIds[] = '-id:music_' . $item['music_id'];
                        }
                        $searchSolarium['-id'] = '0' .' AND '. implode($arrIds, ' AND ');
                    }
                    goto search_music_2;
                }
            }
            if(isset($request->view_all) || isset($request->view_artist)) {
                $searchSolarium = [];
                if($quickSearch)
                    $searchSolarium['artist_nickname_charset_nospace'] =  $charsetNoSpace . '^100 | artist_nickname_charset_nospace:'.$charsetNoSpace.'*^50';
                $searchSolarium['artist_nickname_charset'] = $titleCharset;
                if($titleSearch != $titleCharset) {
                    $searchSolarium['artist_nickname_search'] = $titleSearch;
                }
                $resultArtist = $this->Solr->search($searchSolarium, ($request->page_artist ?? 1), $request->rows ?? ROWS_ARTIST_SEARCH_PAGING, array('score' => 'desc', 'music_total' => 'desc'));
                if($resultArtist['data']) {
                    foreach ($resultArtist['data'] as $item) {
                        $result[0]['artist']['data'][] = [
                            'artist_id' => $item['artist_id'][0],
                            'artist_nickname' => htmlspecialchars_decode($item['artist_nickname'][0], ENT_QUOTES),
                            'artist_link' =>  $item['artist_link'][0],
                            'artist_cover' => $item['artist_cover'][0],
                            'artist_avatar' => $item['artist_avatar'][0],
                        ];
                    }
                }
                $result[0]['artist']['rows'] = $resultArtist['rows'];
                $result[0]['artist']['page'] = $resultArtist['page'];
                $result[0]['artist']['row_total'] = $resultArtist['row_total'];
            }
            if(isset($request->view_all) || isset($request->view_album)) {
                $searchSolarium = [];
                if($quickSearch)
                    $searchSolarium['music_album_charset_nospace'] =  $charsetNoSpace . '^100 | music_album_charset_nospace:'.$charsetNoSpace.'*^50';
                $searchSolarium['music_album_charset'] = $titleCharset;
                if($titleSearch !== $titleCharset)
                    $searchSolarium['music_album_search'] = $titleSearch;
                if(isset($request->only_user)){
                    $searchSolarium['music_album_charset'] = $searchSolarium['music_album_charset'] .' AND album_user_id: ' . Auth::user()->user_id;
                }
                // click từ đường dẫn ca sĩ
                if($request->mode == 'ca-si') {
                    $searchSolarium = [];
                    $searchSolarium['music_album_charset_nospace'] = $charsetNoSpace;
                }
                $resultAlbum = $this->Solr->search($searchSolarium, ($request->page_album ?? 1), $request->rows ?? ROWS_ALBUM_SEARCH_PAGING, array('score' => 'desc'));
                if($resultAlbum['data']) {
                    foreach ($resultAlbum['data'] as $item) {
                        $result[0]['album']['data'][] = [
                            'cover_id' => $item['cover_id'][0],
                            'music_album' => htmlspecialchars_decode($item['music_album'][0], ENT_QUOTES),
                            'album_link' => $item['album_link'][0],
                            'album_id' => $request->view_album ? $item['id'] : '',
                            'album_bitrate' => $item['music_bitrate'][0],
                            'album_artist' => isset($item['album_music_artist']) ? $item['album_music_artist'][0] : '',
                            'album_artist_html' => isset($item['album_music_artist_html']) ? $item['album_music_artist_html'][0] : '',
                            'album_cover' => isset($item['album_cover']) ? $item['album_cover'][0] : '',
                        ];
                    }
                }
                $result[0]['album']['rows'] = $resultAlbum['rows'];
                $result[0]['album']['page'] = $resultAlbum['page'];
                $result[0]['album']['row_total'] = $resultAlbum['row_total'];
            }
            if(isset($request->view_all) || isset($request->view_video)) {
                $searchSolarium = [];
//                if($quickSearch) {
                    $searchSolarium['video_title_charset_nospace'] = $charsetNoSpace . '^500';
                    $searchSolarium['video_title_artist_charset_nospace'] = $charsetNoSpace . '^100 | video_title_artist_charset_nospace:' . $charsetNoSpace . '*^50';
//                }
                if($titleSearch) {
                    $searchSolarium['video_title_charset'] = $titleCharset . '^2';
                    $searchSolarium['video_artist_charset'] = $titleCharset;

                    if ($titleSearch != $titleCharset) {
                        $searchSolarium['video_title_search'] = $titleSearch . '^2';
                        $searchSolarium['video_artist_search'] = $titleSearch;
                    }
                }

                $search_level = 1;

                search_video_2:
                if ($search_level == 2)
                {
                    $searchSolarium['video_artist_charset'] = '';
                    if ($titleSearch != $titleCharset) {
                        $searchSolarium['video_artist_search'] = '';
                    }
                }
                // click từ đường dẫn ca sĩ
                if($request->mode == 'ca-si') {
                    $searchSolarium = [];
                    $searchSolarium['video_artist_charset_nospace'] = $charsetNoSpace;
                }
                // filter
                if($request->filter == 'sang-tac' && !isset($searchSolarium['video_composer_charset'])) {
                    $searchSolarium['video_composer_charset'] = $searchSolarium['video_title_charset_nospace'];
                    $searchSolarium['video_composer_charset_nospace'] = str_replace('video_title_artist_charset_nospace:', 'video_composer_charset_nospace:', $searchSolarium['video_title_artist_charset_nospace']);
                    unset($searchSolarium['video_title_charset_nospace']);
                    unset($searchSolarium['video_title_artist_charset_nospace']);
                    unset($searchSolarium['video_title_charset']);
                    unset($searchSolarium['video_artist_charset']);
                    unset($searchSolarium['video_title_search']);
                    unset($searchSolarium['video_artist_search']);
                }
                if($request->filter == 'ten-bai-hat') {
                    unset($searchSolarium['video_title_artist_charset_nospace']);
                    unset($searchSolarium['video_artist_charset']);
                    unset($searchSolarium['video_artist_search']);
                }
                if($request->filter == 'ca-si') {
                    unset($searchSolarium['video_title_charset_nospace']);
                    unset($searchSolarium['video_title_artist_charset_nospace']);
                    unset($searchSolarium['video_title_charset']);
                    unset($searchSolarium['video_title_search']);
                }

                $resultVideo = $this->Solr->search($searchSolarium, ($request->page_video ?? 1), $request->rows ?? ROWS_VIDEO_SEARCH_PAGING, array('score' => 'desc', 'video_downloads' => 'desc', 'video_listen' => 'desc'));
                if($resultVideo['data']) {
                    foreach ($resultVideo['data'] as $item) {
                        $result[0]['video']['data'][] = [
                            'video_id' => $item['video_id'][0],
                            'video_title' => htmlspecialchars_decode($item['video_title'][0], ENT_QUOTES),
                            'video_artist' => htmlspecialchars_decode($item['video_artist'][0], ENT_QUOTES),
                            'video_bitrate' => $item['video_bitrate'][0],
                            'video_bitrate_html' => $item['video_bitrate_html'][0],
                            'video_link' => $item['video_link'][0],
                            'video_cover' => isset($item['video_cover']) ? $item['video_cover'][0] : '',
                            'video_listen' => $item['video_listen_total'][0],
                            'video_length' => $item['video_length'][0],
                            'video_length_html' => $item['video_length_html'][0],
                            'video_downloads' => $item['video_downloads'][0],
                            'video_title_url' => $item['video_title_url'][0],
                        ];

                        if ($search_level == 1)
                        {
                            if ($item['video_title_charset_nospace'][0] == $charsetNoSpace)
                            {
                                $search_level = 2;
                                $result[0]['video']['data'] = [];
                                goto search_video_2;
                            }
                        }
                    }
                }
                $result[0]['video']['rows'] = $resultVideo['rows'];
                $result[0]['video']['page'] = $resultVideo['page'];
                $result[0]['video']['row_total'] = $resultVideo['row_total'];
            }
        }
        return ($request->type == 'json' ? response((array)$result) : $result);
    }

}