<?php 
namespace Commands;

interface CommandInterface
{
    public function handle($argv);

}