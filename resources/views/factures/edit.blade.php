@extends('layouts.main.dashboard')
@section('header_name')
    Editer les factures
@stop
@extends('compenents.navbar')
@extends('compenents.header')
@section('content')
<div class="row">
   <div class="col-lg-12">
      <div class="card">
         <div class="card-body">
            <div class="form-validation">
               <form class="form-valide2 form-horizontal" action="{{route('facture.update', $tet->id)}}" method="POST">
                  {{ csrf_field() }}
                  <div class="col-lg-12">
                        <a type="button" href="{{route('facture')}}" class="btn btn-dark btn-flat btn-addon"><i class="ti-arrow-left"></i>Retour au listing des factures</a>
                     <div class="panel lobipanel-basic panel-danger">
                        <div class="panel-heading">
                           <div class="panel-title">Editer une facture d'avoir pour rectification.</div>
                        </div>
                        <div class="panel-body">
                           <div class="form-group row">
                              <label class="col-sm-4 control-label" for="bool-mail">Notifer le client par email<span class="text-danger">*</span></label>
                              <div class="col-lg-3">
                                 <input type="checkbox" unchecked data-toggle="toggle" id="bool-mail" name="bool-mail" data-off="Non" data-on="Oui" data-onstyle="success" data-offstyle="danger">
                              </div>
                           </div>
                           <div class="form-group row">
                                <label class="col-sm-4 control-label" for="describe">Raisons de l'avoir <span class="text-danger">*</span></label>
                                <div class="col-lg-4">
                                   <textarea rows="4" id="describe" class="form-control" name="describe" placeholder="Ex: Erreur sur le montant ou la commande..." required></textarea>
                                </div>
                             </div>
                             <div class="form-group row">
                                <label class="col-sm-4 control-label" for="val">Montant de l'avoir TTC (€)<span class="text-danger">*</span></label>
                                <div class="col-lg-4">
                                <input type="number" id="val" class="form-control" min="0" max="{{$tet->montant_ttc}}" value="0" step="0.01" name="val" required>
                                </div>
                             </div>
                           <div class="form-group row" style="text-align: center; margin-top: 50px;">
                              <div class="col-lg-8 ml-auto">
                                 <button class="btn btn-warning btn-flat btn-addon btn-lg m-b-10 m-l-5 submit" id="ajouter"><i class="ti-plus"></i>Valider</button>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
@stop