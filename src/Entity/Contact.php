<?php
namespace App\Entity;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Cache\Adapter\AbstractAdapter;
use Symfony\Component\Validator\Constraints as Assert;

class Contact{
    #[Assert\NotBlank()]
    private ?string $nom = null;

    #[Assert\NotBlank()]
    #[Assert\Email()]
    private ?string $email = null;
    
    #[Assert\NotBlank()]
    private ?string $message = null;


	/**
	 * @return 
	 */
	public function getNom(): ?string {
		return $this->nom;
	}
	
	/**
	 * @param  $nom 
	 * @return self
	 */
	public function setNom(?string $nom): self {
		$this->nom = $nom;
		return $this;
	}
	
	/**
	 * @return 
	 */
	public function getEmail(): ?string {
		return $this->email;
	}
	
	/**
	 * @param  $email 
	 * @return self
	 */
	public function setEmail(?string $email): self {
		$this->email = $email;
		return $this;
	}
	
	/**
	 * @return 
	 */
	public function getMessage(): ?string {
		return $this->message;
	}
	
	/**
	 * @param  $message 
	 * @return self
	 */
	public function setMessage(?string $message): self {
		$this->message = $message;
		return $this;
	}
}
?>