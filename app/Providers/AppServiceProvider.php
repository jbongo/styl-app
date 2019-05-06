<?php
 
namespace App\Providers;
 
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Blade;
 
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(120);

       // directive admin
        Blade::if('admin', function(){
            return auth()->check() && auth()->user()->role === "admin";
        });

        // directive prospect_plus
        Blade::if('prospect_plus',function(){
            return auth()->check() &&  auth()->user()->role == "prospect_plus";
        });

        Blade::if('prospect_plus_no_annex5',function(){
            return auth()->check() &&  auth()->user()->role == "prospect_plus" && auth()->user()->bool_annex_5 == 0;
        });

        // directive prospect
        Blade::if('prospect',function(){
            return auth()->check() &&  auth()->user()->role == "prospect";
        });

        // directive mandataire
        Blade::if('mandataire',function(){
        return auth()->check() &&  auth()->user()->role == "mandataire";
        });

        // directive all but mandataire
        Blade::if('all_but_mandataire',function(){
        return auth()->check() &&  auth()->user()->role != "mandataire";
        });

        // directive formateur
        Blade::if('formateur',function(){
        return auth()->check() &&  auth()->user()->role == "formateur";
        });

        // directive intervenant
        Blade::if('intervenant',function(){
        return auth()->check() &&  auth()->user()->role == "intervenant";
        });

        // directive intervenant ou formateur ou admin
        Blade::if('admin_or_intervenant',function(){
            return auth()->check() && (auth()-> user()->role === "admin" || auth()-> user()->role === "intervenant"  || auth()-> user()->role === "formateur" );
        });

        // directive formateur ou admin
        Blade::if('admin_or_formateur',function(){
            return auth()->check() && (auth()-> user()->role === "admin" || auth()-> user()->role === "formateur" );
        });

        // directive formateur ou admin
        Blade::if('formateur_or_intervenant',function(){
            return auth()->check() && (auth()-> user()->role === "intervenant" || auth()-> user()->role === "formateur" );
        });

       // directive prospect ou prospect_plus
        Blade::if('prospect_or_plus',function(){
            return auth()->check() && (auth()-> user()->role === "prospect" || auth()-> user()->role === "prospect_plus"  );
        });

        // directive prospect_plus ou mandataire
        Blade::if('prospect_plus_or_mandataire',function(){
            return auth()->check() && (auth()-> user()->role === "prospect_plus" || auth()-> user()->role === "mandataire"  );
        });

        // directive admin ou personnel
        Blade::if('admin_or_personnel',function(){
            return auth()->check() && (auth()-> user()->role === "admin" || auth()-> user()->role === "personnel"  );
        });

        // directive  ni ( prospect ou prospect_plus )
        Blade::if('not_prospect_or_plus',function(){
            return auth()->check() && ( auth()-> user()->role !== "prospect" && auth()-> user()->role !== "prospect_plus");
        });

        // directive guest mandant
        Blade::if('guestmandant',function(){
            return auth()->check() && ( auth()->user()->role == "mandant");
        });

        // directive guest acquereur
        Blade::if('guestacquereur',function(){
            return auth('guestusers')->check() && ( auth()->user()->role == "acquereur");
        });

        // directive guest chercheur
        Blade::if('guestchercheur',function(){
            return auth('guestusers')->check() && ( auth()->user()->role == "chercheur");
        });
        
        // directive guest chercheur
        Blade::if('notguestchercheur',function(){
            return auth('guestusers')->check() && ( auth()->user()->role != "chercheur");
        });

    }
 
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}