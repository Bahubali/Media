<?php

namespace StickyNotes\Model;

use StickyNotes\Model\Entity\StickyNote;

class StickyNoteManager
{
    
    /**
     * Add Note
     * 
     * @param object $entityManager
     * 
     * @return integer note id
     */
    public static function addNote( $entityManager )
    {
        if (is_object($entityManager)) {
            $newNote = new \StickyNotes\Model\Entity\StickyNote();
            $newNote->setCreated(new \DateTime());
            $entityManager->persist($newNote);
            $entityManager->flush();
            return $newNote->getId();
        }
    }
    
    /**
     * Remove Note 
     * 
     * @param object $entityManager
     * @param string $noteId
     * 
     * @return boolean true/false
     */
    public static function removeNote( $entityManager, $noteId )
    {
        if (is_object($entityManager)) {
            $noteEntity = $entityManager->find('StickyNotes\Model\Entity\StickyNote', $noteId);
            $entityManager->remove($noteEntity);
            $entityManager->flush();
            return true;
        }
    }
    
    /**
     * Update Note 
     * 
     * @param object $entityManager
     * @param array  $postData
     * 
     * @return void
     */
    public static function updateNote( $entityManager, $postData )
    {
        if (!empty($postData) && is_object($entityManager)) {
            $noteEntity = $entityManager->find('StickyNotes\Model\Entity\StickyNote', $postData["id"]);
            $noteEntity->setNote($postData["content"]);
            $entityManager->persist($noteEntity);
            $entityManager->flush();
            return true;
        }
    }
}