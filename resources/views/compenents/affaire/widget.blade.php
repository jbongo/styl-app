<div class="col-lg-12">
        <div class="col-lg-4">
           <div class="card bg-success">
              <div class="stat-widget-six">
                 <div class="stat-icon">
                    <i class="ti-shopping-cart"></i>
                 </div>
                 <div class="stat-content">
                    <div class="text-left dib">
                       <div class="stat-heading"><strong>Offres d'achat</strong></div>
                       <div class="stat-text"><strong>Total: {{count($offre)}}</strong></div>
                    </div>
                 </div>
              </div>
           </div>
        </div>
        <div class="col-lg-4">
           <div class="card bg-danger">
              <div class="stat-widget-six">
                 <div class="stat-icon">
                    <i class="material-icons">streetview</i>
                 </div>
                 <div class="stat-content">
                    <div class="text-left dib">
                       <div class="stat-heading"><strong>Visites du bien</strong></div>
                       <div class="stat-text"><strong>Total: {{count($bien->visites)}}</strong></div>
                    </div>
                 </div>
              </div>
           </div>
        </div>
        <div class="col-lg-4">
           <div class="card bg-pink">
              <div class="stat-widget-six">
                 <div class="stat-icon">
                    <i class="material-icons">call</i>
                 </div>
                 <div class="stat-content">
                    <div class="text-left dib">
                       <div class="stat-heading"><strong>Appels reçus</strong></div>
                       <div class="stat-text"><strong>Total: {{count($bien->appels)}}</strong></div>
                    </div>
                 </div>
              </div>
           </div>
        </div>
     </div>