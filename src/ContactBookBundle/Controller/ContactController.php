<?php

namespace ContactBookBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use ContactBookBundle\Entity\Contact;
use ContactBookBundle\Entity\Address;
use ContactBookBundle\Entity\Email;
use ContactBookBundle\Entity\Phone;

class ContactController extends Controller
{
    
    /**
     * @Route("/newContact", name="newContact")
     * @Template()
     */
    public function newContactAction()
    {
        $contact = new Contact();
        $form = $this->createFormBuilder($contact)
                ->setAction($this->generateUrl("createContact"))
                ->add('name', 'text', array('required'=> true))
                ->add('surname', 'text', array('required'=> true))
                ->add('description', 'text', array('required'=> false))
                ->add('save', 'submit')
                ->getForm();
        
        return array('form' => $form->createView() );
    }

    /**
     * @Route("/createContact", name="createContact")
     * @Method("POST")
     * @Template()
     */
    public function createContactAction(Request $request)
    {
        $contact = new Contact();
        $form = $this->createFormBuilder($contact)
                ->setAction($this->generateUrl("createContact"))
                ->add('name', 'text', array('required'=> true))
                ->add('surname', 'text', array('required'=> true))
                ->add('description', 'text', array('required'=> false))
                ->add('save', 'submit')
                ->getForm();
        
        $form->handleRequest($request);
        
        if( $form->isSubmitted() && $form->isValid() ) {
            $contact = $form->getData();
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($contact);
            $em->flush();
            
            $text = 'New contact was created.';
        } else {
            $text = 'Request failed.';
        }
        
        return array('text'=> $text );
    }


    /**
     * @Route("/{id}/modifyContactForm", name="modifyContactForm")
     * @Template()
     */
    public function modifyContactFormAction($id)
    {
        $repository = $this->getDoctrine()->getRepository("ContactBookBundle:Contact");
        $contact = $repository->find($id);
        
        $form = $this->createFormBuilder($contact)
                ->setAction($this->generateUrl('modifyContact', array('id' => $id)))
                ->add('name', 'text')
                ->add('surname', 'text')
                ->add('description', 'text')
                ->add('save', 'submit')
                ->getForm();
        
        return array('form' => $form->createView(), 'id' => $id );
        
    }

    /**
     * @Route("/{id}/modifyContact", name="modifyContact")
     * @Method("POST")
     * @Template()
     */
    public function modifyContactAction(Request $request, $id)
    {
        $repository = $this->getDoctrine()->getRepository("ContactBookBundle:Contact");
        $contact = $repository->find($id);
        
        $form = $this->createFormBuilder($contact)
                ->setAction($this->generateUrl('modifyContact', array('id' => $id)))
                ->add('name', 'text')
                ->add('surname', 'text')
                ->add('description', 'text')
                ->add('save', 'submit')
                ->getForm();
        
        $form->handleRequest($request);
        
        $text = "Request failed.";
        
        if( $form->isSubmitted() && $form->isValid() ) {
            $contact = $form->getData();
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($contact);
            $em->flush();
            
            $text = 'Changes saved.';
        } 
        
        return array('text'=> $text, 'id' => $id );
        
    }
    
    /**
     * @Route("/{id}/addEmail", name="addEmail")
     * @Template()
     */
    public function addEmailAction(Request $request, $id)
    {
        $email = new Email();
        $form = $this->createFormBuilder($email)
                ->add('address', 'text')
                ->add('type', 'text')
                ->add('save', 'submit')
                ->getForm();
        
        $form->handleRequest($request);
        
        $text=""; 
        
        $repository = $this->getDoctrine()->getRepository("ContactBookBundle:Contact");
        $loadedContact = $repository->find($id);

        if ( $form->isSubmitted() && $form->isValid() ) {
                $loadedContact->addEmail($email);
                $em = $this->getDoctrine()->getManager();
                $em->persist($email);
                $em->flush();
            
            $text = "Email added.";
        } 
        
       return array('text' => $text, 'form' => $form->createView(), 'loadedContact' => $loadedContact ); 
    }
    
     /**
     * @Route("/{id}/addPhone", name="addPhone")
     * @Template() 
     */
    public function addPhoneAction(Request $request, $id)
    {
        $phone = new Phone();
        $form = $this->createFormBuilder($phone)
                ->add('number', 'text')
                ->add('type', 'text')
                ->add('save', 'submit')
                ->getForm();
        
        $form->handleRequest($request);
        
        $text=""; 
        
            $repository = $this->getDoctrine()->getRepository("ContactBookBundle:Contact");
            $loadedContact = $repository->find($id);

        if ( $form->isSubmitted() && $form->isValid() ) {
                $loadedContact->addPhoneNumber($phone);
                $em = $this->getDoctrine()->getManager();
                $em->persist($phone);
                $em->flush();
            
            $text = "Phone number added.";
        } 
        
       return array ('text' => $text, 'form' => $form->createView(), 'loadedContact' => $loadedContact ); 
    }
    
    /**
    * @Route("/{id}/addAddress", name="addAddress")
    * @Template() 
    */
    public function addAddressAction(Request $request, $id)
    {
        $address = new Address();
        $form = $this->createFormBuilder($address)
                ->add('city', 'text')
                ->add('street', 'text')
                ->add('houseNumber', 'text')
                ->add('save', 'submit')
                ->getForm();
        
        $form->handleRequest($request);
        
        $text=""; 
        
        $repository = $this->getDoctrine()->getRepository("ContactBookBundle:Contact");
        $loadedContact = $repository->find($id);

        if ( $form->isSubmitted() && $form->isValid() ) {
                $loadedContact->setAddress($address);
                $em = $this->getDoctrine()->getManager();
                $em->persist($address);
                $em->flush();
            
            $text = "Address added.";
        } 
        
       return array ('text' => $text, 'form' => $form->createView(), 'loadedContact' => $loadedContact ); 
    }
    
    /**
     * @Route("/{id}/deleteContact", name="deleteContact")
     */
    public function deleteContactAction($id)
    {
        $em=  $this->getDoctrine()->getManager();
        $loadedContact = $em->getRepository("ContactBookBundle:Contact")->find($id);
        
        
        if(!$loadedContact) {
            return false;
        }
        
        $em->remove($loadedContact);
        $em->flush();
        
        return $this->redirectToRoute('getAllContacts');
    }

    /**
     * @Route("/{id}/getContact", name="getContact")
     * @Template()
     */
    public function getContactAction($id)
    {
        $repository = $this->getDoctrine()->getRepository("ContactBookBundle:Contact");
        $loadedContact = $repository->find($id);
        
        
        return array('loadedContact' => $loadedContact);
        
    }

    /**
     * @Route("/getAllContacts", name="getAllContacts")
     * @Template()
     */
    public function getAllContactsAction()
    {
        $repository = $this->getDoctrine()->getRepository("ContactBookBundle:Contact");
        $allContacts = $repository->findAll();
        return array('allContacts' => $allContacts);
    }
    

}
