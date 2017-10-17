<?php

use \Illuminate\Foundation\Testing\DatabaseTransactions;

class FeatureTestCase extends TestCase
{
    use DatabaseTransactions;

    public function seeErrors(array $fields)
    {
        foreach ($fields as $name => $erros) {
            foreach((array) $erros as $message){
                $this->seeInElement(
                    "#field_{$name}.has-error .help-block", $message
                );
            }
        }
    }
}
