<?php

namespace App\Services\Language\EN\Response;

class ResponseMessage
{
    public function storeMessage($module = '', $code = 201)
    {
        return ['message' => ucfirst(substr($module, 0, -1)) . ' has been created', 'code' => $code];
    }
    public function updateMessage($module = '', $code = 201)
    {
        return ['message' => ucfirst(substr($module, 0, -1)) . ' has been updated', 'code' => $code];
    }
    public function destroyMessage($module = '', $code = 201)
    {
        return ['message' => ucfirst(substr($module, 0, -1)) . ' has been deleted', 'code' => $code];
    }
    public function permanentDelete($module = '', $code = 201)
    {
        return ['message' => ucfirst(substr($module, 0, -1)) . ' has been delete permanently', 'code' => $code];
    }
    public function restoreMessage($module = '', $code = 201)
    {
        return ['message' => ucfirst(substr($module, 0, -1)) . ' has been restored', 'code' => $code];
    }
    public function loginMessage($module = '', $code = 201)
    {
        return ['message' => ucfirst(substr($module, 0, -1)) . ' login successfully', 'code' => $code];
    }
    public function logoutMessage($module = '', $code = 200)
    {
        return ['message' => 'You have successfully logged out', 'code' => $code];
    }
}
