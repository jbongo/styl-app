<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Biens;
use App\Models\Photosbien;
class ExportController extends Controller
{
	   
	private $photos_path;
	public function __construct()	{
		$this->photos_path = public_path('/images/photos_bien');
	}
	
/**
* @author jean-philippe
* @param  App\Models\PhotosBien
* @return \Illuminate\Http\Response
**/
	public function add_element($xw,$tag,$value){
		
		xmlwriter_start_element($xw, $tag);
			xmlwriter_text($xw, $value);
		xmlwriter_end_element($xw);
	}
    public function exportPrincipal(){
		
	
	}
	public function exportLogicImmo(){
        $biens_all = Biens::all()->toArray();
        $xw = xmlwriter_open_memory();
        xmlwriter_set_indent($xw, 1);
        $res = xmlwriter_set_indent_string($xw, '    ');
        
    xmlwriter_start_document($xw, '1.0', 'UTF-8');   
        xmlwriter_start_element($xw,"biens");
            xmlwriter_start_element($xw,"annonceur");
                $this->add_element($xw,"numero_carte_pro","16012016000003526");
                $this->add_element($xw,"bareme_honoraires_pdf","http://www.domaine.com/bareme_honoraires.pdf?maj=13042017_110217</bareme_honoraires_pdf");
            xmlwriter_end_element($xw);
            //Biens à la vente
            xmlwriter_start_element($xw,"bien");
                $this->add_element($xw,"agence_nom","agence_nomx");
                $this->add_element($xw,"agence_tel","748956321");
                $this->add_element($xw,"agence_tel2","0252526545");
                $this->add_element($xw,"agence_mail","aderd@gg.fr");
                $this->add_element($xw,"agence_mobile","052854714");
                $this->add_element($xw,"agence_fax","16012016000003526");
                $this->add_element($xw,"agence_adresse","adresse 05");
                $this->add_element($xw,"agence_postal","ag_pos");
                $this->add_element($xw,"agence_postal_insee","xxxxxxxx");
                $this->add_element($xw,"agence_ville","agence_ville");
                $this->add_element($xw,"agence_pays","agence_pays");
                $this->add_element($xw,"code_passerelle","code_passerelle");
                $this->add_element($xw,"reference_logiciel","reference_logiciel");
                $this->add_element($xw,"reference_client","reference_client");
                $this->add_element($xw,"numero_mandat","numero_mandat");
                $this->add_element($xw,"type_mandat","type_mandat");
                $this->add_element($xw,"agence_tel_a_afficher","agence_tel_a_afficher");
                $this->add_element($xw,"agence_mail_a_afficher","agence_mail_a_afficher");
                $this->add_element($xw,"negociateur_nom","negociateur_nom");
                $this->add_element($xw,"negociateur_tel","negociateur_tel");
                $this->add_element($xw,"negociateur_mail","negociateur_mail");
                xmlwriter_start_element($xw,"photos");
                    xmlwriter_start_element($xw,"photo");
                        $this->add_element($xw,"titre","salon");
                        $this->add_element($xw,"url","http://www.domaine.com/monannonce/landscape.jpg");
                    xmlwriter_end_element($xw);
                    xmlwriter_start_element($xw,"photo");
                        $this->add_element($xw,"titre","cuisine");
                        $this->add_element($xw,"url","http://www.domaine.com/monannonce/rec.jpg");
                    xmlwriter_end_element($xw);
                    // photo panoramique
                    xmlwriter_start_element($xw,"photo_panoramique");
                        $this->add_element($xw,"titre","terrasse");
                        $this->add_element($xw,"url","http://www.domaine.com/monannonce/rt.jpg");
                    xmlwriter_end_element($xw);
                xmlwriter_end_element($xw);
                $this->add_element($xw,"type_transaction","type_transaction");
                $this->add_element($xw,"type_bien","type_bien");
                $this->add_element($xw,"publication_web","publication_web");
                xmlwriter_start_element($xw,"publication_liste");
                    $this->add_element($xw,"site","LICOM");
                    $this->add_element($xw,"site","LICOM");
                    $this->add_element($xw,"site","LICOM");
                xmlwriter_end_element($xw);
                xmlwriter_start_element($xw,"titres");
                    $this->add_element($xw,"titre_web_fr","titre_web_fr");
                    $this->add_element($xw,"titre_print_fr","titre_print_fr");
                    $this->add_element($xw,"titre_web_nl","titre_web_nl");
                    $this->add_element($xw,"titre_print_nl","titre_print_nl");
                    $this->add_element($xw,"titre_web_en","titre_web_en");
                    $this->add_element($xw,"titre_print_en","titre_print_en");
                    $this->add_element($xw,"titre_web_de","titre_web_de");
                    $this->add_element($xw,"titre_print_de","titre_print_de");
                    $this->add_element($xw,"titre_web_it","titre_web_it");
                    $this->add_element($xw,"titre_print_it","titre_print_it");
                    $this->add_element($xw,"titre_web_pt","titre_web_pt");
                    $this->add_element($xw,"titre_print_pt","titre_print_pt");
                    $this->add_element($xw,"titre_web_sp","titre_web_sp");
                    $this->add_element($xw,"titre_print_sp","titre_print_sp");
                    $this->add_element($xw,"titre_web_ru","titre_web_ru");
                    $this->add_element($xw,"titre_print_ru","titre_print_ru");
                xmlwriter_end_element($xw);
                xmlwriter_start_element($xw,"descriptions");
                    $this->add_element($xw,"descriptif_web_fr","descriptif_web_fr");
                    $this->add_element($xw,"descriptif_print_fr","descriptif_print_fr");
                    $this->add_element($xw,"descriptif_web_nl","descriptif_web_nl");
                    $this->add_element($xw,"descriptif_print_nl","descriptif_print_nl");
                    $this->add_element($xw,"descriptif_web_en","descriptif_web_en");
                    $this->add_element($xw,"descriptif_print_en","descriptif_print_en");
                    $this->add_element($xw,"descriptif_web_de","descriptif_web_de");
                    $this->add_element($xw,"descriptif_print_de","descriptif_print_de");
                    $this->add_element($xw,"descriptif_web_it","descriptif_web_it");
                    $this->add_element($xw,"descriptif_print_it","descriptif_print_it");
                    $this->add_element($xw,"descriptif_web_pt","descriptif_web_pt");
                    $this->add_element($xw,"descriptif_print_pt","descriptif_print_pt");
                    $this->add_element($xw,"descriptif_web_sp","descriptif_web_sp");
                    $this->add_element($xw,"descriptif_print_sp","descriptif_print_sp");
                    $this->add_element($xw,"descriptif_web_ru","descriptif_web_ru");
                    $this->add_element($xw,"descriptif_print_ru","descriptif_print_ru");
                xmlwriter_end_element($xw);
                $this->add_element($xw,"adresse","adresse");
                $this->add_element($xw,"adresse_approximative","adresse_approximative");
                $this->add_element($xw,"code_postal_a_afficher","code_postal_a_afficher");
                $this->add_element($xw,"code_postal_reel","code_postal_reel");
                $this->add_element($xw,"code_postal_insee","code_postal_insee");
                $this->add_element($xw,"code_postal_approximatif","code_postal_approximatif");
                $this->add_element($xw,"commune_reel","commune_reel");
                $this->add_element($xw,"commune_a_afficher","commune_a_afficher");
                $this->add_element($xw,"commune_approximative","commune_approximative");
                $this->add_element($xw,"secteur","secteur");
                $this->add_element($xw,"pays","pays");
                $this->add_element($xw,"is_confidence_commune","is_confidence_commune");
                $this->add_element($xw,"gps_longitude","gps_longitude");
                $this->add_element($xw,"gps_longitude_approximative","gps_longitude_approximative");
                $this->add_element($xw,"gps_latitude","gps_latitude");
                $this->add_element($xw,"gps_latitude","gps_latitude");
                $this->add_element($xw,"gps_latitude_approximative","gps_latitude_approximative");
                $this->add_element($xw,"gps_rayon","gps_rayon");
                $this->add_element($xw,"proximite_liste","proximite_liste");
                $this->add_element($xw,"proximite_gare","proximite_gare");
                $this->add_element($xw,"proximite_metro","proximite_metro");
                $this->add_element($xw,"proximite_commerce","proximite_commerce");
                $this->add_element($xw,"proximite_bus","proximite_bus");
                $this->add_element($xw,"proximite_tourisme","proximite_tourisme");
                $this->add_element($xw,"proximite_tourisme","proximite_tourisme");
                $this->add_element($xw,"proximite_culture","proximite_culture");
                $this->add_element($xw,"proximite_culture","proximite_culture");
                $this->add_element($xw,"proximite_ecole","proximite_ecole");
                $this->add_element($xw,"proximite_espace_vert","proximite_espace_vert");
                $this->add_element($xw,"prix","prix");
                $this->add_element($xw,"depot_garantie","depot_garantie");
                $this->add_element($xw,"montant_charge","montant_charge");
                $this->add_element($xw,"montant_charges_copropriete","montant_charges_copropriete");
                $this->add_element($xw,"is_en_procedure","is_en_procedure");
                $this->add_element($xw,"evolution_procedure","evolution_procedure");
                $this->add_element($xw,"frais_agence_a_la_charge_de","frais_agence_a_la_charge_de");
                $this->add_element($xw,"is_bien_en_copropriete","is_bien_en_copropriete");
                $this->add_element($xw,"nb_lots_copropriete","nb_lots_copropriete");
                $this->add_element($xw,"numero_du_lot_en_copropriete","numero_du_lot_en_copropriete");
                $this->add_element($xw,"statut_syndicat","statut_syndicat");
                $this->add_element($xw,"montant_taxe","montant_taxe");
                $this->add_element($xw,"devise","devise");
                $this->add_element($xw,"is_confidence_prix","is_confidence_prix");
                $this->add_element($xw,"dpe_bilan","dpe_bilan");
                $this->add_element($xw,"dpe_valeur","dpe_valeur");
                $this->add_element($xw,"dpe_date","dpe_date");
                $this->add_element($xw,"ges_bilan","ges_bilan");
                $this->add_element($xw,"ges_valeur","ges_valeur");
                $this->add_element($xw,"ges_date","ges_date");
                $this->add_element($xw,"is_batiment_basse_conso","is_batiment_basse_conso");
                $this->add_element($xw,"type_chauffage","type_chauffage");
                $this->add_element($xw,"nature_chauffage","nature_chauffage");
                $this->add_element($xw,"type_cuisine","type_cuisine");
                $this->add_element($xw,"nb_pieces","nb_pieces");
                $this->add_element($xw,"nb_chambres","nb_chambres");
                $this->add_element($xw,"nb_etages","nb_etages");
                $this->add_element($xw,"nb_salle_d_eau","nb_salle_d_eau");
                $this->add_element($xw,"nb_salle_de_bain","nb_salle_de_bain");
                $this->add_element($xw,"nb_garages","nb_garages");
                $this->add_element($xw,"nb_parkings","nb_parkings");
                $this->add_element($xw,"nb_parkings_exterieurs","nb_parkings_exterieurs");
                $this->add_element($xw,"nb_parkings_interieurs","nb_parkings_interieurs");
                $this->add_element($xw,"nb_tennis","nb_tennis");
                $this->add_element($xw,"nb_wc","nb_wc");
                $this->add_element($xw,"surface_bien","surface_bien");
                $this->add_element($xw,"surface_sejour","surface_sejour");
                $this->add_element($xw,"surface_terrain","surface_terrain");
                $this->add_element($xw,"surface_terrasse","surface_terrasse");
                $this->add_element($xw,"is_duplex","is_duplex");
                $this->add_element($xw,"is_investissement","is_investissement");
                $this->add_element($xw,"is_recent","is_recent");
                $this->add_element($xw,"is_refait","is_refait");
                $this->add_element($xw,"is_travaux","is_travaux");
                $this->add_element($xw,"is_acces_handicapes","is_acces_handicapes");
                $this->add_element($xw,"is_terrain_constructible","is_terrain_constructible");
                $this->add_element($xw,"has_ascenseur","has_ascenseur");
                $this->add_element($xw,"has_balcon","has_balcon");
                $this->add_element($xw,"has_terrasse","has_terrasse");
                $this->add_element($xw,"has_climatisation","has_climatisation");
                $this->add_element($xw,"has_piscine","has_piscine");
                $this->add_element($xw,"has_cabletv","has_cabletv");
                $this->add_element($xw,"has_cave","has_cave");
                $this->add_element($xw,"has_cellier","has_cellier");
                $this->add_element($xw,"has_garage","has_garage");
                $this->add_element($xw,"has_box","has_box");
                $this->add_element($xw,"has_grenier","has_grenier");
                $this->add_element($xw,"has_jardin","has_jardin");
                $this->add_element($xw,"has_veranda","has_veranda");
                $this->add_element($xw,"annee_construction","annee_construction");
                $this->add_element($xw,"date_de_livraison","date_de_livraison");
                $this->add_element($xw,"liste_annexes","liste_annexes");
                $this->add_element($xw,"url_visite_virtuelle","url_visite_virtuelle");
                $this->add_element($xw,"url_bien_internet","url_bien_internet");
                $this->add_element($xw,"pourcentage_honoraires_acquereur","pourcentage_honoraires_acquereur");
                $this->add_element($xw,"prix_sans_honoraires","prix_sans_honoraires");                     
             //Biens à la vente
            xmlwriter_end_element($xw);
            //Biens à la location
            xmlwriter_start_element($xw,"bien");
                $this->add_element($xw,"agence_nom","agence_nomx");
                $this->add_element($xw,"agence_tel","748956321");
                $this->add_element($xw,"agence_tel2","0252526545");
                $this->add_element($xw,"agence_mail","aderd@gg.fr");
                $this->add_element($xw,"agence_mobile","052854714");
                $this->add_element($xw,"agence_fax","16012016000003526");
                $this->add_element($xw,"agence_adresse","adresse 05");
                $this->add_element($xw,"agence_postal","ag_pos");
                $this->add_element($xw,"agence_postal_insee","xxxxxxxx");
                $this->add_element($xw,"agence_ville","agence_ville");
                $this->add_element($xw,"agence_pays","agence_pays");
                $this->add_element($xw,"code_passerelle","code_passerelle");
                $this->add_element($xw,"reference_logiciel","reference_logiciel");
                $this->add_element($xw,"reference_client","reference_client");
                $this->add_element($xw,"numero_mandat","numero_mandat");
                $this->add_element($xw,"type_mandat","type_mandat");
                $this->add_element($xw,"agence_tel_a_afficher","agence_tel_a_afficher");
                $this->add_element($xw,"agence_mail_a_afficher","agence_mail_a_afficher");
                $this->add_element($xw,"negociateur_nom","negociateur_nom");
                $this->add_element($xw,"negociateur_tel","negociateur_tel");
                $this->add_element($xw,"negociateur_mail","negociateur_mail");
                xmlwriter_start_element($xw,"photos");
                    xmlwriter_start_element($xw,"photo");
                        $this->add_element($xw,"titre","salon");
                        $this->add_element($xw,"url","http://www.domaine.com/monannonce/landscape.jpg");
                    xmlwriter_end_element($xw);
                    xmlwriter_start_element($xw,"photo");
                        $this->add_element($xw,"titre","cuisine");
                        $this->add_element($xw,"url","http://www.domaine.com/monannonce/rec.jpg");
                    xmlwriter_end_element($xw);
                    // photo panoramique
                    xmlwriter_start_element($xw,"photo_panoramique");
                        $this->add_element($xw,"titre","terrasse");
                        $this->add_element($xw,"url","http://www.domaine.com/monannonce/rt.jpg");
                    xmlwriter_end_element($xw);
                xmlwriter_end_element($xw);
                $this->add_element($xw,"type_transaction","type_transaction");
                $this->add_element($xw,"type_bien","type_bien");
                $this->add_element($xw,"publication_web","publication_web");
                xmlwriter_start_element($xw,"publication_liste");
                    $this->add_element($xw,"site","LICOM");
                    $this->add_element($xw,"site","LICOM");
                    $this->add_element($xw,"site","LICOM");
                xmlwriter_end_element($xw);
                xmlwriter_start_element($xw,"titres");
                    $this->add_element($xw,"titre_web_fr","titre_web_fr");
                    $this->add_element($xw,"titre_print_fr","titre_print_fr");
                    $this->add_element($xw,"titre_web_nl","titre_web_nl");
                    $this->add_element($xw,"titre_print_nl","titre_print_nl");
                    $this->add_element($xw,"titre_web_en","titre_web_en");
                    $this->add_element($xw,"titre_print_en","titre_print_en");
                    $this->add_element($xw,"titre_web_de","titre_web_de");
                    $this->add_element($xw,"titre_print_de","titre_print_de");
                    $this->add_element($xw,"titre_web_it","titre_web_it");
                    $this->add_element($xw,"titre_print_it","titre_print_it");
                    $this->add_element($xw,"titre_web_pt","titre_web_pt");
                    $this->add_element($xw,"titre_print_pt","titre_print_pt");
                    $this->add_element($xw,"titre_web_sp","titre_web_sp");
                    $this->add_element($xw,"titre_print_sp","titre_print_sp");
                    $this->add_element($xw,"titre_web_ru","titre_web_ru");
                    $this->add_element($xw,"titre_print_ru","titre_print_ru");
                xmlwriter_end_element($xw);
                xmlwriter_start_element($xw,"descriptions");
                    $this->add_element($xw,"descriptif_web_fr","descriptif_web_fr");
                    $this->add_element($xw,"descriptif_print_fr","descriptif_print_fr");
                    $this->add_element($xw,"descriptif_web_nl","descriptif_web_nl");
                    $this->add_element($xw,"descriptif_print_nl","descriptif_print_nl");
                    $this->add_element($xw,"descriptif_web_en","descriptif_web_en");
                    $this->add_element($xw,"descriptif_print_en","descriptif_print_en");
                    $this->add_element($xw,"descriptif_web_de","descriptif_web_de");
                    $this->add_element($xw,"descriptif_print_de","descriptif_print_de");
                    $this->add_element($xw,"descriptif_web_it","descriptif_web_it");
                    $this->add_element($xw,"descriptif_print_it","descriptif_print_it");
                    $this->add_element($xw,"descriptif_web_pt","descriptif_web_pt");
                    $this->add_element($xw,"descriptif_print_pt","descriptif_print_pt");
                    $this->add_element($xw,"descriptif_web_sp","descriptif_web_sp");
                    $this->add_element($xw,"descriptif_print_sp","descriptif_print_sp");
                    $this->add_element($xw,"descriptif_web_ru","descriptif_web_ru");
                    $this->add_element($xw,"descriptif_print_ru","descriptif_print_ru");
                xmlwriter_end_element($xw);
                $this->add_element($xw,"adresse","adresse");
                $this->add_element($xw,"adresse_approximative","adresse_approximative");
                $this->add_element($xw,"code_postal_a_afficher","code_postal_a_afficher");
                $this->add_element($xw,"code_postal_reel","code_postal_reel");
                $this->add_element($xw,"code_postal_insee","code_postal_insee");
                $this->add_element($xw,"code_postal_approximatif","code_postal_approximatif");
                $this->add_element($xw,"commune_reel","commune_reel");
                $this->add_element($xw,"commune_a_afficher","commune_a_afficher");
                $this->add_element($xw,"commune_approximative","commune_approximative");
                $this->add_element($xw,"secteur","secteur");
                $this->add_element($xw,"pays","pays");
                $this->add_element($xw,"is_confidence_commune","is_confidence_commune");
                $this->add_element($xw,"gps_longitude","gps_longitude");
                $this->add_element($xw,"gps_longitude_approximative","gps_longitude_approximative");
                $this->add_element($xw,"gps_latitude","gps_latitude");
                $this->add_element($xw,"gps_latitude","gps_latitude");
                $this->add_element($xw,"gps_latitude_approximative","gps_latitude_approximative");
                $this->add_element($xw,"gps_rayon","gps_rayon");
                $this->add_element($xw,"proximite_liste","proximite_liste");
                $this->add_element($xw,"proximite_gare","proximite_gare");
                $this->add_element($xw,"proximite_metro","proximite_metro");
                $this->add_element($xw,"proximite_commerce","proximite_commerce");
                $this->add_element($xw,"proximite_bus","proximite_bus");
                $this->add_element($xw,"proximite_tourisme","proximite_tourisme");
                $this->add_element($xw,"proximite_tourisme","proximite_tourisme");
                $this->add_element($xw,"proximite_culture","proximite_culture");
                $this->add_element($xw,"proximite_culture","proximite_culture");
                $this->add_element($xw,"proximite_ecole","proximite_ecole");
                $this->add_element($xw,"proximite_espace_vert","proximite_espace_vert");
                $this->add_element($xw,"prix","prix");
                $this->add_element($xw,"depot_garantie","depot_garantie");
                $this->add_element($xw,"montant_charge","montant_charge");
                $this->add_element($xw,"montant_charges_copropriete","montant_charges_copropriete");
                $this->add_element($xw,"is_en_procedure","is_en_procedure");
                $this->add_element($xw,"evolution_procedure","evolution_procedure");
                $this->add_element($xw,"frais_agence_a_la_charge_de","frais_agence_a_la_charge_de");
                $this->add_element($xw,"is_bien_en_copropriete","is_bien_en_copropriete");
                $this->add_element($xw,"nb_lots_copropriete","nb_lots_copropriete");
                $this->add_element($xw,"numero_du_lot_en_copropriete","numero_du_lot_en_copropriete");
                $this->add_element($xw,"statut_syndicat","statut_syndicat");
                $this->add_element($xw,"montant_taxe","montant_taxe");
                $this->add_element($xw,"devise","devise");
                $this->add_element($xw,"is_confidence_prix","is_confidence_prix");
                $this->add_element($xw,"dpe_bilan","dpe_bilan");
                $this->add_element($xw,"dpe_valeur","dpe_valeur");
                $this->add_element($xw,"dpe_date","dpe_date");
                $this->add_element($xw,"ges_bilan","ges_bilan");
                $this->add_element($xw,"ges_valeur","ges_valeur");
                $this->add_element($xw,"ges_date","ges_date");
                $this->add_element($xw,"is_batiment_basse_conso","is_batiment_basse_conso");
                $this->add_element($xw,"type_chauffage","type_chauffage");
                $this->add_element($xw,"nature_chauffage","nature_chauffage");
                $this->add_element($xw,"type_cuisine","type_cuisine");
                $this->add_element($xw,"nb_pieces","nb_pieces");
                $this->add_element($xw,"nb_chambres","nb_chambres");
                $this->add_element($xw,"nb_etages","nb_etages");
                $this->add_element($xw,"nb_salle_d_eau","nb_salle_d_eau");
                $this->add_element($xw,"nb_salle_de_bain","nb_salle_de_bain");
                $this->add_element($xw,"nb_garages","nb_garages");
                $this->add_element($xw,"nb_parkings","nb_parkings");
                $this->add_element($xw,"nb_parkings_exterieurs","nb_parkings_exterieurs");
                $this->add_element($xw,"nb_parkings_interieurs","nb_parkings_interieurs");
                $this->add_element($xw,"nb_tennis","nb_tennis");
                $this->add_element($xw,"nb_wc","nb_wc");
                $this->add_element($xw,"surface_bien","surface_bien");
                $this->add_element($xw,"surface_sejour","surface_sejour");
                $this->add_element($xw,"surface_terrain","surface_terrain");
                $this->add_element($xw,"surface_terrasse","surface_terrasse");
                $this->add_element($xw,"is_duplex","is_duplex");
                $this->add_element($xw,"is_investissement","is_investissement");
                $this->add_element($xw,"is_recent","is_recent");
                $this->add_element($xw,"is_refait","is_refait");
                $this->add_element($xw,"is_travaux","is_travaux");
                $this->add_element($xw,"is_acces_handicapes","is_acces_handicapes");
                $this->add_element($xw,"is_terrain_constructible","is_terrain_constructible");
                $this->add_element($xw,"has_ascenseur","has_ascenseur");
                $this->add_element($xw,"has_balcon","has_balcon");
                $this->add_element($xw,"has_terrasse","has_terrasse");
                $this->add_element($xw,"has_climatisation","has_climatisation");
                $this->add_element($xw,"has_piscine","has_piscine");
                $this->add_element($xw,"has_cabletv","has_cabletv");
                $this->add_element($xw,"has_cave","has_cave");
                $this->add_element($xw,"has_cellier","has_cellier");
                $this->add_element($xw,"has_garage","has_garage");
                $this->add_element($xw,"has_box","has_box");
                $this->add_element($xw,"has_grenier","has_grenier");
                $this->add_element($xw,"has_jardin","has_jardin");
                $this->add_element($xw,"has_veranda","has_veranda");
                $this->add_element($xw,"annee_construction","annee_construction");
                $this->add_element($xw,"date_de_livraison","date_de_livraison");
                $this->add_element($xw,"liste_annexes","liste_annexes");
                // differences entre vente et location
                $this->add_element($xw,"etage","etage");
                $this->add_element($xw,"expositions","expositions");
                $this->add_element($xw,"url_visite_virtuelle","url_visite_virtuelle");
                $this->add_element($xw,"url_bien_internet","url_bien_internet");
                $this->add_element($xw,"montant_frais_agence","montant_frais_agence");
                $this->add_element($xw,"montant_honoraires_etat_lieux","montant_honoraires_etat_lieux");
                $this->add_element($xw,"type_regularisation_charges","type_regularisation_charges");
                $this->add_element($xw,"mode_regularisation_charges","mode_regularisation_charges");
                $this->add_element($xw,"montant_complement_loyer","montant_complement_loyer");
                $this->add_element($xw,"frequence_reglement_loyer","frequence_reglement_loyer");
                $this->add_element($xw,"frequence_reglement_charges","frequence_reglement_charges");
                $this->add_element($xw,"echeance_reglement_loyer","echeance_reglement_loyer");
                $this->add_element($xw,"echeance_reglement_charges","echeance_reglement_charges");
                // fin differences entre vente et location          
            //Biens à la location
            xmlwriter_end_element($xw);
     
        xmlwriter_end_element($xw);   
        //Fin  du document
    xmlwriter_end_document($xw);
    	file_put_contents ($this->photos_path.'/annonce2.xml',xmlwriter_output_memory($xw));
       dd( xmlwriter_output_memory($xw) );
	}
/** Fonction de téléchargement des photos du bien document
* @author jean-philippe
* @param  App\Models\PhotosBien
* @return \Illuminate\Http\Response
**/	
	public function exportCleMidi(){
        $xw = xmlwriter_open_memory();
        xmlwriter_set_indent($xw, 1);
        $res = xmlwriter_set_indent_string($xw, '    ');
        
    xmlwriter_start_document($xw, '1.0', 'UTF-8');   
        xmlwriter_start_element($xw,"Agence");
        	xmlwriter_start_element($xw,"Client");
				
				xmlwriter_start_element($xw,"ClientDetails");
					$this->add_element($xw,"clientNom","clientNom");
					$this->add_element($xw,"clientContact","clientContact");
					$this->add_element($xw,"clientContactEmail","clientContactEmail");
					$this->add_element($xw,"clientTelephone","clientTelephone");
				xmlwriter_end_element($xw);
            
				xmlwriter_start_element($xw,"Annonces");
					xmlwriter_start_element($xw,"Annonce");
					$this->add_element($xw,"referenceInterne","referenceInterne");
					$this->add_element($xw,"referenceMandat","referenceMandat");
					$this->add_element($xw,"departementNum","departementNum");
					$this->add_element($xw,"codePostal","codePostal");
					$this->add_element($xw,"codeInsee","codeInsee");
					$this->add_element($xw,"typeTransaction","typeTransaction");
					$this->add_element($xw,"honoraires_charges","honoraires_charges");
					$this->add_element($xw,"typeBien","typeBien");
					$this->add_element($xw,"typePrecis","typePrecis");
					$this->add_element($xw,"prix","prix");
					$this->add_element($xw,"prix_net","prix_net");
					$this->add_element($xw,"exclusivite","exclusivite");
					$this->add_element($xw,"surface","surface");
					$this->add_element($xw,"surfaceTerrain","surfaceTerrain");
					$this->add_element($xw,"nombrePiece","nombrePiece");
					$this->add_element($xw,"nombreEtages","nombreEtages");
					$this->add_element($xw,"niveauEtage","niveauEtage");
					$this->add_element($xw,"nombreChambre","nombreChambre");
					$this->add_element($xw,"NombreSalleDeBain","NombreSalleDeBain");
					$this->add_element($xw,"nombreSalleDeau","nombreSalleDeau");
					$this->add_element($xw,"ascenseur","ascenseur");
					$this->add_element($xw,"accesHandicape","accesHandicape");
					$this->add_element($xw,"surfaceBalcon","surfaceBalcon");
					$this->add_element($xw,"nombreBalcon","nombreBalcon");
					$this->add_element($xw,"nombreTerrasse","nombreTerrasse");
					$this->add_element($xw,"surfaceTerrasse","surfaceTerrasse");
					$this->add_element($xw,"piscine","piscine");
					$this->add_element($xw,"cuisine","cuisine");
					$this->add_element($xw,"garage","garage");
					$this->add_element($xw,"parking","parking");
					xmlwriter_start_element($xw,"dpe");
						$this->add_element($xw,"ges","ges");
						$this->add_element($xw,"bges","bges");
						$this->add_element($xw,"ce","ce");
						$this->add_element($xw,"bce","bce");
					xmlwriter_end_element($xw);
					$this->add_element($xw,"titre","titre");
					$this->add_element($xw,"descriptiff","descriptiff");
					$this->add_element($xw,"descriptif_en","descriptif_en");
                    $this->add_element($xw,"descriptif_de","descriptif_de");					
                    xmlwriter_start_element($xw,"images");
                        xmlwriter_start_element($xw,"image");
                            xmlwriter_start_attribute($xw,"number");                        
                                xmlwriter_text($xw, 1);
                            xmlwriter_end_attribute($xw);  
                            xmlwriter_text($xw, 'http:/imag1');
                        xmlwriter_end_element($xw);
                        xmlwriter_start_element($xw,"image");
                            xmlwriter_start_attribute($xw,"number");                      
                                xmlwriter_text($xw, 2);
                            xmlwriter_end_attribute($xw);
                   
                        xmlwriter_text($xw, 'http:/imag1');
                        xmlwriter_end_element($xw);
                    xmlwriter_end_element($xw);
                    $this->add_element($xw,"datemaj","02/12/2018");
					xmlwriter_end_element($xw);			   
				xmlwriter_end_element($xw);
				
            xmlwriter_end_element($xw);
        xmlwriter_end_element($xw);
		
        //Fin  du document
    xmlwriter_end_document($xw);
    	file_put_contents ($this->photos_path.'/annonce2.xml',xmlwriter_output_memory($xw));
       dd( xmlwriter_output_memory($xw) );
    }
    
    
/** Fonction de téléchargement des photos du bien document
* @author jean-philippe
* @param  App\Models\PhotosBien
* @return \Illuminate\Http\Response
**/	
	public function exportLeboncoin(){
        $xw = xmlwriter_open_memory();
        xmlwriter_set_indent($xw, 1);
        $res = xmlwriter_set_indent_string($xw, '    ');
        
    xmlwriter_start_document($xw, '1.0', 'ISO-8859-15');   
        xmlwriter_start_element($xw,"client");
                xmlwriter_start_attribute($xw,"code");                        
                                xmlwriter_text($xw, "ag350219");
                xmlwriter_end_attribute($xw);
				
				xmlwriter_start_element($xw,"coordonnees");
                    $this->add_element($xw,"raison_sociale","raison_sociale");
                    xmlwriter_start_element($xw,"adresse");
					    $this->add_element($xw,"voirie","voirie");					
					    $this->add_element($xw,"code_postal","code_postal");					
					    $this->add_element($xw,"ville","ville");					
                    xmlwriter_end_element($xw);	
                        
					$this->add_element($xw,"telephone","telephone");					
					$this->add_element($xw,"fax","fax");					
					$this->add_element($xw,"email","email");					
					$this->add_element($xw,"web","web");					
                xmlwriter_end_element($xw);
                
                xmlwriter_start_element($xw,"annonces");
                    xmlwriter_start_attribute($xw,"id");                        
                        xmlwriter_text($xw, 1453332);
                    xmlwriter_end_attribute($xw); 
                    $this->add_element($xw,"reference","reference");					
                    $this->add_element($xw,"titre","titre");					
                    $this->add_element($xw,"texte","texte");					
                    $this->add_element($xw,"date_saisie","date_saisie");					
                    $this->add_element($xw,"date_integration","date_integration");
                    
                    xmlwriter_start_element($xw,"bien");
                        $this->add_element($xw,"code_type","code_type");
                        $this->add_element($xw,"libelle_type","libelle_type");
                        $this->add_element($xw,"code_postal","code_postal");
                        $this->add_element($xw,"ville","ville");
                        $this->add_element($xw,"code_insee","code_insee");
                        $this->add_element($xw,"departement","departement");
                        $this->add_element($xw,"pays","pays");
                        $this->add_element($xw,"surface","surface");
                        $this->add_element($xw,"prestige","prestige");
                        $this->add_element($xw,"lotissement","lotissement");
                    xmlwriter_end_element($xw);
                    xmlwriter_start_element($xw,"prestation");
                        $this->add_element($xw,"type","type");
                        $this->add_element($xw,"mandat_type","mandat_type");
                        $this->add_element($xw,"prix","prix");
                    xmlwriter_end_element($xw);	
                    xmlwriter_start_element($xw,"commerces");
                        $this->add_element($xw,"nb_salaries","nb_salaries");
                        $this->add_element($xw,"capital_societe","capital_societe");
                        $this->add_element($xw,"regime_juridique","regime_juridique");
                        $this->add_element($xw,"benefices_industriels_et_commerciaux_annee_n","benefices_industriels_et_commerciaux_annee_n");
                        $this->add_element($xw,"benefices_industriels_et_commerciaux_annee_n_moins_1","benefices_industriels_et_commerciaux_annee_n_moins_1");
                        $this->add_element($xw,"benefices_industriels_et_commerciaux_annee_n_moins_2","benefices_industriels_et_commerciaux_annee_n_moins_2");
                        $this->add_element($xw,"valeur_comptable","valeur_comptable");
                        $this->add_element($xw,"cashflow","cashflow");
                        $this->add_element($xw,"type_bail","type_bail");
                        $this->add_element($xw,"chiffre_d_affaires_annee_n","chiffre_d_affaires_annee_n");
                        $this->add_element($xw,"chiffre_d_affaires_annee_n_moins_1","chiffre_d_affaires_annee_n_moins_1");
                        $this->add_element($xw,"chiffre_d_affaires_annee_n_moins_2","chiffre_d_affaires_annee_n_moins_2");
                        $this->add_element($xw,"rcs","rcs");                        
                        $this->add_element($xw,"masse_salariale","masse_salariale");                        
                        $this->add_element($xw,"raison_sociale","raison_sociale");                        
                        $this->add_element($xw,"enseigne","enseigne");                        
                        $this->add_element($xw,"personnel","personnel");                        
                        $this->add_element($xw,"surface_divisible_minimum","surface_divisible_minimum");                        
                        $this->add_element($xw,"ca","ca");                        
                        $this->add_element($xw,"ebe","ebe");                        
                        $this->add_element($xw,"loto","loto");                        
                        $this->add_element($xw,"pmu","pmu");                                          
                    xmlwriter_end_element($xw);
                    xmlwriter_start_element($xw,"photos");
                        $this->add_element($xw,"photo","http://photos.ubiflow.net/350219/17590669/photos/1.jpg?20130115180221");
                        $this->add_element($xw,"photo","http://photos.ubiflow.net/350219/17590669/photos/1.jpg?20130115180221");
                        $this->add_element($xw,"photo","http://photos.ubiflow.net/350219/17590669/photos/1.jpg?20130115180221");
                        $this->add_element($xw,"photo","http://photos.ubiflow.net/350219/17590669/photos/1.jpg?20130115180221");
                        $this->add_element($xw,"photo","http://photos.ubiflow.net/350219/17590669/photos/1.jpg?20130115180221");  
                    xmlwriter_end_element($xw);	
                    $this->add_element($xw,"contact_a_afficher","contact_a_afficher");                                          
                    $this->add_element($xw,"email_a_afficher","email_a_afficher");                                          
                    $this->add_element($xw,"telephone_a_afficher","telephone_a_afficher");                                          
        xmlwriter_end_element($xw);
        //Fin  du document
    xmlwriter_end_document($xw);
    	file_put_contents ($this->photos_path.'/annonce2.xml',xmlwriter_output_memory($xw));
       dd( xmlwriter_output_memory($xw) );
	}
}