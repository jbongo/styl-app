@extends('layouts.main.dashboard')
@section('header_name')
    Modification des informations de l' utilisateur
@stop
@extends('compenents.navbar')
@extends('compenents.header')

@section('content')
@section('pageActuelle')
@lang('Modifier l\'uitilsateur') {{$user->nom}}
@endsection

        @if (session('ok'))
       
            <div class="alert alert-success alert-dismissible fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    
                    <strong> {{ session('ok') }}</strong>
            </div>
         @endif
         <div class="row">        
<div class="card alert">
                
            <div class="col-lg-10">
                    <a href="{{route('users')}}" class="btn btn-warning btn-flat btn-addon m-b-10 m-l-5"><i class="ti-angle-left"></i>@lang('Retourner à la Liste des utilisateurs')</a>
                    <hr>
        </div>
        
            <div class="card-body">
                   
                <div class="form-validation">
                <form class="form-valide" action="{{ route('user.update',$user->id) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                        <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-select">Role <span class="text-danger">*</span></label>
                                    <div class="col-lg-2">
                                        <select class="js-select2 form-control {{$errors->has('val-select') ? 'is-invalid' : ''}}" id="val-select" name="val-select" style="width: 100%;" data-placeholder="Choose one.." required>
                                            
                                            <option value=" {{ $user->role}}" selected="selected" >{{ $user->role}}</option>
                                            @admin
                                            <option value="admin">Administrateur</option>
                                            @endadmin
                                            <option value="personnel">Personnel</option>
                                            <option value="mandataire">Mandataire</option>
                                            <option value="prospect">Prospect</option>
                                            <option value="prospect_plus">Prospect plus</option>
                                            <option value="intervenant">Intervenant</option>
                                            <option value="formateur">Formateur</option>
                                        </select>
                                        @if ($errors->has('val-select'))
                                            <br>
                                            <div class="alert alert-warning ">
                                                <strong>{{$errors->first('val-select')}}</strong> 
                                            </div>
                                         @endif
                                        
                                    </div>
                        </div>
                        <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="val-select">@lang('Civilité') <span class="text-danger">*</span></label>
                                <div class="col-lg-2">
                                    <select class="js-select2 form-control {{$errors->has('val-civilite') ? 'is-invalid' : ''}}" id="val-civilite" name="val-civilite" style="width: 100%;" data-placeholder="Choose one.." required>
                                            <option value=" {{ $user->civilite}}" selected="selected" >{{ $user->civilite}}</option>
                                        <option ></option>
                                        <option value="Mr">Mr</option>
                                        <option value="Mme">Mme</option>
                                        <option value="Mlle">Mlle</option>
                                    </select>
                                    @if ($errors->has('val-civilite'))
                                        <br>
                                        <div class="alert alert-warning ">
                                            <strong>{{$errors->first('val-civilite')}}</strong> 
                                        </div>
                                     @endif
                                    
                                </div>
                    </div>
                  
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="val-lastname">Nom <span class="text-danger">*</span></label>
                            <div class="col-lg-4">
                            <input type="text" class="form-control {{$errors->has('val-lastname') ? 'is-invalid' : ''}}" value=" {{ ($user->nom) ?  $user->nom : old('val-lastname') }}" id="val-lastname" name="val-lastname" placeholder="Nom.." required>
                                @if ($errors->has('val-lastname'))
                                    <br>
                                    <div class="alert alert-warning ">
                                        <strong>{{$errors->first('val-lastname')}}</strong> 
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="val-firstname">Prénom <span class="text-danger">*</span></label>
                                <div class="col-lg-4">
                                <input type="text"  class="form-control {{ $errors->has('val-firstname') ? ' is-invalid' : '' }}" value="{{$user->prenom}}" id="val-firstname" name="val-firstname" placeholder="Prénom.." required>
                                @if ($errors->has('val-firstname'))
                                    <br>
                                    <div class="alert alert-warning ">
                                        <strong>{{$errors->first('val-firstname')}}</strong> 
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="val-email">Email <span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" id="val-email" value="{{$user->email}}" name="email" placeholder="Email.." required>
                                @if ($errors->has('email'))
                                <br>
                                <div class="alert alert-warning ">
                                    <strong>{{$errors->first('email')}}</strong> 
                                </div>
                                @endif
                            </div>
                              
                        </div>
                        <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="val-adress">Adresse <span class="text-danger">*</span></label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control {{ $errors->has('val-adress') ? ' is-invalid' : '' }}" value="{{$user->adresse}}" id="val-adress" name="val-adress" placeholder="N° et Rue.." required>
                                
                                    @if ($errors->has('val-adress'))
                                        <br>
                                        <div class="alert alert-warning ">
                                            <strong>{{$errors->first('val-adress')}}</strong> 
                                        </div>
                                    @endif   
                                </div>
                        </div>

                        <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="val-compl_adress">Complément d'adresse</label>
                                <div class="col-lg-6">
                                    <input type="text" id="val-compl_adress" class="form-control {{ $errors->has('val-compl_adress') ? ' is-invalid' : '' }}" value="{{$user->complement_adresse}}" name="val-compl_adress" placeholder="Complément d'adresse..">
                                    @if ($errors->has('val-compl_adress'))
                                        <br>
                                        <div class="alert alert-warning ">
                                            <strong>{{$errors->first('val-compl_adress')}}</strong> 
                                        </div>
                                    @endif 
                                </div>
                        </div>

                        <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="val-zip">Code postal <span class="text-danger">*</span></label>
                                <div class="col-lg-1">
                                <input type="text" class="form-control {{ $errors->has('val-zip') ? ' is-invalid' : '' }}" value="{{$user->code_postal}}" id="val-zip" name="val-zip" placeholder="Ex: 75001.." required>
                                   
                                    @if ($errors->has('val-zip'))
                                        <br>
                                        <div class="alert alert-warning ">
                                            <strong>{{$errors->first('val-zip')}}</strong> 
                                        </div>
                                    @endif 
                                </div>
                        </div>
                        <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="val-town">Ville <span class="text-danger">*</span></label>
                                <div class="col-lg-4">
                                    <input type="text" class="form-control {{ $errors->has('val-town') ? ' is-invalid' : '' }}" value="{{$user->ville}}" id="val-town" name="val-town" placeholder="EX: Paris.." required>
                                @if ($errors->has('val-town'))
                                    <br>
                                    <div class="alert alert-warning ">
                                        <strong>{{$errors->first('val-town')}}</strong> 
                                    </div>
                                @endif 
                                </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="val-country">Pays <span class="text-danger">*</span></label>
                            <div class="col-lg-2">
                                <input type="text" class="form-control {{ $errors->has('val-country') ? ' is-invalid' : '' }}" value="{{$user->pays}}" id="val-country" name="val-country" placeholder="Entez une lettre et choisissez.." required>
                            @if ($errors->has('val-country'))
                                <br>
                                <div class="alert alert-warning ">
                                    <strong>{{$errors->first('val-country')}}</strong> 
                                </div>
                            @endif 
                            </div>
                        </div>

                        <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="val-phone">Téléphone (FR) <span class="text-danger">*</span></label>
                                <div class="col-lg-2">
                                    <input type="text" class="form-control {{ $errors->has('val-phone') ? ' is-invalid' : '' }}" value="{{$user->telephone}}" id="val-phone" name="val-phone" placeholder="Ex: 0600000000.." required>
                                @if ($errors->has('val-phone'))
                                    <br>
                                    <div class="alert alert-warning ">
                                        <strong>{{$errors->first('val-phone')}}</strong> 
                                    </div>
                                @endif     
                                
                                </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-8 ml-auto">
                                <button type="submit" class="btn btn-md btn-warning "><span class="glyphicon glyphicon-pencil"></span>@lang('Modifier')</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
@section('js-content')
    <script>
            function autocomplete(inp, arr) {
              /*the autocomplete function takes two arguments,
              the text field element and an array of possible autocompleted values:*/
              var currentFocus;
              /*execute a function when someone writes in the text field:*/
              inp.addEventListener("input", function(e) {
                  var a, b, i, val = this.value;
                  /*close any already open lists of autocompleted values*/
                  closeAllLists();
                  if (!val) { return false;}
                  currentFocus = -1;
                  /*create a DIV element that will contain the items (values):*/
                  a = document.createElement("DIV");
                  a.setAttribute("id", this.id + "autocomplete-list");
                  a.setAttribute("class", "autocomplete-items");
                  /*append the DIV element as a child of the autocomplete container:*/
                  this.parentNode.appendChild(a);
                  /*for each item in the array...*/
                  for (i = 0; i < arr.length; i++) {
                    /*check if the item starts with the same letters as the text field value:*/
                    if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                      /*create a DIV element for each matching element:*/
                      b = document.createElement("DIV");
                      /*make the matching letters bold:*/
                      b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                      b.innerHTML += arr[i].substr(val.length);
                      /*insert a input field that will hold the current array item's value:*/
                      b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                      /*execute a function when someone clicks on the item value (DIV element):*/
                      b.addEventListener("click", function(e) {
                          /*insert the value for the autocomplete text field:*/
                          inp.value = this.getElementsByTagName("input")[0].value;
                          /*close the list of autocompleted values,
                          (or any other open lists of autocompleted values:*/
                          closeAllLists();
                      });
                      a.appendChild(b);
                    }
                  }
              });
              /*execute a function presses a key on the keyboard:*/
              inp.addEventListener("keydown", function(e) {
                  var x = document.getElementById(this.id + "autocomplete-list");
                  if (x) x = x.getElementsByTagName("div");
                  if (e.keyCode == 40) {
                    /*If the arrow DOWN key is pressed,
                    increase the currentFocus variable:*/
                    currentFocus++;
                    /*and and make the current item more visible:*/
                    addActive(x);
                  } else if (e.keyCode == 38) { //up
                    /*If the arrow UP key is pressed,
                    decrease the currentFocus variable:*/
                    currentFocus--;
                    /*and and make the current item more visible:*/
                    addActive(x);
                  } else if (e.keyCode == 13) {
                    /*If the ENTER key is pressed, prevent the form from being submitted,*/
                    e.preventDefault();
                    if (currentFocus > -1) {
                      /*and simulate a click on the "active" item:*/
                      if (x) x[currentFocus].click();
                    }
                  }
              });
              function addActive(x) {
                /*a function to classify an item as "active":*/
                if (!x) return false;
                /*start by removing the "active" class on all items:*/
                removeActive(x);
                if (currentFocus >= x.length) currentFocus = 0;
                if (currentFocus < 0) currentFocus = (x.length - 1);
                /*add class "autocomplete-active":*/
                x[currentFocus].classList.add("autocomplete-active");
              }
              function removeActive(x) {
                /*a function to remove the "active" class from all autocomplete items:*/
                for (var i = 0; i < x.length; i++) {
                  x[i].classList.remove("autocomplete-active");
                }
              }
              function closeAllLists(elmnt) {
                /*close all autocomplete lists in the document,
                except the one passed as an argument:*/
                var x = document.getElementsByClassName("autocomplete-items");
                for (var i = 0; i < x.length; i++) {
                  if (elmnt != x[i] && elmnt != inp) {
                    x[i].parentNode.removeChild(x[i]);
                  }
                }
              }
              /*execute a function when someone clicks in the document:*/
              document.addEventListener("click", function (e) {
                  closeAllLists(e.target);
                  });
            }
            
            /*An array containing all the country names in the world:*/
            var countries = ["Afghanistan","Albania","Algeria","Andorra","Angola","Anguilla","Antigua & Barbuda","Argentina","Armenia","Aruba","Australia","Austria","Azerbaijan","Bahamas","Bahrain","Bangladesh","Barbados","Belarus","Belgium","Belize","Benin","Bermuda","Bhutan","Bolivia","Bosnia & Herzegovina","Botswana","Brazil","British Virgin Islands","Brunei","Bulgaria","Burkina Faso","Burundi","Cambodia","Cameroon","Canada","Cape Verde","Cayman Islands","Central Arfrican Republic","Chad","Chile","China","Colombia","Congo","Cook Islands","Costa Rica","Cote D Ivoire","Croatia","Cuba","Curacao","Cyprus","Czech Republic","Denmark","Djibouti","Dominica","Dominican Republic","Ecuador","Egypt","El Salvador","Equatorial Guinea","Eritrea","Estonia","Ethiopia","Falkland Islands","Faroe Islands","Fiji","Finland","France","French Polynesia","French West Indies","Gabon","Gambia","Georgia","Germany","Ghana","Gibraltar","Greece","Greenland","Grenada","Guam","Guatemala","Guernsey","Guinea","Guinea Bissau","Guyana","Haiti","Honduras","Hong Kong","Hungary","Iceland","India","Indonesia","Iran","Iraq","Ireland","Isle of Man","Israel","Italy","Jamaica","Japan","Jersey","Jordan","Kazakhstan","Kenya","Kiribati","Kosovo","Kuwait","Kyrgyzstan","Laos","Latvia","Lebanon","Lesotho","Liberia","Libya","Liechtenstein","Lithuania","Luxembourg","Macau","Macedonia","Madagascar","Malawi","Malaysia","Maldives","Mali","Malta","Marshall Islands","Mauritania","Mauritius","Mexico","Micronesia","Moldova","Monaco","Mongolia","Montenegro","Montserrat","Morocco","Mozambique","Myanmar","Namibia","Nauro","Nepal","Netherlands","Netherlands Antilles","New Caledonia","New Zealand","Nicaragua","Niger","Nigeria","North Korea","Norway","Oman","Pakistan","Palau","Palestine","Panama","Papua New Guinea","Paraguay","Peru","Philippines","Poland","Portugal","Puerto Rico","Qatar","Reunion","Romania","Russia","Rwanda","Saint Pierre & Miquelon","Samoa","San Marino","Sao Tome and Principe","Saudi Arabia","Senegal","Serbia","Seychelles","Sierra Leone","Singapore","Slovakia","Slovenia","Solomon Islands","Somalia","South Africa","South Korea","South Sudan","Spain","Sri Lanka","St Kitts & Nevis","St Lucia","St Vincent","Sudan","Suriname","Swaziland","Sweden","Switzerland","Syria","Taiwan","Tajikistan","Tanzania","Thailand","Timor L'Este","Togo","Tonga","Trinidad & Tobago","Tunisia","Turkey","Turkmenistan","Turks & Caicos","Tuvalu","Uganda","Ukraine","United Arab Emirates","United Kingdom","United States of America","Uruguay","Uzbekistan","Vanuatu","Vatican City","Venezuela","Vietnam","Virgin Islands (US)","Yemen","Zambia","Zimbabwe"];
            
            /*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
            autocomplete(document.getElementById("val-country"), countries);
            </script>

@endsection
