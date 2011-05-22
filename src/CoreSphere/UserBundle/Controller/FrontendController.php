<?php

namespace CoreSphere\UserBundle\Controller;


use CoreSphere\UserBundle\Form\UserType;
use CoreSphere\UserBundle\Entity\User;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Symfony\Component\Security\Acl\Domain\ObjectIdentity;
use Symfony\Component\Security\Acl\Domain\UserSecurityIdentity;
use Symfony\Component\Security\Acl\Permission\MaskBuilder;

class FrontendController extends Controller
{
    public function indexAction()
    {
        $user_list = $this->getRepository()->findAllOrderedByName();

        return $this->renderAction('index', array(
			'user_list' => $user_list
		));
    }

    public function showAction($id)
    {
        $user = $this->find($id);

        return $this->renderAction('show', array(
			'user' => $user
		));
    }

    public function newAction()
    {
        $user = new User();
        $form = $this->get('form.factory')->create(new UserType(), $user);

        return $this->renderAction('new', array(
			'user' => $user,
			'form' => $form->createView()
		));
    }

    public function editAction($id)
    {
        $user = $this->find($id);
        $form = $this->get('form.factory')->create(new UserType(), $user);

        return $this->renderAction('edit', array(
			'user' => $user,
			'form' => $form->createView()
		));
    }


    public function createAction()
    {
        $user = new User();
        $form = $this->get('form.factory')->create(new UserType(), $user);

        $form->bindRequest($this->get('request'));

        if ($form->isValid()) {

            // TODO: NEED PASSWORD MANAGER
            if( strlen($user->getPlainPassword()) > 0 )
            {
                $encoderFactory = $this->container->get('security.encoder_factory');
    	        $encoder = $encoderFactory->getEncoder($user);

    	        $password = $encoder->encodePassword($user->getPlainPassword(), $user->getSalt());
    	        $user->setPassword($password);
            }
            else
            {
                $user->setPassword('');
            }
            // ---------------------------


            $this->persist($user);


            $this->flash('success', 'message.success.user_create');
            return $this->redirect($this->generateUrl('show_user', array('id' => $user->getId())));
        }
        else
        {
            return $this->renderAction('new', array(
    			'user' => $user,
    			'form' => $form->createView()
    		));
        }
    }


    public function updateAction($id)
    {
        $user = $this->find($id);
        $form = $this->get('form.factory')->create(new UserType(), $user);

        $form->bindRequest($this->get('request'));

        if ($form->isValid()) {

            // TODO: NEED PASSWORD MANAGER
            if( strlen($user->getPlainPassword()) > 0 )
            {
                $encoderFactory = $this->container->get('security.encoder_factory');
    	        $encoder = $encoderFactory->getEncoder($user);

    	        $password = $encoder->encodePassword($user->getPlainPassword(), $user->getSalt());
    	        $user->setPassword($password);
            }
            // ---------------------------

            $this->persist($user);

            $this->flash('success', 'message.success.user_update');
            return $this->redirect($this->generateUrl('show_user', array('id' => $user->getId())));
        }
        else
        {
            return $this->renderAction('edit', array(
    			'user' => $user,
    			'form' => $form->createView()
    		));
        }
    }

    protected function persist($entity)
    {
        $em = $this->get('doctrine')->getEntityManager();
        $em->persist($entity);
        $em->flush();
    }

    protected function find($id)
    {
        $record = $this->getRepository()->find($id);

        if( ! $record) {
            throw new NotFoundHttpException(sprintf('%s not Found.', $this->getModel()));
        }

        return $record;
    }

    protected function flash($type, $message)
    {
        $this->get('session')->setFlash($type, $this->get('translator')->trans($message));
    }

    protected function getRepository()
    {
        $em = $this->get('doctrine')->getEntityManager();
        return $em->getRepository('CoreSphereUserBundle:' . $this->getModel());
    }

    protected function renderAction($name, $params)
    {
        return parent::render(
            'CoreSphereUserBundle:Frontend:'.$name.'.html.twig',
            $params
        );
    }

    protected function getModel()
    {
        return 'User';
    }

    protected function currentUser() {
        $securityContext = $this->container->get('security.context');
        return $securityContext->getToken()->getUser();
    }

    protected function grantAccess($user, $object, $access) {
        $builder = new MaskBuilder();

        foreach($access AS $acc) {
            $builder->add($acc);
        }

        $mask = $builder->get();

        // creating the ACL
        $aclProvider = $this->container->get('security.acl.provider');
        $objectIdentity = ObjectIdentity::fromDomainObject($object);
        $acl = $aclProvider->createAcl($objectIdentity);

        // retrieving the security identity of the currently logged-in user
        $securityIdentity = UserSecurityIdentity::fromAccount($user);

        // grant owner access
        $acl->insertObjectAce($securityIdentity, $mask);
        $aclProvider->updateAcl($acl);
    }
}
