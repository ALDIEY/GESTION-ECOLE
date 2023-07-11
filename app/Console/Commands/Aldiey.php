<?php

namespace App\Console\Commands;

use App\Mail\EventMail;
use App\Mail\EventOwnerMail;
use App\Models\Evenement;
use Illuminate\Console\Command;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\EventReminderMail;
use App\Mail\EventStudentMail;
use App\Mail\SendingMails;
use App\Models\Classe;
use App\Models\Eleve;
use App\Models\EvenClass;
use App\Models\Inscription;
use App\Models\User;

use Illuminate\Http\Request;

class Aldiey extends Command 
{
    // Reste du code...
    /**
* The name and signature of the console command.
*
* @var string
*/
protected $signature = 'app:aldiey';


/**
 * The console command description.
 *
 * @var string
 */
protected $description = 'Command description';

/**
 * Execute the console command.
 */
    
    public function handle(Request $request)
    {
        // Mail::mailer('smtp')->raw('mail accepter', function ($message) {
        //     $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
        //     $message->to('kiriririririr12345@gmail.com');
        //     $message->subject('tester');
        // });
        // $eventId = $request->input('event_id');
    //     $tomorrow = Carbon::now()->addDay();
    //     $eventId = \App\Models\Evenement::whereDate('date', $tomorrow)->get();

    // // dd($eventId);
    //     $eventClasses = EvenClass::where('evenement_id', $eventId)->get();
    //     $event = Evenement::find($eventId);
    //     // dd( $eventClasses);
    //     // Récupérer l'email de l'utilisateur propriétaire
    //     if ($event) {
    //         // Récupérer l'email du propriétaire
    //         $ownerEmail = User::find($event->user_id)->email;
    //         // dd($ownerEmail);
    //     }
        
    //     // Envoyer le mailable au propriétaire 
    //     if (isset($ownerEmail)) { 
    //         Mail::to($ownerEmail)->send(new EventOwnerMail($event));
    //     }    
    //     foreach ($eventClasses as $eventClass){
    //         $classId = $eventClass->classe_id;
              
    //         $students = Inscription::where('classe_id', $classId)->get();
                    
    //         foreach($students as $student){
    //             $studentId = $student->eleve_id;
    //             $email = Eleve::where('id', $studentId)->first()->email;
    //             dd(  $email);
    //             Mail::to($email)->send(new EventStudentMail($event));
    //          }  
    //     }
    $tomorrow = Carbon::now()->addDay();
    $events = \App\Models\Evenement::whereDate('date', $tomorrow)->get();

    foreach ($events as $event) {
        $this->info($event);
        $user = \App\Models\User::where('id', $event->user_id)->select('email', 'name')->first();
        $subject = 'Rappels d\'evenements';
        $user_email = $user->email;
        $user_name = $user->name;
        $this->info($user_email);
        $this->info($user_name);

        $classeId = $event->even_classe()->select('classe_id')->first();
        $this->info($classeId);
        $inscriptions = Inscription::where('classe_id', $classeId->classe_id)->get();
        $this->info($inscriptions);
        $id_eleve = $inscriptions->pluck('eleve_id');
        $this->info($id_eleve);
        foreach ($id_eleve as $el){
            $this->info($el);
            $student = Eleve::where('id', $el)->select('email', 'nom', 'prenom')->first();
            $this->info($student->email);

            $message = "Bonjour {$student->prenom} {$student->nom} nous tenons à
            vous informer de l'événement {$event->libelle} qui aura lieu demain inshaAllah.";
            Mail::to($student->email)->send(new SendingMails($subject, $message));
        }
        $message = "Bonjour {$user_name} nous tenons à vous informer de l'événement
         {$event->libelle} que vous aviez plannifié aura lieu demain inshaAllah.";
        Mail::to($user_email)->send(new SendingMails($subject, $message));
    }

}
}