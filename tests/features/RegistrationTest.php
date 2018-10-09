<?php

use App\User;
use App\Token;
use App\Mail\TokenMail;
use Illuminate\Support\Facades\Mail;

class RegistrationTest extends FeatureTestCase
{
    
    public function test_a_user_create_an_account()
    { 
        Mail::fake();
        
        $this->visitRoute('register')
            ->type('test@test.com', 'email')
            ->type('fguzman', 'username')
            ->type('Felipe', 'first_name')
            ->type('Guzman', 'last_name')
            ->press('Regístrate');

        $this->seeInDatabase('users', [
            'email' => 'test@test.com',
            'username' => 'fguzman',
            'first_name' => 'Felipe',
            'last_name' => 'Guzman'
        ]);

        $user = User::first();

        $this->seeInDatabase('tokens', [
            'user_id' => $user->id
        ]);
        
        $token = Token::where('user_id', $user->id)->firstOrFail(); 
        Mail::assertSentTo($user, TokenMail::class, function($mail) use($token){
            return $mail->token->id == $token->id;
        });

       
    }
}
