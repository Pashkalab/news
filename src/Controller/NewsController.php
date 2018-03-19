<?php

namespace Controller;

use Framework\BaseController;
use Framework\Request;
use Framework\Exception\NotFoundException;

use Model\Form\FeedbackForm;
use Model\Entity\Feedback;

class NewsController extends BaseController
{
    
    public function indexAction(Request $request)
    {
        $repo =  $this->getRepository('News');

        $news = $repo
            ->findAll();

        return $this->render('index.html.twig', [
            'news' => $news,

        ]);
    }

    public function showAction(Request $request)
    {
        $id = $request->get('id');
        $news = $this
            ->getRepository('News')
            ->find($id)
        ;

        if (!$news) {
            throw new NotFoundException('News not found');
        }
        
        return $this->render('show.html.twig', [
            'news' => $news,
        ]);
    }

    public function feedbackAction(Request $request)
    {
        header('content-type: application/json');
        $form = new FeedbackForm(
            $request->post('title'),
            $request->post('description'),
             $request->post('news_id')
        );

        if ($request->isPost()) {
            if ($form->isValid()) {

                $news = new Feedback(
                    $form->title,
                    $form->description,
                    $form->news_id
                );

                try {
                    $this->getRepository('Feedback')->save($news);
                } catch (\Exception $e) {
                    http_response_code(500);

                    return json_encode([
                        'message' => 'Internal server error'
                    ]);
                }

                return json_encode([
                    'message' => 'Ваш коментарий появиться в ближайшее время'
                ]);
            }

            http_response_code(400);

            return json_encode([
                'message' => 'Bad request'
            ]);
        }

        http_response_code(405);

        return json_encode([
            'message' => 'Method not allowed'
        ]);
    }

}