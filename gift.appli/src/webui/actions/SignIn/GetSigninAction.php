<?php

namespace gift\appli\webui\actions\SignIn;

use gift\appli\application_core\application\useCases\interfaces\FormBuilderInterface;
use gift\appli\webui\actions\Abstract\AbstractAction;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Views\Twig;

class GetSigninAction extends AbstractAction{

    private FormBuilderInterface $formBuilder;

    public function __construct(FormBuilderInterface $formBuilder) {
        $this->formBuilder = $formBuilder;
    }

    public function __invoke(Request $request, Response $response, array $args)
    {
        $twig = Twig::fromRequest($request);
        return $twig->render($response, 'form/index.html.twig', [
            "form" => $this->formBuilder->buildSignInForm()
        ]);
    }
}