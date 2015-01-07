<?php

/**
 * Ce fichier contient la classe EtudiantsController.
 *
 * @copyright  2008 Gabriel Malkas
 * @license    "New" BSD License
*/

/**
 * // TODO :: Description du contrôleur //
 *
 * @copyright  2008 Gabriel Malkas
 * @license    "New" BSD License
 */
class EtudiantsController 
{

    /**
     * // TODO :: Description de l'action //
     *
     * @return void
     */
    public function indexAction()
    {
        
        /*$this->view->etudiants = Etudiant::get();
        
        echo $this->view->render('etudiants/index.tpl');*/
    }
    
    /**
     * // TODO :: Description de l'action //
     *
     * @return void
     */
    public function ajouterAction()
    {
        
        // On crée une instance du formulaire
        //$form = new Form_Etudiant_Ajouter();
        
        if ($this->getRequest()->isPost()) {
             
            //if ($form->isValid(  )) {
               $etudiant =  new Model_DbTable_Example_Etudiant();
                //$post = $this->getRequest()->getPost();
                try {
                   
                /*$resultat= $this->prepare("INSERT INTO etudiant (nom,prenom) VALUES (?,?)");
		$resultat->bindValue(1, , PDO::PARAM_STR);    
		$resultat->bindValue(2,$_POST['prenom'], PDO::PARAM_STR);    
		$resultat->execute();*/
                    
                     Etudiant::add(array("nom"=>$_POST['nom'],"prenom"=>$_POST['prenom']));
                    //$this->insert();
                    $this->_redirect('/Etudiants');
                    
                }catch (Zend_Db_Exception $e) {
                    $this->view->messages = array('DbError' => $e->getMessage());
                }               
                
            } else {
                $this->view->values = $form->getValues();
                $this->view->messages = $form->getMessages();
            }

       //}
        
    }
    
    /**
     * // TODO :: Description de l'action //
     *
     * @return void
     */
    public function modifierAction()
    {
        
        $id = $this->getRequest()->getParam( 'id' );
        $etudiant = Etudiant::findByid('id');
        
        if ($etudiant == null) {
            $this->_redirect('/Etudiants');
        }
    
        // On crée une instance du formulaire
        $form = new Form_Etudiant_Modifier();
        
        if ($this->getRequest()->isPost()) {
             
            if ($form->isValid( $this->getRequest()->getPost() )) {
                
                try {
                    Etudiant::edit($id, $form->getValues());
                    $this->_redirect('/Etudiants');
                }catch (Zend_Db_Exception $e) {
                    $this->view->messages = array('DbError' => $e->getMessage());
                }               
                
            } else {
                $this->view->values = $form->getValues();
                $this->view->messages = $form->getMessages();
            }

        }
    }
    
    /**
     * // TODO :: Description de l'action //
     *
     * @return void
     */
    public function supprimerAction()
    {
    
        $id = $this->getRequest()->getParam( 'id' );
        $etudiant = Etudiant::findByid('id');
        
        if ($etudiant == null) {
            $this->_redirect('/Etudiants');
        }
    
        // On crée une instance du formulaire
        $form = new Form_Etudiant_Supprimer();
        
        if ($this->getRequest()->isPost()) {
             
            if ($form->isValid( $this->getRequest()->getPost() )) {
                
                try {
                    Etudiant::remove(id);
                    $this->_redirect('/Etudiants');
                }catch (Zend_Db_Exception $e) {
                    $this->view->messages = array('DbError' => $e->getMessage());
                }               
                
            } else {
                $this->view->values = $form->getValues();
                $this->view->messages = $form->getMessages();
            }

        }
        
    }

}