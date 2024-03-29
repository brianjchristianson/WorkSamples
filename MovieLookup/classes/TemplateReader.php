<?php

class TemplateReader
{
    /**
     * @const TEMPLATE_DIR The location of template files, relative to web root
     */
    const TEMPLATE_DIR = 'templates/';

    /**
     * Parse the named template and return the template results
     *
     * @param string $templateName
     * @param array $args
     * @return string
     * @throws Exception on error reading or parsing template
     */
    public static function parseTemplate(string $templateName, array $args =[]) : string {
        ob_start();

        require "{$_SERVER['DOCUMENT_ROOT']}/" . APP_PATH . self::TEMPLATE_DIR . "{$templateName}.php";

        $result = ob_get_clean();

        if ($result === false) {
            throw new Exception("Error parsing template '{$templateName}'");
        }

        return $result;
    }
}