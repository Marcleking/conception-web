<?php

class GestionCompteController extends TinyMVC_Controller
{
    public function index()
    {
        $this->view->assign('entete', $this->view->fetch("entete"));

        $this->view->assign('accueil', '');
        $this->view->assign('message', '');
        $this->view->assign('envoyerMessage', '');
        $this->view->assign('documents', '');
        $this->view->assign('horaire', '');
        $this->view->assign('dispo', '');
        $this->view->assign('gestionCompte', 'class="active"');
        $this->view->assign('gestionComptes', '');
        $this->view->assign('ressource', '');

        if (isset($_SESSION['user'])) {

            if (isset($_POST['nom']) && isset($_POST['prenom']) &&
                isset($_POST['motdePasse']) && isset($_POST['ancienMotdePasse']) &&
                !empty($_POST['nom']) && !empty($_POST['prenom'])
            ) {
                $notifHoraire = 1;
                $notifRemplacement = 1;


                if (!isset($_POST['notifHoraire'])) {
                    $notifHoraire = 0;
                }

                if (!isset($_POST['notifRemplacement'])) {
                    $notifRemplacement = 0;
                }

                $this->load->model('modifierutilisateur_model', 'modif');

                if (empty($_POST['motdePasse']) && empty($_POST['ancienMotdePasse'])) {
                    $result = $this->modif->modifierUnutilisateur(
                        trim($_POST['nom']),
                        trim($_POST['prenom']),
                        null,
                        null,
                        $_SESSION['user']->getNom(),
                        trim($_POST['numeroCiv']),
                        trim($_POST['rue']),
                        trim($_POST['ville']),
                        trim($_POST['codepost']),
                        $notifHoraire,
                        $notifRemplacement
                    );

                    if (isset($result)) {
                        $this->view->assign("success", "");
                    }
                } elseif (!empty($_POST['motdePasse']) && !empty($_POST['ancienMotdePasse'])) {
                    $result = $this->modif->modifierUnutilisateur(
                        trim($_POST['nom']),
                        trim($_POST['prenom']),
                        $_POST['motdePasse'],
                        $_POST['ancienMotdePasse'],
                        $_SESSION['user']->getNom(),
                        trim($_POST['numeroCiv']),
                        trim($_POST['rue']),
                        trim($_POST['ville']),
                        trim($_POST['codepost']),
                        $notifHoraire,
                        $notifRemplacement
                    );

                    if (isset($result['motDePasse'])) {
                        $this->view->assign("success", "");
                    } else {
                        $this->view->assign("fail", "");
                    }
                } else {
                    $this->view->assign("fail", "");
                }

                $valCritique = false;
                $i = 0;

                $this->modif->supprimerTelephone();

                while (!$valCritique) {
                    if (!isset($_POST['tel'.$i])) {
                        $valCritique = true;
                    } else {
                        $this->modif->ajoutTelephone($_POST['typeTel'.$i], $_POST['tel'.$i]);
                    }
                    $i++;
                }
            } elseif (isset($_POST['numeroCiv']) ||
                isset($_POST['rue']) ||
                isset($_POST['ville']) ||
                isset($_POST['codepost'])
            ) {
                $this->view->assign("fail", "");
            }

            $this->load->model('affichageUtilisateur_model', 'affiche');
            $result = $this->affiche->afficherutilisateur($_SESSION['user']->getNom());
            $this->load->model('affichageutilisateur_model', 'tel');
            $result1 = $this->tel->affichertelehpone($_SESSION['user']->getNom());

            if (count($result1) == 0) {
                $this->view->assign('notelephone', '');
            } else {
                $this->view->assign('notelephone', $result1[0]['noTelephone']);
            }

            $this->view->assign('cell', '');
            $this->view->assign('domi', '');
            $this->view->assign('ecole', '');
            $this->view->assign('bureau', '');
            $this->view->assign('autre', '');

            if ($result1[0]['description'] == "Cellulaire") {
                $this->view->assign('cell', 'selected');
            }

            if ($result1[0]['description'] == "Maison") {
                $this->view->assign('domi', 'selected');
            }

            if ($result1[0]['description'] == "École") {
                $this->view->assign('ecole', 'selected');
            }

            if ($result1[0]['description'] == "Bureau") {
                $this->view->assign('bureau', 'selected');
            }

            if ($result1[0]['description'] == "Autre") {
                $this->view->assign('autre', 'selected');
            }

            $lestel = "";
            for ($i = 0; $i < count($result1); $i++) {
                $tel = "<div class='row' id='tel".$i."'>";
                $tel .= "<div class='large-4 columns'>";
                $tel .=     "<select id='typeTel".$i."' name='typeTel".$i."'>";

                if ($result1[$i]['description'] == "Cellulaire") {
                    $tel .= "<option value='Cellulaire' selected>Cellulaire</option>";
                } else {
                    $tel .= "<option value='Cellulaire'>Cellulaire</option>";
                }

                if ($result1[$i]['description'] == "Maison") {
                    $tel .= "<option value='Domicile' selected>Domicile</option>";
                } else {
                    $tel .= "<option value='Domicile'>Domicile</option>";
                }

                if ($result1[$i]['description'] == "École") {
                    $tel .= "<option value='École' selected>École</option>";
                } else {
                    $tel .= "<option value='École'>École</option>";
                }

                if ($result1[$i]['description'] == "Bureau") {
                    $tel .= "<option value='Bureau' selected>Bureau</option>";
                } else {
                    $tel .= "<option value='Bureau'>Bureau</option>";
                }

                if ($result1[$i]['description'] == "Autre") {
                    $tel .= "<option value='Autre' selected>Autre</option>";
                } else {
                    $tel .= "<option value='Autre'>Autre</option>";
                }

                $tel .= "</select>";
                $tel .= "</div>";

                $tel .= "<div class='large-4 columns left'>";
                    $tel .= "<input type='text' id='tel".$i."' name='tel".$i."'".
                            "value='".$result1[$i]['noTelephone']."' placeholder='Votre téléphone' />";
                $tel .= "</div>";
                $tel .= "<div class='large-4 columns left'>";
                    $tel .= "<a id='telMoins".$i."' class='button small' onClick='suppTel(".$i.")'>".
                            "<i class='fa fa-minus'></i></a>";
                $tel .= "</div>";
                $tel .= "</div>";

                $lestel .= $tel;
            }
            $this->view->assign('resteTel', $lestel);

            $this->view->assign('nom', $result["nom"]);
            $this->view->assign('prenom', $result["prenom"]);
            $this->view->assign('numCivi', $result["numeroCivique"]);
            $this->view->assign('rue', $result["rue"]);
            $this->view->assign('ville', $result["ville"]);
            $this->view->assign('codePostal', $result["codePostal"]);
            $this->view->assign('notHor', $result["notifHoraire"]);
            $this->view->assign('notRem', $result["notifRemplacement"]);


            $this->view->assign('menu', $this->view->fetch("menu"));
            $this->view->assign('contenu', $this->view->fetch("view-gestionCompte"));
        } else {
            $this->view->display('view-connexion');
            return;
        }

        $this->view->display('gabarit');
    }
}
