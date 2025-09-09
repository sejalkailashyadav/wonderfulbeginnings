<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;
use App\Http\Controllers\CenterMonthReportController;
use App\Models\UserManagements;
use App\Http\Controllers\{
    ProgramGenController,
    ReportController,
    CenterReportController,
    ClassMasterController,
    CurrentFeesMasterController,
    CurrentChildMasterController,
    CenterManagementController,
    FeesMasterController,
    UserManagementController,
    ChildMasterController,
    ProgramMasterController,
    CenterReportInlineEditController,
     WaitingListController,
     CronController,
     EmployeeMasterController,
     EmployeeWaitingListController,
     NotificationController,
     CreateManagerController
};


// Manager can only access their center; Admin can access all commest 
// Route::get('/current-child-masters/{center_id?}', [CurrentChildMasterController::class, 'index'])
//     ->middleware('centerCheck');


// Route::get('/center-month-reports/view/{center_id}/{report_month}', [CenterMonthReportController::class, 'showChildReportsByMonth'])
//     ->middleware('centerCheck');
//      Route::resource('current-child-masters', CurrentChildMasterController::class);
     
     
// ------------------- Public Routes -------------------
    // Route::resource('employee_masters', EmployeeMasterController::class);

                 Route::get('employee_masters/create', [EmployeeMasterController::class, 'create'])->name('employee_masters.create');
                 Route::post('employee_masters', [EmployeeMasterController::class, 'store'])->name('employee_masters.store');
                Route::get('employee_masters/{employee}/edit', [EmployeeMasterController::class, 'edit'])->name('employee_masters.edit');

                Route::get('waiting-lists/create', [WaitingListController::class, 'create'])->name('waiting-lists.create');
                Route::post('waiting-lists', [WaitingListController::class, 'store'])->name('waiting-lists.store');

              
                
            Route::get('/', fn() => view('login'));
            
            Route::get('/login', fn() => view('login'))->name('login');
            
            Route::get('/fix-laravel', function () {
                Artisan::call('optimize:clear');
                Artisan::call('config:clear');
                Artisan::call('cache:clear');
                Artisan::call('view:clear');
                Artisan::call('route:clear');
                return 'laravel cleared!';
            });
            
             
                //empoyee manmenst accessiable to admin only 
                    //  Route::resource('waiting-lists', WaitingListController::class);


            Route::post('/do-login', function (Request $request) {
                $user = UserManagements::where('user_name', $request->user_name)
                    ->where('password', $request->password)
                    ->where('user_status', 'Active')
                    ->first();
            
                if ($user) {
                    Session::put('user', $user);
                    return redirect('/dashboard');
                }
            
                return back()->with('error', 'Invalid credentials');
            })->name('doLogin');
            
                Route::get('/logout', function () {
                    Session::forget('user');
                    return redirect('/login');
                })->name('logout');
         
                // Route::resource('waiting-lists', WaitingListController::class);
                
                
                 Route::resource('create-manger', CreateManagerController::class);
                    Route::resource('employee_waitlist', EmployeeWaitingListController::class);
                 //cron job 
                 Route::get('/cron/archive-withdrawals', [CronController::class, 'archiveWithdrawals']);
              
                

                
                //fress> center> class drodowen 
              // Route::get('/get-classes-by-center/{center_id}', [App\Http\Controllers\CurrentChildMasterController::class, 'getClassesByCenter']);
            // Route::get('/center-month-filter', [CenterMonthReportController::class, 'index'])->name('center.month.filter');
            // Route::post('/center-month-filter', [CenterMonthReportController::class, 'filterChildren'])->name('center.month.filter.submit');
            //   Route::get('monthly-report/{id}/edit', [CenterMonthReportController::class, 'edit'])->name('monthly-report.edit');
            // Route::put('monthly-report/{id}', [CenterMonthReportController::class, 'update'])->name('monthly-report.update');


  
          
          
          
// ------------------- Protected Routes -------------------

        Route::group(['middleware' => function ($request, $next) {
            if (!Session::has('user')) {
                return redirect()->route('login');
            }
            return $next($request);
        }], function () {
        
            Route::get('/dashboard', fn() => view('index'));
                 // Route::post('/get-fees-by-centers', [\App\Http\Controllers\CurrentChildMasterController::class, 'getFeesByCenters']);
               
               
               Route::get('waiting-lists/{id}/edit', [WaitingListController::class, 'edit'])->name('waiting-lists.edit');
Route::get('waiting-lists', [WaitingListController::class, 'index'])->name('waiting-lists.index');
Route::get('waiting-lists/{id}', [WaitingListController::class, 'show'])->name('waiting-lists.show');
Route::put('waiting-lists/{id}', [WaitingListController::class, 'update'])->name('waiting-lists.update');
Route::delete('waiting-lists/{id}', [WaitingListController::class, 'destroy'])->name('waiting-lists.destroy');


               //empl 
               
               
 Route::get('employee_masters', [EmployeeMasterController::class, 'index'])->name('employee_masters.index');
    Route::get('employee_masters/{employee}', [EmployeeMasterController::class, 'show'])->name('employee_masters.show');

    Route::put('employee_masters/{employee}', [EmployeeMasterController::class, 'update'])->name('employee_masters.update');
    Route::delete('employee_masters/{employee}', [EmployeeMasterController::class, 'destroy'])->name('employee_masters.destroy');

            
            //center code

            Route::resource('center-managements', CenterManagementController::class);
            Route::get('center-managements/{id}/gallery', [CenterManagementController::class, 'gallery'])->name('center_managements.gallery');
            Route::post('center-managements/{id}/gallery/upload', [CenterManagementController::class, 'uploadGallery'])->name('center_managements.gallery.upload');
            //gallery udpat eand delete
           Route::put('center-managements/{id}/gallery/{fileIndex}/update', [CenterManagementController::class, 'updateGallery'])->name('center_managements.gallery.update');

Route::delete('center-managements/{id}/gallery/{fileIndex}/delete', [CenterManagementController::class, 'deleteGallery'])->name('center_managements.gallery.delete');

            
            //class 
            
     
            Route::resource('class-masters', ClassMasterController::class);
            Route::get('child-masters/{id}/gallery', [ClassMasterController::class, 'gallery'])->name('class_masters.gallery');
            Route::post('child-masters/{id}/gallery/upload', [ClassMasterController::class, 'uploadGallery'])->name('class_masters.gallery.upload');
            
            Route::get('/class-masters/{class_id}/children', [ClassMasterController::class, 'showChildren'])->name('class_masters.children');
 Route::put('child-masters/{id}/gallery/{fileIndex}/update', [ClassMasterController::class, 'updateGallery'])->name('class_masters.gallery.update');

Route::delete('child-masters/{id}/gallery/{fileIndex}/delete', [ClassMasterController::class, 'deleteGallery'])->name('class_masters.gallery.delete');


            //chidl 
            
            
            Route::resource('current-child-masters', CurrentChildMasterController::class);
                  Route::get('/get-classes-by-center/{centerId}', [CurrentChildMasterController::class, 'getClassesByCenter']);
                  Route::get('/get-fees-by-center-and-class/{centerId}/{classId}', [CurrentChildMasterController::class, 'getFeesByCenterAndClass']);
                            Route::post('/current-child-masters/{id}/toggle-status', [CurrentChildMasterController::class, 'toggleStatus']);
                            Route::get('current-child-masters/{id}/edit', [CurrentChildMasterController::class, 'edit'])->name('current-child.edit');
                            Route::delete('current-child-masters/{id}', [CurrentChildMasterController::class, 'destroy'])->name('current-child.destroy');
                            Route::get('current-child-masters/{id}', [CurrentChildMasterController::class, 'show'])->name('current-child-masters.show');
                            Route::get('/current-get-child-programs/{centerId}', [CurrentChildMasterController::class, 'getPrograms']);
                            Route::post('/current-child-masters/filter', [CurrentChildMasterController::class, 'filter'])->name('current-child-masters.filter');
                    
                          //for status approve opf tat chidl-master -8-12 
                          
                        //   Route::put('/current-child-masters/{id}/approve', [CurrentChildMasterController::class, 'approve'])->name('child.approve');
                            Route::post('/current-child-masters/{id}/approve', [CurrentChildMasterController::class, 'approve'])->name('current-child.approve');
                          
                        Route::get('/get-fees-by-center/{center_id}', [App\Http\Controllers\CurrentChildMasterController::class, 'getFeesByCenter']);
          
              //  current-child routes
     
           //  Route::get('/get-classes-by-center/{center_id}', [CurrentChildMasterController::class, 'getClassesByCenter']); 
                 Route::get('/get-fees-by-center/{center_id}', [App\Http\Controllers\CurrentChildMasterController::class, 'getFeesByCenter']);
                 Route::get('/center-month-reports/export-csv', [CenterMonthReportController::class, 'exportCSV'])
                    ->name('center.month.reports.export.csv');
                    
                 Route::post('/get-fees-by-centers', [\App\Http\Controllers\CurrentChildMasterController::class, 'getFeesByCenters']);
            
            
            
            //reports 
            
            
            
      
          
                        // Show filter form
                        Route::get('/center-month-filter', [CenterMonthReportController::class, 'index'])->name('center.month.filter');
                        
                        // Handle form submission & show filtered child reports
                        Route::post('/center-month-filter', [CenterMonthReportController::class, 'filterChildren'])->name('center.month.filter.submit');
                        
                        // Edit individual child monthly report
                        Route::get('/monthly-report/{id}/edit', [CenterMonthReportController::class, 'edit'])->name('monthly-report.edit');
                        
                        // Update individual child monthly report
                        Route::put('/monthly-report/{id}', [CenterMonthReportController::class, 'update'])->name('monthly-report.update');
                        
                        // Export report to Excel
                        Route::get('/center-month-export-html', [CenterMonthReportController::class, 'exportHtmlExcel'])->name('center.month.export.html');
                        
                       
                        
                        Route::get('/monthly-report/{id}/view', [CenterMonthReportController::class, 'view'])->name('monthly-report.view');

                         Route::get('/center-month-export-html', [CenterMonthReportController::class, 'exportHtmlExcel'])->name('center.month.export.html');
                         //add listing 
                          Route::post('/center-month-report-listing', [CenterMonthReportController::class, 'listReportsByCenter'])
                         ->name('center.month.report.listing');
   
           
                             Route::get('/center-month-reports', [CenterMonthReportController::class, 'listAllReports'])->name('center.month.reports.list');
                             //export 
                             
                                Route::get('/center-month-reports/view/{center_id}/{report_month}', [CenterMonthReportController::class, 'showChildReportsByMonth'])->name('center.month.reports.view');
                    
                                Route::post('/monthly-report/bulk-update', [CenterMonthReportController::class, 'bulkUpdate'])->name('monthly-report.bulk-update');


       // Reports
            Route::get('/center-report', [CenterReportController::class, 'index'])->name('center.report');
            Route::get('/center-report/details', [CenterReportController::class, 'details'])->name('center-report.details');
        
        
                Route::get('/center-report-editor', [CenterReportInlineEditController::class, 'index'])->name('center.report.editor');
                Route::post('/center-report-editor/update', [CenterReportInlineEditController::class, 'update'])->name('center.report.editor.update');
        
          
            
        });  
     
        
        
            Route::get('/admin-section', fn() => view('admin'))->middleware('adminOnly');
        
            // Admin only
              Route::middleware('adminOnly')->group(function () {
                Route::resource('user-managements', UserManagementController::class);
                Route::resource('fees-masters', FeesMasterController::class);
                Route::resource('program-create', ProgramGenController::class);
             
         Route::resource('notifications', App\Http\Controllers\NotificationController::class);
         
            // Shared child routes
            Route::get('/get-child-programs/{centerId}', [ChildMasterController::class, 'getPrograms']);
            Route::get('get-days-by-center-program', [ChildMasterController::class, 'getDaysByCenterProgram']);
        
     
            // Program Master
            Route::get('/get-programs/{centerId}', [ProgramMasterController::class, 'getPrograms']);
            Route::get('/get-programs-by-center/{centerId}', [ProgramMasterController::class, 'getProgramsByCenter']);
        
            // Current Fees Master
                Route::prefix('current-fees-master')->name('current-fees-master.')->group(function () {
                Route::get('/', [CurrentFeesMasterController::class, 'index'])->name('index');
                Route::get('/create', [CurrentFeesMasterController::class, 'create'])->name('create');
                Route::post('/store', [CurrentFeesMasterController::class, 'store'])->name('store');
                Route::get('/edit/{id}', [CurrentFeesMasterController::class, 'edit'])->name('edit');
                Route::put('/update/{id}', [CurrentFeesMasterController::class, 'update'])->name('update');
                Route::delete('/delete/{id}', [CurrentFeesMasterController::class, 'destroy'])->name('destroy');
           
             
           
        
                Route::get('/get-classes-by-center/{centerId}', [App\Http\Controllers\CurrentFeesMasterController::class, 'getByCenter']);

                });
        
              });
              
                    
   

                        // Admin + Manager
       Route::middleware('adminOrManager')->group(function () {
                          
      
 });




