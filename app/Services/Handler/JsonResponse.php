<?php

namespace App\Services\Handler;

use App\Services\Language\EN\Response\ResponseMessage as EN;


class JsonResponse
{
    public $language;
    public $code = 200;
    public $status = 'Success';
    public $message = '';
    public $data = [];

    public function __construct(EN $EN)
    {
        $this->language = ['en' => $EN];
    }

    public function success($data)
    {
        return $this->data($data);
    }


    public function data($data = [])
    {

        $this->data = $data;

        unset($this->language);

        return response()->json($this);
    }

    public function choseLang($language)
    {
        $this->language = $this->language[$language];

        return $this;
    }

    public function modeMessage($mode, $module)
    {
        $messageStatus = [];
        if ($mode == 'login') $messageStatus = $this->language->loginMessage($module, 200);
        if ($mode == 'logout') $messageStatus = $this->language->logoutMessage($module, 200);
        if ($mode == 'create') $messageStatus = $this->language->storeMessage($module, 201);
        if ($mode == 'update') $messageStatus = $this->language->updateMessage($module, 200);
        if ($mode == 'delete') $messageStatus = $this->language->destroyMessage($module, 200);
        if ($mode == 'force') $messageStatus = $this->language->permanentDelete($module, 200);
        if ($mode == 'restore') $messageStatus = $this->language->restoreMessage($module, 200);
        if ($mode == 'index') $messageStatus = ['message' => 'data ' . $module, 'code' => 200];
        if ($mode == 'show') $messageStatus = ['message' => 'data ' . $module, 'code' => 200];
        if ($messageStatus)  $this->message = $messageStatus['message'];
        if ($messageStatus) $this->code = $messageStatus['code'];
        return $this;
    }
}
