<?php
namespace Pelshoff\Blog\Test;

use Pelshoff\Blog\Comment\PostCommentContext;

/**
 * @author		Pim Elshoff <pim@pelshoff.com>
 */
class PostCommentContextTest extends \PHPUnit_Framework_TestCase
{
	private $dummyPost = array(
		'message'		=> 'test-message',
		'name'			=> 'test-name',
		'emailAddress'	=> 'test-email',
		'website'		=> 'test-website',
	);

	public function testArticleNotFound()
	{
		$articleRepository = $this->getMock('Pelshoff\Blog\Model\ArticleRepository');

		$commentRepository = $this->getMock('Pelshoff\Blog\Model\CommentRepository');

		$listener = $this->getMock('Pelshoff\Blog\UserEventListener');

		$context = new PostCommentContext($articleRepository, $commentRepository);

		$result = $context->execute($listener, new \Pelshoff\Blog\Comment\PostCommentRequest('test', '::1'));

		$this->assertFalse($result->isOpened());
		$this->assertNull($result->getArticle());
		$this->assertNull($result->getComment());
	}

	public function testArticleFound()
	{
		$article = new \Pelshoff\Blog\Model\Article();
		$articleRepository = $this->getMock('Pelshoff\Blog\Model\ArticleRepository');
		$articleRepository->expects($this->once())->method('findArticleByUrl')->will($this->returnValue($article));

		$commentRepository = $this->getMock('Pelshoff\Blog\Model\CommentRepository');

		$listener = $this->getMock('Pelshoff\Blog\UserEventListener');

		$context = new PostCommentContext($articleRepository, $commentRepository);

		$result = $context->execute($listener, new \Pelshoff\Blog\Comment\PostCommentRequest('test', '::1'));

		$this->assertFalse($result->isOpened());
		$this->assertEquals($article, $result->getArticle());
		$this->assertNull($result->getComment());
	}

	public function testPostCommentFailed()
	{
		$article = new \Pelshoff\Blog\Model\Article();
		$articleRepository = $this->getMock('Pelshoff\Blog\Model\ArticleRepository');
		$articleRepository->expects($this->once())->method('findArticleByUrl')->will($this->returnValue($article));

		$commentRepository = $this->getMock('Pelshoff\Blog\Model\CommentRepository');

		$listener = $this->getMock('Pelshoff\Blog\UserEventListener');
		$listener->expects($this->once())->method('isSubmitted')->will($this->returnValue(true));

		$context = new PostCommentContext($articleRepository, $commentRepository);

		$result = $context->execute($listener, new \Pelshoff\Blog\Comment\PostCommentRequest('test', '::1'));

		$this->assertTrue($result->isOpened());
		$this->assertFalse($result->isSuccess());
		$this->assertEquals($article, $result->getArticle());
		$this->assertNull($result->getComment());
	}

	public function testPostCommentSucceeded()
	{
		$article = new \Pelshoff\Blog\Model\Article();
		$articleRepository = $this->getMock('Pelshoff\Blog\Model\ArticleRepository');
		$articleRepository->expects($this->once())->method('findArticleByUrl')->will($this->returnValue($article));

		$comment = new \Pelshoff\Blog\Model\Comment();
		$commentRepository = $this->getMock('Pelshoff\Blog\Model\CommentRepository');
		$commentRepository->expects($this->once())->method('create')->will($this->returnValue($comment));
		$commentRepository->expects($this->once())->method('store')->with($comment);

		$listener = $this->getMock('Pelshoff\Blog\UserEventListener');
		$listener->expects($this->once())->method('isSubmitted')->will($this->returnValue(true));
		$listener->expects($this->once())->method('isValid')->will($this->returnValue(true));
		$listener->expects($this->once())->method('getData')->will($this->returnValue($this->dummyPost));

		$context = new PostCommentContext($articleRepository, $commentRepository);
		$result = $context->execute($listener, new \Pelshoff\Blog\Comment\PostCommentRequest('test', '::1'));

		$this->assertTrue($result->isOpened());
		$this->assertTrue($result->isSuccess());
		$this->assertEquals($article, $result->getArticle());
		$this->assertEquals($comment, $result->getComment());
		$this->assertEquals('test-name', $comment->getName());
	}
}
