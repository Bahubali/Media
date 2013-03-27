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
        $request = $this->getRequest();
        $response = $this->getResponse();
        if ($request->isPost()) {           
            $noteId = \StickyNotes\Model\StickyNoteManager::addNote($this->getEntityManager());
            if (!$noteId)
                $response->setContent(\Zend\Json\Json::encode(array('response' => false)));
            else {
                $response->setContent(\Zend\Json\Json::encode(array('response' => true, 'new_note_id' => $noteId)));
            }
        }
        return $response;
    }
    
    /**
     * Remove Note Action
     * 
     * @return \Zend\Stdlib\ResponseInterface
     */
    public function removeAction() {
        $request = $this->getRequest();
        $response = $this->getResponse();
        if ($request->isPost()) {
            $postData = $request->getPost();
            if (!\StickyNotes\Model\StickyNoteManager::removeNote($this->getEntityManager(), $postData["id"]))
                $response->setContent(\Zend\Json\Json::encode(array('response' => false)));
            else {
                $response->setContent(\Zend\Json\Json::encode(array('response' => true)));
            }
        }
        return $response;
    }
    
    /**
     * Update Action
     * 
     * @return void
     */
    public function updateAction() {
        $request = $this->getRequest();
        $response = $this->getResponse();
        if ($request->isPost()) {
            $postData = $request->getPost();
            if (!\StickyNotes\Model\StickyNoteManager::updateNote($this->getEntityManager(), $postData))
                $response->setContent(\Zend\Json\Json::encode(array('response' => false)));
            else {
                $response->setContent(\Zend\Json\Json::encode(array('response' => true)));
            }
        }
        return $response;
    }
}