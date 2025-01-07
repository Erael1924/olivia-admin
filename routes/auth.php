<?php
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\EmailTemplateController;
use App\Http\Controllers\BannersController;
use App\Http\Controllers\TicketsController;
use App\Http\Controllers\FaqsController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\GeneralSettingController;
use App\Http\Controllers\Reports\SalesReportController;
use App\Http\Controllers\Reports\CustomerInsightController;
use App\Http\Controllers\Reports\ProductPerformanceController;
use App\Http\Controllers\AccountSettingController;
use App\Http\Controllers\MessagesController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');

    Route::get('orders', [OrderController::class, 'view'])->name('orders');
    Route::get('return-orders', [OrderController::class, 'returnOrders'])->name('return-orders');
    Route::get('orders/view-order', [OrderController::class, 'orderDetails'])->name('view-order');

    Route::prefix('products')->group(function () {

        Route::controller(ProductController::class)->group(function () {
            Route::get('/', 'view')->name('products');
            Route::get('/view-product/{id}', 'viewProduct')->name('products.view-product');
            Route::get('/create-product', 'viewCreateProduct')->name('products.view-create');
            Route::post('/create-product', 'create')->name('products.create');
            Route::get('/update-product/{id}', 'viewUpdateProduct')->name('products.view-update');
            Route::put('/update-product/{id}', 'update')->name('products.update');

        });

        Route::controller(CategoryController::class)->prefix('category')->group(function () {
            Route::get('/', 'view')->name('products.category');
            Route::post('/create', 'create')->name('products.category.create');
            Route::put('/{id}', 'update')->name('products.category.update');
        });

        Route::controller(SubCategoryController::class)->prefix('sub-category')->group(function () {
            Route::get('/', 'view')->name('products.sub-category');
            Route::post('/create', 'create')->name('products.sub-category.create');
            Route::put('/{id}', 'update')->name('products.sub-category.update');
        });

        Route::controller(TagController::class)->prefix('tags')->group(function () {
            Route::get('/', 'view')->name('products.tags');
            Route::post('/create', 'create')->name('products.tags.create');
            Route::put('/{id}', 'update')->name('products.tags.update');
        });
    });

    Route::get('tag', [TagController::class, 'view'])->name('tag');

    Route::get('customers', [CustomerController::class, 'view'])->name('customers');

    Route::get('promotion/vouchers', [VoucherController::class, 'view'])->name('vouchers');

    Route::get('promotion/discounts', [DiscountController::class, 'view'])->name('discounts');

    Route::prefix('user_management')->group(function () {

        Route::controller(UserController::class)->prefix('users')->group(function () {
            Route::get('/', 'view')->name('users');
            Route::post('/create', 'create')->name('users.create');
            Route::put('/{id}', 'update')->name('users.update');
            Route::put('/{id}/reset-password', 'resetPassword')->name('users.reset');
        });

        Route::controller(RoleController::class)->prefix('roles')->group(function () {
            Route::get('/', 'view')->name('roles');
            Route::post('/create', 'create')->name('roles.create');
            Route::put('/{id}', 'update')->name('roles.update');
            Route::get('/permissions/{role}', 'permissions')->name('permissions');
            Route::put('/permissions/{role}', 'updatePermissions')->name('permissions.update');
        });
    });

    Route::prefix('content-management')->group(function () {
    });

    Route::get('content-management/site-pages', [PagesController::class, 'view'])->name('site-pages');
    Route::get('content-management/site-pages/create-site-page', [PagesController::class, 'createSitePage'])->name('create-site-page');
    Route::get('content-management/site-pages/update-site-page', [PagesController::class, 'editSitePage'])->name('update-site-page');


    Route::get('content-management/email-templates', [EmailTemplateController::class, 'view'])->name('email-templates');
    Route::get('content-management/email-templates/create-email-template', [EmailTemplateController::class, 'createEmailTemplate'])->name('create-email-template');
    Route::get('content-management/email-templates/edit-email-template', [EmailTemplateController::class, 'editEmailTemplate'])->name('update-email-template');

    Route::get('content-management/promo-banners', [BannersController::class, 'view'])->name('promo-banners');
    Route::get('content-management/collection-banners', [BannersController::class, 'collectionBanners'])->name('collection-banners');

    Route::get('help-center/support-tickets', [TicketsController::class, 'view'])->name('support-tickets');
    Route::get('help-center/support-tickets/ticket-information', [TicketsController::class, 'ticketInformation'])->name('ticket-information');

    Route::get('help-center/faqs', [FaqsController::class, 'view'])->name('faqs');
    Route::get('help-center/faqs/create-faq', [FaqsController::class, 'createFaq'])->name('create-faq');
    Route::get('help-center/faqs/update-faq', [FaqsController::class, 'updateFaq'])->name('update-faq');

    Route::prefix('settings')->group(function () {
        Route::controller(GeneralSettingController::class)->prefix('general-settings')->group(function () {
            Route::get('/', 'view')->name('general-settings');
            Route::post('/company-profile', 'companyProfile')->name('general-settings.company-profile');
            Route::post('/social-media', 'socialMedia')->name('general-settings.social-media');
            Route::post('/maintenance', 'maintenance')->name('general-settings.maintenance');
        });

        Route::get('/shipping-options', [ShippingController::class, 'view'])->name('shipping-options');

        Route::get('/payment-methods', [PaymentMethodController::class, 'view'])->name('payment-methods');
    });

    Route::get('reports/sales-report', [SalesReportController::class, 'view'])->name('sales-report');
    Route::get('reports/customer-insights', [CustomerInsightController::class, 'view'])->name('customer-insights');
    Route::get('reports/product-performance', [ProductPerformanceController::class, 'view'])->name('product-performance');

    Route::get('account_settings', [AccountSettingController::class, 'view'])->name('account-settings');

    Route::get('messages', [MessagesController::class, 'view'])->name('messages');


});
