<?php

/**
 * Robert McDermot
 * rom66@pitt.edu
 * Date: 3/4/14
 * Time: 10:03 PM
 */
class ReviewsController extends AppController
{
	public function index()
	{
		$this->set('reviews', $this->Review->find('all'));
		$this->set('username', $this->Auth->user('username'));
	}

	public function add()
	{
		if($this->request->is('post'))
		{
			$this->Review->create();
			$this->request->data['Review']['user_id'] = $this->Auth->user('id');
			if($this->Review->save($this->request->data))
			{
				$this->Session->setFlash(__('Your review has been saved.'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('Unable to add your review.'));
		}
	}

	public function view($id)
	{
		if(!$id)
		{
			throw new NotFoundException('Invalid Review');
		}

		$review = $this->Review->findById($id);
		if(!$review)
		{
			throw new NotFoundException('Invalid Review');
		}

		$this->set('review', $review);
		$this->set('username', $this->Auth->user('username'));
		$this->set('userid', $this->Auth->user('id'));
	}

	public function edit($id)
	{
		if(!$id)
		{
			throw new NotFoundException(__('Invalid review'));
		}

		$review = $this->Review->findById($id);
		if(!$review)
		{
			throw new NotFoundException(__('Invalid review'));
		}

		if($this->request->is(array('post', 'put')))
		{
			$this->Review->id = $id;
			if($this->Review->save($this->request->data))
			{
				$this->Session->setFlash(__('Your review has been updated.'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('Unable to update your review.'));
		}

		if(!$this->request->data)
		{
			$this->request->data = $review;
		}
	}

	public function delete($id)
	{
		if($this->request->is('get'))
		{
			throw new MethodNotAllowedException();
		}

		if($this->Review->delete($id))
		{
			$this->Session->setFlash(
				__('The review with id: %s has been deleted.', h($id))
			);
			return $this->redirect(array('action' => 'index'));
		}
	}

	public function beforeFilter()
	{
		$this->Auth->allow('index', 'view');
	}
}