<?php

namespace Html;

use DateTimeImmutable;

class WebPage
{
    private string $head = '';
    private string $title;
    private string $body = '';

    /** Constructeur
     * @param string $title Titre de la page
     */
    public function __construct(string $title = '')
    {
        $this->title = $title;
    }

    /** Ajouter un contenu dans $this->body.
     * @param string $content Le contenu à ajouter
     */
    public function appendBody(string $content): void
    {
        $this->body .= $content;
    }

    /** Ajouter un contenu dans $this->head.
     * @param string $content Le contenu à ajouter
     */
    public function appendToHead(string $content)
    {
        $this->head .= <<<HTML
        $content

HTML;
        ;
    }

    /** Ajouter un contenu CSS dans $this->head.
     * @param string $css Le contenu CSS à ajouter
     */
    public function appendCss(string $css): void
    {
        $this->head .= <<<HTML
        <style>
            $css
        </style>

HTML;
    }

    /** Ajouter l'URL d'un script CSS dans $this->head.
     * @param string $url L'URL du script CSS
     */
    public function appendCssUrl(string $url)
    {
        $this->head .= <<<HTML
        <link rel='stylesheet' type='text/css' href='$url' />

HTML;

    }

    /** Ajouter un contenu JavaScript dans $this->head.
     * @param string $js Le contenu JavaScript à ajouter
     */
    public function appendJs(string $js): void
    {
        $this->head .= <<<HTML
        <script>
            $js
        </script>

HTML;
    }

    /** Ajouter l'URL d'un script JavaScript dans $this->head.
     * @param string $url L'URL du script JavaScript
     */
    public function appendJsUrl(string $url): void
    {
        $this->head .= <<<HTML
        <script src='$url'></script>

HTML;

    }

    /** Ajouter un contenu dans $this->body.
     * @param string $content Le contenu à ajouter
     */
    public function appendContent(string $content): void
    {
        $this->body .= <<<HTML
        $content

HTML;
    }

    /** Protéger les caractères spéciaux pouvant dégrader la page Web.
     * @param string $string La chaîne à protéger
     * @return string La chaîne protégée
     */
    public function escapeString(string $string): string
    {
        return htmlspecialchars($string);
    }

    /** Produire la page Web complète.
     */
    public function toHTML(): string
    {
        $html = <<<HTML
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
HTML;
        $html .= $this->getHead();
        if ($this->getTitle()) {
            $html .= '<title>' . $this->getTitle() . "</title>\n    </head>\n";
        } else {
            $html .= "<title>Web page</title>\n    </head>\n";
        }
        $html .= <<<HTML
    <body>
        {$this->getBody()}
    </body>
</html>
HTML;
        return $html;
    }

    /**
     * @return string
     */
    public function getHead(): string
    {
        return $this->head;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    public static function getLastModification(): string
    {
        date_default_timezone_set('Europe/Paris');
        return date('d/m/Y-H:i:s', getlastmod());
    }
}
