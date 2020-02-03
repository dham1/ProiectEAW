<?php


namespace App\Helpers;
require_once(dirname(__FILE__) . '../../../autoload.php');

use App\Entity\Examination;
use App\Entity\Animal;

use App\Entity\UserAnimal;
use Zend_Search_Lucene;
use Zend_Search_Lucene_Document;
use Zend_Search_Lucene_Field;
use Zend_Search_Lucene_Search_Query_MultiTerm;
class ZendLuceneSearch
{
    /**
     * Calea catre directorul unde fisierele specifice indexarii vor fi salvate
     *
     * @return string
     */
    static public function getLuceneIndexFile() {
        return '/xampp/htdocs/simfony/an_index'; //pentru testare: schimbati la an_index_test
    }


    /**
     * Se verifica daca directorul mentionat mai sus exista,
     * in acest caz indexul este deschis,
     * altfel indexul este creat
     *
     * @return \Zend_Search_Lucene_Interface
     */
    static public function getLuceneIndex() {
        if (file_exists($index = self::getLuceneIndexFile())) {
            return Zend_Search_Lucene::open($index);
        } else {

            return  Zend_Search_Lucene::create($index);
        }
    }


    /**
     * Crearea si/sau editarea unei intrari (un job introdus)
     * si salvarea informatiilor specifice in document
     *
     * @param job
     */
    public function updateLuceneIndex(Examination $examination)
    {
        $index = self::getLuceneIndex();

        foreach ($index -> find('key:'.$examination -> getId()) as $hit)
        {
            $index -> delete($hit -> id);
        }

        $doc = new Zend_Search_Lucene_Document();
        $doc -> addField(Zend_Search_Lucene_Field::Keyword('key', $examination -> getId()));
        $doc -> addField(Zend_Search_Lucene_Field::Text('description', $examination -> getDescription(), 'utf-8'));

        $index -> addDocument($doc);
        $index -> commit();
    }

    public function updateLuceneAnimalIndex(UserAnimal $animal)
    {
        $index = self::getLuceneIndex();

        foreach ($index -> find('key:'.$animal -> getId()) as $hit)
        {
            $index -> delete($hit -> id);
        }

        $doc = new Zend_Search_Lucene_Document();
        $doc -> addField(Zend_Search_Lucene_Field::Keyword('key', $animal -> getId()));
        $doc -> addField(Zend_Search_Lucene_Field::Text('Name', $animal ->getAnimal()->getName(), 'utf-8'));

        $index -> addDocument($doc);
        $index -> commit();
    }


    // /**
    //  * Stergerea unui index corespunzator unui job
    //  *
    //  * @param job
    //  */
    // public function deleteLuceneIndex(patient $patient) {
    //     $index = self::getLuceneIndex();

    //     foreach ($index -> find('key:'.$patient -> getId()) as $hit){
    //         $index -> delete($hit -> id);
    //     }
    // }


    // // extra metode
    // /**
    //  * Verificarea existentei unui index cu o cheie specifica
    //  *
    //  * @param indexNr
    //  */
    // public function countIndex($indexNr) {
    //     $index = self::getLuceneIndex();
    //     if ($index -> find('key:'.$indexNr)) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }


    // /**
    //  * Verificarea unui job daca se gaseste in index,
    //  * in functie de descriere
    //  *
    //  * @param job
    //  * @return string
    //  */
    // public function getIndexOfASpecificJob(patient $patient) {
    //     $searchTerm = $patient -> getName();
    //     $hits = self::getLuceneIndex() -> find($searchTerm);

    //     $result ="";
    //     foreach ($hits as $hit) {
    //         if ($hit -> key == $patient -> getId()) {
    //             $result = $hit -> key;
    //             break;
    //         }
    //     }

    //     return $result;
    // }


    // /**
    //  * Adaugarea unui element care nu va fi afisat la cautare
    //  *
    //  * @param job
    //  * @return string
    //  */
    // public function addProhibitedJobTerm(patient $patient) {
    //     $index = self::getLuceneIndex();

    //     $query = new Zend_Search_Lucene_Search_Query_MultiTerm($patient -> getName(), '-');
    //     $hits  = $index -> find($query);

    //     $result = "";
    //     foreach ($hits as $hit) {
    //         if ($hit -> key == $patient -> getId()) {
    //             $result = $hit -> key;
    //             break;
    //         }
    //     }

    //     return $result;
    // }
}