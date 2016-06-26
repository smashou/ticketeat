<?php

/**
 * Created by PhpStorm.
 * User: edlef
 * Date: 20/05/16
 * Time: 09:37
 */
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Customer;

class CustomerController extends Controller
{

    /**
     * @Route("/admin/customer/add", name="customer_add")
     *
     */
    public function addAction(Request $request){

        $object = new Customer();
        $form = $this->createForm(new CustomerType(), $object);

        if ($form->handleRequest($request)->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($object);
            $em->flush();

            $request->getSession()->getFlashBag()->add(
                'success',
                'customer_added'
            );

            return $this->redirect($this->generateUrl('customer_list'));
        }

        return $this->render('App:Customer:form.html.twig',[
            'form' => $form->createView(),
            'title' => 'customer_add'

        ]);

    }

    /**
     * @Route("/admin/customer/edit/{id}", name="customer_edit")
     *
     */
    public function editAction(Request $request, $id){

        $object = $this->getDoctrine()->getRepository('App:Customer')->findOneById($id);

        $form = $this->createForm(new CustomerType(), $object);

        if ($form->handleRequest($request)->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->flush();

            $request->getSession()->getFlashBag()->add(
                'success',
                'customer_edited'
            );

            return $this->redirect($this->generateUrl('customer_list'));
        }

        return $this->render('App:Customer:form.html.twig',[
            'form' => $form->createView(),
            'title' => 'customer_edit'
        ]);

    }

    /**
     * @Route("/admin/customer/remove/{id}", name="customer/remove")
     *
     */
    public function removeAction(Request $request, $id){

        $object = $this->getDoctrine()->getRepository('App:Customer')->findOneById($id);

        $em = $this->getDoctrine()->getManager();
        $em->remove($object);
        $em->flush();

        $request->getSession()->getFlashBag()->add(
            'success',
            'customer_removed'
        );

        return $this->redirect($this->generateUrl('customer_list'));
    }

    /**
     * @Route("/admin/customer", name="customer_list")
     *
     */
    public function listAction(Request $request) {

        $list = $this->getDoctrine()->getRepository('App:Customer')->findBy([], ['name' => 'ASC']);

        return $this->render('App:Customer:list.html.twig', [
            "list" => $list
        ]);

    }

}

