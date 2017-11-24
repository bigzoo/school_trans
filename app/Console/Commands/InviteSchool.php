<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Mail;
use App\Mail\InviteSchool as InviteSchoolMail;
use App\School;

class InviteSchool extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'invite:school
                            {name}
                            {email}
                            ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends a unique link for inviting a school to the platform.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(){
      // Pluck variables from submited data and generate a maigic string
      $name  = $this->argument('name');
      $email = $this->argument('email');
      $magic_word = substr(md5(mt_rand()), 0, 25);

      // Create the school
      $school = $this->create([
        'name' => $name,
        'email' => $email,
        'magic_word' => $magic_word
      ]);

      // Send the school email invitation
      $this->info("Sending invite email to '$name'");
      Mail::to($email)->send(new InviteSchoolMail($school));

      // Give information
      $this->info("Email sent to '$name' successfully.");
    }

    protected function create(array $data){
      return  School::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'magic_word' => $data['magic_word']
      ]);
    }
}
