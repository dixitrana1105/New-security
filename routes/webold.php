<?php

use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\SuperAdmin\SchoolController;
use App\Http\Controllers\SuperAdmin\BuildingController;
use App\Http\Controllers\SuperAdmin\TicketController;
use App\Http\Controllers\SuperAdmin\SettingController;
use App\Http\Controllers\Building\BuildingsController;
use App\Http\Controllers\Building\BuildingTicketController;
use App\Http\Controllers\Building\TenantController;
use App\Http\Controllers\Building\SecurityController;
use App\Http\Controllers\Building\KeyChangeController;
use App\Http\Controllers\Building\ProfileController;
use App\Http\Controllers\BuildingSecurity\BuildingsSecurityController;
use App\Http\Controllers\BuildingSecurity\BuildingsSecurityVisitorController;
use App\Http\Controllers\BuildingSecurity\BuildingsSecurityTenantController;
use App\Http\Controllers\BuildingSecurity\BuildingsSecuritySecController;
use App\Http\Controllers\BuildingSecurity\BuildingsSecurityProfileController;
use App\Http\Controllers\BuildingSecurity\BuildingsSecurityPasswordController;
use App\Http\Controllers\BuildingSecurity\BuildingsSecurityTicketController;
use App\Http\Controllers\BuildingTenant\BuildingsTenantVisitorController;
use App\Http\Controllers\BuildingTenant\BuildingsTenantTicketController;
use App\Http\Controllers\BuildingTenant\BuildingsTenantSecurityController;
use App\Http\Controllers\BuildingTenant\BuildingsTenantTenController;
use App\Http\Controllers\BuildingTenant\BuildingsTenantController;
use App\Http\Controllers\BuildingTenant\BuildingsTenantProfileController;
use App\Http\Controllers\BuildingTenant\BuildingsTenantPasswordController;
use App\Http\Controllers\Building\PasswordChangeController;

use App\Http\Controllers\SchoolAdminController;
use App\Http\Controllers\SchoolAdmin\StudentSchoolController;
use App\Http\Controllers\SchoolAdmin\SecuritySchoolController;
use App\Http\Controllers\SchoolAdmin\TicketSchoolController;
use App\Http\Controllers\SchoolAdmin\SettingSchoolController;
use App\Http\Controllers\SchoolSecurity\SchoolSecurityController;
use App\Http\Controllers\SchoolSecurity\TicketSecuritySchool;
use App\Http\Controllers\SchoolSecurity\SettingSecuritySchool;
use App\Http\Controllers\SchoolSecurity\ReportSecuritySchool;
use App\Http\Controllers\SchoolSecurity\VisitorSecuritySchool;
use App\Http\Controllers\SchoolSecurity\MasterSecuritySchool;

use Illuminate\Support\Facades\Route;


Route::view('/', 'auth.boxed-signin');
Route::view('/analytics', 'analytics');
Route::view('/finance', 'finance');
Route::view('/crypto', 'crypto');

Route::view('/apps/chat', 'apps.chat');
Route::view('/apps/mailbox', 'apps.mailbox');
Route::view('/apps/todolist', 'apps.todolist');
Route::view('/apps/notes', 'apps.notes');
Route::view('/apps/scrumboard', 'apps.scrumboard');
Route::view('/apps/contacts', 'apps.contacts');
Route::view('/apps/calendar', 'apps.calendar');

Route::view('/apps/invoice/list', 'apps.invoice.list');
Route::view('/apps/invoice/preview', 'apps.invoice.preview');
Route::view('/apps/invoice/add', 'apps.invoice.add');
Route::view('/apps/invoice/edit', 'apps.invoice.edit');

Route::view('/components/tabs', 'ui-components.tabs');
Route::view('/components/accordions', 'ui-components.accordions');
Route::view('/components/modals', 'ui-components.modals');
Route::view('/components/cards', 'ui-components.cards');
Route::view('/components/carousel', 'ui-components.carousel');
Route::view('/components/countdown', 'ui-components.countdown');
Route::view('/components/counter', 'ui-components.counter');
Route::view('/components/sweetalert', 'ui-components.sweetalert');
Route::view('/components/timeline', 'ui-components.timeline');
Route::view('/components/notifications', 'ui-components.notifications');
Route::view('/components/media-object', 'ui-components.media-object');
Route::view('/components/list-group', 'ui-components.list-group');
Route::view('/components/pricing-table', 'ui-components.pricing-table');
Route::view('/components/lightbox', 'ui-components.lightbox');

Route::view('/elements/alerts', 'elements.alerts');
Route::view('/elements/avatar', 'elements.avatar');
Route::view('/elements/badges', 'elements.badges');
Route::view('/elements/breadcrumbs', 'elements.breadcrumbs');
Route::view('/elements/buttons', 'elements.buttons');
Route::view('/elements/buttons-group', 'elements.buttons-group');
Route::view('/elements/color-library', 'elements.color-library');
Route::view('/elements/dropdown', 'elements.dropdown');
Route::view('/elements/infobox', 'elements.infobox');
Route::view('/elements/jumbotron', 'elements.jumbotron');
Route::view('/elements/loader', 'elements.loader');
Route::view('/elements/pagination', 'elements.pagination');
Route::view('/elements/popovers', 'elements.popovers');
Route::view('/elements/progress-bar', 'elements.progress-bar');
Route::view('/elements/search', 'elements.search');
Route::view('/elements/tooltips', 'elements.tooltips');
Route::view('/elements/treeview', 'elements.treeview');
Route::view('/elements/typography', 'elements.typography');

Route::view('/charts', 'charts');
Route::view('/widgets', 'widgets');
Route::view('/font-icons', 'font-icons');
Route::view('/dragndrop', 'dragndrop');

Route::view('/tables', 'tables');

Route::view('/datatables/advanced', 'datatables.advanced');
Route::view('/datatables/alt-pagination', 'datatables.alt-pagination');
Route::view('/datatables/basic', 'datatables.basic');
Route::view('/datatables/checkbox', 'datatables.checkbox');
Route::view('/datatables/clone-header', 'datatables.clone-header');
Route::view('/datatables/column-chooser', 'datatables.column-chooser');
Route::view('/datatables/export', 'datatables.export');
Route::view('/datatables/multi-column', 'datatables.multi-column');
Route::view('/datatables/multiple-tables', 'datatables.multiple-tables');
Route::view('/datatables/order-sorting', 'datatables.order-sorting');
Route::view('/datatables/range-search', 'datatables.range-search');
Route::view('/datatables/skin', 'datatables.skin');
Route::view('/datatables/sticky-header', 'datatables.sticky-header');

Route::view('/forms/basic', 'forms.basic');
Route::view('/forms/input-group', 'forms.input-group');
Route::view('/forms/layouts', 'forms.layouts');
Route::view('/forms/validation', 'forms.validation');
Route::view('/forms/input-mask', 'forms.input-mask');
Route::view('/forms/select2', 'forms.select2');
Route::view('/forms/touchspin', 'forms.touchspin');
Route::view('/forms/checkbox-radio', 'forms.checkbox-radio');
Route::view('/forms/switches', 'forms.switches');
Route::view('/forms/wizards', 'forms.wizards');
Route::view('/forms/file-upload', 'forms.file-upload');
Route::view('/forms/quill-editor', 'forms.quill-editor');
Route::view('/forms/markdown-editor', 'forms.markdown-editor');
Route::view('/forms/date-picker', 'forms.date-picker');
Route::view('/forms/clipboard', 'forms.clipboard');

Route::view('/users/profile', 'users.profile');
Route::view('/users/user-account-settings', 'users.user-account-settings');

Route::view('/pages/knowledge-base', 'pages.knowledge-base');
Route::view('/pages/contact-us-boxed', 'pages.contact-us-boxed');
Route::view('/pages/contact-us-cover', 'pages.contact-us-cover');
Route::view('/pages/faq', 'pages.faq');
Route::view('/pages/coming-soon-boxed', 'pages.coming-soon-boxed');
Route::view('/pages/coming-soon-cover', 'pages.coming-soon-cover');
Route::view('/pages/error404', 'pages.error404');
Route::view('/pages/error500', 'pages.error500');
Route::view('/pages/error503', 'pages.error503');
Route::view('/pages/maintenence', 'pages.maintenence');

Route::view('/auth/boxed-lockscreen', 'auth.boxed-lockscreen');
Route::view('/auth/boxed-signin', 'auth.boxed-signin');
Route::view('/auth/boxed-signup', 'auth.boxed-signup');
Route::view('/auth/boxed-password-reset', 'auth.boxed-password-reset');
Route::view('/auth/cover-login', 'auth.cover-login');
Route::view('/auth/cover-register', 'auth.cover-register');
Route::view('/auth/cover-lockscreen', 'auth.cover-lockscreen');
Route::view('/auth/cover-password-reset', 'auth.cover-password-reset');

//----------------Project Start-------------------------------------//

Route::middleware(['auth:superadmin'])->group(function () {
    Route::get('/dashboard', [SuperAdminController::class, 'dashboard'])->name('super-admin.dashboard');
});

Route::post('/login', [SuperAdminController::class, 'login'])->name('super-admin.login');

Route::post('/super-admin/email-setup', [SettingController::class, 'store'])->name('email.setup.store');
Route::post('/super-admin/update-password', [SettingController::class, 'update_password'])->name('superadmin.update_password');
Route::post('/super-admin/reset-key', [SettingController::class, 'update_key'])->name('super-admin.reset.key');

Route::post('/super-admin/profile/update', [SettingController::class, 'updateProfile'])->name('super-admin.profile.update');

Route::post('/super-admin/building-store', [BuildingController::class, 'store'])->name('super-admin.building-store');
Route::put('/super-admin/building-update/{id}', [BuildingController::class, 'update_building'])->name('super-admin.building-update');
Route::patch('/super-admin/building-status/{id}', [BuildingController::class, 'statusUpdate'])->name('super-admin.building-status');
Route::patch('/super-admin/school-status/{id}', [SchoolController::class, 'statusUpdate'])->name('super-admin.school-status');







Route::get('/super-admin/school-create', [SchoolController::class, 'create_school'])->name('super-admin.school-create');
Route::get('/super-admin/school-index', [SchoolController::class, 'index_school'])->name('super-admin.school-index');
Route::get('/super-admin/school-edit/{id}', [SchoolController::class, 'edit_school'])->name('super-admin.school-edit');
Route::get('/super-admin/building-index', [BuildingController::class, 'index_building'])->name('super-admin.building-index');
Route::get('/super-admin/building-create', [BuildingController::class, 'create_building'])->name('super-admin.building-create');
Route::get('/super-admin/building-edit/{id}', [BuildingController::class, 'edit_building'])->name('super-admin.building-edit');
Route::get('/super-admin/ticket-dashboard', [TicketController::class, 'dashboard'])->name('super-admin.ticket-dashboard');
Route::get('/super-admin/new-ticket', [TicketController::class, 'new_ticket'])->name('super-admin.new-ticket');
Route::get('/super-admin/open-ticket', [TicketController::class, 'open_ticket'])->name('super-admin.open-ticket');
Route::get('/super-admin/hold-ticket', [TicketController::class, 'hold_ticket'])->name('super-admin.hold-ticket');
Route::get('/super-admin/close-ticket', [TicketController::class, 'close_ticket'])->name('super-admin.close-ticket');
Route::get('/super-admin/setting/email', [SettingController::class, 'email'])->name('super-admin.setting.email');
Route::get('/super-admin/setting/reset-password', [SettingController::class, 'password_reset'])->name('super-admin.setting.reset-password');
Route::get('/super-admin/setting/profile', [SettingController::class, 'profile'])->name('super-admin.setting.profile');
Route::get('/super-admin/setting/profile-form', [SettingController::class, 'profile_form'])->name('super-admin.setting.profile-form');
Route::get('/super-admin/setting/reset-key', [SettingController::class, 'key_reset'])->name('super-admin.setting.reset-key');





//Building Admin
Route::view('/building_admin', 'auth.building-signin');
Route::view('/building-security', 'auth.building-security-signin');

Route::view('/building-tenant', 'auth.building-tenant-signin');
Route::get('/building/dashboard', [BuildingsController::class, 'dashboard'])->name('building.dashboard');

Route::get('/building-admin/tenant-create', [TenantController::class, 'create_tenant'])->name('building-admin.tenant-create');
Route::get('/building-admin/tenant-index', [TenantController::class, 'index_tenant'])->name('building-admin.tenant-index');
Route::get('/building-admin/tenant-edit', [TenantController::class, 'edit_tenant'])->name('building-admin.tenant-edit');

Route::get('/building-admin/sub-tenant', [TenantController::class, 'sub_tenant_index'])->name('building-admin.sub-tenant');
Route::get('/building-admin/visitor-log', [TenantController::class, 'visitor_log_index'])->name('building-admin.visitor-log');
Route::get('/building-admin/password-reset', [PasswordChangeController::class, 'password_reset'])->name('building-admin.password-reset');

Route::get('/building-admin/key-reset', [KeyChangeController::class, 'key_reset'])->name('building-admin.key-reset');

Route::get('/building-admin/profile', [ProfileController::class, 'profile'])->name('building-admin.profile.profile');
Route::get('/building-admin/profile-form', [ProfileController::class, 'profile_form'])->name('building-admin.profile.profile-form');

Route::get('/building-admin/security-create', [SecurityController::class, 'create_security'])->name('building-admin.security-create');
Route::get('/building-admin/security-index', [SecurityController::class, 'index_security'])->name('building-admin.security-index');
Route::get('/building-admin/security-edit', [SecurityController::class, 'edit_security'])->name('building-admin.security-edit');

Route::get('/building-admin/ticket-dashboard', [BuildingTicketController::class, 'dashboard'])->name('building-admin.ticket-dashboard');
Route::get('/building-admin/new-ticket', [BuildingTicketController::class, 'new_ticket'])->name('building-admin.new-ticket');
Route::get('/building-admin/open-ticket', [BuildingTicketController::class, 'open_ticket'])->name('building-admin.open-ticket');

Route::get('/building-admin/hold-ticket', [security::class, 'hold_ticket'])->name('building-admin.hold-ticket');

Route::get('/building-admin/close-ticket', [BuildingTicketController::class, 'close_ticket'])->name('building-admin.close-ticket');
Route::get('/building-admin/hold-ticket', [BuildingTicketController::class, 'hold_ticket'])->name('building-admin.hold-ticket');
Route::get('/building-admin/myTicket-create', [BuildingTicketController::class, 'create_MyTicket'])->name('building-admin.myTicket-create');
Route::get('/building-admin/myTicket-index', [BuildingTicketController::class, 'index_MyTicket'])->name('building-admin.myTicket-index');

Route::get('/building-security/dashboard', [BuildingsSecurityController::class, 'dashboard'])->name('building-security.dashboard');
Route::get('/building-security/visitor-create', [BuildingsSecurityVisitorController::class, 'create_visitor'])->name('building-security.visitor-create');
Route::get('/building-security/visitor-index', [BuildingsSecurityVisitorController::class, 'index_visitor'])->name('building-security.visitor-index');
Route::get('/building-security/tenant-index', [BuildingsSecurityTenantController::class, 'index_tenant'])->name('building-security.tenant-index');
Route::get('/building-security/security-index', [BuildingsSecuritySecController::class, 'index_security'])->name('building-security.security-index');

Route::get('/building-security/visitor-log', [BuildingsSecuritySecController::class, 'index_visitor_log'])->name('building-security.visitor-log');
Route::get('/building-security/sub-tenant', [BuildingsSecuritySecController::class, 'index_sub_tenant'])->name('building-security.sub-tenant');

Route::get('/building-security/profile', [BuildingsSecurityProfileController::class, 'profile'])->name('building-security.profile');
Route::get('/building-security/profile-form', [BuildingsSecurityProfileController::class, 'profile_form'])->name('building-security.profile-form');
Route::get('/building-security/password-reset', [BuildingsSecurityPasswordController::class, 'password_reset'])->name('building-security.password-reset');

Route::get('/building-security/ticket-dashboard', [BuildingsSecurityTicketController::class, 'dashboard'])->name('building-security.ticket-dashboard');
Route::get('/building-security/new-ticket', [BuildingsSecurityTicketController::class, 'new_ticket'])->name('building-security.new-ticket');
Route::get('/building-security/open-ticket', [BuildingsSecurityTicketController::class, 'open_ticket'])->name('building-security.open-ticket');
Route::get('/building-security/hold-ticket', [BuildingsSecurityTicketController::class, 'hold_ticket'])->name('building-security.hold-ticket');
Route::get('/building-security/close-ticket', [BuildingsSecurityTicketController::class, 'close_ticket'])->name('building-security.close-ticket');
Route::get('/building-security/myTicket-create', [BuildingsSecurityTicketController::class, 'create_MyTicket'])->name('building-security.myTicket-create');
Route::get('/building-security/myTicket-index', [BuildingsSecurityTicketController::class, 'index_MyTicket'])->name('building-security.myTicket-index');
Route::get('/building-tenant/dashboard', [BuildingsTenantController::class, 'dashboard'])->name('building-tenant.dashboard');
Route::get('/building-tenant/visitor-create', [BuildingsTenantVisitorController::class, 'create_visitor'])->name('building-tenant.visitor-create');
Route::get('/building-tenant/visitor-index', [BuildingsTenantVisitorController::class, 'index_visitor'])->name('building-tenant.visitor-index');
Route::get('/building-tenant/tenant-index', [BuildingsTenantTenController::class, 'index_tenant'])->name('building-tenant.tenant-index');
Route::get('/building-tenant/security-index', [BuildingsTenantSecurityController::class, 'index_security'])->name('building-tenant.security-index');

Route::get('/building-tenant/sub-tenant', [BuildingsTenantSecurityController::class, 'index_sub_tenant'])->name('building-tenant.sub-tenant');
Route::get('/building-tenant/sub-tenant-create', [BuildingsTenantSecurityController::class, 'create_sub_tenant'])->name('building-tenant.sub-tenant-create');

Route::get('/building-tenant/visitor-log', [BuildingsTenantSecurityController::class, 'index_visitor_log'])->name('building-tenant.visitor-log');
Route::get('/building-tenant/ticket-dashboard', [BuildingsTenantTicketController::class, 'dashboard'])->name('building-tenant.ticket-dashboard');
Route::get('/building-tenant/new-ticket', [BuildingsTenantTicketController::class, 'new_ticket'])->name('building-tenant.new-ticket');
Route::get('/building-tenant/open-ticket', [BuildingsTenantTicketController::class, 'open_ticket'])->name('building-tenant.open-ticket');
Route::get('/building-tenant/hold-ticket', [BuildingsTenantTicketController::class, 'hold_ticket'])->name('building-tenant.hold-ticket');
Route::get('/building-tenant/close-ticket', [BuildingsTenantTicketController::class, 'close_ticket'])->name('building-tenant.close-ticket');

Route::get('/building-tenant/myTicket-create', [BuildingsTenantTicketController::class, 'create_MyTicket'])->name('building-tenant.myTicket-create');
Route::get('/building-tenant/myTicket-index', [BuildingsTenantTicketController::class, 'index_MyTicket'])->name('building-tenant.myTicket-index');
Route::get('/building-tenant/profile', [BuildingsTenantProfileController::class, 'profile'])->name('building-tenant.profile');
Route::get('/building-tenant/profile-form', [BuildingsTenantProfileController::class, 'profile_form'])->name('building-tenant.profile-form');
Route::get('/building-tenant/password-reset', [BuildingsTenantPasswordController::class, 'password_reset'])->name('building-tenant.password-reset');

//----School Admin-----------//


Route::view('/school_admin', 'auth.school-signin');
Route::get('/school/dashboard', [SchoolAdminController::class, 'dashboard'])->name('school.dashboard');
Route::get('/school/student/create', [StudentSchoolController::class, 'student_create'])->name('school.student.create');
Route::get('/school/student/index', [StudentSchoolController::class, 'student_index'])->name('school.student.index');
Route::get('/school/security/create', [SecuritySchoolController::class, 'security_create'])->name('school.security.create');
Route::get('/school/security/index', [SecuritySchoolController::class, 'security_index'])->name('school.security.index');
Route::get('/school/security/edit', [SecuritySchoolController::class, 'security_edit'])->name('school.security.edit');
Route::get('/school-admin/visitor-log', [SchoolAdminController::class, 'visitor_log'])->name('school-admin.visitor-log');
Route::get('/school-admin/hold-ticket', [TicketSchoolController::class, 'holdticket_school'])->name('school-admin.hold-ticket');
Route::get('/school-admin/new-ticket', [TicketSchoolController::class, 'newticket_school'])->name('school-admin.new-ticket');
Route::get('/school-admin/open-ticket', [TicketSchoolController::class, 'openticket_school'])->name('school-admin.open-ticket');
Route::get('/school-admin/close-ticket', [TicketSchoolController::class, 'closeticket_school'])->name('school-admin.close-ticket');
Route::get('/school-admin/my-ticket-index', [TicketSchoolController::class, 'myticket_school_index'])->name('school-admin.my-ticket-index');
Route::get('/school-admin/my-ticket-create', [TicketSchoolController::class, 'myticket_school_create'])->name('school-admin.my-ticket-create');
Route::get('/school-admin/dashboard-ticket', [TicketSchoolController::class, 'dashboard'])->name('school-admin.dashboard-ticket');
Route::get('/school-admin/setting/profile', [SettingSchoolController::class, 'profile'])->name('school-admin.setting.profile');
Route::get('/school-admin/setting/profile-form', [SettingSchoolController::class, 'profile_form'])->name('school-admin.setting.profile');
Route::get('/school-admin/setting/email', [SettingSchoolController::class, 'email'])->name('school-admin.setting.email');
Route::get('/school-admin/setting/reset-key', [SettingSchoolController::class, 'reset_key'])->name('school-admin.setting.reset-key');
Route::get('/school-admin/setting/reset-password', [SettingSchoolController::class, 'reset_password'])->name('school-admin.setting.reset-password');


//----School Security------

Route::view('/school/security', 'auth.school-security-signin');
Route::get('/school/security/dashboard', [SchoolSecurityController::class, 'dashboard'])->name('school.security.dashboard');
Route::get('/school/security/dashboard-ticket', [TicketSecuritySchool::class, 'dashboard'])->name('school.security.dashboard-ticket');
Route::get('/school/security/new-ticket', [TicketSecuritySchool::class, 'newticket_security'])->name('school.security.new-ticket');
Route::get('/school/security/open-ticket', [TicketSecuritySchool::class, 'openticket_security'])->name('school.security.open-ticket');
Route::get('/school/security/hold-ticket', [TicketSecuritySchool::class, 'holdticket_security'])->name('school.security.hold-ticket');
Route::get('/school/security/close-ticket', [TicketSecuritySchool::class, 'closeticket_security'])->name('school.security.close-ticket');
Route::get('/school/security/my-ticket-index', [TicketSecuritySchool::class, 'myticket_school_index'])->name('school.security.my-ticket-index');
Route::get('/school/security/my-ticket-create', [TicketSecuritySchool::class, 'myticket_school_create'])->name('school.security.my-ticket-create');
Route::get('/school/security/setting/profile', [SettingSecuritySchool::class, 'profile'])->name('school.security.setting.profile');
Route::get('/school/security/setting/profile-form', [SettingSecuritySchool::class, 'profile_form'])->name('school.security.setting.profile-form');
Route::get('/school/security/setting/reset-password', [SettingSecuritySchool::class, 'reset_password'])->name('school.security.setting.reset-password');
Route::get('/school/security/report/sub-tenant', [ReportSecuritySchool::class, 'sub_tenant'])->name('school.security.report.sub-tenant');
Route::get('/school/security/report/visitor-log', [ReportSecuritySchool::class, 'visitor_log'])->name('school.security.report.visitor-log');
Route::get('/school/security/visitor/create', [VisitorSecuritySchool::class, 'create'])->name('school.security.visitor.create');
Route::get('/school/security/visitor/index', [VisitorSecuritySchool::class, 'index'])->name('school.security.visitor.index');
Route::get('/school/security/master/tenant-index', [MasterSecuritySchool::class, 'tenant_index'])->name('school.security.master.tenant-index');
Route::get('/school/security/master/security-index', [MasterSecuritySchool::class, 'security_index'])->name('school.security.master.security-index');
