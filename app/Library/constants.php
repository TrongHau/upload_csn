<?php

define('MUSIC_DATA_PATH', 'data/128/');
define('SUB_ALLBUM', '/nghe-album/');
define('SUB_PLAYLIST', '/playlist/');
define('SUB_PLAYLIST_PUBLISHER', '/playlist_publisher/');
define('SUB_BXH_MUSIC', '/nhac-hot/');
define('SUB_BXH_NOW_MUSIC', '/nhac-hot/');
define('SUB_VIDEO', '/v-video/');
define('KBPS', 'kbps');
define('LOSSLESS', 'Lossless');
define('UPDATE_CASE_SUGGESTION_MUSIC', true); //604800); // 1 will week
define('TIMESPAN_TWO_DAY', 172800); // 2 day
define('UPDATE_CASE_SUGGESTION_MUSIC_ONCE', false); // only 1 render cache suggest
define('CATEGORY_ID_VIDEO', 1);
define('LIMIT_HISTORY_MUSIC', 20);
define('LIMIT_HOME_ALBUM_OLD', 10);
define('LIMIT_HOME_ALBUM_OLD_MOBILE', 3);
define('LIMIT_HOME_ALBUM_NEW', 20);
define('LIMIT_HOME_ALBUM_NEW_MOBILE', 10);
define('LIMIT_HOME_ALBUM_NEW_BOTTOM', 10);
define('LIMIT_HOME_MUSIC_NEW', 10);
define('LIMIT_HOME_VIDEO_NEW', 8);
define('LIMIT_HOME_VIDEO_NEW_MOBILE', 4);
define('LIMIT_SUG_MUSIC', 10);
define('LIMIT_HOME_CAT_MUSIC', 10);
define('LIMIT_HOME_UPLOADER_MUSIC', 10);
define('LIMIT_HOME_ARTIST', 15);
define('LIMIT_SEARCH_RESULT', 20);
define('DEFAULT_ROOT_TEMP_MUSIC_PATH', '/storage/data/temp/');
define('DEFAULT_STORAGE_TEMP_MUSIC_PATH', '/data/temp/');
define('DEFAULT_ROOT_CACHE_MUSIC_PATH', '/storage/data/cache_upload/');
define('DEFAULT_STORAGE_CACHE_MUSIC_PATH', '/data/cache_upload/');
define('LYRIC_DETAIL_NEW_MUSIC', 5);
define('LYRIC_DETAIL_NEW_ALBUM', 5);
define('LIMIT_COMMENT', 10);
define('LIMIT_PAGE_MUSIC_UPLOADED', 10);
define('LIMIT_PAGE_ARTIST_FAVOURITE', 10);
define('LIMIT_PAGE_MUSIC_FAVOURITE', 10);
define('LIMIT_LISTEN_MUSIC_FAVOURITE', 100);
define('LITMIT_TITLE_PLAYLIST', 2);
define('TIME_EXPIRY_ADD_LISTEN_MUSIC', '+1 hour');
define('KEY_ID_PLAYLIST_ENCODE_URL', 'csn_playlist~');
define('KEY_ID_ALBUM_ENCODE_URL', 'csn_album~');
define('KEY_ID_ARTIST_ENCODE_URL', 'csn_artist~');
define('DEFAULT_CAT_ID_ACTIVE_BXH', 3);
define('DEFAULT_TIME_QUERY_BXH', 60); // những bài bát có 90 ngày trong bảng xếp hạng ngày
define('UPLOAD_STAGE_DELETED', -1); // đã xóa
define('UPLOAD_STAGE_UNCENSOR', 0); // chưa duyệt. mới upload, chờ xử lý
define('UPLOAD_STAGE_INCONVERT', 1); // đang xử lý
define('UPLOAD_STAGE_FULLCONVERT', 2); // chờ duyệt
define('UPLOAD_STAGE_FULLCENSOR', 3); ///Đã duyệt
define('MIN_DOWNLOAD_SUG_TITLE_SAME', 300);
define('LIMIT_PAGE_CATEGORY', 20);
define('LIMIT_MUSIC_PAGE_ARTIST', 20);
define('LIMIT_LISTEN_MUSIC_ARTIST', 100);
define('LIMIT_LISTEN_MUSIC_ARTIST_MOBILE', 30);
define('LIMIT_MUSIC_PAGE_CATEGORY', 20);
define('CURRENT_YEAR', 2019);
define('CURRENT_MONTH', 10);
define('MAX_LOSTLESS', 1000);

// MUSIC ID ENCRIPT
define('MAX_ID_CONST', 71902891);

// ARTIST
define('AVATAR_ARTIST_SOURCE_PATH', '/data/source_artist_avatar/');
define('COVER_ARTIST_SOURCE_PATH', '/data/source_artist_cover/');
define('AVATAR_ARTIST_CROP_PATH', '/data/artist_avatar/');
define('COVER_ARTIST_CROP_PATH', '/data/artist_cover/');
define('CACHE_AVATAR_ARTIST_CROP_PATH', '/data/cache_artist/artist_avatar/');
define('CACHE_COVER_ARTIST_CROP_PATH', '/data/cache_artist/artist_cover/');
define('PUBLIC_CACHE_AVATAR_ARTIST_PATH', '/storage/data/cache_artist/artist_avatar/');
define('PUBLIC_CACHE_COVER_ARTIST_PATH', '/storage/data/cache_artist/artist_cover/');

// ALBUM
define('AVATAR_ALBUM_CROP_PATH', '/data/album_cover/');
define('COVER_ALBUM_SOURCE_PATH', '/data/source_album_cover/');
define('PUBLIC_COVER_ALBUM_CROP_PATH', '/storage/data/album_cover/');


define('PUBLIC_AVATAR_ARTIST_SOURCE_PATH', '/storage/data/source_artist_avatar/');
define('PUBLIC_COVER_ARTIST_SOURCE_PATH', '/storage/data/source_artist_cover/');
define('PUBLIC_AVATAR_ARTIST_PATH', '/storage/data/artist_avatar/');
define('PUBLIC_COVER_ARTIST_PATH', '/storage/data/artist_cover/');

// MUSIC
define('MUSIC_PATH', '/storage/data/source_music/');
define('MUSIC_STORAGE_PATH', '/data/source_music/');
// VIDEO
define('VIDEO_PATH', '/storage/data/source_video/');
define('VIDEO_STORAGE_PATH', '/data/source_video/');

define('SOURCE_STORAGE_PATH', '/data/source/');
define('PUBLIC_SOURCE_STORAGE_PATH', '/storage/data/source/');

// URL PARAMETERS
define('CAT_VIDEO', 1);
define('CAT_BEAT', 2);
define('CAT_VIDEO_URL', 'video');
define('VIEW_VIDEO_URL', 'hd');
define('VIEW_MUSIC_URL', 'mp3');
// Video thumbnail
define('MUSIC_THUMBNAIL_PATH', 'data/thumb/');
// Cover
define('MUSIC_COVER_PATH', 'data/cover/');
define('MUSIC_COVER_SOURCE_PATH', 'data/source_cover/');
// Artist
define('MUSIC_ARTIST_PATH', 'data/artist/');
define('MUSIC_ARTIST_SOURCE_PATH', 'data/source_artist/');
// Face (Artist)
define('MUSIC_FACE_PATH', 'data/face/');
define('MUSIC_FACE_SOURCE_PATH', 'data/source_face/');
// Spectrum
define('MUSIC_SPECTRUM_PATH', 'data/spectrum/');
// Playlist
define('MUSIC_PLAYLIST_PATH', 'data/playlist/');
define('PUBLIC_MUSIC_PLAYLIST_PATH', '/storage/data/playlist/');
define('DEFAULT_APPROVAL_PUBLISHER', 0); // 0 disable 1 activite
define('MUSIC_PLAYLIST_PUBLISHER_PATH', 'data/playlist_publisher/');
define('PUBLIC_MUSIC_PLAYLIST_PUBLISHER_PATH', '/storage/data/playlist_publisher/');
// User
define('AVATAR_PATH', 'data/user_avatar/');
define('PUBLIC_AVATAR_PATH', '/storage/data/user_avatar/');
define('HTMLEX', 'html');
define('DEACTIVE_USER', 0); //  not verify
define('ACTIVE_USER', 1); // verified
define('BANNED_USER', 2);
define('DEFAULT_ROLE_NAME_EMPTY', 'user');
define('ROLE_NAME_ADMIN', 'admin');
define('ROLE_NAME_MANAGER', 'manager');
define('ROLE_NAME_USER', 'user');

// setting
define('SET_ACTIVE', 1);
define('SET_DEACTIVE', 0);

// search
define('ROWS_MUSIC_SEARCH_PAGING', 10);
define('ROWS_ARTIST_SEARCH_PAGING', 10);
define('ROWS_ALBUM_SEARCH_PAGING', 20);
define('ROWS_VIDEO_SEARCH_PAGING', 16);

define('TIME_EXPIRED_LINK', 20); // minute
define('TIME_EXPIRED_UPLOAD_LISTEN_DOWNLOAD', '-1 hour'); // hour
define('TIME_EXPIRED_UPLOAD_NEW', '-15 minutes'); // minute
define('TIME_SOLR_TO_ADD_ITEM', '-1 hour'); // hour
define('TIME_7DAY_AGO', '-7 day'); // hour
define('TIME_30DAY_AGO', '-30 day'); // day
define('TIME_60DAY_AGO', '-60 day'); // day
define('TIME_90DAY_AGO', '-90 day'); // day
define('TIME_MUSIC_SEARCH_RESULT_1DAY_AGO', '-1 day'); // day time to music search result
define('TIME_1DAY_AGO', '-1 day');
define('TIME_2DAY_AGO', '-2 day');
define('TIME_EXPIRED_QR_CODE', '+5 minutes');

define('MAXIMUM_FILE_SIZE_UPLOAD_VIDEO', 5737418240); // maximum upload file video 5Gb
define('ID_OLD_MUSIC', 1000000);
define('LIMIT_SEARCH_TOP_RESULT', 100);

// level CSN
define('LEVEL_VIP_1_1', 1); // vip 1 - 1 tháng
define('LEVEL_VIP_1_2', 2); // vip 1 - 6 tháng
define('LEVEL_VIP_1_3', 3); // vip 1 - 1 năm
define('LEVEL_VIP_2_1', 4); // vip 2 - 7 ngày
define('LEVEL_VIP_2_2', 5); // vip 2 - 1 tháng
define('LEVEL_VIP_2_3', 6); // vip 2 - 3 tháng
define('LEVEL_VIP_2_4', 7); // vip 2 - 6 tháng
define('LEVEL_VIP_2_5', 8); // vip 2 - 1 năm

// news
define('STATUS_PUBLISHED', 'PUBLISHED');
define('STATUS_DRAF', 'DRAF');
define('PAGE_CATEGORY', 5);
define('LIMIT_ADD_PLAYLIST', 100);
define('LIMIT_SHOW_MUSICS_PLAYLIST', 100);
