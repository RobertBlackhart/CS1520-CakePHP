<?php

/**
 * Robert McDermot
 * rom66@pitt.edu
 * Date: 3/4/14
 * Time: 10:03 PM
 */
class CommentsController extends AppController
{
	public function add($reviewId)
	{
		if($this->request->is('post'))
		{
			$this->Comment->create();
			$this->request->data['Comment']['user_id'] = $this->Auth->user('id');
			$this->request->data['Comment']['username'] = $this->Auth->user('username');
			$this->request->data['Comment']['review_id'] = $reviewId;
			if($this->Comment->save($this->request->data))
			{
				$this->Session->setFlash(__('Your comment has been saved.'));
				return $this->redirect(array('controller' => 'reviews', 'action' => 'view', $reviewId));
			}
			$this->Session->setFlash(__('Unable to add your comment.'));
		}
	}

	public function edit($id, $reviewId)
	{
		if(!$id)
		{
			throw new NotFoundException(__('Invalid comment'));
		}

		$comment = $this->Comment->findById($id);
		if(!$comment)
		{
			throw new NotFoundException(__('Invalid comment'));
		}

		if($this->request->is(array('post', 'put')))
		{
			$this->Comment->id = $id;
			if($this->Comment->save($this->request->data))
			{
				$this->Session->setFlash(__('Your comment has been updated.'));
				return $this->redirect(array('controller' => 'reviews', 'action' => 'view', $reviewId));
			}
			$this->Session->setFlash(__('Unable to update your comment.'));
		}

		if(!$this->request->data)
		{
			$this->request->data = $comment;
		}
	}

	public function delete($id, $reviewId)
	{
		if($this->request->is('get'))
		{
			throw new MethodNotAllowedException();
		}

		if($this->Comment->delete($id))
		{
			$this->Session->setFlash(
				__('The comment with id: %s has been deleted.', h($id))
			);
			return $this->redirect(array('controller' => 'reviews', 'action' => 'view', $reviewId));
		}
	}

	public function beforeFilter()
	{
		$this->Auth->deny();
	}
}