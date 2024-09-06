<?php

use App\Http\Controllers\Dashboard\CollaboratorController as ManageCollaboratorController;
use App\Http\Controllers\Dashboard\EntrepreneurController;
use App\Http\Controllers\Dashboard\LogoController as ManageLogoController;
use App\Http\Controllers\Dashboard\MainController;
use App\Http\Controllers\Dashboard\MentorController as ManageMentorController;
use App\Http\Controllers\Dashboard\NewsController as ManageNewsController;
use App\Http\Controllers\Dashboard\ProfileController as ManageProfileController;
use App\Http\Controllers\Dashboard\TemplateController as ManageTemplateController;
use App\Http\Controllers\Dashboard\WorkshopController as ManageWorkshopController;
use App\Http\Controllers\Dashboard\AdministratorController as ManageAdministratorController;
use App\Http\Controllers\Landing\AuthController;
use App\Http\Controllers\Landing\ClientAreaController;
use App\Http\Controllers\Landing\CornerController;
use App\Http\Controllers\Landing\CourseController;
use App\Http\Controllers\Landing\HomeController;
use App\Http\Controllers\Landing\MentorController;
use App\Http\Controllers\Landing\NewsController;
use App\Http\Controllers\Landing\ProfileController;
use App\Http\Controllers\Landing\TemplateController;
use App\Http\Controllers\Landing\UmkmController;
use App\Http\Controllers\Landing\WorkshopController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/about-us', [HomeController::class, 'about_us'])->name('home.about-us');
Route::get('/contact-us', [HomeController::class, 'contact_us'])->name('home.contact-us');
Route::get('/faq', [HomeController::class, 'faq'])->name('home.faq');
Route::get('/privacy-policy', [HomeController::class, 'privacy_policy'])->name('home.privacy-policy');
Route::get('/term-condition', [HomeController::class, 'term_condition'])->name('home.term-condition');
Route::get('/entrepreneur-step/{slug}', [HomeController::class, 'entrepreneur_step'])->name('home.entrepreneur-step');
Route::get('/entrepreneur-step/download/{filename}', [HomeController::class, 'download'])->name('home.entrepreneur-step.download');

Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');

Route::get('/workshops', [WorkshopController::class, 'index'])->name('workshops.index');
Route::get('/workshops/{slug}', [WorkshopController::class, 'detail'])->name('workshops.detail');

Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{slug}', [NewsController::class, 'detail'])->name('news.detail');
Route::get('/collaborators', [UmkmController::class, 'index'])->name('umkm.index');
Route::get('/collaborators/{name}', [UmkmController::class, 'detail'])->name('umkm.detail');

Route::get('/mentors', [MentorController::class, 'index'])->name('mentors.index');

Route::get('/corner/memulai-usaha-dengan-membangun-personal-branding', [CornerController::class, 'webinar2'])->name('corner.webinar2');
Route::get('/corner/literasi-wirausaha-untuk-mempersiapkan-pebisnis-handal', [CornerController::class, 'webinar1'])->name('corner.webinar1');
Route::get('/corner/strategi-pemasaran-jitu-dengan-ai', [CornerController::class, 'webinar3'])->name('corner.webinar3');


Route::get('/templates', [TemplateController::class, 'index'])->name('templates.index');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'doLogin'])->name('do.login');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'doRegister'])->name('register');
Route::get('/sendverify/{email}', [AuthController::class, 'sendEmailVerify'])->name('email.send');
Route::get('/verify/{token}', [AuthController::class, 'verifyEmail'])->name('email.verify');
Route::get('/forgot/password', [AuthController::class, 'forgotPassword'])->name('forgot.password');
Route::post('/forgot/password', [AuthController::class, 'doForgotPassword'])->name('do.forgot.password');
Route::get('/reset/password/{token}', [AuthController::class, 'resetPassword'])->name('reset.password');
Route::post('/reset/password', [AuthController::class, 'doResetPassword'])->name('do.reset.password');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'store'])->name('profile.store');

    Route::get('/management-profile', [ManageProfileController::class, 'index'])->name('dashboard.profile.index');
    Route::get('/management-profile/edit', [ManageProfileController::class, 'edit'])->name('dashboard.profile.edit');
    Route::post('/management-profile/update', [ManageProfileController::class, 'update'])->name('dashboard.profile.update');

    Route::get('/dashboard', [MainController::class, 'index'])->name('dashboard.index');

    Route::get('/management-entrepreneurs', [EntrepreneurController::class, 'index'])->name('dashboard.entrepreneurs.index');
    Route::get('/management-entrepreneurs/detail/{id}', [EntrepreneurController::class, 'show'])->name('dashboard.entrepreneurs.detail');
    Route::get('/management-entrepreneurs/create', [EntrepreneurController::class, 'create'])->name('dashboard.entrepreneurs.create');
    Route::post('/management-entrepreneurs/store', [EntrepreneurController::class, 'store'])->name('dashboard.entrepreneurs.store');
    Route::get('/management-entrepreneurs/edit/{id}', [EntrepreneurController::class, 'edit'])->name('dashboard.entrepreneurs.edit');
    Route::post('/management-entrepreneurs/update/{id}', [EntrepreneurController::class, 'update'])->name('dashboard.entrepreneurs.update');
    Route::post('/management-entrepreneurs/delete/{id}', [EntrepreneurController::class, 'destroy'])->name('dashboard.entrepreneurs.delete');
    Route::post('/management-entrepreneurs/import', [EntrepreneurController::class, 'import'])->name('dashboard.entrepreneurs.import');

    Route::get('/management-workshops', [ManageWorkshopController::class, 'index'])->name('dashboard.workshops.index');
    Route::get('/management-workshops/create', [ManageWorkshopController::class, 'create'])->name('dashboard.workshops.create');
    Route::post('/management-workshops/store', [ManageWorkshopController::class, 'store'])->name('dashboard.workshops.store');
    Route::get('/management-workshops/edit/{id}', [ManageWorkshopController::class, 'edit'])->name('dashboard.workshops.edit');
    Route::post('/management-workshops/update/{id}', [ManageWorkshopController::class, 'update'])->name('dashboard.workshops.update');
    Route::post('/management-workshops/delete/{id}', [ManageWorkshopController::class, 'destroy'])->name('dashboard.workshops.delete');
    Route::get('/management-workshops/participants/{id}', [ManageWorkshopController::class, 'participant'])->name('dashboard.workshops.participants');
    Route::post('/management-workshops/participants/confirmation', [ManageWorkshopController::class, 'participantConfirmation'])->name('dashboard.workshops.participants.confirmation');
    Route::get('/management-workshops/participants/status/{id}', [ManageWorkshopController::class, 'contactParticipant'])->name('dashboard.workshops.participants.contact');
    Route::get('/management-workshops/participants/download/{id}', [ManageWorkshopController::class, 'download'])->name('dashboard.workshops.participants.download');

    Route::get('/management-news', [ManageNewsController::class, 'index'])->name('dashboard.news.index');
    Route::get('/management-news/add', [ManageNewsController::class, 'create'])->name('dashboard.news.create');
    Route::post('/management-news/add', [ManageNewsController::class, 'store'])->name('dashboard.news.store');
    Route::get('/management-news/edit/{id}', [ManageNewsController::class, 'edit'])->name('dashboard.news.edit');
    Route::put('/management-news/edit/{id}', [ManageNewsController::class, 'update'])->name('dashboard.news.update');
    Route::delete('/management-news/delete/{id}', [ManageNewsController::class, 'destroy'])->name('dashboard.news.destroy');

    Route::post('/workshops/{slug}', [WorkshopController::class, 'follow'])->name('workshops.follow');

    Route::post('/mentors/consultation', [MentorController::class, 'store'])->name('mentor.consultation.store');
    Route::get('/templates/{id}', [TemplateController::class, 'show'])->name('templates.show');
    Route::post('/templates/download/{id}', [TemplateController::class, 'download'])->name('templates.download');

    Route::get('/management-collaborators', [ManageCollaboratorController::class, 'index'])->name('dashboard.collaborators.index');
    Route::get('/management-collaborators/create', [ManageCollaboratorController::class, 'create'])->name('dashboard.collaborators.create');
    Route::post('/management-collaborators/store', [ManageCollaboratorController::class, 'store'])->name('dashboard.collaborators.store');
    Route::get('/management-collaborators/edit/{id}', [ManageCollaboratorController::class, 'edit'])->name('dashboard.collaborators.edit');
    Route::post('/management-collaborators/update/{id}', [ManageCollaboratorController::class, 'update'])->name('dashboard.collaborators.update');
    // Route::post('/management-collaborators/delete/{id}', [ManageCollaboratorController::class, 'destroy'])->name('dashboard.collaborators.delete');

    Route::get('/management-mentors', [ManageMentorController::class, 'index'])->name('dashboard.mentors.index');
    Route::get('/management-mentors/create', [ManageMentorController::class, 'create'])->name('dashboard.mentors.create');
    Route::post('/management-mentors/store', [ManageMentorController::class, 'store'])->name('dashboard.mentors.store');
    Route::get('/management-mentors/edit/{id}', [ManageMentorController::class, 'edit'])->name('dashboard.mentors.edit');
    Route::post('/management-mentors/update/{id}', [ManageMentorController::class, 'update'])->name('dashboard.mentors.update');
    Route::post('/management-mentors/delete/{id}', [ManageMentorController::class, 'destroy'])->name('dashboard.mentors.delete');

    Route::get('/management-templates', [ManageTemplateController::class, 'index'])->name('dashboard.templates.index');
    Route::get('/management-templates/create', [ManageTemplateController::class, 'create'])->name('dashboard.templates.create');
    Route::post('/management-templates/store', [ManageTemplateController::class, 'store'])->name('dashboard.templates.store');
    Route::get('/management-templates/edit/{id}', [ManageTemplateController::class, 'edit'])->name('dashboard.templates.edit');
    Route::post('/management-templates/update/{id}', [ManageTemplateController::class, 'update'])->name('dashboard.templates.update');
    Route::post('/management-templates/delete/{id}', [ManageTemplateController::class, 'destroy'])->name('dashboard.templates.delete');

    Route::get('/management-logo', [ManageLogoController::class, 'index'])->name('dashboard.logos.index');
    Route::get('/management-logo/create', [ManageLogoController::class, 'create'])->name('dashboard.logos.create');
    Route::post('/management-logo/store', [ManageLogoController::class, 'store'])->name('dashboard.logos.store');
    Route::get('/management-logo/edit/{id}', [ManageLogoController::class, 'edit'])->name('dashboard.logos.edit');
    Route::put('/management-logo/update/{id}', [ManageLogoController::class, 'update'])->name('dashboard.logos.update');
    Route::post('/management-logo/delete/{id}', [ManageLogoController::class, 'destroy'])->name('dashboard.logos.destroy');

    Route::get('/management-administrators', [ManageAdministratorController::class, 'index'])->name('dashboard.administrators.index');
    Route::get('/management-administrators/create', [ManageAdministratorController::class, 'create'])->name('dashboard.administrators.create');
    Route::post('/management-administrators/store', [ManageAdministratorController::class, 'store'])->name('dashboard.administrators.store');
    Route::get('/management-administrators/edit/{id}', [ManageAdministratorController::class, 'edit'])->name('dashboard.administrators.edit');
    Route::post('/management-administrators/update/{id}', [ManageAdministratorController::class, 'update'])->name('dashboard.administrators.update');
    Route::post('/management-administrators/generate/{id}', [ManageAdministratorController::class, 'generatePassword'])->name('dashboard.administrators.generate');

});

Route::middleware(['auth'])->group(function () {
    Route::prefix('client-area')->group(function () {
        Route::get('/profile', [ClientAreaController::class, 'index'])->name('clientarea.profile.index');
        Route::get('/profile/edit', [ClientAreaController::class, 'edit'])->name('clientarea.profile.edit');
        Route::post('/profile/update', [ClientAreaController::class, 'update'])->name('clientarea.profile.update');

        Route::get('/workshops', [ClientAreaController::class, 'myWorkshop'])->name('clientarea.workshops.index');
    });
});
