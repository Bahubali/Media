<?php

/**
 * Description of StickyNotesController
 *
 * @author Arian Khosravi <arian@bigemployee.com>, <@ArianKhosravi>
 */
// module/StickyNotes/src/StickyNotes/Controller/StickyNotesController.php:
namespace Core\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Doctrine\ORM\EntityManager,
    StickyNotes\Model\Entity\StickyNote,
    Zend\Filter\Null;

class CoreController extends AbstractActionController {
    
    /**
     * @var Doctrine\ORM\EntityManager
     */
    protected $_entityManager;
    
    /**
     * Constructor
     * 
     * @return void
     */
    public function __construct()
    {
        
    }
    
    /**
     * Get Entity Class
     * 
     * @param string $entityName
     */
    public function getEntityClass( $entityName )
    {
        if (!is_object($this->_entityManager)) {
            return $this->getEntityManager()->getRepository($entityName);
        }
        return Null;
    }
    
    /**
     * Get EntityManager
     * 
     * @return object 
     */
    public function getEntityManager()
    {
        if ($this->_entityManager == null) {
            $this->_entityManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        }
        return $this->_entityManager;    
    }
}