<?php

namespace App\Controller;

use App\Entity\Departments;
use App\Entity\Employees;
use App\Repository\DepartmentsRepository;
use Doctrine\DBAL\Types\ArrayType;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToOne;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EmployeesController extends AbstractController
{
    /**
     * @Route("/", name="employees")
     */
    public function index()
    {

        $employees = $this->getDoctrine()->getRepository(Employees::class)->findAll();

        return $this->render('employees/index.html.twig',array('employees' => $employees));
    }

    /**
     * @Route("/create", name="createNew")
     */
    public function createNewEmployee(Request $request){
        $employees = new Employees();

        $form = $this->createFormBuilder($employees)
            ->add('first_name', TextType::class, array('label' => 'First name:', 'attr'=>array('class'=>'form-control mb-3')))
            ->add('last_name', TextType::class, array('label' => 'Last name:', 'attr'=>array('class'=>'form-control mb-3')))
            ->add('gender', TextType::class, array('label' => 'Gender:', 'attr'=>array('class'=>'form-control mb-3')))
            ->add('birth_date', BirthdayType::class, array('label' => 'Date of birth:', 'attr'=>array('class'=>'form-control mb-3')))
            ->add('hire_date', DateType::class, array('years' => range(date('y') -20, date('y')),'label' => 'Date of employment:', 'attr'=>array('class'=>'form-control mb-3')))

            ->add('Department', EntityType::class, [

                'class' => Departments::class,


                'choice_label' => 'dept_name',


                 'multiple' => true,

            ])
            ->add('save', SubmitType::class, array('label' => 'Spremi', 'attr' => array('class' => 'btn btn-primary mt-4')))
            ->getForm();

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $employees = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($employees);
            $entityManager->flush();
            return $this->redirectToRoute('employees');

        }


        return $this->render('employees/new.html.twig', array('form' => $form->createView()));

    }

    /**
     * @Route("/delete/{id}", name="deleteEmp")
     * @Method({"DELETE"})
     */
    public function delete(Request $request, $id) {

        $entityManager = $this->getDoctrine()->getManager();
        $employee = $this->getDoctrine()->getRepository(Employees::class)->findOneById($id);


        $entityManager->remove($employee);
        $entityManager->flush();

        $response = new Response();
        $response->send();
        return $this->redirectToRoute('employees');
    }

    /**
     * @Route("/edit/{id}", name="editEmp")
     */
    public function edit(Request $request, $id){
        $employee = new Employees();
        $employee = $this->getDoctrine()->getRepository(Employees::class)->findOneById($id);
        $form = $this->createFormBuilder($employee)
            ->add('first_name', TextType::class, array('label' => 'First name:', 'attr'=>array('class'=>'form-control mb-3')))
            ->add('last_name', TextType::class, array('label' => 'Last name:', 'attr'=>array('class'=>'form-control mb-3')))
            ->add('gender', TextType::class, array('label' => 'Gender:', 'attr'=>array('class'=>'form-control mb-3')))
            ->add('birth_date', BirthdayType::class, array('label' => 'Date of birth:', 'attr'=>array('class'=>'form-control mb-3')))
            ->add('hire_date', DateType::class, array('years' => range(date('y') -20, date('y')),'label' => 'Date of employment:', 'attr'=>array('class'=>'form-control mb-3')))
            ->add('save', SubmitType::class, array('label' => 'Spremi', 'attr' => array('class' => 'btn btn-primary mt-4')))
            ->getForm();

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->flush();
            return $this->redirectToRoute('employees');
        }


        return $this->render('employees/edit.html.twig', array('form' => $form->createView()));
    }

}
