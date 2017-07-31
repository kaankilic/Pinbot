<?php

namespace Kaankilic\Pinbot\Api\Traits;

use Kaankilic\Pinbot\Api\Response;
use Kaankilic\Pinbot\Helpers\UrlBuilder;

trait SendsRegisterActions
{
    use HandlesRequest;

    /**
     * @var array
     */
    protected $firstStepActions = [
        ['name' => 'unauth.signup_step_1.completed']
    ];

    /**
     * @var array
     */
    protected $secondStepActions = [
        ["name" => "multi_step_step_2_complete"],
        ["name" => "signup_home_page"],
        ["name" => "signup_referrer.other"],
        ["name" => "signup_referrer_module.unauth_home_react_page"],
        ["name" => "unauth.signup_step_2.completed"],
        ["name" => "setting_new_window_location"],
    ];

    /**
     * @return bool|Response
     */
    protected function sendEmailVerificationAction()
    {
        return $this->sendRegisterActionRequest($this->firstStepActions);
    }

    /**
     * @return bool
     */
    protected function sendRegistrationActions()
    {
        if(!$this->sendRegisterActionRequest($this->secondStepActions)) {
            return false;
        }

        return $this->sendRegisterActionRequest();
    }


    /**
     * @param array $actions
     * @return bool|Response
     */
    protected function sendRegisterActionRequest($actions = [])
    {
        return $this->post(
            ['secondStepActions' => $actions], UrlBuilder::RESOURCE_UPDATE_REGISTRATION_TRACK
        );
    }
}