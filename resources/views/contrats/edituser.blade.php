@extends('layouts.main.dashboard')
@extends('compenents.navbar')
@extends('compenents.header')
@section('content')
<div class="row">
<div class="col-lg-12">
   <div class="card">
      <div class="card-body">
         <div class="col-sm-8 col-md-offset-2">
            <div class="panel lobipanel-basic panel-warning">
               <div class="panel-heading">
                  <div class="panel-title">Informations du mandataire</div>
               </div>
               <div class="panel-body"> 
                  Vous pouvez ici modifier les informations du mandataire, cela ne génére pas d'avenant au contrat.
               </div>
            </div>
         </div>
         <div class="form-validation">
            <form class="form-valide2 form-horizontal" id="msform" action="{{ route('contrat.user.update', $user->id) }}" method="POST">
               {{ csrf_field() }}
               <!-- progressbar -->
               <div class="col-md-12 col-md-offset-2">
                  <ul  id="progressbar">
                     <li class="active">Informations de base</li>
                     <li>Informations professionnelles</li>
                  </ul>
                  </div
                  <!-- fieldsets -->
                  <fieldset>
                     <div class="col-lg-12">
                        <div class="panel lobipanel-basic panel-default">
                           <div class="panel-heading">
                              <div class="panel-title">Informations personnelles</div>
                           </div>
                           <div class="panel-body">
                              <div class="form-group">
                                 <label class="col-sm-4 control-label" for="choice-famille">Situation familialle<span class="text-danger">*</span></label>
                                 <div class="col-sm-4">
                                    <select class="js-select2 form-control" id="choice-marital" name="choice-marital" style="width: 100%;" data-placeholder="Choose one.." required>
                                       <option value="{{ $user->situation_matrimoniale}}" selected="selected" >{{ $user->situation_matrimoniale}}</option>
                                       <option value="En couple">En couple</option>
                                       <option value="Célibataire">Célibataire</option>
                                       <option value="Marié(e)">Marié(e)</option>
                                       <option value="Divorcé(e)">Divorcé(e)</option>
                                       <option value="Veuf(ve)">Veuf(ve)</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label class="col-sm-4 control-label" for="val-fille">Nom de jeune fille</label>
                                 <div class="col-sm-6">
                                    <input class="form-control" type="text" id="val-fille" name="val-fille" value="{{$user->nom_jeune_fille}}">
                                    <span class="help-block">
                                    <small>Laissez vide si absent.</small>
                                    </span>
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label class="col-sm-4 control-label" for="val-adress">Adresse <span class="text-danger">*</span></label>
                                 <div class="col-lg-6">
                                    <input type="text" class="form-control" value="{{$user->adresse}}" id="val-adress" name="val-adress" required>  
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label class="col-sm-4 control-label" for="val-compl_adress">Complément d'adresse</label>
                                 <div class="col-lg-6">
                                    <input type="text" id="val-compl_adress" class="form-control" value="{{$user->complement_adresse}}" name="val-compl_adress">
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label class="col-sm-4 control-label" for="val-ville">Ville</label>
                                 <div class="col-lg-6">
                                    <input type="text" id="val-ville" class="form-control" value="{{$user->ville}}" name="val-ville">
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label class="col-sm-4 control-label" for="val-zip">Code postal <span class="text-danger">*</span></label>
                                 <div class="col-lg-3">
                                    <input type="number" class="form-control" value="{{$user->code_postal}}" id="val-zip" name="val-zip" required>
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label class="col-sm-4 control-label" for="nationality-country">Nationalité<span class="text-danger">*</span></label>
                                 <div class="col-lg-3">
                                    <input class="form-control" id="nationality-country" name="nationality-country" type="text" value="{{$user->nationalite}}" required>
                                    <span class="help-block">
                                    <small>Modifiez si hors France.</small>
                                    </span>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <input type="button" name="next" class="next action-button" value="Suivant" />
                  </fieldset>
                  <fieldset>
                     <div class="col-lg-12">
                        <div class="panel lobipanel-basic panel-primary">
                           <div class="panel-heading">
                              <div class="panel-title">Informations de l'entreprise</div>
                           </div>
                           <div class="panel-body">
                              <div class="form-group">
                                 <label class="col-sm-4 control-label" for="choice-corporate">Statut juridique<span class="text-danger">*</span></label>
                                 <div class="col-sm-4">
                                    <select class="js-select2 form-control" id="choice-corporate" name="choice-corporate" style="width: 100%;" data-placeholder="Choose one.." required>
                                       <option value="{{ $user->statut_juridique}}" selected="selected" >{{ $user->statut_juridique}}</option>
                                       <option value="Administrateur">VRP</option>
                                       <option value="Portage salarial">Portage salarial</option>
                                       <option value="Autoentrepreneur">Autoentrepreneur</option>
                                       <option value="Agent commercial">Agent commercial</option>
                                       <option value="EI Entreprise individuelle">EI Entreprise individuelle</option>
                                       <option value="EIRL Entreprise individuelle à résponsabilité limitée">EIRL Entreprise individuelle à résponsabilité limitée</option>
                                       <option value="EURL unipersonnelle à résponsabilité limitée">EURL unipersonnelle à résponsabilité limitée</option>
                                       <option value="SASU Societé à action simplifiée unipersonnelle">SASU Societé à action simplifiée unipersonnelle</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label class="col-sm-4 control-label" for="siret">Numéro SIRET<span class="text-danger">*</span></label>
                                 <div class="col-sm-6">
                                    <input class="form-control" id="siret" name="siret" type="text" value="{{$user->numero_siret}}" required>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label class="col-sm-4 control-label" for="siren">Numéro SIREN<span class="text-danger">*</span></label>
                                 <div class="col-sm-6">
                                    <input class="form-control" id="siren" name="siren" type="text" value="{{$user->numero_siren}}" required>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label class="col-sm-4 control-label" for="naf" >Code NAF</label>
                                 <div class="col-sm-6">
                                    <input class="form-control" name="naf" id="naf" type="text" value="{{$user->code_caf}}">
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label class="col-sm-4 control-label" for="date-matricle">Date d'imatriculation<span class="text-danger">*</span></label>
                                 <div class="col-sm-6">
                                    <input class="form-control" id="date-matricle" name="date-matricle" type="date" value="{{$user->date_immatriculation}}" required>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="panel lobipanel-basic panel-dark">
                           <div class="panel-heading">
                              <div class="panel-title">Complément informations d'entreprise</div>
                           </div>
                           <div class="panel-body">
                              <div class="form-group">
                                 <label class="col-sm-4 control-label" for="tva">Numéro de TVA</label>
                                 <div class="col-sm-6">
                                    <input class="form-control" id="tva" name="tva" type="text" value="{{$user->numero_tva}}">
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label class="col-sm-4 control-label" for="rcs">Numéro RCS</label>
                                 <div class="col-sm-6">
                                    <input class="form-control" id="rcs" name="rcs" type="text" value="{{$user->numero_rcs}}">
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label class="col-sm-4 control-label" for="nom-legal">Nom légal de l'entreprise</label>
                                 <div class="col-sm-6">
                                    <input class="form-control" id="nom-legal" name="nom-legal" type="text" value="{{$user->nom_legal_entreprise}}">
                                    <span class="help-block">
                                    <small>Laissez vide si absence d'informations ou statut auto entrepreneur.</small>
                                    </span>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="panel lobipanel-basic panel-pink">
                           <div class="panel-heading">
                              <div class="panel-title">RSAC et assurance</div>
                           </div>
                           <div class="panel-body">
                              <div class="form-group row">
                                 <label class="col-sm-4 control-label" for="val-gref">Tribunal d'immatriculation <span class="text-danger">*</span></label>
                                 <div class="col-sm-6">
                                    <input class="form-control" type="text" id="val-gref" name="val-gref" value="{{$user->nom_organisme_delivrant_carte_pro}}" required>
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label class="col-sm-4 control-label" for="val-rsac">Numéro d'immatriculation RSAC <span class="text-danger">*</span></label>
                                 <div class="col-lg-6">
                                    <input type="text" class="form-control" id="val-rsac" name="val-rsac" value="{{$user->numero_carte_pro}}" required>  
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label class="col-sm-4 control-label" for="val-date">Date d'immatriculation <span class="text-danger">*</span></label>
                                 <div class="col-lg-6">
                                    <input type="date" id="val-date" class="form-control" name="val-date" value="{{$user->date_delivrance_carte_pro}}" required>
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label class="col-sm-4 control-label" for="val-care">Organisme d'assurance professionnelle <span class="text-danger">*</span></label>
                                 <div class="col-lg-6">
                                    <input type="text" id="val-care" class="form-control" name="val-care" value="{{$user->nom_organisme_assurance}}" required>
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label class="col-sm-4 control-label" for="val-num">Numéro d'assurance <span class="text-danger">*</span></label>
                                 <div class="col-lg-3">
                                    <input type="text" class="form-control" id="val-num" name="val-num" value="{{$user->numero_assurance}}" required>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <input type="button" name="previous" class="previous action-button" value="Précedent" />
                     <input type="submit" name="submit" id="submit" class="next action-button" value="Modifier">
                  </fieldset>
            </form>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
@section('js-content')
<!--country-->
<script>
   function autocomplete(inp, arr) {
     var currentFocus;
     inp.addEventListener("input", function(e) {
         var a, b, i, val = this.value;
         closeAllLists();
         if (!val) { return false;}
         currentFocus = -1;
         a = document.createElement("DIV");
         a.setAttribute("id", this.id + "autocomplete-list");
         a.setAttribute("class", "autocomplete-items");
         this.parentNode.appendChild(a);
         for (i = 0; i < arr.length; i++) {
           if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
             b = document.createElement("DIV");
             b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
             b.innerHTML += arr[i].substr(val.length);
             b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
             b.addEventListener("click", function(e) {
                 inp.value = this.getElementsByTagName("input")[0].value;
                 closeAllLists();
             });
             a.appendChild(b);
           }
         }
     });
     inp.addEventListener("keydown", function(e) {
         var x = document.getElementById(this.id + "autocomplete-list");
         if (x) x = x.getElementsByTagName("div");
         if (e.keyCode == 40) {
           currentFocus++;
           addActive(x);
         } else if (e.keyCode == 38) { 
           currentFocus--;
           addActive(x);
         } else if (e.keyCode == 13) {
           e.preventDefault();
           if (currentFocus > -1) {
             if (x) x[currentFocus].click();
           }
         }
     });
     function addActive(x) {
       if (!x) return false;
       removeActive(x);
       if (currentFocus >= x.length) currentFocus = 0;
       if (currentFocus < 0) currentFocus = (x.length - 1);
       x[currentFocus].classList.add("autocomplete-active");
     }
     function removeActive(x) {
       for (var i = 0; i < x.length; i++) {
         x[i].classList.remove("autocomplete-active");
       }
     }
     function closeAllLists(elmnt) {
       var x = document.getElementsByClassName("autocomplete-items");
       for (var i = 0; i < x.length; i++) {
         if (elmnt != x[i] && elmnt != inp) {
           x[i].parentNode.removeChild(x[i]);
         }
       }
     }
     document.addEventListener("click", function (e) {
         closeAllLists(e.target);
         });
   }
   var countries = ["Afghanistan","Albania","Algeria","Andorra","Angola","Anguilla","Antigua & Barbuda","Argentina","Armenia","Aruba","Australia","Austria","Azerbaijan","Bahamas","Bahrain","Bangladesh","Barbados","Belarus","Belgium","Belize","Benin","Bermuda","Bhutan","Bolivia","Bosnia & Herzegovina","Botswana","Brazil","British Virgin Islands","Brunei","Bulgaria","Burkina Faso","Burundi","Cambodia","Cameroon","Canada","Cape Verde","Cayman Islands","Central Arfrican Republic","Chad","Chile","China","Colombia","Congo","Cook Islands","Costa Rica","Cote D Ivoire","Croatia","Cuba","Curacao","Cyprus","Czech Republic","Denmark","Djibouti","Dominica","Dominican Republic","Ecuador","Egypt","El Salvador","Equatorial Guinea","Eritrea","Estonia","Ethiopia","Falkland Islands","Faroe Islands","Fiji","Finland","France","French Polynesia","French West Indies","Gabon","Gambia","Georgia","Germany","Ghana","Gibraltar","Greece","Greenland","Grenada","Guam","Guatemala","Guernsey","Guinea","Guinea Bissau","Guyana","Haiti","Honduras","Hong Kong","Hungary","Iceland","India","Indonesia","Iran","Iraq","Ireland","Isle of Man","Israel","Italy","Jamaica","Japan","Jersey","Jordan","Kazakhstan","Kenya","Kiribati","Kosovo","Kuwait","Kyrgyzstan","Laos","Latvia","Lebanon","Lesotho","Liberia","Libya","Liechtenstein","Lithuania","Luxembourg","Macau","Macedonia","Madagascar","Malawi","Malaysia","Maldives","Mali","Malta","Marshall Islands","Mauritania","Mauritius","Mexico","Micronesia","Moldova","Monaco","Mongolia","Montenegro","Montserrat","Morocco","Mozambique","Myanmar","Namibia","Nauro","Nepal","Netherlands","Netherlands Antilles","New Caledonia","New Zealand","Nicaragua","Niger","Nigeria","North Korea","Norway","Oman","Pakistan","Palau","Palestine","Panama","Papua New Guinea","Paraguay","Peru","Philippines","Poland","Portugal","Puerto Rico","Qatar","Reunion","Romania","Russia","Rwanda","Saint Pierre & Miquelon","Samoa","San Marino","Sao Tome and Principe","Saudi Arabia","Senegal","Serbia","Seychelles","Sierra Leone","Singapore","Slovakia","Slovenia","Solomon Islands","Somalia","South Africa","South Korea","South Sudan","Spain","Sri Lanka","St Kitts & Nevis","St Lucia","St Vincent","Sudan","Suriname","Swaziland","Sweden","Switzerland","Syria","Taiwan","Tajikistan","Tanzania","Thailand","Timor L'Este","Togo","Tonga","Trinidad & Tobago","Tunisia","Turkey","Turkmenistan","Turks & Caicos","Tuvalu","Uganda","Ukraine","United Arab Emirates","United Kingdom","United States of America","Uruguay","Uzbekistan","Vanuatu","Vatican City","Venezuela","Vietnam","Virgin Islands (US)","Yemen","Zambia","Zimbabwe"];
   autocomplete(document.getElementById("nationality-country"), countries);
</script>
<!--country-->
<script>
   var current_fs, next_fs, previous_fs; 
   var left, opacity, scale; 
   var animating; 
   
   $(".next").click(function(){
       var form = $(".form-valide2");
   		form.validate({
                   errorClass: "invalid-feedback animated fadeInDown",
                   errorElement: "div",
                   errorPlacement: function(e, a) {
                       jQuery(a).parents(".form-group > div").append(e)
                   },
                   highlight: function(e) {
                       jQuery(e).closest(".form-group").removeClass("is-invalid").addClass("is-invalid")
                   },
                   success: function(e) {
                       jQuery(e).closest(".form-group").removeClass("is-invalid"), jQuery(e).remove()
                   },
   			rules: {
                   "choice-marital": {
                           required: !0
                   },
                   "val-adress": {
                           required: !0
                   },
                   "val-zip": {
                           required: !0,
                           minlength: 5
                   },
                   "val-ville": {
                           required: !0
                   },
                   "nationality-country": {
                           required: !0
                   },
                   "choice-corporate": {
                           required: !0
                   },
                   "siret": {
                           required: !0,
                   },
                   "siren": {
                           required: !0,
                   },
                   "date-matricle": {
                           required: !0
                   },
                   "val-gref": {
                          required: !0
                  },
                  "val-rsac": {
                          required: !0
                  },
                  "val-date": {
                          required: !0
                  },
                  "val-care": {
                          required: !0
                  },
                  "val-num": {
                          required: !0
                  }
   			},
   			messages: {
                   "choice-marital": "Vous devez choisir une situation familialle !",
                   "val-adress": "Vous devez saisir l'adresse !",
                   "val-ville": "Vous devez saisir la ville !",
                   "val-zip": "Vous devez saisir un code postal correct",
                   "nationality-country": "Le pays de nationalité doit etre saisi !",
                   "choice-corporate": "Vous devez rensegner le status de votre entreprise !",
                   "siret": "Veuillez rensegner votre numéro siret correctement !",
                   "siren": "Veuillez rensegner votre numéro siren correctement !",
                   "date-matricle": "Veillez saisir la date d'immatriculation !",
                   "val-gref": "Vous devez saisir le tribunal d'immatriculation !",
                   "val-rsac": "Vous devez saisir correctement le numéro RSAC !",
                   "val-date": "Vous devez saisir la date d'immatriculation RSAC !",
                   "val-care": "Vous devez saisir l'organisme d'assurance !",
                   "val-num": "Vous devez saisir correctement le numéro d'assurance !"
   			}
   		});
   		
       if (form.valid() == true){
   	if(animating) return false;
   	    animating = true;
   	
   	current_fs = $(this).parent();
   	next_fs = $(this).parent().next();
   	$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
   	next_fs.show(); 
   	current_fs.animate({opacity: 0}, {
   		step: function(now, mx) {
   			scale = 1 - (1 - now) * 0.2;
   			left = (now * 50)+"%";
   			opacity = 1 - now;
   			current_fs.css({
           'transform': 'scale('+scale+')',
         });
   			next_fs.css({'left': left, 'opacity': opacity});
   		}, 
   		duration: 0, 
   		complete: function(){
   			current_fs.hide();
   			animating = false;
   		}, 
   		easing: 'easeInOutBack'
   	});
   }
   });
   
   $(".previous").click(function(){
   	if(animating) return false;
   	animating = true;
   	
   	current_fs = $(this).parent();
   	previous_fs = $(this).parent().prev();
   	$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
       previous_fs.show();
       current_fs.hide();
   	current_fs.animate({opacity: 0}, {
   		step: function(now, mx) {
   			scale = 0.8 + (1 - now) * 0.2;
   			left = ((1-now) * 50)+"%";
   			opacity = 1 - now;
   			current_fs.css({'left': left});
   			previous_fs.css({'transform': 'scale('+scale+')','opacity': opacity});
   		}, 
   		duration: 0, 
   		complete: function(){
               current_fs.hide();
               animating = false;
   		}, 
   		seasing: 'easeInOutBack'
   	});
   });
</script>
@endsection