<?php

/**
 * Description of StickyNotesController
 *
 * @author Arian Khosravi <arian@bigemployee.com>, <@ArianKhosravi>
 */
// module/StickyNotes/src/StickyNotes/Controller/StickyNotesController.php:

namespace StickyNotes\Controller;

use Core\Controller\CoreController,
    Zend\View\Model\ViewModel, 
    Album\Form\AlbumForm,
    Doctrine\ORM\EntityManager,
    StickyNotes\Model\StickyNoteManager;

class StickyNotesController extends CoreController {

    /**
     * List All Notes
     * 
     * (non-PHPdoc)
     * @see Zend\Mvc\Controller.AbstractActionController::indexAction()
     */
    public function indexAction() {
        return new ViewModel(array(
                    'stickynotes' => $this->getEntityClass('StickyNotes\Model\Entity\StickyNote')->findAll(), 
                ));
    }
    
    /**
     * Add New Note Action
     * 
     * @return void
     */
    public function addAction() {
        if ($this->request->isPost()) {           
            $noteId = \StickyNotes\Model\StickyNoteManager::addNote($this->getEntityManager());
            if (!$noteId)
                $this->response->setContent(\Zend\Json\Json::encode(array('response' => false)));
            else {
                $this->response->setContent(\Zend\Json\Json::encode(array('response' => true, 'new_note_id' => $noteId)));
            }
        }
        return $this->response;
    }
    
    /**
     * Remove Note Action
     * 
     * @return \Zend\Stdlib\ResponseInterface
     */
    public function removeAction() {
        
        if ($this->request->isPost()) {
            $postData = $this->request->getPost();
            if (!\StickyNotes\Model\StickyNoteManager::removeNote($this->getEntityManager(), $postData["id"]))
                $this->response->setContent(\Zend\Json\Json::encode(array('response' => false)));
            else {
                $this->response->setContent(\Zend\Json\Json::encode(array('response' => true)));
            }
        }
        return $this->response;
    }
    
    /**
     * Update Action
     * 
     * @return void
     */
    public function updateAction() {
        
        if ($this->request->isPost()) {
            $postData = $this->request->getPost();
            if (!\StickyNotes\Model\StickyNoteManager::updateNote($this->getEntityManager(), $postData))
                $this->response->setContent(\Zend\Json\Json::encode(array('response' => false)));
            else {
                $this->response->setContent(\Zend\Json\Json::encode(array('response' => true)));
            }
        }
        return $this->response;
    }
}