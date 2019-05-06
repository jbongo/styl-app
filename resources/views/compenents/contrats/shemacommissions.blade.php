<div class="form-validation">
    <form class="form-valide4" action="{{ route('contrat.settingcommission') }}" method="post">
       {{ csrf_field() }}
       <div class="form-group row" id="max-starter-parrent">
             <div class="col-lg-4">
                <label class="col-lg-8 col-form-label" for="nb-palier">Nombre de paliers<span class="text-danger">*</span></label>
                <input type="number"  class="form-control"  id="nb-palier" name="nb-palier" min="1" value="{{$pln->nombre_palier}}" readonly>
             </div>
         </div>

       <div class="col-lg-10" id="palier">
          <div class="panel panel-pink m-t-15">
             <div class="panel-heading"><strong>Barème d'honoraires</strong></div>
             <div class="panel-body">
                 @php($val = 1)
                 @foreach($chunk as $one)
                <div class="input_fields_wrap">
                   <div class="form-inline field{{$val}}">
                      <div class="form-group">
                         <label for="fr{{$val}}">De (€)</label>
                      <input class="form-control" type="number" min="1" value="{{$one[0]}}" id="fr{{$val}}" name="fr{{$val}}" required>
                      </div>
                      <div class="form-group">
                         <label for="to{{$val}}">A (€) </label>
                         <input class="form-control" type="number" min="1" value="{{$one[1]}}" id="to{{$val}}" name="to{{$val}}" required>
                      </div>
                      <div class="form-group">
                         <label for="forfait{{$val}}">Soit forfait maximum (€) </label>
                         <input class="form-control" type="number" min="0" value="{{$one[2]}}" id="forfait{{$val}}" name="forfait{{$val}}" required>
                      </div>
                      <div class="form-group">
                         <label for="percent{{$val}}">Ou pourcentage (%)</label>
                         <input class="form-control" type="number" min="0" max="100" step="0.05" value="{{$one[3]}}" id="percent{{$val}}" name="percent{{$val}}" required>
                      </div>
                   </div>
                </div>
                @php($val += 1)
                @endforeach
             </br></br><strong>Au dela</br></br></strong>
             <div class = "form-inline field{{$pln->nombre_palier}}">
                 <div class="form-group">
                     <label for="fr{{$pln->nombre_palier}}">De et + </label>
                     <input class="form-control" type="number" min="1" value="{{$last[0]}}" id="fr{{$pln->nombre_palier}}" name="fr{{$pln->nombre_palier}}">
                 </div>
                 <div class="form-group">
                     <label for="percent{{$pln->nombre_palier}}">Pourcentage(%)</label>
                 <input class="form-control" type="number" step="0.05" min="0" max="100" value="{{$last[1]}}" id="percent{{$pln->nombre_palier}}" name="percent{{$pln->nombre_palier}}" required>
                 </div>
             </div>
             </div>
          </div>
       </div>
       <div class="form-group row" style="text-align: center; margin-top: 50px;">
          <div class="col-lg-8 ml-auto">
             <button class="btn btn-warning btn-flat btn-addon btn-lg m-b-10 m-l-5 shema"><i class="ti-pencil"></i>Modifier</button>
          </div>
       </div>
    </form>
 </div>