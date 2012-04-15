<?php
namespace Pelshoff\Blog\Comment;

use Pelshoff\Blog\Model\Article,
	Pelshoff\Blog\Model\ArticleRepository,
	Pelshoff\Blog\Model\Comment,
	Pelshoff\Blog\Model\CommentRepository,
	Pelshoff\DCI\UserEventListener;

/**
 * Context for posting comments
 *
 * @author		Pim Elshoff <pim@pelshoff.com>
 */
class PostCommentContext
{
	/**
	 * @var CommentRepository
	 */
	private $commentRepository;

	/**
	 * @var ArticleRepository
	 */
	private $articleRepository;

	/**
	 * @var UserEventListener
	 */
	private $listener;

	/**
	 * @param \Pelshoff\Blog\Model\ArticleRepository $articleRepository
	 * @param \Pelshoff\Blog\Model\CommentRepository $commentRepository
	 * @param \Pelshoff\DCI\UserEventListener $listener
	 */
	public function __construct(ArticleRepository $articleRepository, CommentRepository $commentRepository, UserEventListener $listener)
	{
		$this->articleRepository = $articleRepository;
		$this->commentRepository = $commentRepository;
		$this->listener = $listener;
	}

	/**
	 * @param PostCommentRequest $request
	 * @return PostCommentResult
	 */
	public function execute(PostCommentRequest $request)
	{
		$article = $this->articleRepository->findArticleByUrl($request->getArticleUrl());
		if (!$article) {
			return new PostCommentResult(PostCommentResult::NONE);
		}
		if (!$this->listener->isSubmitted()) {
			return new PostCommentResult(PostCommentResult::NONE, $article);
		}
		if (!$this->listener->isValid()) {
			return new PostCommentResult(PostCommentResult::FAILURE, $article);
		}
		$data = $this->getFilteredData();
		$comment = $this->commentRepository->create();
		$this->fillComment($comment, $article, $data, $request->getClientIp());
		$this->commentRepository->store($comment);
		return new PostCommentResult(PostCommentResult::SUCCESS, $article, $comment);
	}

	/**
	 * @return array
	 */
	private function getFilteredData()
	{
		$data = array_map(function($value) { return trim(strip_tags($value)); }, $this->listener->getData());
		return $data;
	}

	/**
	 * @param \Pelshoff\Blog\Model\Comment $comment
	 * @param \Pelshoff\Blog\Model\Article $article
	 * @param array $data
	 * @param $clientIp
	 */
	private function fillComment(Comment $comment, Article $article, array $data, $clientIp)
	{
		$comment->setMessage($data['message']);
		$comment->setName($data['name']);
		$comment->setEmailAddress($data['emailAddress']);
		$comment->setWebsite($data['website']);
		$comment->setArticle($article);
		$comment->setActive(true);
		$comment->setIpAddress($clientIp);
		$comment->setTime(new \DateTime());
		$comment->setType('comment');
	}
}