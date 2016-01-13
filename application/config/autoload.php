<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| AUTO-LOADER
| -------------------------------------------------------------------
| This file specifies which systems should be loaded by default.
|
| In order to keep the framework as light-weight as possible only the
| absolute minimal resources are loaded by default. For example,
| the database is not connected to automatically since no assumption
| is made regarding whether you intend to use it.  This file lets
| you globally define which systems you would like loaded with every
| request.
|
| -------------------------------------------------------------------
| Instructions
| -------------------------------------------------------------------
|
| These are the things you can load automatically:
|
| 1. Packages
| 2. Libraries
| 3. Helper files
| 4. Custom config files
| 5. Language files
| 6. Models
|
*/

/*
| -------------------------------------------------------------------
|  Auto-load Packges
| -------------------------------------------------------------------
| Prototype:
|
|  $autoload['packages'] = array(APPPATH.'third_party', '/usr/local/shared');
|
*/

$autoload['packages'] = array();


/*
| -------------------------------------------------------------------
|  Auto-load Libraries
| -------------------------------------------------------------------
| These are the classes located in the system/libraries folder
| or in your application/libraries folder.
|
| Prototype:
|
|	$autoload['libraries'] = array('database', 'session', 'xmlrpc');
*/

/*
'system/loader/class_loader',
    'system/users/session_user',
    'database',
    'system/pages/class_error_page',
    'system/simple_html_dom/simple_html_dom',
    'system/date_time/date_time',
    'system/post_get/class_post',
    'system/post_get/class_get',
    'system/template/Template',
    'system/template/Template_tools',
    'system/template/template_render_ajax',
    'system/template/template_render',
    'system/include/render_page_system',


    'system/users/info_user',
    'system/users/t_users',
    'system/users/render_page_users',
    'system/users/t_users_clients',
    'system/users/t_users_type',
    'client/table/t_client',

    'system/users/group/table/group',
    'system/users/group/table/group_user',





    'trend/youtube/clone/trends_youtube_lib',
    'trend/youtube/tables/table_trends_youtube',
    'trend/youtube/tables/table_trends_youtube_country',

    'trend/google/clone/trends_google_lib',
    'trend/google/tables/google_country_trends',
    'trend/google/tables/news_google_trends',
    'trend/google/tables/google_trends',


    'trend/google/clone/trends_youtube_google_lib',
    'trend/google/tables/google_youtube_country_trends',
    'trend/google/tables/google_youtube_trends',


    'system/platform_lib/twitter_lib/twitteroauth',

    'trend/twitter/clone/trends_twitter_lib',
    'trend/twitter/tables/table_country_twitter',
    'trend/twitter/tables/table_twitter',
    'trend/twitter/tables/table_twitter_api',
    'trend/twitter/tables/table_twitter_retweet',

        'client/table/t_client_type_platform',
        'client/table/t_client_instagram',
        'client/table/t_client_facebook',
        'client/table/t_client_twitter',
        'instagram_lib/platform',
        'facebook_lib/facebook',
        'twitter_lib/twitteroauth',
        'virgin_mega_storeme/cron/cron_instagram',
        'virgin_mega_storeme/cron/cron_facebook',
        'virgin_mega_storeme/cron/cron_twitter',
        'virgin_mega_storeme/table/t_virgin_ms_instagram',
        'virgin_mega_storeme/table/t_virgin_ms_facebook',
        'virgin_mega_storeme/table/t_virgin_ms_twitter',

'system/pages/render_pages',
    'system/array/method_array',
*/

$autoload['libraries'] = array(
    'database',
    'system/loader/class_loader',
    'system/template/Template',
    'system/template/Template_tools',
    'system/template/template_render',
    'system/template/template_render_ajax',
);


/*
| -------------------------------------------------------------------
|  Auto-load Helper Files
| -------------------------------------------------------------------
| Prototype:
|
|	$autoload['helper'] = array('url', 'file');
*/

$autoload['helper'] = array('url' ,'language','date');


/*
| -------------------------------------------------------------------
|  Auto-load Config files
| -------------------------------------------------------------------
| Prototype:
|
|	$autoload['config'] = array('config1', 'config2');
|
| NOTE: This item is intended for use ONLY if you have created custom
| config files.  Otherwise, leave it blank.
|
*/

$autoload['config'] = array();


/*
| -------------------------------------------------------------------
|  Auto-load Language files
| -------------------------------------------------------------------
| Prototype:
|
|	$autoload['language'] = array('lang1', 'lang2');
|
| NOTE: Do not include the "_lang" part of your file.  For example
| "codeigniter_lang.php" would be referenced as array('codeigniter');
|
*/

$autoload['language'] = array('client_info');


/*
| -------------------------------------------------------------------
|  Auto-load Models
| -------------------------------------------------------------------
| Prototype:
|
|	$autoload['model'] = array('model1', 'model2');
|
*/

$autoload['model'] = array('data_base');


/* End of file autoload.php */
/* Location: ./application/config/autoload.php */