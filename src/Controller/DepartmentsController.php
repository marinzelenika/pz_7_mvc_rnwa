<?php

namespace App\Controller;

use App\Entity\Departments;
use Doctrine\DBAL\Types\DateType;
use Doctrine\DBAL\Types\TextType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DepartmentsController extends AbstractController
{
    /**
     * @Route("/departments", name="departments")
     */
    public function index()
    {
        $departments = $this->getDoctrine()->getRepository(Departments::class)->findAll();
        return $this->render('departments/index.html.twig', array('departments' => $departments));
    }

    /**
     * @Route("/addnewdept", name="createNewDept")
     */
    public function createNewEmployee(Request $request){
        $departments = new Departments();

        $form = $this->createFormBuilder($departments)
            ->add('dept_name', \Symfony\Component\Form\Extension\Core\Type\TextType::class, array('label' => 'Department name:', 'attr'=>array('class'=>'form-control mb-3')))


            ->add('save', SubmitType::class, array('label' => 'Spremi', 'attr' => array('class' => 'btn btn-primary mt-4')))
            ->getForm();

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $departments = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($departments);
            $entityManager->flush();
            return $this->redirectToRoute('departments');

        }


        return $this->render('departments/new.html.twig', array('form' => $form->createView()));

    }

    /**
     * @Route("/update/{id}", name="editDept")
     */
    public function edit(Request $request, $id){
        $department = new Departments();
        $department = $this->getDoctrine()->getRepository(Departments::class)->findOneById($id);
        $form = $this->createFormBuilder($department)
            ->add('dept_name', \Symfony\Component\Form\Extension\Core\Type\TextType::class, array('label' => 'Department name:', 'attr'=>array('class'=>'form-control mb-3')))
            ->add('save', SubmitType::class, array('label' => 'Spremi', 'attr' => array('class' => 'btn btn-primary mt-4')))
            ->getForm();

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->flush();
            return $this->redirectToRoute('departments');
        }


        return $this->render('departments/edit.html.twig', array('form' => $form->createView()));
    }


    /**
     * @Route("/deleteDept/{id}", name="deleteDept")
     * @Method({"DELETE"})
     */
    public function delete(Request $request, $id) {

        $entityManager = $this->getDoctrine()->getManager();
        $department = $this->getDoctrine()->getRepository(Departments::class)->findOneById($id);


        $entityManager->remove($department);
        $entityManager->flush();

        $response = new Response();
        $response->send();
        return $this->redirectToRoute('departments');
    }
}
