<?php 

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Contact {

    /**
     * 
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Length(min=2, max=35)
     */
    private $prenom;

/**
 * Getter for Prenom
 *
 * @return [type]
 */
public function getPrenom()
{
    return $this->prenom;
}

/**
 * Setter for Prenom
 * @var [type] prenom
 *
 * @return self
 */
public function setPrenom($prenom)
{
    $this->prenom = $prenom;
    return $this;
}


     /**
     * 
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Length(min=2, max=35)
     */
    private $nom;

 /**
  * Getter for Nom
  *
  * @return [type]
  */
 public function getNom()
 {
     return $this->nom;
 }

 /**
  * Setter for Nom
  * @var [type] nom
  *
  * @return self
  */
 public function setNom($nom)
 {
     $this->nom = $nom;
     return $this;
 }


     /**
     * 
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Email
     */
    private $email;

   /**
    * Getter for Email
    *
    * @return [type]
    */
   public function getEmail()
   {
       return $this->email;
   }

   /**
    * Setter for Email
    * @var [type] email
    *
    * @return self
    */
   public function setEmail($email)
   {
       $this->email = $email;
       return $this;
   }


     /**
     * 
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Length(min=5, max=255)
     */
    private $objet;

  /**
   * Getter for Objet
   *
   * @return [type]
   */
  public function getObjet()
  {
      return $this->objet;
  }

  /**
   * Setter for Objet
   * @var [type] objet
   *
   * @return self
   */
  public function setObjet($objet)
  {
      $this->objet = $objet;
      return $this;
  }


     /**
     * 
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Length(min=15)
     */
    private $message;

  /**
   * Getter for Message
   *
   * @return [type]
   */
  public function getMessage()
  {
      return $this->message;
  }

  /**
   * Setter for Message
   * @var [type] message
   *
   * @return self
   */
  public function setMessage($message)
  {
      $this->message = $message;
      return $this;
  }

}