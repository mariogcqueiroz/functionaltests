<?php

class LoginFormCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(1);
        $I->amOnRoute('feedback/create');
    }

    public function sendFeedbackSuccessfully(\FunctionalTester $I)
    {
        $I->submitForm('form', [
            'Feedback[nome]' => 'Alessandro',
            'Feedback[email]' => 'asdsd@asdasd.com',
            'Feedback[idade]' => '23',
            'Feedback[feedback]' => 'Nda a delcarar',
        ]);
        $I->expectTo('Encontrar registro na base de Dados');
        $result=$I->grabRecord('\app\models\Feedback',[
            'nome' => 'Alessandro',
            'email' => 'asdsd@asdasd.com',
            'idade' => '23',
            'feedback' => 'Nda a delcarar',
        ]);
        $I->assertNotEquals($result,null);
    }

}