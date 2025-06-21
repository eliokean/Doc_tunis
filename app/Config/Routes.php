<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

 /* les routes avant connexion*/
$routes->get('/', 'Home::index');
$routes->get('/contact', 'Home::contact');
$routes->get('/galerie', 'Home::galerie');
$routes->get('/Apropos', 'Home::Apropos');
$routes->get('/inscription', 'InscriptionController::inscription');



/* les routes après connexion*/ 
$routes->get('/dashboard', 'DashController::index');
$routes->get('/film', 'FilmController::afficher');
$routes->get('/galerie', 'GalerieController::index');
$routes->get('/planning', 'PlanningController::index');
$routes->get('/resultats', 'ResultatsController::index');
$routes->get('/TestConnexion', 'TestConnexion::index');

/* Admin*/
$routes->get('/admin_dashboard', 'DashController::admin');
$routes->get('/admin_film', 'FilmController::admin');
$routes->get('/admin_planning', 'PlanningController::admin');
$routes->get('/admin_resultats', 'ResultatsController::admin');
$routes->get('/admin', 'AdminController::index');
$routes->post('/admin/updateRole', 'AdminController::updateRole');
$routes->post('admin/assignFilmToJury', 'AdminController::assignFilmToJury');



/* Responsable_Inspection*/
$routes->get('/dashboard_inspection', 'DashController::inspection');
$routes->get('/film_inspection', 'FilmController::afficherFilms');
$routes->get('/planning_inspection', 'PlanningController::inspection');
$routes->get('/resultats_inspection', 'ResultatsController::inspection');
$routes->get('/ajouter-documentaire', 'FilmController::afficherFormulaire');
$routes->post('/ajouter-documentaire', 'FilmController::ajouterFilm');
$routes->get('/film', 'FilmController::afficherFilms');

/* Responsable_Production*/
$routes->get('/dashboard_production', 'DashController::production');
$routes->get('/film_production', 'FilmController::production');
$routes->get('/planning_production', 'PlanningController::production');
$routes->get('/resultats_production', 'ResultatsController::production');
$routes->post('/planning/store', 'PlanningController::store');
$routes->get('/api/getPlanningWithFilms', 'PlanningController::getPlanningWithFilms');


/* Membres Jury*/
$routes->get('/dashboard_jury', 'DashController::jury');
$routes->get('/film_jury', 'FilmController::jury');
$routes->get('/planning_jury', 'PlanningController::jury');
$routes->get('/resultats_jury', 'ResultatsController::jury');
$routes->get('note_jury', 'NoteController::jury');
$routes->post('/note_jury/submit', 'NoteController::notes'); // Pour soumettre une note par le jury


/* President Jury*/
$routes->get('/dashboard_president', 'DashController::president');
$routes->get('/film_president', 'FilmController::president');
$routes->get('/planning_president', 'PlanningController::president');
$routes->get('/resultats_president', 'ResultatsController::president');
$routes->get('jury_president', 'NoteController::jury');
$routes->post('/jury_president/submit', 'NoteController::noteglobale');


//$routes->get('/inscription', 'InscriptionController::inscription'); // Affiche le formulaire
//$routes->post('/inscription', 'InscriptionController::inscription'); // Traite le formulaire
//$routes->get('/success', 'InscriptionController::success'); // Page de confirmation

$routes->get('/test', 'TestController::test');
$routes->get('/test2', 'TestController::test2');

$routes->get('/test-formulaire', 'TestController::afficherFormulaire');
$routes->post('/test-insertion', 'TestController::insererDonnees');
$routes->get('/success', 'TestController::success');



/*Inscription*/
$routes->get('/ajouter-user', 'InscriptionController::afficherFormulaire');
$routes->post('/ajouter-user', 'InscriptionController::ajouterUtilisateur');


/*Authentification*/
$routes->get('/connexion', 'AuthController::index');
$routes->post('/connexion', 'AuthController::authenticate');
$routes->get('/logout', 'AuthController::logout');



