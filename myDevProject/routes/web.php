<?php
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Mydevproject\SocialShareButtonsController;

/*
 * Mydevproject Studio 2021 All rights reserved © 
 */ 

Route::redirect('/logout', '/login');
Route::redirect('/home', '/admin')->name('dashboard');
Route::view('/mydevproject/termsofuse','termsofuse');  


Auth::routes(['register' => true]);
Auth::routes(['verify' => true]);

/*
--------------------------------------------------------------------------
 SocialShare
--------------------------------------------------------------------------
*/
Route::get('/socialmediashare', [SocialShareButtonsController::class,'ShareWidget']);

  
 Route::group(['prefix' => 'mydevproject', 'as' => 'mydevproject.','namespace' => 'Mydevproject'], function () {
    //share social
    Route::get('sharesocial', 'tools\ShareSocialController@shareSocial');

    //redirect to encyclopedia
    Route::get('encyclopedia/{num}/{language}/{key}', 'tools\ToolsController@toEncyclopedia'); 
    
    //contacts
    Route::post('mydevprojectcontacts','tools\EmailController@contacts')->name('mydevprojectcontacts');      
    Route::get('listcontacts','tools\EmailController@listContacts')->name('listcontacts');    
    
    //Mydevproject Catalog
    Route::get('cats', 'CatalogController@index');
    Route::get('cat-list', 'CatalogController@index')->name('catlist');
    Route::get('cat-list/{id}/edit', 'CatalogController@edit');
    Route::post('cat-list/store', 'CatalogController@store')->name('catstore');
    Route::get('cat-list/delete/{id}', 'CatalogController@destroy');    
 
    Route::match(['post','get','put'], 'cats/create', 'CatalogController@create')->name('cat-create');  
    Route::match(['post','get','put'], 'subcats/create', 'CatalogController@subCreate')->name('subcat-create');  
   
    //Sub Catalog     
    Route::get('subcats/{cat}/{slavecat}', 'CatalogController@getSubCatalog')->name('subcatlist'); 
    Route::get('subcat-list/{id}/edit/{subcat}', 'CatalogController@subEdit');
    Route::get('subcat-list/{id}/submodaledit/{subcat}', 'CatalogController@subModalEdit');
    Route::post('subcat-list/store/', 'CatalogController@subEditStore');
    Route::get('subcat-list/delete/{id}', 'CatalogController@subDestroy');
    Route::get('generatesubdirectories/{cat}/{create}/{language}', 'CatalogController@generateSubdirectories'); 
    
    //show dictionary
    Route::get('dictshow/{language}','DictionaryController@showDictionary')->name('dictshow');
    Route::match(['post','get','put'], 'decn/create/{language}', 'DictionaryController@dictCreate')->name('dictcreate');  
    Route::get('dictlist/delete/{language}/{id}', 'DictionaryController@dictDestroy'); 
    Route::get('dictedit/{id}/edit', 'DictionaryController@dictEdit');
    Route::get('newarticle/{language}/{search}','DictionaryController@dictNewArticle')->middleware(['auth'])->name('dictnewarticle'); 
    Route::get('editcontent/{id}/{language}','DictionaryController@dictEditContent')->name('editcontent'); 
    Route::match(['post','get'],'convertcontent/update/{id}/{language}','DictionaryController@dictContentConvert')->name('convertcontent'); 
    Route::match(['post','get'],'convertcontenturl/update/{id}/{language}','DictionaryController@dictContentConvertUrl')->name('convertcontenturl'); 
    Route::match(['post','get'],'convertallcontent/convert/{language}','DictionaryController@dictAllContentConvert')->name('convertallcontent'); 
    Route::match(['post','get'],'convertallcontent/convertimport/{language}','DictionaryController@dictAllContentConvertImport')->name('convertallcontentimport'); 
    Route::match(['post','get'],'convertallcontent/converturl/{language}','DictionaryController@dictAllContentConvertUrl')->name('convertallcontenturl'); 
    Route::post('editcontent/update/{id}/{language}', 'DictionaryController@dictContentUpdate')->name('contentupdate');
    Route::post('dictcontentdelete/{id}/{language}','DictionaryController@dictContentDelete');
    
    //distribute content into other languages
    
    Route::match(['post','get'], 'distribution/{id}/{language}/{distribute}','DictionaryController@distribution');
    
    //create new url content
    Route::get('createnewurlcontent/{id}/{language}','DictionaryController@createNewUrlContent');
    Route::post('savenewurlcontent/{id}','DictionaryController@saveNewUrlContent');
    Route::post('updatenewurlcontent/{urlid}/{id}/{language}','DictionaryController@updateNewUrlContent');
    Route::get('editnewurlcontent/{urlid}/{editor}/{language}','DictionaryController@editNewUrlContent')->middleware('auth');
    Route::get('deletenewurlcontent/{urlid}/{id}/{editor}/{language}','DictionaryController@deleteNewUrlContent');
  //  
    //new content
    Route::post('mynewtopicstore', 'NewContentApplicationController@myNewTopicStore');
    Route::post('mynewtopicupdate/{id}', 'NewContentApplicationController@myNewTopicUpdate');
    
    //publish my topics 
    Route::post('publishmytopics', 'NewContentApplicationController@publishMyTopics')->name('publishmytopics');
    Route::get('/show/topicsearch','DictionaryController@topicSearch')->name('topicsearch');
    
    Route::get('newcontent','NewContentApplicationController@index');  
    Route::get('newcontent/delete/{id}','NewContentApplicationController@newContentDelete'); 
    Route::match(['post','get'],'newcontent/create','NewContentApplicationController@create'); 
    Route::get('newcontentapp','NewContentApplicationController@newcontentApproval');  
    Route::match(['post','get'], 'publicationapprov/{id}/{content_id}','NewContentApplicationController@publicationApprov');
    Route::get('newcontentpublishstatus','NewContentApplicationController@newcontentPublishStatus');    
    Route::get('editnewcontent/{id}','NewContentApplicationController@editNewContent')->name('editnewcontent'); 
    Route::post('editnewcontent/update/{id}', 'NewContentApplicationController@newContentUpdate')->name('newcontentupdate');
    
    //news for everybody
    Route::get('newsforeverybody','NewContentApplicationController@newsForEverybody');
    Route::post('publishmyopinions', 'NewContentApplicationController@publishMyOpinions')->name('publishmyopinions');
    
    Route::get('createnewcontenturl/{id}','DictionaryController@createNewContentUrl');
    Route::get('decn/createmytopictitle','NewContentApplicationController@createMyTopicTitle');
    
    Route::post('/urlnewcontentmediastore/{id}', 'DictionaryController@urlNewContentMediaStore');
    Route::get('mynewcontentlist','NewContentApplicationController@myNewcontentList'); 
    Route::get('newcontentdetail/{id}/{language}','NewContentApplicationController@newcontentDetail');
    Route::get('editnewcontenturluser/{urlid}','DictionaryController@editNewContentUrlUser');
    Route::post('updatenewcontenturluser/{urlid}/{id}','DictionaryController@updateNewContentUrlUser');
    Route::get('deletenewcontenturluser/{urlid}/{id}','DictionaryController@deleteNewContentUrlUser');
    
    //Category List show
    Route::get('/show/category/{cat}/{viewcompact}/{language}','DictionaryController@categoryListShow')->name('categorylistshow');
    
    //Category List show
    Route::get('/show/subcategory/{id}/{catslave}/{subcat}/{viewcompact}/{language}','DictionaryController@subcategoryListShow')->name('subcategorylistshow');
    
    //Category List delete
    Route::get('/delete/subcategory/{mainid}/{maincat}/{catslave}/{language}','DictionaryController@subcategoryListDelete')->name('subcategorylistdelete');
    Route::get('/delete/maincategory/{mainid}/{maincat}/{language}','DictionaryController@maincategoryListDelete')->name('maincategorylistdelete');
    
    //show
    Route::get('/show/list/{language}','DictionaryController@index');
    Route::get('/show/detail/{id}/{language}','DictionaryController@detail')->name('detail');    
    Route::match(['post','get'],'/show/topsearch','DictionaryController@search')->name('topsearch');
    Route::get('/show/topsearchnavi','DictionaryController@naviSearch')->name('topsearchnavi');
    Route::get('/media/imagesearch','DictionaryController@imageSearch')->name('imagesearch');
    Route::get('/media/videosearch','DictionaryController@videoSearch')->name('videosearch');
    Route::get('/show/imagelist/{id}/{dict}','tools\ToolsController@getImage');
    
    //show editor
    Route::get('/show/editors','DictionaryController@listEditors');
    Route::get('show/mytopic/{email}/{viewcompact}','DictionaryController@mytopicEditors');
    Route::get('show/allmytopic/{email}/{language}','DictionaryController@allmytopicAdmin');
    Route::get('show/alleditorstopic/{language}','DictionaryController@allEditorsTopic');
    Route::get('show/onetopicview/{topic}/{language}','DictionaryController@oneTopicView');
    Route::get('/show/editorsearch','DictionaryController@editorSearch')->name('editorsearch');

    //Catalog Tree
    Route::get('categoryview',['uses'=>'DictionaryController@manageCategory'])->name('catvisiblemanage');
    Route::get('maincategoryview/{cat}/{language}/','DictionaryController@mainCategoryView');
    Route::post('addcategory',['as'=>'add.category','uses'=>'DictionaryController@addCategory']);
    Route::get('categoryvisible','DictionaryController@catVisible')->name('catvisible');   
    Route::get('maincategoryvisible','DictionaryController@maincatVisible')->name('maincatvisible');  
    Route::get('slavemaincatsubvisible/{id}/{slavemaincatsub}/{language}','DictionaryController@slavemaincatsubVisible');
    Route::post('slavemaincatsubassign/{language}','DictionaryController@slavemaincatsubAssign');

    
    
});

Route::group(['middleware' => ['auth']], function(){  
       
    Route::get('/image/catalog','DictionaryController@imageCatalogSearch');   
});

    
//video like counter
Route::match(['post','get'],'/like', 'Like\LikeController@like');
//image like counter
Route::match(['post','get'],'/imagelike', 'Like\LikeController@imageLike');

//new content like counter
Route::match(['post','get'],'/newcontentlike', 'Like\LikeController@newContentLike');
//maincontent like counter
Route::match(['post','get'],'/diccontentlike/{tbl}', 'Like\LikeController@dicContentLike');
//topic like counter
Route::match(['post','get'],'/mytopiclike', 'Like\LikeController@mytopicLike');
//editor like counter
Route::match(['post','get'],'/userlike', 'Like\LikeController@userLike');

//visit
Route::get('/post/{id}', 'Visit\PostController@showPost');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Vue show
Route::get('/vueshow','HomeController@vueShow')->name('vueshow');

//Test products
Route::get('product-list', 'ProductController@index')->name('plist');
Route::get('product-list/{id}/edit', 'ProductController@edit');
Route::post('product-list/store', 'ProductController@store')->name('pstore');
Route::get('product-list/delete/{id}', 'ProductController@destroy');

/*
|--------------------------------------------------------------------------
| Laravel Logger Web Routes
|--------------------------------------------------------------------------
|
*/

Route::group(['prefix' => 'activity', 'namespace' => 'jeremykenedy\LaravelLogger\App\Http\Controllers', 'middleware' => ['web', 'auth', 'activity']], function () {

    // Dashboards
    Route::get('/', 'LaravelLoggerController@showAccessLog')->name('activity');
    Route::get('/cleared', ['uses' => 'LaravelLoggerController@showClearedActivityLog'])->name('cleared');

    // Drill Downs
    Route::get('/log/{id}', 'LaravelLoggerController@showAccessLogEntry');
    Route::get('/cleared/log/{id}', 'LaravelLoggerController@showClearedAccessLogEntry');

    // Forms
    Route::delete('/clear-activity', ['uses' => 'LaravelLoggerController@clearActivityLog'])->name('clear-activity');
    Route::delete('/destroy-activity', ['uses' => 'LaravelLoggerController@destroyActivityLog'])->name('destroy-activity');
    Route::post('/restore-log', ['uses' => 'LaravelLoggerController@restoreClearedActivityLog'])->name('restore-activity');
});

