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
    StickyNotes\Model\Entity\StickyNote;

class StickyNotesController extends CoreController {
     
    public function indexAction() {
        return new ViewModel(array(
                    'stickynotes' => $this->getEntityClass('StickyNotes\Model\Entity\StickyNote')->findAll(), 
                ));
    }

    public function addAction() {
        $request = $this->getRequest();
        $response = $this->getResponse();
        if ($request->isPost()) {
            $newNote = new \StickyNotes\Model\Entity\StickyNote();
            $newNote->setCreated(date("Y-m-d H:i:s"));
            if (!$note_id = $this->getEntityManager()->persist($newNote))
                $response->setContent(\Zend\Json\Json::encode(array('response' => false)));
            else {
                $response->setContent(\Zend\Json\Json::encode(array('response' => true, 'new_note_id' => $note_id)));
            }
        }
        return $response;
    }

    public function removeAction() {
        $request = $this->getRequest();
        $response = $this->getResponse();
        if ($request->isPost()) {
            $post_data = $request->getPost();
            $note_id = $post_data['id'];
            if (!$this->getEntityManager()->getRepository('StickyNotes\Model\Entity\StickyNote')->removeStickyNote($note_id))
                $response->setContent(\Zend\Json\Json::encode(array('response' => false)));
            else {
                $response->setContent(\Zend\Json\Json::encode(array('response' => true)));
            }
        }
        return $response;
    }

    public function updateAction() {
        // update post
        $request = $this->getRequest();
        $response = $this->getResponse();
        if ($request->isPost()) {
            $post_data = $request->getPost();
            $note_id = $post_data['id'];
            $note_content = $post_data['content'];
            $stickynote = $this->getEntityManager()->getRepository('StickyNotes\Model\Entity\StickyNote')->getStickyNote($note_id);
            $stickynote->setNote($note_content);
            if (!$this->getEntityManager()->getRepository('StickyNotes\Model\Entity\StickyNote')->saveStickyNote($stickynote))
                $response->setContent(\Zend\Json\Json::encode(array('response' => false)));
            else {
                $response->setContent(\Zend\Json\Json::encode(array('response' => true)));
            }
        }
        return $response;
    }

    public function getStickyNotesTable() {
        if (!$this->_stickyNotesTable) {
            $sm = $this->getServiceLocator();
            var_dump($sm->get('Doctrine\ORM\EntityManager'));die;
            $this->_stickyNotesTable = $sm->get('StickyNotes\Model\StickyNotesTable');
        }
        return $this->_stickyNotesTable;
    }

}