<?php

class LoginFormCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(1);

    }

    public function sendFeedbackSuccessfully(\FunctionalTester $I)
    {
        $I->amOnRoute('feedback/create');
        $I->submitForm('form', [
            'Feedback[nome]' => 'Mario',
            'Feedback[email]' => 'aspoi@auiop.com',
            'Feedback[idade]' => '45',
            'Feedback[feedback]' => 'Nd',
        ]);
        $I->expectTo('Encontrar registro na base de Dados');
        $result=$I->grabRecord('\app\models\Feedback',[
            'nome' => 'Mario',
            'email' => 'aspoi@auiop.com',
            'idade' => '45',
            'feedback' => 'Nd',
        ]);
        $I->assertNotEquals($result,null);
    }

    public function sendInvalidEmail(\FunctionalTester $I)
{
    // Simulando o envio de um formulário de feedback com um email inválido
    $I->amOnRoute('feedback/create');
    $I->submitForm('form', [
        'Feedback[nome]' => 'Mario',
        'Feedback[email]' => 'email@invalidouiop98.com', // Email com domínio inválido (sem MX)
        'Feedback[idade]' => '25',
        'Feedback[feedback]' => 'Teste com email inválido',
    ]);

    $I->see("\"E-mail\" não é um endereço de e-mail válido.");
    $I->expectTo('Não encontrar registro na base de Dados');
    $result=$I->dontSeeRecord('\app\models\Feedback', [
        'nome' => 'Mario',
        'email' => 'email@invalidouiop98.com',
        'idade' => '25',
        'feedback' => 'Teste com email inválido',
    ]);
    $I->assertEquals($result,null);
}


}