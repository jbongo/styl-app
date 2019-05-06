@extends('layouts.main.dashboard')
@extends('compenents.navbar')
@extends('compenents.header')
@section('content')
@if (session('ok'))
<div class="alert alert-success alert-dismissible fade in">
   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
   <strong> {{ session('ok') }}</strong>
</div>
@endif
<div class="row">
   <div class="col-lg-12">
      <div class="card">
         <div class="col-lg-10">
            <div class="panel panel-info m-t-15">
               <div class="panel-heading"><strong>Modification du model de parrainage</strong></div>
               <div class="panel-body">
               </div>
            </div>
         </div>
         <div class="card-body">
            <div class="form-validation">
               <form class="form-valide3" action="{{ route('parrainage.contrat.update', $pln->id) }}" method="post">
                  {{ csrf_field() }}
                  <div class="form-group row">
                     <div class="col-lg-4">
                        <label class="col-lg-3 col-form-label" for="plan-name">Nom du plan <span class="text-danger">*</span></label>
                     <input type="text"  class="form-control" id="plan-name" name="plan-name" value="{{$pln->nom}}" readonly>
                     </div>
                  </div>
                  <div class="form-group row" id="max-starter-parrent">
                        <div class="col-lg-4">
                           <label class="col-lg-8 col-form-label" for="max-forfait">Prime forfitaire si le parrain est à 100% (€)<span class="text-danger">*</span></label>
                           <input type="number"  class="form-control"  id="max-forfait" name="max-forfait" min="1" value="{{$pln->forfait_100percent}}" required>
                        </div>
                    </div>
                    <div class="form-group row" id="yr00">
                        <div class="col-lg-4">
                           <label class="col-lg-8 col-form-label" for="max-forfait">Pourcentage de la premiere année<span class="text-danger">*</span></label>
                        <input type="number"  class="form-control"  id="annee1" name="annee1" min="0" max="100" step="0.10" value="{{$pln->pourcentage_annee1}}" required>
                        </div>
                    </div>
                  <div class="form-group row" id="max-starter-parrent">
                        <div class="col-lg-4">
                           <label class="col-lg-8 col-form-label" for="nb-years">Nombre d'années<span class="text-danger">*</span></label>
                           <input type="number"  class="form-control"  id="nb-years" name="nb-years" min="1" max="48" value="{{$pln->nombre_annee}}" readonly>
                        </div>
                    </div>

                  <div class="col-lg-11" id="palier">
                     <div class="panel panel-pink m-t-15">
                        <div class="panel-heading"><strong>Rémunération par année</strong></div>
                        <div class="panel-body">
                            @php($val = 1)
                            @foreach($chunk as $one)
                           <div class="input_fields_wrap">
                              <div class="form-inline field{{$val}}">
                                 <div class="form-group">
                                    <label for="year{{$val}}">Année </label>
                                 <input class="form-control" type="text" value="{{$one[0]}}" id="year{{$val}}" name="year{{$val}}" readonly>
                                 </div>
                                 <div class="form-group">
                                    <label for="min-percent{{$val}}">Pourcentage minimum(%) </label>
                                    <input class="form-control" type="number" min="0" max="100" step="0.10" value="{{$one[1]}}" id="min-percent{{$val}}" name="min-percent{{$val}}" required>
                                 </div>
                                 <div class="form-group">
                                    <label for="max-percent{{$val}}">Pourcentage maximum(%) </label>
                                    <input class="form-control" type="number" min="0" max="100" step="0.10" value="{{$one[2]}}" id="max-percent{{$val}}" name="max-percent{{$val}}" required>
                                 </div>
                                 <div class="form-group">
                                    <label for="chiffre{{$val}}">Chiffre d'affaire requis pour maximum (€)</label>
                                    <input class="form-control" type="number" min="0" value="{{$one[3]}}" id="chiffre{{$val}}" name="chiffre{{$val}}" required>
                                 </div>
                              </div>
                           </div>
                           @php($val += 1)
                           @endforeach
                        </br></br><strong>Au dela de l'année {{$pln->nombre_annee}}</br></br></strong>
                        <div class = "form-inline field{{$pln->nombre_annee}}">
                            <div class="form-group">
                                <label for="year{{$pln->nombre_annee}}">Année </label>
                                <input class="form-control" type="text" value="{{$last[0]}}" id="year{{$pln->nombre_annee}}" name="year{{$pln->nombre_annee}}"/ readonly>
                            </div>
                            <div class="form-group">
                                <label for="min-percent{{$pln->nombre_annee}}">Pourcentage(%)</label>
                            <input class="form-control" type="number" step="0.10" min="0" max="100" value="{{$last[1]}}" id="min-percent{{$pln->nombre_annee}}" name="min-percent{{$pln->nombre_annee}}" required>
                            </div>
                        </div>
                        </div>
                     </div>
                  </div>
                  <div class="form-group row" style="text-align: center; margin-top: 50px;">
                     <div class="col-lg-8 ml-auto">
                        <button class="btn btn-primary btn-flat btn-addon btn-lg m-b-10 m-l-5 submit"><i class="ti-pencil"></i>Modifier</button>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
@stop
@section('js-content')
<script>
   $('.submit').click(function(e){ 
         e.preventDefault();
         var form = $(".form-valide3");
          form.validate({
              errorClass: "invalid-feedback animated fadeInDown",
              errorElement: "div",
              errorPlacement: function(e, a) {
                  jQuery(a).parents(".form-group > div").append(e)
              },
              highlight: function(e) {
                  jQuery(e).closest(".form-group").removeClass("is-invalid").addClass("is-invalid");
              },
              success: function(e) {
                  jQuery(e).closest(".form-group").removeClass("is-invalid"), jQuery(e).remove();
              },
              rules: {
              "plan-name": {
                  required: !0
              },
              "nb-years": {
                  required: !0
              }
          },
          messages: {
              "plan-name": "Veuillez saisir un nom !",
              "nb-years": "Veuillez choisir une valeure !"
          }
      });
      if (form.valid() == true){
        var level = $('#palier input').serialize();
        var name = $('#plan-name').val();

        $.ajax({
            type: "POST",
            url: ("{{ route('parrainage.contrat.update', $pln->id) }}"),
            beforeSend: function(xhr, type) {
                if (!type.crossDomain) {
                    xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
                }
            },
            data: {
                  planname: $('#plan-name').val(), maxforfait: $('#max-forfait').val(),
                  annee1: $('#annee1').val(), nbyears: $('#nb-years').val(), palierdata: level
            },
            success: function(data){
                swal(
                'Modifié',
                'Le model '+name+' est modifié avec succées!',
                'success'
                )
                .then(function(){
                    window.location.href = "{{route('contrat.index')}}";
                })
              },
              error: function(data){
                console.log(data);
                swal(
                'Echec',
                'Le model '+name+' n\'a pas été modifié!',
                'danger'
                );
              }
        });
      }
   });
</script>
@endsection