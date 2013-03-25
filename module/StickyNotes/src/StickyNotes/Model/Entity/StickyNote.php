<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of StickyNote
 *
 * @author Arian Khosravi <arian@bigemployee.com>, <@ArianKhosravi>
 */
// module/StickyNotes/src/StickyNotes/Model/Entity/StickyNotes.php

namespace StickyNotes\Model\Entity;
use Doctrine\ORM\Mapping as ORM;
    
/**
 * 
 * 
 * @ORM\Entity
 * @ORM\Table(name="stickynotes")
 * @property string $note
 * @property time $created
 * @property int $id
 *
 */
class StickyNote {
    
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer");
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(name="note", length=255)
     */
    protected $note;
    
    /**
     * @ORM\Column(name="created",type="datetime")
     */
    protected $created;
    
    /**
     * Constructor of entity class
     * 
     * @param array $options
     */
    public function __construct(array $options = null) {
        if (is_array($options)) {
            $this->setOptions($options);
        }
    }

    public function __set($name, $value) {
        $method = 'set' . $name;
        if (!method_exists($this, $method)) {
            throw new Exception('Invalid Method');
        }
        $this->$method($value);
    }

    public function __get($name) {
        $method = 'get' . $name;
        if (!method_exists($this, $method)) {
            throw new Exception('Invalid Method');
        }
        return $this->$method();
    }

    public function setOptions(array $options) {
        $methods = get_class_methods($this);
        foreach ($options as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (in_array($method, $methods)) {
                $this->$method($value);
            }
        }
        return $this;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function getNote() {
        return $this->note;
    }

    public function setNote($note) {
        $this->note = $note;
        return $this;
    }

    public function getCreated() {
        return $this->created;
    }

    public function setCreated($created) {
        $this->created = $created;
        return $this;
    }

}

?>
