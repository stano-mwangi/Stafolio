<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Admin\ProjectCategoryController;
use App\Http\Controllers\Admin\ProjectSectionController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\TechnologyController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\ContactInfoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::post('/track-event', [EventController::class, 'store']);

// Public project routes
Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin routes for managing CMS content
    Route::patch('/admin/pages/{key}', [PageController::class, 'updateContent'])->name('admin.pages.update');

    // Admin routes for managing projects
    Route::get('/admin/projects', [AdminProjectController::class, 'index'])->name('admin.projects.index');
    Route::get('/admin/projects/create', [AdminProjectController::class, 'create'])->name('admin.projects.create');
    Route::post('/admin/projects', [AdminProjectController::class, 'store'])->name('admin.projects.store');
    Route::get('/admin/projects/{project}/edit', [AdminProjectController::class, 'edit'])->name('admin.projects.edit');
    Route::put('/admin/projects/{project}', [AdminProjectController::class, 'update'])->name('admin.projects.update');
    Route::delete('/admin/projects/{project}', [AdminProjectController::class, 'destroy'])->name('admin.projects.destroy');
    Route::post('/admin/projects/reorder', [AdminProjectController::class, 'reorder'])->name('admin.projects.reorder');

    // Admin routes for project categories
    Route::get('/admin/categories', [ProjectCategoryController::class, 'index'])->name('admin.categories.index');
    Route::get('/admin/categories/create', [ProjectCategoryController::class, 'create'])->name('admin.categories.create');
    Route::post('/admin/categories', [ProjectCategoryController::class, 'store'])->name('admin.categories.store');
    Route::get('/admin/categories/{category}/edit', [ProjectCategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::put('/admin/categories/{category}', [ProjectCategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('/admin/categories/{category}', [ProjectCategoryController::class, 'destroy'])->name('admin.categories.destroy');

    // Admin routes for project sections
    Route::post('/admin/sections', [ProjectSectionController::class, 'store'])->name('admin.sections.store');
    Route::put('/admin/sections/{section}', [ProjectSectionController::class, 'update'])->name('admin.sections.update');
    Route::delete('/admin/sections/{section}', [ProjectSectionController::class, 'destroy'])->name('admin.sections.destroy');
    Route::post('/admin/sections/reorder', [ProjectSectionController::class, 'reorder'])->name('admin.sections.reorder');

    // Admin routes for managing skills
    Route::get('/admin/skills', [SkillController::class, 'index'])->name('admin.skills.index');
    Route::get('/admin/skills/create', [SkillController::class, 'create'])->name('admin.skills.create');
    Route::post('/admin/skills', [SkillController::class, 'store'])->name('admin.skills.store');
    Route::get('/admin/skills/{skill}/edit', [SkillController::class, 'edit'])->name('admin.skills.edit');
    Route::put('/admin/skills/{skill}', [SkillController::class, 'update'])->name('admin.skills.update');
    Route::delete('/admin/skills/{skill}', [SkillController::class, 'destroy'])->name('admin.skills.destroy');

    // Admin routes for managing technologies
    Route::get('/admin/technologies', [TechnologyController::class, 'index'])->name('admin.technologies.index');
    Route::get('/admin/technologies/create', [TechnologyController::class, 'create'])->name('admin.technologies.create');
    Route::post('/admin/technologies', [TechnologyController::class, 'store'])->name('admin.technologies.store');
    Route::get('/admin/technologies/{technology}/edit', [TechnologyController::class, 'edit'])->name('admin.technologies.edit');
    Route::put('/admin/technologies/{technology}', [TechnologyController::class, 'update'])->name('admin.technologies.update');
    Route::delete('/admin/technologies/{technology}', [TechnologyController::class, 'destroy'])->name('admin.technologies.destroy');

    // Admin routes for managing education
    Route::get('/admin/education', [EducationController::class, 'index'])->name('admin.education.index');
    Route::get('/admin/education/create', [EducationController::class, 'create'])->name('admin.education.create');
    Route::post('/admin/education', [EducationController::class, 'store'])->name('admin.education.store');
    Route::get('/admin/education/{education}/edit', [EducationController::class, 'edit'])->name('admin.education.edit');
    Route::put('/admin/education/{education}', [EducationController::class, 'update'])->name('admin.education.update');
    Route::delete('/admin/education/{education}', [EducationController::class, 'destroy'])->name('admin.education.destroy');

    // Admin routes for managing contact information
    Route::patch('/admin/contact/{key}', [ContactInfoController::class, 'update'])->name('admin.contact.update');
});

Route::post('/ask-agent',[AgentController::class,'ask']);
Route::view('/about','about')->name('about');
Route::view('/contact','contact')->name('contact');
Route::post('/contact/send',[ContactController::class,'send'])->name('contact.send');

require __DIR__.'/auth.php';
