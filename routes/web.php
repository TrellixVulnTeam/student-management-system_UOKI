<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

if(version_compare(PHP_VERSION, '7.2.0', '>=')) {
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
}


Route::get('/', function () {
    return view('welcome');
});

Route::get('/load/{profile}/{section}', 'ProfilesController@loadEditSection');
Route::get('/detach/{profile}/{section}', 'ProfilesController@detach');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/success', function () {
    return view('auth.success');
})->name('auth.success');


// SETUP RESOUCES
Route::resource('/departments', 'DepartmentsController');
Route::resource('/countries', 'CountriesController');
Route::resource('/cities', 'CitiesController');
Route::resource('/languages', 'LanguagesController');
Route::resource('/duties', 'DutiesController');
Route::resource('/event-types', 'EventTypesController');
Route::resource('/fruit-levels', 'FruitLevelsController');
Route::resource('/industries', 'IndustriesController');
Route::resource('/organizations', 'OrganizationsController');
Route::resource('/report-types', 'ReportTypesController');
Route::resource('/fruit-roles', 'FruitRolesController');
Route::resource('/fruit-stages', 'FruitStagesController');
Route::resource('/maintainers', 'MaintainersController');
Route::resource('/maintainer-assignment', 'MaintainerAssignmentController');
Route::resource('/meeting-types', 'MeetingTypesController');
Route::resource('/sector-relationships', 'SectorRelationshipsController');
Route::resource('/sectors', 'SectorsController');
Route::resource('/teams', 'TeamsController');
Route::resource('/activity-types', 'ActivityTypeController');
Route::resource('/titles', 'TitlesController');
Route::resource('/religions', 'ReligionsController');
Route::resource('/users', 'UsersController');
Route::resource('/documentation', 'DocumentationsController');
Route::resource('/document-types', 'DocumentTypesController');
Route::get('/warp-attendees/delete/{id}', 'WarpSummitAttendeesController@destroy')->name('warp-attendees.delete');
Route::resource('/warp-attendees', 'WarpSummitAttendeesController');
Route::resource('/campaigns', 'CampaignsController');
Route::get('/campaign-report/{id}', 'CampaignsController@report_index')->name('campaigns.report');
Route::post('/campaign-report/{id}', 'CampaignsController@report')->name('campaigns.report.save');
Route::get('/campaign-report-view/{id}', 'CampaignsController@viewCampaignReport')->name('campaigns.report.view');
Route::get('/documentation-download/{id}', 'DocumentationsController@download')->name('documentation-download');
Route::resource('/roles', 'RolesController');

//USERS
Route::get('/users/{id}/disable-or-enable', 'UsersController@disableEnableUser')->name('users.disableEnable');

//PROFILES
Route::resource('/profiles', 'ProfilesController');
//Route::get('/profiles/show/{slug}', 'ProfilesController@show')->name('profiles.show');
//Route::get('/profiles', 'ProfilesController@index')->name('profiles.index');
//Route::get('/profiles/{slug}/edit', 'ProfilesController@edit')->name('profiles.edit');
//Route::post('/profiles/{slug}/edit', 'ProfilesController@update')->name('profiles.update');
//Route::get('/profiles/create', 'ProfilesController@create')->name('profiles.create');
Route::get('/tbl-profiles', 'ProfilesController@getSimpleDatatablesData')->name('tbl-profiles');
Route::post('/profiles/documents', 'ProfilesController@upload_document');
Route::get('/profile/documents/{id}/download', 'ProfilesController@download_document');
Route::get('/profile/documents/{id}/delete', 'ProfilesController@delete_document');
Route::get('/profile/print/{slug}', 'ProfilesController@print');
Route::get('/profile/ajax/show/{slug}/{section}', 'ProfilesController@loadShowSection')->name('profiles.ajax.show');
Route::get('/profile/ajax/entity/{slug}/{entity}', 'ProfilesController@loadAddNewEntityForm')->name('profiles.ajax.new-entity');
Route::get('/profile/cancel/{section}/{slug}/', 'ProfilesController@cancelEdit');
Route::get('/profile/add/{entity}/{slug}/', 'ProfilesController@addNewEntity');
Route::post('/ajax/get-profile-info', 'ProfilesController@ajaxGetProfileInfo');
Route::get('/add-profile-organisation', 'ProfilesController@addOrganisation');
Route::get('/add-profile-assistant', 'ProfilesController@addAssistant');
Route::post('/profiles', 'ProfilesController@store')->name('profiles.store');
Route::post('/profiles/filter', 'ProfilesController@filter')->name('filter-profiles');
Route::post('/delete-profile-organisation', 'ProfilesController@deleteOrganisation');
Route::post('/delete-profile-assistant', 'ProfilesController@deleteAssistant');

//ACTIVITIES
Route::get('/meetings/create/{profileSlug}', 'ActivitiesController@create');
Route::get('/calls/create/{profileSlug}', 'ActivitiesController@create');
Route::get('/emails/create/{profileSlug}', 'ActivitiesController@create');
Route::get('/messages/create/{profileSlug}', 'ActivitiesController@create');
Route::post('/activities', 'ActivitiesController@store');
Route::get('/activities/{activity_type}/{id}/{profile_slug}/edit', 'ActivitiesController@edit');
Route::post('/activities/{activity_id}/{profile_slug}/edit', 'ActivitiesController@update')->name('activities.edit');
Route::get('/delete/activity/photo/{id}', 'ActivitiesController@deletePhoto')->name('delete.activity.photo');
Route::get('/delete/media/photo/{id}', 'MediaCoverageController@deletePhoto')->name('delete.media.photo');

//MEDIA COVARAGE
Route::get('/media-coverage/{profileSlug}', 'MediaCoverageController@index');
Route::get('/media-coverage/create/{profileSlug}', 'MediaCoverageController@create');
Route::get('/media-coverage/{id}/edit', 'MediaCoverageController@edit');
Route::post('/media-coverage/create', 'MediaCoverageController@store');
Route::post('/media-coverage/{id}', 'MediaCoverageController@update')->name('media-coverage.edit');

//EVENTS
Route::resource('/events', 'EventsController')->except('show');
Route::get('/events/other-attendees/{slug}/{action}/{participant}', 'EventsController@manage_other_attendees');
Route::post('/save-invite/{slug}', 'EventsController@saveInviteFromAjaxTable')->name('save-invite');
Route::post('/update-invite/{slug}', 'EventsController@updateInviteFromAjaxTable')->name('update-invite');

Route::get('/events/{slug}', 'EventsController@show')->name('events.show');
Route::get('/events/details/{slug}', 'EventsController@show')->name('event-details');
Route::get('/events/program/{slug}', 'EventsController@show')->name('event-program');
Route::get('/events/guests/{slug}', 'EventsController@show')->name('event-guests');
Route::get('/events/staff/{slug}', 'EventsController@show')->name('event-staff');
Route::get('/events/co-hosts/{slug}', 'EventsController@show')->name('event-co-hosts');
Route::get('/events/media-coverage/{slug}', 'EventsController@show')->name('event-media-coverage');
Route::get('/events/documents/{slug}', 'EventsController@show')->name('event-documents');
Route::get('/events/other-details/{slug}', 'EventsController@show')->name('event-other-details');
Route::get('/events/gallery/{slug}', 'EventsController@show')->name('event-gallery');

//EVENTS ACTIVITIES REPORT - MAIN ATENDEES
Route::get('/events/activity-report/{type}/{person}/{event_slug}', 'ActivitiesController@create_activity_report_from_events')->name('main_attendees.activityReport');

Route::post('events/activity-report/{type}/{person}/{event_slug}', 'ActivitiesController@store_activity_report_from_events')->name('main_attendees.activityReport');

Route::get('/events/activity-report/{id}/edit', 'ActivitiesController@edit_activity_report_from_events')->name('edit.main_attendees.activityReport');

Route::post('/events/activities/{id}/update', 'ActivitiesController@update_activity_report_from_events')->name('edit.main_attendees.activityReport');


//EVENTS ACTIVITIES REPORT - OTHER ATENDEES
Route::get('/events/activities/other_participant/{type}/{person}/{event_slug}', 'ActivitiesController@create_event_other_activities')->name('other_participant.activityReport');
Route::post('/events/activities/other_participant/{type}/{person}/{event_slug}', 'ActivitiesController@store_event_other_activities')->name('other_participant.activityReport');
Route::get('/events/activities/other_participant/{id}', 'ActivitiesController@edit_event_other_activities')->name('edit.other_participant.activityReport');
Route::post('/events/activities/other_participant/{id}', 'ActivitiesController@update_event_other_activities')->name('edit.other_participant.activityReport');
Route::get('/events/{slug}/{action}/{participant}', 'EventsController@manage');

Route::post('/event-staff/add/{slug}', 'EventsController@invite_staff');
Route::get('/event-staff/remove/{slug}', 'EventsController@remove_staff');

Route::get('/liaising-list/{slug}', 'EventsController@getSimpleDatatablesData')->name('liaising-list');

Route::get('/event-co-host/create/{slug}', 'EventCoHostsController@create');
Route::post('/event-co-host/create/{slug}', 'EventCoHostsController@store')->name('co-hosts.create');

Route::get('/event-co-host/view/{id}', 'EventCoHostsController@view');
Route::get('/event-co-host/delete/{id}', 'EventCoHostsController@delete');

Route::post('/event-co-host/update/{id}', 'EventCoHostsController@update')->name('co-hosts.edit');
Route::get('/event-co-host/edit/{id}', 'EventCoHostsController@edit');

Route::post('/event-documents/upload/{slug}', 'EventDocumentsController@store');
Route::get('/event-documents/download/{id}', 'EventDocumentsController@download');

Route::get('/event-documents/delete/{id}', 'EventDocumentsController@delete');

Route::post('event-other-information/create/{slug}', 'EventMiscellaneousController@store');
Route::get('event-other-information/edit/{id}', 'EventMiscellaneousController@edit');
Route::post('event-other-information/edit/{id}', 'EventMiscellaneousController@update')->name('event-other-information.edit');
Route::get('/misc-file/delete/{id}', 'EventMiscellaneousController@delete_file');
Route::get('/misc-file/download/{id}', 'EventMiscellaneousController@download');
Route::get('/event-other-information/delete/{id}', 'EventMiscellaneousController@delete');

Route::resource('/external-events', 'ExternalEventsController');


Route::post('/event-gallery/create/{slug}', 'EventGalleryController@store');
Route::get('/event-check-in', 'EventCheckInController@index');
Route::get('/event-check-in/{slug}', 'EventCheckInController@create');
Route::post('/event-check-in/{slug}', 'EventCheckInController@store');

Route::post('/get-guest', 'EventCheckInController@get_guest');


Route::get('report/{type}/events', 'ReportsController@events_report_index');
Route::get('report/events/create/{slug}', 'ReportsController@events_report_create');
Route::get('report/events/edit/{slug}', 'ReportsController@events_report_edit');
Route::post('report/events/create/{slug}', 'ReportsController@events_report_store');
Route::post('report/events/edit/{slug}/{id}', 'ReportsController@events_report_update')->name('event.report.edit');
Route::get('report/events/view/{slug}', 'ReportsController@events_report_view');
Route::get('report/events/print/{slug}', 'ReportsController@events_report_print');

Route::get('reports/periodic', 'ReportsController@periodic_index');
Route::get('reports/profiles', 'ReportsController@profiles');
Route::get('reports/documentation', 'ReportsController@documentation');
Route::get('reports/sector/{sector}', 'ReportsController@sector_report');
Route::post('/reports/periodic/filters', 'ReportsController@periodic_report_filter')->name('periodic.reports.filter');
Route::get('/reports/periodic/excel', 'ReportsController@export');
Route::post('/reports/profiles/search', 'ReportsController@searchProfiles')->name('search-profiles');
Route::post('/reports/documentation/search', 'ReportsController@searchDocumentations')->name('search-documentation');
Route::get('/reports/profiles/excel', 'ReportsController@exportProfilesToExcel')->name('export-profiles');
Route::get('/reports/documentations/excel', 'ReportsController@exportDocumentationsToExcel')->name('export-documentations');
Route::get('/reports/warp-attendees', 'ReportsController@WarpAttendees');
Route::post('/reports/warp-attendees/search', 'ReportsController@WarpAttendeesSearch')->name('search-warp');
Route::get('/export-warp-summit-attendees', 'ReportsController@exportWarpSummitAttendees')->name('export-warp-summit-attendees');
