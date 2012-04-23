<?php
namespace Pelshoff\Blog\Comment;

use Pelshoff\Blog\Model\Article,
	Pelshoff\Blog\Model\ArticleRepository,
	Pelshoff\Blog\Model\Comment,
	Pelshoff\Blog\Model\CommentRepository,
	Pelshoff\Blog\UserEventListener;

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
	 * @param ArticleRepository $articleRepository
	 * @param CommentRepository $commentRepository
	 */
	public function __construct(ArticleRepository $articleRepository, CommentRepository $commentRepository)
	{
		$this->articleRepository = $articleRepository;
		$this->commentRepository = $commentRepository;
	}

	/**
	 * @param PostCommentRequest $request
	 * @param UserEventListener $listener
	 * @return PostCommentResult
	 */
	public function execute(UserEventListener $listener, PostCommentRequest $request)
	{
		$article = $this->articleRepository->findArticleByUrl($request->getArticleUrl());
		if (!$article) {
			return new PostCommentResult(PostCommentResult::NONE);
		}
		if (!$listener->isSubmitted()) {
			return new PostCommentResult(PostCommentResult::NONE, $article);
		}
		if (!$listener->isValid()) {
			return new PostCommentResult(PostCommentResult::FAILURE, $article);
		}
		$comment = $this->createComment($listener, $article, $request);
		return new PostCommentResult(PostCommentResult::SUCCESS, $article, $comment);
	}

	/**
	 * @param UserEventListener $listener
	 * @param Article $article
	 * @param PostCommentRequest $request
	 * @return Comment
	 */
	private function createComment(UserEventListener $listener, Article $article, PostCommentRequest $request)
	{
		$data = $this->filterData($listener->getData());
		$comment = $this->commentRepository->create();
		$this->fillComment($comment, $article, $data, $request->getClientIp());
		$this->commentRepository->store($comment);
		return $comment;
	}

	/**
	 * @param array $data
	 * @return array
	 */
	private function filterData(array $data)
	{
		$data = array_map(function($value) { return trim(strip_tags($value)); }, $data);
		return $data;
	}

	/**
	 * @param Comment $comment
	 * @param Article $article
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