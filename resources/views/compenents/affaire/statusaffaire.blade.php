<div class="card alert nestable-cart">
    <div class="card-header">
       <h4><strong style="color:#2cabe0;">Progression de l'affaire</strong></h4>
       <div class="progress">
        @if($mandat->dossiervente->status === "offre")
            <div class="progress-bar progress-bar-warning w-20" role="progressbar" style="border-style: initial; border-radius: 10px;">
        @elseif($mandat->dossiervente->status === "debut")
            <div class="progress-bar progress-bar-danger w-20" role="progressbar" style="border-style: initial; border-radius: 10px;">
        @else
            <div class="progress-bar progress-bar-success w-20" role="progressbar" style="border-style: initial; border-radius: 10px;">
        @endif
             Sous offre
          </div>
          @if($mandat->dossiervente->status === "compromis")
            <div class="progress-bar progress-bar-warning w-20" role="progressbar" style="border-style: initial; border-radius: 10px;">
        @elseif($mandat->dossiervente->status === "offre" || $mandat->dossiervente->status === "debut")
            <div class="progress-bar progress-bar-danger w-20" role="progressbar" style="border-style: initial; border-radius: 10px;">
        @else
            <div class="progress-bar progress-bar-success w-20" role="progressbar" style="border-style: initial; border-radius: 10px;">
        @endif
             Bien sous compromis
          </div>
          @if($mandat->dossiervente->status === "compromis_signe")
            <div class="progress-bar progress-bar-warning w-20" role="progressbar" style="border-style: initial; border-radius: 10px;">
        @elseif($mandat->dossiervente->status === "compromis" || $mandat->dossiervente->status === "offre" || $mandat->dossiervente->status === "debut")
            <div class="progress-bar progress-bar-danger w-20" role="progressbar" style="border-style: initial; border-radius: 10px;">
        @else
            <div class="progress-bar progress-bar-success w-20" role="progressbar" style="border-style: initial; border-radius: 10px;">
        @endif
             Compromis signé
          </div>
          @if($mandat->dossiervente->status === "acte_signe")
            <div class="progress-bar progress-bar-warning w-20" role="progressbar" style="border-style: initial; border-radius: 10px;">
        @elseif($mandat->dossiervente->status === "compromis_signe" || $mandat->dossiervente->status === "compromis" || $mandat->dossiervente->status === "offre" || $mandat->dossiervente->status === "debut")
            <div class="progress-bar progress-bar-danger w-20" role="progressbar" style="border-style: initial; border-radius: 10px;">
        @else
            <div class="progress-bar progress-bar-success w-20" role="progressbar" style="border-style: initial; border-radius: 10px;">
        @endif
             Acte signé
          </div>
          @if($mandat->dossiervente->status === "acte_signe")
            <div class="progress-bar progress-bar-warning w-20" role="progressbar" style="border-style: initial; border-radius: 10px;">
        @elseif($mandat->dossiervente->status === "cloture")
            <div class="progress-bar progress-bar-success w-20" role="progressbar" style="border-style: initial; border-radius: 10px;">
        @else
            <div class="progress-bar progress-bar-danger w-20" role="progressbar" style="border-style: initial; border-radius: 10px;">
        @endif
             Bien vendu
          </div>
       </div>
    </div>
 </div>