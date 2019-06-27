<?php

namespace App\Providers;

use App\User;
use App\Policies\RolePolicy;
// use Laravel\Passport\Passport;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Role' => 'App\Policies\RolePolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        $this->registerCustomersProjectPolicies();
        $this->registerAdminsPolicies();
        $this->registerCustomersPolicies();
        $this->registerAdminmenuPolicies();
        $this->Departments();
        $this->Designation();
        $this->Preferences();
        $this->Generalsettings();
        $this->logs();
        // Passport::routes();

    }
    // Logs
    public function logs(){
        Gate::define('activitylogs', function($user){
            return $user->hasAccess(['activitylogs']);
        });
    }
    //For chat
    public function chatPolicies(){
        
        Gate::define('chat-view', function($user){
            return $user->hasAccess(['chat-view']);
        });
        Gate::define('create-chat-groups', function($user){
            return $user->hasAccess(['create-chat-groups']);
        });

        Gate::define('chat-add-new-chat-single', function($user){
            return $user->hasAccess(['chat-add-new-chat-single']);
        });
     
    }

    //General Settings
    public function Generalsettings(){
        Gate::define('attendance-exception', function($user){
            return $user->hasAccess(['attendance-exception']);
        });
        
    }
    
    //Preferences
    public function Preferences(){
    
        Gate::define('preferences-index', function($user){
            return $user->hasAccess(['preferences-index']);
        });

        Gate::define('create-preference', function($user){
            return $user->hasAccess(['create-preference']);
        });

        Gate::define('edit-preference', function($user){
            return $user->hasAccess(['edit-preference']);
        });

        Gate::define('delete-preference', function($user){
            return $user->hasAccess(['delete-preference']);
        });
    }

    //Departments
    public function Designation(){
    
        Gate::define('designations-index', function($user){
            return $user->hasAccess(['designations-index']);
        });

        Gate::define('create-designation', function($user){
            return $user->hasAccess(['create-designation']);
        });

        Gate::define('edit-designation', function($user){
            return $user->hasAccess(['edit-designation']);
        });

        Gate::define('status-designation', function($user){
            return $user->hasAccess(['status-designation']);
        });

        Gate::define('delete-designation', function($user){
            return $user->hasAccess(['delete-designation']);
        });
    }
    //Departments
    public function Departments(){
    
        Gate::define('departments-index', function($user){
            return $user->hasAccess(['departments-index']);
        });

        Gate::define('create-department', function($user){
            return $user->hasAccess(['create-department']);
        });

        Gate::define('edit-department', function($user){
            return $user->hasAccess(['edit-department']);
        });

        Gate::define('status-department', function($user){
            return $user->hasAccess(['status-department']);
        });

        Gate::define('delete-department', function($user){
            return $user->hasAccess(['delete-department']);
        });
    }

    //Admin Menu
    public function registerAdminmenuPolicies(){
    
        Gate::define('menu-index', function($user){
            return $user->hasAccess(['menu-index']);
        });

    }

    //Project
    public function registerCustomersProjectPolicies(){
       
        Gate::define('customer-projects-index', function($user){
            return $user->hasAccess(['customer-projects-index']);
        });

        Gate::define('customer-fetch-projects', function($user){
            return $user->hasAccess(['customer-fetch-projects']);
        });

        Gate::define('customer-show-projects', function($user){
            return $user->hasAccess(['customer-show-projects']);
        });
    }

   
    //Sub Admins
    public function registerAdminsPolicies(){

         //New Staff Detail Page Permission Set By Kabeer
        Gate::define('view-presentAddress', function($user){
            return $user->hasAccess(['view-presentAddress']);
        });
        Gate::define('view-permanentAddress', function($user){
            return $user->hasAccess(['view-permanentAddress']);
        });
        Gate::define('view-gaurdianInfo', function($user){
            return $user->hasAccess(['view-gaurdianInfo']);
        });
        Gate::define('view-personalContact', function($user){
            return $user->hasAccess(['view-personalContact']);
        });
        Gate::define('view-UserDepartmentRole', function($user){
            return $user->hasAccess(['view-UserDepartmentRole']);
        });
        Gate::define('view-userAccountInfo', function($user){
            return $user->hasAccess(['view-userAccountInfo']);
        });
        Gate::define('view-otherInfoSettings', function($user){
            return $user->hasAccess(['view-otherInfoSettings']);
        });
        Gate::define('view-attendance', function($user){
            return $user->hasAccess(['view-attendance']);
        });
        Gate::define('view-adjustments', function($user){
            return $user->hasAccess(['view-adjustments']);
        });

        Gate::define('admins-index', function($user){
            return $user->hasAccess(['admins-index']);
        });

        Gate::define('create-staff', function($user){
            return $user->hasAccess(['create-staff']);
        });

        Gate::define('edit-staff', function($user){
            return $user->hasAccess(['edit-staff']);
        });

        Gate::define('status-staff', function($user){
            return $user->hasAccess(['status-staff']);
        });

        Gate::define('show-staff', function($user){
            return $user->hasAccess(['show-staff']);
        });
        
        Gate::define('delete-staff', function($user){
            return $user->hasAccess(['delete-staff']);
        });

        /* To update staff check if required
        Gate::define('edit-staff', function($user, \App\User $user){
            return $user->hasAccess(['edit-staff']) or $user->id==$lead->user_id;
        });
        */

        Gate::define('staff-reset-password', function($user){
            return $user->hasAccess(['staff-reset-password']);
        });

        Gate::define('edit-staff-attendance', function($user){
            return $user->hasAccess(['edit-staff-attendance']);
        });


    }

    //Customers
    public function registerCustomersPolicies(){
        Gate::define('customers-index', function($user){
            return $user->hasAccess(['customers-index']);
        });

        Gate::define('create-customer', function($user){
            return $user->hasAccess(['create-customer']);
        });

        Gate::define('edit-customer', function($user){
            return $user->hasAccess(['edit-customer']);
        });

        Gate::define('status-customer', function($user){
            return $user->hasAccess(['status-customer']);
        });

        Gate::define('show-customer', function($user){
            return $user->hasAccess(['show-customer']);
        });
        
        Gate::define('delete-customer', function($user){
            return $user->hasAccess(['delete-customer']);
        });

        /* To update staff check if required
        Gate::define('edit-staff', function($user, \App\User $user){
            return $user->hasAccess(['edit-staff']) or $user->id==$lead->user_id;
        });
        */

        Gate::define('reset-customer-password', function($user){
            return $user->hasAccess(['reset-customer-password']);
        });

    }

}
