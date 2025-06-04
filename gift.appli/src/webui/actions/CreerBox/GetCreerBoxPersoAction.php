<?php

namespace gift\appli\webui\actions\CreerBox;

use gift\appli\application_core\application\useCases\interfaces\FormBuilderInterface;
use gift\appli\webui\actions\Abstract\AbstractAction;
use gift\appli\webui\providers\interfaces\CsrfTokenProviderInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Views\Twig;

class GetCreerBoxPersoAction extends AbstractAction {
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
            "form" => $this->formBuilder->buildCreerBoxPersoForm(),
            "token" => $this->csrfProvider->generate()
        ]);
    }
}