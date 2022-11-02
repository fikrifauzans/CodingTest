<?php

namespace App\Services\Validator;

use App\Services\Language\EN\Validator\RuleAndMessage as EN;
use Illuminate\Support\Facades\Validator;


class CustomValidator
{
    protected  $lang;


    public function __construct(EN $en)
    {
        $this->lang =  ['en' => $en];
    }

    public function getLanguage($language)
    {
        return $language;
    }

    public  function validate($request, string $language, string $module)
    {
        if ($language) $datalanguage  =  $this->lang[$language];

        if ($datalanguage && $module) {

            $rules = $datalanguage->validator[$module]['rules'] ? $datalanguage->validator[$module]['rules'] : [];

            $messages = $datalanguage->validator[$module]['messages'] ?  $datalanguage->validator[$module]['messages'] : [];
        }
        $validated = Validator::make($request->all(), $rules, $messages);

        return $validated;
    }
}
