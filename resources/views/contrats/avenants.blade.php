@extends('layouts.main.dashboard')
@extends('compenents.navbar')
@extends('compenents.header')

@section('content')
    <div class="row"> 
       
        <div class="col-lg-12">
                @if (session('ok'))
       
                <div class="alert alert-success alert-dismissible fade in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <a href="#" class="alert-link"><strong> {{ session('ok') }}</strong></a> 
                </div>
             @endif       
            <div class="card">
                <!-- table -->
                <a href="{{route('contrat.show',$contrat->id)}}" class="btn btn-success btn-flat btn-addon m-b-10 m-l-5"><i class="ti-user"></i>@lang('Retour au contrat')</a>
                <div class="card-body">
                        <div class="table-responsive" style="overflow-x: inherit !important;">
                            <table  id="example" class=" table student-data-table  m-t-20 ">
                                <thead>
                                    <tr>
                                        <th>@lang('Type du fichier')</th>
                                        <th>@lang('Mandataire')</th>
                                        <th>@lang('Numero du contrat')</th>                                        
                                        <th>@lang('Type de l\'avenant')</th>
                                        <th>@lang('Signature mandataire')</th>
                                        <th>@lang('Date de création')</th>
                                        <th>@lang('Action')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($list as $ls)
                                    <tr>
                                        <td>
                                            <div class="product-2-img ">
                                                <img src="{{asset('/images/pdf.png')}}" alt="pdf">
                                            </div>
                                        </td>
                                        <td>
                                            {{$user->nom}} {{$user->prenom}}
                                        </td>
                                        <td>
                                            {{$contrat->numero_contrat}} 
                                        </td>
                                        <td>
                                            {{$ls->type}} 
                                        </td>
                                        <td>
                                            @if($ls->signature == 1)
                                                <span class="badge badge-success">oui</span>
                                            @endif
                                            @if($ls->signature == 0)
                                                <span class="badge badge-danger">non</span>
                                            @endif                                                   
                                        </td>
                                        <td>
                                                {{date('d-m-Y',strtotime($ls->created_at))}} 
                                        </td>
                                       
                                        <td>
                                            <a type="button" href="{{route('avenant.download', $ls->id)}}" class="btn btn-pink btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="ti-download"></i>Télécharger<a>
                                        </td>
                                    </tr>
                            @endforeach
                              </tbody>
                            </table>
                        </div>
                    </div>
                <!-- end table -->
            </div>
        </div>
    </div>
@endsection