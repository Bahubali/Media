<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Register\Controller;

use Core\Controller\CoreController,
    Zend\View\Model\ViewModel,
    Doctrine\ORM\EntityManager;

class IndexController extends CoreController
{
    public function indexAction()
    {
        return new ViewModel();
    }
}
