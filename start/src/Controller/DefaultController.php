<?php
/**
 * Created by PhpStorm.
 * User: Tudor
 * Date: 11/5/2018
 * Time: 4:41 PM
 */

namespace App\Controller;


use App\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/admin/form_scris", name="app_form_scris")
     */
    public function new(Request $request)
    {
        $task = new Task();
        $task->setTask(null);
        $task->setDueDate(new \DateTime('tomorrow'));

        $form = $this->createFormBuilder($task)
            ->add('task', null,[
                'help' => 'Write something',

            ])
            ->add('dueDate', DateType::class,[
                'widget' => 'single_text',
                'help' => 'Choose the date imbecile'
            ])
            ->add('save', SubmitType::class, array('label' => 'Create Task'))
            ->getForm();

        return $this->render('default/form_scris.html.twig', array(
            'form' => $form->createView(),
        ));
    }

}