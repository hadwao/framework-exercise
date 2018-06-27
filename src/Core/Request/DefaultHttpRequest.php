<?php
/**
 * @license http://creatuity.com/license
 * @copyright Copyright (c) 2008-2018 Creatuity Corp. (http://www.creatuity.com/)
 */

namespace Core\Request;


class DefaultHttpRequest extends HttpRequest
{

    public function __construct()
    {
        parent::__construct($_POST, $_GET, $_SERVER);
    }

}