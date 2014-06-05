<?php

/**
 * Robert McDermot
 * rom66@pitt.edu
 * Date: 3/4/14
 * Time: 10:03 PM
 */
class MessagesController extends AppController
{
	public function index()
	{
		$this->set('messages', $this->Message->find('all'));
		$this->set('username', $this->Auth->user('username'));
	}

	public function add($toId, $fromId)
	{
		if($this->request->is('post'))
		{
			$this->Message->create();
			$this->request->data['Message']['user_id'] = $toId;
			$this->request->data['Message']['from_id'] = $fromId;
			if($this->Message->save($this->request->data))
			{
				$this->Session->setFlash(__('Your message has been sent.'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('Unable to add your review.'));
		}
	}

	public function view($id)
	{
		if(!$id)
		{
			throw new NotFoundException('Invalid Message');
		}

		$message = $this->Message->findById($id);
		if(!$message)
		{
			throw new NotFoundException('Invalid Message');
		}

		$this->set('message', $message);
	}

	public function delete($id)
	{
		if($this->request->is('get'))
		{
			throw new MethodNotAllowedException();
		}

		if($this->Message->delete($id))
		{
			$this->Session->setFlash(
				__('The message with id: %s has been deleted.', h($id))
			);
			return $this->redirect(array('action' => 'index'));
		}
	}

	public function beforeFilter()
	{
		$this->Auth->deny();
	}
}