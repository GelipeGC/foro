<?php

use App\Token;
use App\Mail\TokenMail;
use Illuminate\Support\Facades\Mail;



class RequestTokenTest extends FeatureTestCase
{
    public function test_a_guest_user_can_request_a_token()
    { 
        //Having
        Mail::fake();

        $user = $this->defaultUser(['email' => 'fguzman@test.com']);

        //When
        $this->visitRoute('token')
            ->type('fguzman@test.com', 'email')
            ->press('Solicitar token');
        // Then a new token is created in the database
        $token = Token::where('user_id', $user->id)->first();

        $this->assertNotNull($token, 'A token was not created');

        // And sent to the user
        Mail::assertSentTo($user, TokenMail::class, function($mail) use($token){
            return $mail->token->id == $token->id;
        });

        $this->dontSeeIsAuthenticated();

        $this->see('Enviamos a tu email un enlace para que inicies sesión');

        
    }

    public function test_a_guest_user_can_request_a_token_without_an_email()
    {
        //Having
        Mail::fake();


        //When
        $this->visitRoute('token')
            ->press('Solicitar token');
        // Then a new token is NOT created in the database
        $token = Token::first();

        $this->assertNull($token, 'A token was created');

        // And sent to the user
        Mail::assertNotSent(TokenMail::class);

        $this->dontSeeIsAuthenticated();

        $this->seeErrors([
            'email' => 'El campo correo electrónico es obligatorio'
        ]);
    }

    public function test_a_guest_user_can_request_a_token_an_invalid_email()
    {
        //Having
        Mail::fake();

        //When
        $this->visitRoute('token')
            ->type('fguzman', 'email')
            ->press('Solicitar token');
       

        $this->seeErrors([
            'email' => 'Correo electrónico no es un correo válido'
        ]);
    }
    public function test_a_guest_user_can_request_a_token_with_a_non_existent_email()
    {
        $this->defaultUser(['email' => 'fguzman@test.com']);

        //When
        $this->visitRoute('token')
            ->type('test@test.com', 'email')
            ->press('Solicitar token');
       

        $this->seeErrors([
            'email' => 'Este correo electrónico no existe'
        ]);
    }
}
