<?php
namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Component\Mime\Email;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{

    /**
     * @Route("/contact", name="contact")
     * @return Response
     */
    public function index(Request $request, MailerInterface $mailer): Response
    {
        $contact = new Contact();
        $formContact = $this->createForm(ContactType::class, $contact);
        $formContact->handleRequest($request);

        if($formContact->isSubmitted() && $formContact->isValid()){
            //envoie du mail
            $this->sendEmail($mailer, $contact);
            $this->addFlash('success', 'message envoyé');
            return $this->redirectToRoute('contact');
        }
        return $this->render("pages/contact.html.twig", ['contact' => $contact, 'formcontact' => $formContact->createView()]);
    }
    /**
     * Envoie de mail
     * @param MailerInterface $mailer
     * @param Contact $contact
     */
    public function sendEmail(MailerInterface $mailer, Contact $contact){
        $email = (new Email())->from($contact->getEmail())->to('contact@mesVoyages.com')->subject('Message du site du voyage')->html($this->renderView('pages/_email.html.twig', ['contact' => $contact]), 'utf-8');
        $mailer->send($email);
    }
}
?>