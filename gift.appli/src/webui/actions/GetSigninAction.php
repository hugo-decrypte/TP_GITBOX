<?php

namespace gift\appli\webui\actions;

use gift\appli\application_core\application\useCases\FormBuilder;
use gift\appli\application_core\application\useCases\interfaces\FormBuilderInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Views\Twig;

class GetSigninAction extends AbstractAction{
    public function __construct(private FormBuilderInterface $formBuilder) {}

    public function __invoke(Request $request, Response $response, array $args) {
        $twig = Twig::fromRequest($request);

        return $twig->render($response, 'form/index.html.twig', [
            "form" => $this->formBuilder->buildSigninForm()
        ]);
    }
}