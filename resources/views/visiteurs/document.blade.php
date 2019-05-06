@extends('layouts.main.visiteurs')
@extends('compenents.visiteurs.navbar')
@extends('compenents.visiteurs.footer')
@section('content')

@if (session('ok'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
		<strong>{{ session('ok') }}</strong>
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
	 </div>
	 @endif
<!--modal file-->
<div class="dynamic_modal">

	</div>
<!--modal file-->

<section class="wthree-row py-sm-5 py-3" id="ab-bot">
	<div class="row justify-content-center align-items-center no-gutters abbot-main">
			<div class="col-lg-6 py-lg-3 px-lg-5 p-sm-5 px-3 py-5 abbot-right">
				<h3 class="stat-title card-title align-self-center pt-3 text-center">Avancement des dossier</h3>
				<span class="w3-line mx-auto text-center d-block"></span>
				<div class="progress_agile mx-auto mt-5">
					<div class="progress-outer mt-3">
						<div class="progress">
							<div class="progress-bar progress-bar-info progress-bar-striped active" style="width:25%; box-shadow:-1px 10px 10px rgba(91, 192, 222, 0.7);"></div>
							<div class="progress-value">25%</div>
						</div>
						<h6 class="text-right text-capitalize pt-3">Acquéreur</h6>
					</div>
					<div class="progress-outer  my-4">
						<div class="progress">
							<div class="progress-bar progress-bar-warning progress-bar-striped active" style="width:80%; box-shadow:-1px 10px 10px rgba(240, 173, 78,0.7);"></div>
							<div class="progress-value">80%</div>
						</div>
						<h6 class="text-right text-capitalize pt-3">Mandant</h6>
					</div>
					<div class="progress-outer  my-4">
							<div class="progress">
								<div class="progress-bar progress-bar-danger progress-bar-striped active" style="width:80%; box-shadow:-1px 10px 10px rgba(240, 173, 78,0.7);"></div>
								<div class="progress-value">80%</div>
							</div>
							<h6 class="text-right text-capitalize pt-3">Bien</h6>
						</div>
				</div>
			</div>
		<div class="col-lg-6 p-0 abbot-right">
			<div class="card">
				<div class="card-body px-sm-5 py-5 px-4">
					<h3 class="stat-title card-title align-self-center">Constitution du dossier</h3>
					<span class="w3-line"></span>
					<p class="card-text align-self-center my-3">
						Vous pouvez ici constituer le dossier et réunir toutes les pieces justificatives necessaires pour réaliser la vente, chaque piece demandée ici est indispensable pour rediger l'acte de vente chez le notaire, assurez vous de la validité des pieces avant de les soumettre,
						une fois une piece soumise elle sera vérifiée pour validation par notre service.</p>
				</div>
			</div>
		</div>
	</div>
	<div class="row  align-items-center no-gutters abbot-grid2">
	</div>
</section>

@guestmandant
<section class="wthree-row pt-md-5 pt-0">
	<div class="py-sm-5 pt-3 pb-4 bg-pricemain text-center">
	   <h3 class="agile-title text-uppercase">Liste des documents mandant</h3>
	   <span class="w3-line"></span>
	</div>
	<div class="row justify-content-center align-items-center no-gutters abbot-main">
	   <div class="col-lg-12 p-0 abbot-right">
		  <div class="card">
			 <div class="card-body px-sm-5 py-5 px-4">
					<table class="table table-hover" style="margin-left: 75px;">
							<thead>
							  <tr>
								<th scope="col" style="color: magenta;"><h3>INTITULÉ DU DOCUMENT</h3></th>
								<th scope="col" style="color: magenta;"><h3>STATUS</h3></th>
								<th scope="col" style="color: magenta;"><h3>DATE D'AJOUT</h3></th>
								<th scope="col" style="color: magenta;"><h3>ACTION</h3></th>
							  </tr>
							</thead>
							<tbody>
								@if($mdn_doc != NULL)
								@foreach ($mdn_doc as $key=>$one)
								<tr>
										<th scope="row">{{$one[0]}}</th>
										<td>
											@if($one[2] === "non ajouté")
												<span class="badge badge-primary">{{$one[2]}}</span>
											@elseif($one[2] === "en traitement")
												<span class="badge badge-warning">{{$one[2]}}</span>
											@elseif($one[2] === "rejeté")
												<span class="badge badge-danger">{{$one[2]}}</span>
											@elseif($one[2] === "validé")
												<span class="badge badge-success">{{$one[2]}}</span>
											@endif
										</td>
										<td>{{$one[1]}}</td>
										<td>
												@if($one[2] === "non ajouté" || $one[2] === "rejeté")
													<a id="{{$key}}" type="button" style="background:green;" data-toggle="modal" data-target="#file" class="btn btn-success push666">Ajouter</a>
												@else
													<a type="button"  href="#" class="btn btn-primary">Voir</a>
												@endif
										</td>
									  </tr>
								@endforeach
								@endif
							</tbody>
						  </table>
			 </div>
		  </div>
	   </div>
	</div>
 </section>
 <section class="wthree-row pt-md-5 pt-0">
		<div class="py-sm-5 pt-3 pb-4 bg-pricemain text-center">
			<h3 class="agile-title text-uppercase">Liste des documents du bien</h3>
			<span class="w3-line"></span>
		</div>
		<div class="row justify-content-center align-items-center no-gutters abbot-main">
			<div class="col-lg-12 p-0 abbot-right">
			  <div class="card">
				 <div class="card-body px-sm-5 py-5 px-4">
						<table class="table table-hover" style="margin-left: 75px;">
								<thead>
								  <tr>
									<th scope="col" style="color: magenta;"><h3>INTITULÉ DU DOCUMENT</h3></th>
									<th scope="col" style="color: magenta;"><h3>STATUS</h3></th>
									<th scope="col" style="color: magenta;"><h3>DATE D'AJOUT</h3></th>
									<th scope="col" style="color: magenta;"><h3>ACTION</h3></th>
								  </tr>
								</thead>
								<tbody>
									@if($bn_doc != NULL)
									@foreach ($bn_doc as $key=>$one)
									<tr>
											<th scope="row">{{$one[0]}}</th>
											<td>
												@if($one[2] === "non ajouté")
													<span class="badge badge-primary">{{$one[2]}}</span>
												@elseif($one[2] === "en traitement")
													<span class="badge badge-warning">{{$one[2]}}</span>
												@elseif($one[2] === "rejeté")
													<span class="badge badge-danger">{{$one[2]}}</span>
												@elseif($one[2] === "validé")
													<span class="badge badge-success">{{$one[2]}}</span>
												@endif
											</td>
											<td>{{$one[1]}}</td>
											<td>
													@if($one[2] === "non ajouté" || $one[2] === "rejeté")
														<a id="{{$key}}" type="button" style="background:green;" data-toggle="modal" data-target="#file_bn" class="btn btn-success push777">Ajouter</a>
													@else
														<a type="button"  href="#" class="btn btn-primary">Voir</a>
													@endif
											</td>
										  </tr>
									@endforeach
									@endif
								</tbody>
							  </table>
				 </div>
			  </div>
			</div>
		</div>
	 </section>
	 @endguestmandant

	 @guestacquereur
	 <section class="wthree-row pt-md-5 pt-0">
			<div class="py-sm-5 pt-3 pb-4 bg-pricemain text-center">
				<h3 class="agile-title text-uppercase">Liste des documents acquéreur</h3>
				<span class="w3-line"></span>
			</div>
			<div class="row justify-content-center align-items-center no-gutters abbot-main">
				<div class="col-lg-12 p-0 abbot-right">
				  <div class="card">
					 <div class="card-body px-sm-5 py-5 px-4">
							<table class="table table-hover" style="margin-left: 75px;">
									<thead>
									  <tr>
										<th scope="col" style="color: magenta;"><h3>INTITULÉ DU DOCUMENT</h3></th>
										<th scope="col" style="color: magenta;"><h3>STATUS</h3></th>
										<th scope="col" style="color: magenta;"><h3>DATE D'AJOUT</h3></th>
										<th scope="col" style="color: magenta;"><h3>ACTION</h3></th>
									  </tr>
									</thead>
									<tbody>
										@if($acq_doc != NULL)
										@foreach ($acq_doc as $key=>$one)
										<tr>
												<th scope="row">{{$one[0]}}</th>
												<td>
													@if($one[2] === "non ajouté")
														<span class="badge badge-primary">{{$one[2]}}</span>
													@elseif($one[2] === "en traitement")
														<span class="badge badge-warning">{{$one[2]}}</span>
													@elseif($one[2] === "rejeté")
														<span class="badge badge-danger">{{$one[2]}}</span>
													@elseif($one[2] === "validé")
														<span class="badge badge-success">{{$one[2]}}</span>
													@endif
												</td>
												<td>{{$one[1]}}</td>
												<td>
														@if($one[2] === "non ajouté" || $one[2] === "rejeté")
															<a id="{{$key}}" type="button" style="background:green;" data-toggle="modal" data-target="#file" class="btn btn-success push666">Ajouter</a>
														@else
															<a type="button"  href="#" class="btn btn-primary">Voir</a>
														@endif
												</td>
											  </tr>
										@endforeach
										@endif
									</tbody>
								  </table>
					 </div>
				  </div>
				</div>
			</div>
		 </section>
		 @endguestacquereur
@endsection
@section('js-content')
<!--<script>
$(document).ready(function(){
var id = null;
$('.push666').on('click',function(e){
	 e.preventDefault();
	 id = $(this).attr('id') ;
	 });
	 $('.submit666').on('click',function(e){
		 e.preventDefault();
		 $.ajax({
              type: "POST",
              url: '/guestusers/documents/post/'+id,
              beforeSend: function(xhr, type) {
                if (!type.crossDomain) {
                    xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
                }
                },
              data: {
					  file: $('#file-doc').attr('files'), note: $('#notes').val()
                  },
              success: function(data){
					console.log(data);
                swal(
                'Ajouté',
                'Le document a été envoyé',
                'success'
                )
              },
              error: function(data){
					  console.log(data);
                swal(
                'Echec',
                'Une erreur s\'est produite ressayez',
                'error'
                );
              }
          });
	 });
});
</script>-->
<script>
		$(document).ready(function(){
		var id = null;
		$('.push666').on('click',function(e){
			 e.preventDefault();
			 id = $(this).attr('id') ;
			 var url = '/guestusers/documents/post/'+id;
			 var wrapper = $(".dynamic_modal");
			 $(wrapper).html('');
			 $(wrapper).append('<div class="modal fade" id="file" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true"> <div class="modal-dialog" role="document"> <div class="modal-content"> <div class="modal-header"> <h5 class="modal-title" id="exampleModalLabel1">Ajouter un document justificatif</h5> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div><div class="modal-body"> <img src="images/modal.jpg" alt="" class="img-fluid"/> <form class="formtt6 p-3" action="'+url+'" method="post" enctype="multipart/form-data"> @csrf <div class="form-group"> <label for="file-doc" class="col-form-label">FICHIER (PDF, PNG, JPEG, DOCX)</label> <input type="file" class="form-control" name="file-doc" id="file-doc" required> </div><div class="form-group"> <label for="notes" class="col-form-label">NOTES</label> <textarea name="notes" id="notes" class="form-control" rows="6">Vous pouvez écrire quelque chose ici.</textarea> </div><div class="right-w3l"> <input type="submit" class="form-control submit666" value="valider"> </div></form> </div></div></div></div>');
			 });
		$('.push777').on('click',function(f){
			 id2 = $(this).attr('id') ;
			 var url2 = '/guestusers/documentsbien/post/'+id2;
			 var wrapper2 = $(".dynamic_modal");
			 $(wrapper2).html('');
			 $(wrapper2).append('<div class="modal fade" id="file_bn" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true"> <div class="modal-dialog" role="document"> <div class="modal-content"> <div class="modal-header"> <h5 class="modal-title" id="exampleModalLabel1">Ajouter un document justificatif</h5> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div><div class="modal-body"> <img src="images/modal.jpg" alt="" class="img-fluid"/> <form class="formtt6 p-3" action="'+url2+'" method="post" enctype="multipart/form-data"> @csrf <div class="form-group"> <label for="file-doc" class="col-form-label">FICHIER (PDF, PNG, JPEG, DOCX)</label> <input type="file" class="form-control" name="file-doc" id="file-doc" required> </div><div class="form-group"> <label for="notes" class="col-form-label">NOTES</label> <textarea name="notes" id="notes" class="form-control" rows="6">Vous pouvez écrire quelque chose ici.</textarea> </div><div class="right-w3l"> <input type="submit" class="form-control submit666" value="valider"> </div></form> </div></div></div></div>');
			 });
		});
		</script>
@endsection