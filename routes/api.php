<?php

use App\Http\Controllers\Api;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ApiLoginController;
use App\Http\Controllers\API\ApiMessageController;
use App\Http\Controllers\API\ApiFaceScanController;
use App\Http\Controllers\API\VisitorgetController;
use App\Http\Controllers\API\AddStatusfromtenenat;
use App\Http\Controllers\API\ProfileUpdateController;
use App\Http\Controllers\API\VisitoreOutController;
use App\Http\Controllers\API\VisitoreCreateController;
use App\Http\Controllers\API\SchoolVisitoreCreateController;
use App\Http\Controllers\API\BlockVisitorController;
use App\Http\Controllers\API\PreApproveVisitore;
use App\Http\Controllers\API\ChatController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::fallback(function () {
    return response()->json(['message' => 'Route not found'], 404);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('detect-face', [Api::class, 'detect_face'])->name('detectFaceApi');
Route::post('detect-face-controller', [Api::class, 'controller_detect_face'])->name('detectFaceApiController');
Route::post('create-user-with-face', [Api::class, 'create_user_with_face'])->name('createUserWithFaceApi');
Route::get('delete-collection', [Api::class, 'delete_collection'])->name('deleteCollectionApi');
Route::post('/login', [ApiLoginController::class, 'login']);
Route::post('/face-scan', [ApiFaceScanController::class, 'faceScan']);
Route::post('/face-scan/handle-visitor', [ApiFaceScanController::class, 'handleVisitorData'])->name('api.face-scan.handle-visitor');
Route::get('/get-current-visitors', [VisitorgetController::class, 'getCurrentVisitors']);
Route::get('/get-old-visitors-log', [VisitorgetController::class, 'getAllVisitorslog']);
Route::post('/add-status-visitor', [AddStatusfromtenenat::class, 'addStatusVisitor']);
Route::post('/update-profile', [ProfileUpdateController::class, 'updateProfile']);
Route::delete('/delete-profile', [ProfileUpdateController::class, 'deleteProfile']);
Route::post('/logout', [ApiLoginController::class, 'logout'])->name('logout');
Route::post('/add-out-remark', [VisitoreOutController::class, 'add_out_remark']);

Route::get('/get-tenant', [VisitorgetController::class, 'getTenant']);
Route::post('/add-visitor', [VisitoreCreateController::class, 'addVisitore']);

Route::post('/add-visitor-school-security', [SchoolVisitoreCreateController::class, 'addVisitoreforSchool']);

Route::get('/get-sections-by-class', [VisitorgetController::class, 'getSectionsByClass']);
Route::get('/get-students-by-section', [VisitorgetController::class, 'getStudentsBySection']);

Route::post('/visitor-block', [BlockVisitorController::class, 'blockVisitor']);
Route::post('/pre-visitor-store', [PreApproveVisitore::class, 'preStoreVisitor']);
Route::post('/chats', [ChatController::class, 'createChat']);
Route::post('/chats/{chatId}/messages', [ChatController::class, 'addMessage']);
Route::get('/chats/{chatId}/messages', [ChatController::class, 'getMessages']);
Route::get('/preapprove-visitor/{building_id}', [PreApproveVisitore::class, 'getPreapproveVisitore']);


Route::get('/get-user-list', [ApiMessageController::class, 'getUserList']);
Route::post('/send-new-meesage', [ApiMessageController::class, 'sendNewMessage'])->name('api.tenant-send-message');
Route::get('/messages/fetch', [ApiMessageController::class, 'fetchMessages'])->name('messages.fetch');
Route::post('/messages/send', [ApiMessageController::class, 'sendMessage'])->name('messages.send');