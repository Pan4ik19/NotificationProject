<?php

namespace app\Jobs\Notifications;


use App\Mail\DemoMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendEmailJob implements ShouldQueue
{
    use Queueable;

    public const birthdayKey = 0;
    public const communicateKey = 1;
    public const twoWeeksBirthdayKey = 2;

    private const bladeNamesArray = [
        SendEmailJob::birthdayKey => 'birthday',
        SendEmailJob::communicateKey => 'communicate',
        SendEmailJob::twoWeeksBirthdayKey => 'in_two_weeks'
    ];
    private string $userName;
    private string $email;
    private string $bladeName;


    /**
     * Create a new job instance.
     */
    public function __construct(string $userName, string $email, int $bladeKey)
    {
        $this->userName = $userName;
        $this->email = $email;
        $this->bladeName = SendEmailJob::bladeNamesArray[$bladeKey] ?? '';
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            Mail::to($this->email)->send(new DemoMail($this->userName, $this->bladeName));
        } catch (\Throwable $exception) {
            echo $exception->getMessage();
        }
    }
}
