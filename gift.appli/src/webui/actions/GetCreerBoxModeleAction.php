<?php

namespace gift\appli\webui\actions;

use gift\appli\application_core\application\providers\interfaces\CsrfTokenProviderInterface;
use gift\appli\application_core\application\useCases\interfaces\FormBuilderInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Views\Twig;

class GetCreerBoxModeleAction extends AbstractAction {
    private FormBuilderInterface $formBuilder;
    private CsrfTokenProviderInterface $csrfProvider;
    public function __construct(FormBuilderInterface $formBuilder, CsrfTokenProviderInterface $csrfProvider) {
        $this->formBuilder = $formBuilder;
        $this->csrfProvider = $csrfProvider;
    }
    public function __invoke(Request $request, Response $response, array $args)
    {
        $twig = Twig::fromRequest($request);
        return $twig->render($response, 'form/index.html.twig', [
            "form" => $this->formBuilder->buildCreerBoxModelForm(),
            "token" => $this->csrfProvider->generate()
        ]);
    }
}